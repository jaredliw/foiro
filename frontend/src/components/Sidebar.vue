<template>
  <v-navigation-drawer permanent expand-on-hover>
    <v-list>
      <v-list-item class="px-2">
        <v-list-item-avatar class="my-1">
          <avatar :username="myName" :size="40"></avatar>
        </v-list-item-avatar>
        <v-list-item-content class="py-1">
          <v-list-item-title class="text-h6">
            {{ myName }}
          </v-list-item-title>
          <v-list-item-subtitle>{{ myUsername }}</v-list-item-subtitle>
        </v-list-item-content>
        <v-list-item-action class="my-1" @click="logout()">
          <v-btn icon>
            <v-icon color="error">mdi-logout</v-icon>
          </v-btn>
        </v-list-item-action>
      </v-list-item>
    </v-list>

    <v-divider></v-divider>

    <v-list nav dense>
      <v-list-item-group mandatory v-model="selectedNavItem">
        <v-list-item
          v-for="item in navItems"
          :key="item.text"
          :href="item.href"
        >
          <v-list-item-icon>
            <v-icon>{{ item.icon }}</v-icon>
          </v-list-item-icon>
          <v-list-item-title>{{ item.text }}</v-list-item-title>
        </v-list-item>
      </v-list-item-group>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
import Avatar from "vue-avatar";

export default {
  name: "Sidebar",
  components: {
    Avatar,
  },
  data() {
    return {
      myName: "",
      myUsername: "",
      navItems: [
        {
          icon: "mdi-account-multiple",
          text: "Pengguna",
          href: "/admin/student", // Warning: always use absolute path
        },
        {
          icon: "mdi-town-hall",
          text: "Sekolah",
          href: "/admin/school",
        },
        {
          icon: "mdi-calendar-star",
          text: "Pertandingan",
          href: "/admin/contest",
        },
      ],
    };
  },
  computed: {
    selectedNavItem() {
      for (let i = 0; i < this.navItems.length; i++) {
        if (this.$route.path === this.navItems[i].href) {
          return i;
        }
      }
      return -1; // Still default to the first item
    },
  },
  methods: {
    getUserInfo() {
      this.axios
        .get("/api/me")
        .then((response) => {
          console.log(response);
          this.myUsername = response.data["data"]["username"];
          this.myName = response.data["data"]["name"];
        })
        .catch(() => {
          this.$swal.fire({
            icon: "error",
            title: "Data pengguna tidak dapat dimuatkan.",
          });
        });
    },
    logout() {
      this.axios
        .get("/api/logout")
        .then(() => {
          this.$router.push("/login");
        })
        .catch(() => {
          this.$swal.fire({
            icon: "error",
            title: "Ralat yang tidak diketahui berlaku.",
          });
        });
    },
  },
  mounted() {
    this.getUserInfo();
  },
};
</script>

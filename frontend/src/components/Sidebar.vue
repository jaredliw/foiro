<template>
  <v-navigation-drawer expand-on-hover permanent>
    <v-list>
      <v-list-item class="px-2">
        <v-list-item-avatar class="my-1">
          <avatar :size="40" :username="myName"></avatar>
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

    <v-list dense nav>
      <v-list-item-group mandatory>
        <template v-for="item in navItems">
          <v-list-group
            v-if="item.children"
            :prepend-icon="item.icon"
            :key="item.text"
          >
            <template v-slot:activator>
              <v-list-item-content>
                <v-list-item-title>{{ item.text }}</v-list-item-title>
              </v-list-item-content>
            </template>
            <v-list-item
              v-for="child in item.children"
              :key="child.text"
              link
              :href="child.href"
            >
              <v-list-item-icon>
                <v-icon>{{ child.icon }}</v-icon>
              </v-list-item-icon>
              <v-list-item-title>{{ child.text }}</v-list-item-title>
            </v-list-item>
          </v-list-group>

          <v-list-item v-else :href="item.href" :key="item.text">
            <v-list-item-icon>
              <v-icon>{{ item.icon }}</v-icon>
            </v-list-item-icon>
            <v-list-item-title>{{ item.text }}</v-list-item-title>
          </v-list-item>
        </template>
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
          icon: "mdi-account-school-outline",
          text: "Pelajar",
          href: "/admin/student", // Warning: always use absolute path
        },
        {
          icon: "mdi-account-tie-hat-outline",
          text: "Hakim",
          href: "/admin/judge",
        },
        {
          icon: "mdi-town-hall",
          text: "Sekolah",
          href: "/admin/school",
        },
        {
          icon: "mdi-calendar-star",
          text: "Pertandingan",
          children: [
            {
              icon: "mdi-newspaper",
              text: "Acara",
              href: "/admin/contest",
            },
            {
              icon: "mdi-badge-account-horizontal-outline",
              text: "Pendaftaran Pelajar",
              href: "/admin/contest/student",
            },
            {
              icon: "mdi-ballot-outline",
              text: "Pendaftaran Hakim",
              href: "/admin/contest/judge",
            },
            {
              icon: "mdi-note-search-outline",
              text: "Keputusan",
              href: "/admin/contest/result",
            },
          ],
        },
      ],
    };
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
            title: "Data akaun anda tidak dapat dimuatkan.",
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

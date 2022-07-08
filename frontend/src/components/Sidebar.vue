<template>
  <v-navigation-drawer
    :expand-on-hover="$vuetify.breakpoint.smAndUp"
    :permanent="$vuetify.breakpoint.smAndUp"
    :temporary="$vuetify.breakpoint.xsOnly"
    :absolute="$vuetify.breakpoint.xsOnly"
    v-model="state"
  >
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
        <!-- .v-list-item--active will be added to this dummy hidden item -->
        <!-- We don't want to have active style applied on our list items (due
        to its tree structure) -->
        <v-list-item class="d-none"></v-list-item>
        <template
          v-for="item in navItems.filter((value) =>
            value.accessibleBy.includes(myRole)
          )"
        >
          <v-list-group
            v-if="item.children"
            :key="item.text"
            :prepend-icon="item.icon"
          >
            <template v-slot:activator>
              <v-list-item-content>
                <v-list-item-title>{{ item.text }}</v-list-item-title>
              </v-list-item-content>
            </template>
            <v-list-item
              v-for="child in item.children.filter((value) =>
                value.accessibleBy.includes(myRole)
              )"
              :key="child.text"
              :href="child.href"
              link
            >
              <v-list-item-icon>
                <v-icon>{{ child.icon }}</v-icon>
              </v-list-item-icon>
              <v-list-item-title>{{ child.text }}</v-list-item-title>
            </v-list-item>
          </v-list-group>

          <v-list-item v-else :key="item.text" :href="item.href">
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
      state: false,
      myName: "",
      myUsername: "",
      myRole: "",
      navItems: [
        {
          icon: "mdi-account-details-outline",
          text: "Maklumat Diri",
          href: "/dashboard", // Warning: always use absolute path
          accessibleBy: ["Pelajar", "Hakim"],
        },
        {
          icon: "mdi-account-school-outline",
          text: "Pelajar",
          href: "/student",
          accessibleBy: ["Admin"],
        },
        {
          icon: "mdi-account-tie-hat-outline",
          text: "Hakim",
          href: "/judge",
          accessibleBy: ["Admin"],
        },
        {
          icon: "mdi-town-hall",
          text: "Sekolah",
          href: "/school",
          accessibleBy: ["Admin"],
        },
        {
          icon: "mdi-calendar-star",
          text: "Pertandingan",
          accessibleBy: ["Pelajar", "Hakim", "Admin"],
          children: [
            {
              icon: "mdi-newspaper",
              text: "Acara",
              href: "/contest",
              accessibleBy: ["Admin"],
            },
            {
              icon: "mdi-badge-account-horizontal-outline",
              text: "Pendaftaran Pelajar",
              href: "/contest/student",
              accessibleBy: ["Admin"],
            },
            {
              icon: "mdi-ballot-outline",
              text: "Pendaftaran Hakim",
              href: "/contest/judge",
              accessibleBy: ["Admin"],
            },
            {
              icon: "mdi-counter",
              text: "Pemarkahan",
              href: "/contest/scoring",
              accessibleBy: ["Hakim"],
            },
            {
              icon: "mdi-counter",
              text: "Papan Markah",
              href: "/contest/scoreboard",
              accessibleBy: ["Admin"],
            },
            {
              icon: "mdi-note-search-outline",
              text: "Keputusan",
              href: "/contest/result",
              accessibleBy: ["Pelajar", "Hakim", "Admin"],
            },
          ],
        },
      ],
    };
  },
  methods: {
    triggerOpen() {
      this.state = true;
    },
    getUserInfo() {
      this.axios
        .get("/api/me")
        .then((response) => {
          this.myUsername = response.data["data"]["username"];
          this.myName = response.data["data"]["name"];
          this.myRole = response.data["data"]["role"];
        })
        .catch(() => {
          this.fireErrorToast("Data akaun tidak dapat dimuatkan.");
        });
    },
    logout() {
      this.axios
        .get("/api/logout")
        .then(() => {
          this.$router.push("/login");
        })
        .catch(() => {
          this.fireErrorToast();
        });
    },
  },
  mounted() {
    this.getUserInfo();
  },
};
</script>

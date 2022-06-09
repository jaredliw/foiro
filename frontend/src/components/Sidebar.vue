<template>
  <v-navigation-drawer permanent expand-on-hover>
    <v-list>
      <v-list-item class="px-2">
        <v-list-item-avatar class="my-1">
          <avatar username="Jared Liw Zhi Long" :size="40"></avatar>
        </v-list-item-avatar>
        <v-list-item-content class="py-1">
          <v-list-item-title class="text-h6">
            Jared Liw Zhi Long
          </v-list-item-title>
          <v-list-item-subtitle>jaredliw</v-list-item-subtitle>
        </v-list-item-content>
        <v-list-item-action class="my-1">
          <v-btn icon>
            <v-icon color="error">mdi-logout</v-icon>
          </v-btn>
        </v-list-item-action>
      </v-list-item>
    </v-list>

    <v-divider></v-divider>

    <v-list nav dense>
      <v-list-item-group mandatory v-model="selectedNavItem">
        <v-list-item link v-for="item in navItems" :key="item.text">
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
      selectedNavItem: 0,
      navItems: [
        {
          icon: "mdi-account-multiple",
          text: "Pengguna",
        },
        {
          icon: "mdi-town-hall",
          text: "Sekolah",
        },
        {
          icon: "mdi-calendar-star",
          text: "Pertandingan",
        },
      ],
    };
  },
};
</script>

<template>
  <v-app>
    <router-view v-slot="{ Component }">
      <transition mode="out-in" name="fade">
        <component :is="Component"></component>
      </transition>
    </router-view>
    <link
      href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900"
      rel="stylesheet"
    />
  </v-app>
</template>

<script>
export default {
  name: "App",
  metaInfo: {
    // If no subcomponents specify a metaInfo.title, this title will be used
    title: "Laman Utama",
    // All titles will be injected into this template
    titleTemplate: "%s | Sistem Pengurusan Pertandingan",
  },
};
</script>

<!--suppress CssUnusedSymbol -->
<style>
@import "~sweetalert2/dist/sweetalert2.min.css";
@import "~@mdi/font/css/materialdesignicons.min.css";
@import "~vuetify/dist/vuetify.min.css";

html {
  /* Vuetify uses a slightly modified version of ress reset which by default turns on the html scrollbar to normalize
  behavior between browsers. We disable this functionality here. */
  overflow-y: auto;
  /* Smallest screen size supported. */
  min-width: 320px;
}

.swal2-title {
  font-family: Roboto, sans-serif !important;
  font-weight: 400 !important;
}
</style>

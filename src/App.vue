<template>
  <router-view v-slot="{ Component }">
    <transition name="fade" mode="out-in">
      <component :is="Component"></component>
    </transition>
  </router-view>
</template>

<script>
export default {
  name: "App",
  metaInfo: {
    // if no subcomponents specify a metaInfo.title, this title will be used
    title: "Laman Utama",
    // all titles will be injected into this template
    titleTemplate: "%s | Sistem Pengurusan Pertandingan",
  },
};
</script>

<style lang="scss">
$primary: #6868ab;
$body-color: #3a5743;

@import "../node_modules/bootstrap/scss/bootstrap";
@import "../node_modules/@fortawesome/fontawesome-free/css/fontawesome.min.css";
@import "../node_modules/@fortawesome/fontawesome-free/css/solid.min.css";
@import "../node_modules/sweetalert2/dist/sweetalert2.min.css";

@font-face {
  font-family: MontserratLight;
  src: url(assets/fonts/Montserrat/Montserrat-Light.ttf);
  font-style: normal;
  font-weight: 200;
}

@font-face {
  font-family: Montserrat;
  src: url(assets/fonts/Montserrat/Montserrat-Regular.ttf);
  font-style: normal;
  font-weight: normal;
}

html,
body {
  height: 100%;
  width: 100%;
}
</style>

import Vue from "vue";
import VueAxios from "vue-axios";
import VueMeta from "vue-meta";
import VueSweetalert2 from "vue-sweetalert2";
import axios from "axios";

import App from "./App";
import router from "./router";
import vuetify from "./plugins/vuetify";

import "sweetalert2/dist/sweetalert2.all.min.js";

Vue.config.productionTip = false;
Vue.use(VueMeta);
Vue.use(VueAxios, axios);
Vue.use(VueSweetalert2, {
  toast: true,
  position: "bottom-end",
  showConfirmButton: false,
  timer: 2000,
});
Vue.mixin({
  methods: {
    fireSuccessToast(message) {
      this.$swal.fire({
        icon: "success",
        title: message ?? "Berjaya.",
      });
    },
    fireErrorToast(message) {
      this.$swal.fire({
        icon: "error",
        title: message ?? "Ralat yang tidak diketahui berlaku.",
      });
    },
  },
});

new Vue({
  router,
  vuetify,
  render: (h) => h(App),
}).$mount("#app");

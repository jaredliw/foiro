<template>
  <v-container fluid fill-height class="pa-0">
    <sidebar id="sidebar"></sidebar>
    <v-container id="main" fill-height class="align-content-start">
      <v-row class="mb-2 mt-4 align-center">
        <v-col cols="6">
          <h5 class="text-h5 font-weight-medium">{{ title }}</h5>
        </v-col>
        <v-col cols="6">
          <div class="d-flex justify-end">
            <slot name="action-bar"></slot>
          </div>
        </v-col>
      </v-row>
      <slot></slot>
    </v-container>
  </v-container>
</template>

<script>
import Sidebar from "@/components/Sidebar";

export default {
  name: "Page",
  components: {
    Sidebar,
  },
  props: {
    title: {
      type: String,
      required: true,
    },
  },
  metaInfo() {
    return {
      title: this.title,
    };
  },
};
</script>

<style scoped>
/* animation */
#main {
  animation-name: fadeInFromTop;
  animation-duration: 0.4s;
  animation-delay: 50ms;
  animation-timing-function: ease-out;
}

@keyframes fadeInFromTop {
  from {
    opacity: 0;
    transform: translateY(-30px);
  }
  to {
    opacity: 1;
    transform: none;
  }
}

#sidebar {
  animation-name: fadeInFromLeft;
  animation-duration: 0.4s;
  animation-timing-function: ease-out;
}

@keyframes fadeInFromLeft {
  from {
    opacity: 0;
    transform: translateX(-80px);
  }
  to {
    opacity: 1;
    transform: none;
  }
}

@media print {
  #sidebar {
    display: none;
  }
}
</style>

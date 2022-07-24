<template>
  <v-container class="pa-0" fill-height fluid>
    <sidebar id="sidebar" ref="sidebar"></sidebar>
    <v-container id="main" fill-height :class="$vuetify.breakpoint.smOnly ? 'pa-3 align-content-start' : 'align-content-start'">
      <v-row class="mb-2 mt-4 align-center">
        <v-col
          :cols="noActionBar ? 12 : 7"
          :md="noActionBar ? 12 : 6"
          class="d-flex align-content-center"
        >
          <v-btn
            icon
            @click.stop="$refs.sidebar.triggerOpen()"
            v-if="$vuetify.breakpoint.mdAndDown"
          >
            <v-icon>mdi-menu</v-icon>
          </v-btn>
          <h5 class="text-h5 font-weight-medium text-truncate align-self-center">
            {{ title }}
          </h5>
        </v-col>
        <v-col cols="5" :md="6" v-if="!noActionBar">
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
    noActionBar: {
      type: Boolean,
      default: false,
    }
  },
  metaInfo() {
    return {
      title: this.title,
    };
  },
  data() {
    return {
      navigationDrawer: false,
    };
  },
};
</script>

<style scoped>
/* animation */
#main {
  animation-delay: 50ms;
  animation-duration: 0.4s;
  animation-name: fadeInFromTop;
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
  animation-duration: 0.4s;
  animation-name: fadeInFromLeft;
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

<template>
  <v-dialog v-model="dialog" max-width="500px">
    <v-card>
      <v-card-title>
        <h5 class="text-h5">{{ formTitle }}</h5>
      </v-card-title>

      <v-card-text>
        <v-container>
          <slot></slot>
        </v-container>
      </v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn
          color="blue darken-1"
          text
          @click="$emit('close')"
          >Batal</v-btn
        >
        <v-btn
          color="blue darken-1"
          text
          @click="
            save();
            $emit('close');
          "
          >Terus</v-btn
        >
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  name: "FormDialog",
  props: {
    dialog: {
      type: Boolean,
    },
    formTitle: {
      type: String,
      default: "",
    },
    save: {
      type: Function,
    },
  },
};
</script>

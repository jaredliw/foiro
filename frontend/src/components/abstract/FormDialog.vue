<template>
  <v-dialog v-model="dialog" max-width="800px">
    <v-card>
      <v-card-title>
        <h5 class="text-h5">{{ formTitle }}</h5>
      </v-card-title>

      <v-card-text>
        <v-container>
          <v-form ref="form">
            <slot></slot>
          </v-form>
        </v-container>
      </v-card-text>

      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="close()">Batal</v-btn>
        <v-btn
          color="blue darken-1"
          text
          @click="
            save();
            close();
          "
        >
          Terus
        </v-btn>
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
  methods: {
    close() {
      this.$refs.form.reset();
      this.$emit("close");
    },
  },
};
</script>

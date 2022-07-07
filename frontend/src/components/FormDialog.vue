<template>
  <v-dialog v-model="dialog" max-width="700px" persistent>
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
        <v-btn color="blue darken-1" text @click="closeHandler()">Batal</v-btn>
        <v-btn color="blue darken-1" text @click="saveHandler()">Terus</v-btn>
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
      required: true,
    },
    formTitle: {
      type: String,
      default: "",
    },
    save: {
      type: Function,
      required: true,
    },
    close: {
      type: Function,
      default: () => {},
    },
  },
  methods: {
    saveHandler() {
      let isValid = this.$refs.form.validate();
      if (isValid) {
        this.save();
      }
    },
    closeHandler() {
      this.$refs.form.reset();
      this.close();
      this.$emit("close");
    },
  },
};
</script>

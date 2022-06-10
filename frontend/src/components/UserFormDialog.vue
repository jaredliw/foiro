<template>
  <form-dialog
    form-title="Tambah Pengguna"
    :save="addUser"
    :dialog="dialog"
    v-on:close="$emit('close')"
  >
    <v-row>
      <v-col cols="12" sm="6" md="4">
        <v-text-field label="Dessert name"></v-text-field>
      </v-col>
      <v-col cols="12" sm="6" md="4">
        <v-text-field label="Calories"></v-text-field>
      </v-col>
      <v-col cols="12" sm="6" md="4">
        <v-text-field label="Fat (g)"></v-text-field>
      </v-col>
      <v-col cols="12" sm="6" md="4">
        <v-text-field label="Carbs (g)"></v-text-field>
      </v-col>
      <v-col cols="12" sm="6" md="4">
        <v-text-field label="Protein (g)"></v-text-field>
      </v-col>
    </v-row>
  </form-dialog>
</template>

<script>
import FormDialog from "@/components/abstract/FormDialog";

export default {
  name: "UserFormDialog",
  components: {
    FormDialog,
  },
  props: {
    dialog: Boolean,
  },
  methods: {
    addUser() {
      console.log("addUser");
    },
  },
};
</script>

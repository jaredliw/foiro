<template>
  <form-dialog
    ref="dialog"
    :dialog="dialog"
    :form-title="updateMode ? 'Kemas Kini Sekolah' : 'Tambah Sekolah Baharu'"
    :save="addSchool"
    v-on:close="$emit('close')"
  >
    <v-row>
      <v-col cols="6">
        <v-text-field
          v-model="code"
          :readonly="updateMode"
          :rules="[
            rules.required,
            rules.fixedLength(7),
            rules.schoolCodeFormat,
          ]"
          label="Kod Sekolah"
          @keyup="uppercaseCode"
        ></v-text-field>
      </v-col>
      <v-col cols="6">
        <v-text-field
          v-model="name"
          :rules="[
            rules.required,
            rules.maxLength(80),
            rules.asciiPrintableOnly,
            rules.containsAlpha,
          ]"
          counter="80"
          label="Nama sekolah"
        ></v-text-field>
      </v-col>
    </v-row>
  </form-dialog>
</template>

<script>
import FormDialog from "@/components/abstract/FormDialog";
import Validation from "./utils/validation.js";

export default {
  name: "SchoolFormDialog",
  components: {
    FormDialog,
  },
  props: {
    dialog: {
      type: Boolean,
      required: true,
    },
    updateMode: {
      type: Boolean,
      default: false,
    },
    apiUrl: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      code: "",
      name: "",
      rules: Validation.rules,
    };
  },
  methods: {
    uppercaseCode() {
      this.code = this.code.toUpperCase();
    },
    addSchool() {
      this.axios({
        method: this.updateMode ? "PUT" : "POST",
        url: this.apiUrl,
        data: {
          code: this.code,
          name: this.name,
        },
      })
        .then((response) => {
          this.fireSuccessToast(response.data["message"]);
          // noinspection JSUnresolvedFunction
          this.$parent.$parent.loadAll();
          this.$refs.dialog.close();
        })
        .catch((error) => {
          this.fireErrorToast(error.response.data["message"]);
        });
    },
    setItem(item) {
      this.code = item.code;
      this.name = item.name;
    },
  },
};
</script>

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
      password: "",
      confirmPassword: "",
      school: null,
      showPassword: false,
      showConfirmPassword: false,
      schools: [],
      rules: {
        required: (v) => !!v || "Ruangan ini wajib diisi.",
        fixedLength: (length) => (v) =>
          (v && v.length >= length) || `Panjangnya ${length} aksara.`,
        maxLength: (length) => (v) =>
          (v && v.length <= length) || `Panjang maksimum ${length} aksara.`,
        schoolCodeFormat: (v) =>
          (v && /^[A-Z]{3}\d{4}$/.test(v)) ||
          "Kod sekolah tidak sah, contoh: ABC1234.",
        asciiPrintableOnly: (v) =>
          /^[ -~]+$/.test(v) ||
          "Hanya abjad, nombor, ruang dan simbol dibenarkan.",
        containsAlpha: (v) => /[A-Za-z]/.test(v) || "Mesti mengandungi abjad.",
      },
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
          this.$swal.fire({
            icon: "success",
            title: response.data["message"],
          });
          this.$parent.loadAll();
          this.$refs.dialog.close();
        })
        .catch((error) => {
          this.$swal.fire({
            icon: "error",
            title:
              error.response.data["message"] ??
              "Ralat yang tidak diketahui berlaku.",
          });
        });
    },
    setItem(item) {
      this.code = item.code;
      this.name = item.name;
    },
  },
};
</script>

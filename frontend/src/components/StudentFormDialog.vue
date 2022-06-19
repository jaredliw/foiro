<template>
  <form-dialog
    ref="dialog"
    :dialog="dialog"
    :form-title="updateMode ? 'Kemas Kini Pelajar' : 'Tambah Pelajar Baharu'"
    :save="addStudent"
    v-on:close="$emit('close')"
  >
    <v-row>
      <v-col cols="6">
        <!-- todo readonly-->
        <v-text-field
          v-model="username"
          :readonly="updateMode"
          :rules="[
            rules.required,
            rules.minLength(3),
            rules.maxLength(15),
            rules.alnumUnderscoreOnly,
          ]"
          counter="15"
          label="Nama Pengguna"
          @keyup="lowercaseUsername"
        ></v-text-field>
      </v-col>
      <v-col cols="6">
        <v-text-field
          v-model="name"
          :rules="[
            rules.required,
            rules.maxLength(80),
            rules.alphaSpaceOnly,
            rules.containsAlpha,
          ]"
          counter="80"
          label="Nama"
        ></v-text-field>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="6">
        <v-text-field
          v-model="password"
          :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
          :label="updateMode ? 'Kata Laluan Baharu (jika ada)' : 'Kata Laluan'"
          :rules="passwordRules"
          :type="showPassword ? 'text' : 'password'"
          @click:append="showPassword = !showPassword"
        ></v-text-field>
      </v-col>
      <v-col cols="6">
        <v-text-field
          v-model="confirmPassword"
          :append-icon="showConfirmPassword ? 'mdi-eye' : 'mdi-eye-off'"
          :label="
            updateMode
              ? 'Sahkan Kata Laluan Baharu (jika ada)'
              : 'Sahkan Kata Laluan'
          "
          :rules="confirmPasswordRules"
          :type="showConfirmPassword ? 'text' : 'password'"
          @click:append="showConfirmPassword = !showConfirmPassword"
        ></v-text-field>
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <v-select
          label="Sekolah"
          no-data-text="Tiada rekod."
          :items="schools"
          v-model="school"
        ></v-select>
      </v-col>
    </v-row>
  </form-dialog>
</template>

<script>
import FormDialog from "@/components/abstract/FormDialog";

export default {
  name: "StudentFormDialog",
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
      username: "",
      name: "",
      password: "",
      confirmPassword: "",
      school: null,
      showPassword: false,
      showConfirmPassword: false,
      schools: [],
      rules: {
        required: (v) => !!v || "Ruangan ini wajib diisi.",
        minLength: (length) => (v) =>
          (v && v.length >= length) || `Panjang minimum ${length} aksara.`,
        maxLength: (length) => (v) =>
          (v && v.length <= length) || `Panjang maksimum ${length} aksara.`,
        alnumUnderscoreOnly: (v) =>
          /^\w+$/.test(v) ||
          "Hanya nombor, abjad dan tanda garis bawah dibenarkan.",
        alphaSpaceOnly: (v) =>
          /^[a-zA-Z ]+$/.test(v) || "Hanya abjad dan ruang dibenarkan.",
        asciiPrintableOnly: (v) =>
          /^[ -~]+$/.test(v) ||
          "Hanya abjad, nombor, ruang dan simbol dibenarkan.",
        containsLowercase: (v) =>
          /[a-z]/.test(v) || "Mesti mengandungi abjad huruf kecil.",
        containsUppercase: (v) =>
          /[A-Z]/.test(v) || "Mesti mengandungi abjad huruf besar.",
        containsAlpha: (v) => /[A-Za-z]/.test(v) || "Mesti mengandungi abjad.",
        containsNumber: (v) => /\d/.test(v) || "Mesti mengandungi nombor.",
        containsSymbol: (v) =>
          /[!"#$%&'()*+,-./:;<=>?@[\]^_`{|}~]/.test(v) ||
          "Mesti mengandungi simbol.",
        passwordMatch: (v) =>
          v === this.password || "Kata laluan tidak sepadan.",
      },
    };
  },
  methods: {
    lowercaseUsername() {
      this.username = this.username.toLowerCase();
    },
    addStudent() {
      this.axios({
        method: this.updateMode ? "PUT" : "POST",
        url: this.apiUrl,
        data: {
          username: this.username,
          name: this.name,
          password: this.password,
          school: this.school,
        },
      })
        .then((response) => {
          this.$swal.fire({
            icon: "success",
            title: response.data["message"],
          });
          this.showPassword = false;
          this.showConfirmPassword = false;
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
      this.username = item.username;
      this.name = item.name;
      this.school = item.school;
    },
  },
  async mounted() {
    this.schools = await this.axios
      .get("/api/admin/school")
      .then((response) => {
        return [
          {
            text: "Sila pilih",
            value: null,
          },
          ...response.data["data"].map((school) => {
            return {
              text: `(${school["code"]}) ${school["name"]}`,
              value: school["code"],
            };
          }),
        ];
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
  computed: {
    passwordRules() {
      return this.updateMode && !this.password
        ? []
        : [
            this.rules.required,
            this.rules.minLength(8),
            this.rules.maxLength(12),
            this.rules.asciiPrintableOnly,
            this.rules.containsLowercase,
            this.rules.containsUppercase,
            this.rules.containsNumber,
            this.rules.containsSymbol,
          ];
    },
    confirmPasswordRules() {
      return this.updateMode && !this.confirmPassword
        ? []
        : [this.rules.required, this.rules.passwordMatch];
    },
  },
};
</script>

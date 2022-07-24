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
      <v-col cols="12">
        <v-select
          v-model="school"
          :items="schools"
          append-outer-icon="mdi-close"
          label="Sekolah (jika ada)"
          no-data-text="Tiada rekod."
          @click:append-outer="school = null"
        ></v-select>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12">
        <v-autocomplete
          v-model="selectedContests"
          :items="contests"
          chips
          label="Pertandingan yang Disertai (jika ada)"
          multiple
          small-chips
        ></v-autocomplete>
      </v-col>
    </v-row>
  </form-dialog>
</template>

<script>
import FormDialog from "@/components/FormDialog";
import Validation from "./utils/validation.js";

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
      selectedContests: [],
      contests: [],
      rules: Validation.rules,
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
          contests: this.selectedContests,
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
      this.username = item.username;
      this.name = item.name;
      this.school = item.school;
      this.selectedContests = item.contests;
    },
  },
  async mounted() {
    this.schools = await this.axios
      .get("/api/school")
      .then((response) => {
        return response.data["data"].map((school) => {
          return {
            text: `(${school["code"]}) ${school["name"]}`,
            value: school["code"],
          };
        });
      })
      .catch((error) => {
        this.fireErrorToast(error.response.data["message"]);
      });

    this.contests = await this.axios
      .get("/api/contest")
      .then((response) => {
        return response.data["data"].map((contests) => {
          return {
            text: contests["name"],
            value: contests["id"],
          };
        });
      })
      .catch((error) => {
        this.fireErrorToast(error.response.data["message"]);
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
        : [this.rules.required, this.rules.passwordMatch(this.password)];
    },
  },
};
</script>

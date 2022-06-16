<template>
  <form-dialog
    ref="dialog"
    :form-title="updateMode ? 'Kemas Kini Pengguna' : 'Tambah Pengguna'"
    :save="addUser"
    :dialog="dialog"
    v-on:close="$emit('close')"
  >
    <v-row>
      <v-col cols="6">
        <v-text-field
          label="Nama Pengguna"
          counter="15"
          :rules="[
            rules.required,
            rules.minLength(3),
            rules.maxLength(15),
            rules.alnumUnderscoreOnly,
          ]"
          v-model="username"
          :readonly="updateMode"
        ></v-text-field>
      </v-col>
      <v-col cols="6">
        <v-text-field
          label="Nama"
          counter="80"
          :rules="[
            rules.required,
            rules.maxLength(80),
            rules.alphaSpaceOnly,
            rules.containsAlpha,
          ]"
          v-model="name"
        ></v-text-field>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="6">
        <v-text-field
          :label="updateMode ? 'Kata Laluan Baharu (jika ada)' : 'Kata Laluan'"
          :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
          :type="showPassword ? 'text' : 'password'"
          @click:append="showPassword = !showPassword"
          :rules="[
            rules.optional(rules.required),
            rules.optional(rules.minLength(8)),
            rules.optional(rules.maxLength(12)),
            rules.optional(rules.asciiPrintableOnly),
            rules.optional(rules.containsLowercase),
            rules.optional(rules.containsUppercase),
            rules.optional(rules.containsNumber),
            rules.optional(rules.containsSymbol),
          ]"
          v-model="password"
          :validate-on-blur="true"
        ></v-text-field>
      </v-col>
      <v-col cols="6">
        <v-text-field
          :label="
            updateMode
              ? 'Sahkan Kata Laluan Baharu (jika ada)'
              : 'Sahkan Kata Laluan'
          "
          :append-icon="showConfirmPassword ? 'mdi-eye' : 'mdi-eye-off'"
          :type="showConfirmPassword ? 'text' : 'password'"
          @click:append="showConfirmPassword = !showConfirmPassword"
          :rules="[
            rules.optional(rules.required),
            rules.optional(rules.passwordMatch),
          ]"
          :validate-on-blur="true"
        ></v-text-field>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="6">
        <v-radio-group row label="Jantina" v-model="gender" mandatory>
          <v-radio value="M" color="primary">
            <template v-slot:label>
              <span :class="{ 'primary--text': gender === 'M' }">Lelaki</span>
            </template>
          </v-radio>
          <v-radio value="F" color="pink">
            <template v-slot:label>
              <span :class="{ 'pink--text': gender === 'F' }">Perempuan</span>
            </template>
          </v-radio>
        </v-radio-group>
      </v-col>
      <v-col cols="6">
        <v-select label="Sekolah" no-data-text="Tiada rekod."></v-select>
      </v-col>
    </v-row>
    <v-row>
      <v-col>
        <v-radio-group row label="Peranan" v-model="role" mandatory>
          <v-radio value="student">
            <template v-slot:label>
              <span :class="{ 'primary--text': role === 'student' }">
                Pelajar
              </span>
            </template>
          </v-radio>
          <v-radio value="judge">
            <template v-slot:label>
              <span :class="{ 'primary--text': role === 'judge' }">
                Hakim
              </span>
            </template>
          </v-radio>
          <v-radio value="admin">
            <template v-slot:label>
              <span :class="{ 'primary--text': role === 'admin' }">
                Admin
              </span>
            </template>
          </v-radio>
        </v-radio-group>
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
    updateMode: {
      type: Boolean,
      default: false,
    },
  },
  data() {
    return {
      username: "",
      name: "",
      password: "",
      gender: "M",
      role: "student",
      showPassword: false,
      showConfirmPassword: false,
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
          /[a-z]/.test(v) || "Mesti mengandungi huruf kecil.",
        containsUppercase: (v) =>
          /[A-Z]/.test(v) || "Mesti mengandungi huruf besar.",
        containsAlpha: (v) => /[A-Za-z]/.test(v) || "Mesti mengandungi abjad.",
        containsNumber: (v) => /\d/.test(v) || "Mesti mengandungi nombor.",
        containsSymbol: (v) =>
          /[!"#$%&'()*+,-./:;<=>?@[\]^_`{|}~]/.test(v) ||
          "Mesti mengandungi simbol.",
        passwordMatch: (v) =>
          v === this.password || "Kata laluan tidak sepadan.",
        // If updateMode is true, then the field is optional.
        optional: (f) => (v) => (this.updateMode && !v) || f(v),
      },
    };
  },
  methods: {
    addUser() {
      this.axios({
        method: "POST",
        url: "/api/admin/user",
        data: {
          username: this.username,
          name: this.name,
          password: this.password,
          gender: this.gender,
          role: this.role,
        },
      })
        .then((response) => {
          this.$swal.fire({
            icon: "success",
            title: response.data["message"],
          });
          this.showPassword = false;
          this.showConfirmPassword = false;
          this.$parent.loadAllUsers();
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
    setUsername(username) {
      this.username = username;
    },
    setName(name) {
      this.name = name;
    },
    setRole(role) {
      this.role = role;
    },
  },
};
</script>

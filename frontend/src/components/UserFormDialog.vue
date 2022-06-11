<template>
  <form-dialog
    form-title="Tambah Pengguna"
    :save="addUser"
    :dialog="dialog"
    v-on:close="$emit('close')"
  >
    <v-row>
      <v-col cols="6">
        <v-text-field
          label="Nama Pengguna"
          counter="15"
          required
          aria-required="true"
          :rules="[
            rules.required,
            rules.minLength(3),
            rules.maxLength(15),
            rules.alnumUnderscoreOnly,
          ]"
          v-model="username"
        ></v-text-field>
      </v-col>
      <v-col cols="6">
        <v-text-field
          label="Nama"
          counter="80"
          required
          aria-required="true"
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
          label="Kata Laluan"
          :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
          :type="showPassword ? 'text' : 'password'"
          @click:append="showPassword = !showPassword"
          required
          aria-required="true"
          :rules="[
            rules.required,
            rules.minLength(8),
            rules.maxLength(12),
            rules.asciiPrintableOnly,
            rules.containsLowercase,
            rules.containsUppercase,
            rules.containsNumber,
            rules.containsSymbol,
          ]"
          v-model="password"
        ></v-text-field>
      </v-col>
      <v-col cols="6">
        <v-text-field
          label="Sahkan Kata Laluan"
          :append-icon="showConfirmPassword ? 'mdi-eye' : 'mdi-eye-off'"
          :type="showConfirmPassword ? 'text' : 'password'"
          @click:append="showConfirmPassword = !showConfirmPassword"
          required
          aria-required="true"
          :rules="[rules.required, rules.passwordMatch]"
        ></v-text-field>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="6">
        <v-radio-group
          row
          label="Jantina"
          v-model="gender"
          required
          aria-required="true"
        >
          <v-radio value="M" color="primary">
            <template v-slot:label>
              <span :class="{ 'primary--text': gender === 'M' }">Lelaki</span>
            </template>
          </v-radio>
          <v-radio value="P" color="pink">
            <template v-slot:label>
              <span :class="{ 'pink--text': gender === 'P' }">Perempuan</span>
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
        <v-radio-group
          row
          label="Peranan"
          v-model="role"
          required
          aria-required="true"
        >
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
        containsAlpha: (v) =>
          this.rules.containsLowercase(v) ||
          this.rules.containsUppercase(v) ||
          "Mesti mengandungi abjad.",
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
    addUser() {
      console.log("addUser");
    },
  },
};
</script>

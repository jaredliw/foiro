<template>
  <form-dialog
    ref="dialog"
    :dialog="dialog"
    :form-title="
      updateMode ? 'Kemas Kini Pertandingan' : 'Tambah Pertandingan Baharu'
    "
    :save="addContest"
    v-on:close="$emit('close')"
  >
    <v-row>
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
          label="Acara"
        ></v-text-field>
      </v-col>
      <v-col cols="6">
        <v-menu
          v-model="menu"
          :close-on-content-click="false"
          :nudge-right="40"
          transition="scale-transition"
          offset-y
          min-width="auto"
        >
          <template v-slot:activator="{ on, attrs }">
            <v-text-field
              v-model="date"
              label="Tarikh"
              prepend-icon="mdi-calendar"
              v-bind="attrs"
              v-on="on"
            ></v-text-field>
          </template>
          <v-date-picker v-model="date" @input="menu = false"></v-date-picker>
        </v-menu>
      </v-col>
    </v-row>
  </form-dialog>
</template>

<script>
import FormDialog from "@/components/abstract/FormDialog";
import moment from "moment";

export default {
  name: "ContestFormDialog",
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
      menu: false,
      contest_id: null,
      name: "",
      date: this.getTodayDate(),
      rules: {
        required: (v) => !!v || "Ruangan ini wajib diisi.",
        maxLength: (length) => (v) =>
          (v && v.length <= length) || `Panjang maksimum ${length} aksara.`,
        asciiPrintableOnly: (v) =>
          /^[ -~]+$/.test(v) ||
          "Hanya abjad, nombor, ruang dan simbol dibenarkan.",
        containsAlpha: (v) => /[A-Za-z]/.test(v) || "Mesti mengandungi abjad.",
      },
    };
  },
  methods: {
    getTodayDate() {
      return moment().format("YYYY-MM-DD");
    },
    addContest() {
      let data = {
        name: this.name,
        date: this.date,
      };
      if (this.updateMode) {
        data.id = this.contest_id;
      }

      this.axios({
        method: this.updateMode ? "PUT" : "POST",
        url: this.apiUrl,
        data: data,
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
      this.contest_id = item.id;
      this.name = item.name;
      this.date = item.date;
    },
  },
  watch: {
    dialog(valOfDialog) {
      if (valOfDialog === true) {
        this.date = this.getTodayDate();
      }
    },
  },
};
</script>

<template>
  <form-dialog
    ref="dialog"
    :dialog="dialog"
    form-title="Import CSV"
    :save="importToDatabase"
    :close="resetAll"
    v-on:close="$emit('close')"
  >
    <v-row>
      <v-col cols="12">
        <span class="caption text--secondary">
          Petunjuk: Format fail CSV anda haruslah mengikut
          <a href="/csv/pelajar.csv" download>templat ini</a>.
        </span>
      </v-col>
    </v-row>
    <v-row
      class="d-flex flex-column pb-6 grey lighten-4"
      dense
      align="center"
      justify="center"
      @drop.prevent="
        dragStateCounter = 0;
        onDrop($event);
      "
      @dragenter.prevent="dragStateCounter++"
      @dragover.prevent
      @dragleave.prevent="dragStateCounter--"
      @click="$refs.fileInput.click()"
      :class="{ 'lighten-2': dragStateCounter > 0 }"
      style="cursor: pointer"
    >
      <v-icon
        :class="[dragStateCounter > 0 ? 'mt-3, mb-9' : 'mt-8']"
        size="60"
        >mdi-cloud-upload</v-icon
      >
      <p class="subtitle-1 text--secondary">
        Klik atau lepaskan fail anda di sini.
      </p>
      <input
        ref="fileInput"
        type="file"
        class="d-none"
        accept=".csv"
        @click="$refs.fileInput.value = null"
        @change="onFileChange"
      /><!-- Clear value everytime the input is clicked, or else @change won't be triggered if the same file is chosen. -->
    </v-row>
    <v-row dense v-if="uploadedFile !== null">
      <v-col cols="12">
        <v-list-item>
          <v-list-item-content>
            <v-list-item-title>
              {{ uploadedFile.name }}
              <span class="ml-3 text--secondary">
                {{
                  formatFileSize(uploadedFile.size, (si = false))
                }}
              </span>
            </v-list-item-title>
          </v-list-item-content>
          <v-list-item-action class="my-0">
            <v-btn
              @click.stop="
                uploadedFile = null;
                csvContent = null;
              "
              icon
            >
              <v-icon>mdi-close-circle</v-icon>
            </v-btn>
          </v-list-item-action>
        </v-list-item>
      </v-col>
    </v-row>
  </form-dialog>
</template>

<script>
import Papa from "papaparse";
import Format from "./utils/format.js";
import FormDialog from "@/components/FormDialog";

export default {
  name: "UploadFileDialog",
  components: {
    FormDialog,
  },
  props: {
    dialog: {
      type: Boolean,
      required: true,
    },
  },
  data() {
    return {
      dragStateCounter: 0,
      uploadedFile: null,
      csvContent: null,
      formatFileSize: Format.formatFileSize,
      errorFlag: false,
    };
  },
  methods: {
    onDrop(e) {
      if (e.dataTransfer.files.length > 1) {
        this.fireErrorToast("Hanya satu fail sahaja diterima pada satu masa.");
        return;
      }
      this.processFile(e.dataTransfer.files[0]);
    },
    onFileChange(e) {
      this.processFile(e.target.files[0]);
    },
    processFile(file) {
      if (file.type !== "text/csv") {
        this.fireErrorToast("Hanya fail CSV diterima.");
        return;
      }
      if (file.size > 500 * 1024 * 1024) {
        this.fireErrorToast("Had saiz fail ialah 500 MB.");
        return;
      }
      this.uploadedFile = file;

      this.doneProcessing = false;
      Papa.parse(file, {
        header: true,
        dynamicTyping: true,
        complete: (results) => {
          if (results.error) {
            this.errorFlag = true;
          }
          this.csvContent = results.data;
        },
      });
    },
    resetAll() {
      this.dragStateCounter = 0;
      this.uploadedFile = null;
      this.csvContent = null;
      this.errorFlag = false;
    },
    importToDatabase() {
      if (!this.csvContent) {
        this.fireErrorToast("Sila muat naik fail CSV anda.");
        return;
      }
      if (this.errorFlag) {
        this.fireErrorToast("Tidak dapat proses fail yang dimuat naik.")
        return;
      }

      let filtered = [];
      let keys = {
        "Nama Pengguna": "username",
        "Nama": "name",
        "Kata Laluan": "password",
        "Kod Sekolah": "school",
      }
      for (let row of this.csvContent) {
        let item = {};
        for (let [key, value] of Object.entries(keys)) {
          item[value] = row[key];
        }
        filtered.push(item);
      }

      this.axios
        .post("/api/admin/student", {
          bulk: true,
          students: filtered,
        })
        .then((response) => {
          this.fireSuccessToast(response.data["message"]);
        })
        .catch((error) => {
          this.fireErrorToast(error.response.data["message"]);
        });
    },
  },
};
</script>
<template>
  <form-dialog
    ref="dialog"
    :close="resetAll"
    :dialog="dialog"
    :save="importToDatabase"
    form-title="Import CSV"
    v-on:close="$emit('close')"
  >
    <v-row v-if="templateHref">
      <v-col cols="12">
        <span class="caption text--secondary">
          Petunjuk: Format fail CSV anda haruslah mengikut
          <a download :href="templateHref">templat ini</a>.
        </span>
      </v-col>
    </v-row>
    <v-row
      :class="{ 'lighten-2': dragStateCounter > 0 }"
      align="center"
      class="d-flex flex-column pb-6 grey lighten-4"
      dense
      justify="center"
      style="cursor: pointer"
      @click="$refs.fileInput.click()"
      @drop.prevent="
        dragStateCounter = 0;
        onDrop($event);
      "
      @dragenter.prevent="dragStateCounter++"
      @dragover.prevent
      @dragleave.prevent="dragStateCounter--"
    >
      <v-icon :class="[dragStateCounter > 0 ? 'mt-3, mb-9' : 'mt-8']" size="60"
        >mdi-cloud-upload
      </v-icon>
      <p class="subtitle-1 text--secondary">
        Klik atau lepaskan fail anda di sini.
      </p>
      <input
        ref="fileInput"
        accept=".csv"
        class="d-none"
        type="file"
        @change="onFileChange"
        @click="$refs.fileInput.value = null"
      />
      <!-- Clear value everytime the input is clicked, or else @change won't be triggered if the same file is chosen. -->
    </v-row>
    <v-row v-if="uploadedFile !== null" dense>
      <v-col cols="12">
        <v-list-item>
          <v-list-item-content>
            <v-list-item-title>
              {{ uploadedFile.name }}
              <span class="ml-3 text--secondary">
                {{ formatFileSize(uploadedFile.size, (si = false)) }}
              </span>
            </v-list-item-title>
          </v-list-item-content>
          <v-list-item-action class="my-0">
            <v-btn
              icon
              @click.stop="
                uploadedFile = null;
                csvContent = null;
              "
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
    templateHref: {
      type: String,
    },
    apiUrl: {
      type: String,
      required: true,
    },
    keyMappings: {
      type: Object,
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

      Papa.parse(file, {
        header: true,
        dynamicTyping: true,
        skipEmptyLines: true,
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
        this.fireErrorToast("Tidak dapat proses fail yang dimuat naik.");
        return;
      }

      let filtered = [];
      for (let row of this.csvContent) {
        let item = {};
        for (let [key, value] of Object.entries(this.keyMappings)) {
          item[value] = row[key];
        }
        filtered.push(item);
      }

      this.axios
        .post(this.apiUrl, {
          bulk: true,
          items: filtered,
        })
        .then((response) => {
          this.fireSuccessToast(response.data["message"]);
          this.$parent.$parent.loadAll();
          this.resetAll();
          this.$emit('close');
        })
        .catch((error) => {
          this.fireErrorToast(error.response.data["message"]);
        });
    },
  },
};
</script>

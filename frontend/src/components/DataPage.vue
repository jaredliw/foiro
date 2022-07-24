<template>
  <page :title="title" :no-action-bar="noImportCsv && noPrintButton && noCrud">
    <template v-slot:action-bar>
      <v-btn
        v-if="!noImportCsv"
        :class="{ 'me-3': !noPrintButton || !noCrud }"
        @click.stop="uploadFileDialog = true"
        :small="$vuetify.breakpoint.xsOnly"
      >
        <span class="text-uppercase" v-if="$vuetify.breakpoint.smAndUp">
          IMPORT CSV
        </span>
        <v-icon :right="$vuetify.breakpoint.smAndUp">
          mdi-database-import
        </v-icon>
      </v-btn>
      <upload-file-dialog
        :dialog="uploadFileDialog"
        v-on:close="uploadFileDialog = false; loadAll();"
        :template-href="templateHref"
        :api-url="apiUrl"
        :key-mappings="keyMappings"
      ></upload-file-dialog>
      <v-btn
        v-if="!noPrintButton"
        :class="{ 'me-3': !noCrud }"
        @click="print"
        :small="$vuetify.breakpoint.xsOnly"
      >
        <span class="text-uppercase" v-if="$vuetify.breakpoint.smAndUp">
          CETAK
        </span>
        <v-icon :right="$vuetify.breakpoint.smAndUp">mdi-printer</v-icon>
      </v-btn>
      <v-btn
        v-if="!noCrud"
        class="darken-1"
        color="success"
        @click.stop="
          dialog = true;
          dialogUpdateMode = false;
        "
        :small="$vuetify.breakpoint.xsOnly"
      >
        <span class="text-uppercase" v-if="$vuetify.breakpoint.smAndUp">
          TAMBAH
        </span>
        <v-icon :right="$vuetify.breakpoint.smAndUp">mdi-plus</v-icon>
      </v-btn>
      <component
        :is="dialogComponent"
        v-if="!noCrud"
        ref="dialog"
        :api-url="apiUrl"
        :dialog="dialog"
        :updateMode="dialogUpdateMode"
        v-on:close="dialog = false"
      ></component>
    </template>
    <v-row>
      <v-col class="mb-4" cols="12">
        <slot></slot>
        <v-data-table
          ref="dataTable"
          v-model="selected"
          :headers="noCrud ? headers : processedHeaders"
          :item-key="itemKey"
          :items="items"
          :items-per-page="5"
          :loading="is_loading"
          :search="search"
          class="elevation-1"
          loading-text="Data sedang dimuatkan..."
          multi-sort
          show-select
        >
          <template v-slot:top>
            <v-row no-gutters>
              <v-col cols="9" md="6">
                <v-text-field
                  v-model="search"
                  aria-label="Cari"
                  class="mx-4"
                  hide-details
                  placeholder="Cari..."
                  prepend-inner-icon="mdi-magnify"
                >
                </v-text-field>
              </v-col>
              <v-col class="d-flex justify-end align-end" cols="3" md="6">
                <v-btn
                  :style="{ opacity: selected.length >= 1 ? 1 : 0 }"
                  class="mx-4"
                  @click="exportCSV()"
                  :small="$vuetify.breakpoint.xsOnly"
                >
                  <span
                    class="d-none d-sm-inline text-uppercase"
                    v-if="$vuetify.breakpoint.smAndUp"
                  >
                    EKSPORT CSV
                  </span>
                  <v-icon :right="$vuetify.breakpoint.smAndUp"
                    >mdi-database-export</v-icon
                  >
                </v-btn>
              </v-col>
            </v-row>
          </template>
          <template v-slot:item.actions="{ item }">
            <v-icon class="mr-2" color="blue" small @click="editItem(item)">
              mdi-pencil
            </v-icon>
            <v-icon color="red" small @click="deleteItem(item)">
              mdi-delete
            </v-icon>
          </template>
          <template v-slot:no-data>
            <v-card-text>Tiada rekod.</v-card-text>
          </template>
          <template v-slot:no-results>
            <v-card-text>Tiada rekod dijumpai.</v-card-text>
          </template>
        </v-data-table>
      </v-col>
    </v-row>
  </page>
</template>

<script>
import Papa from "papaparse";
import moment from "moment";
import Page from "@/components/Page";
import StudentFormDialog from "@/components/StudentFormDialog";
import JudgeFormDialog from "@/components/JudgeFormDialog";
import SchoolFormDialog from "@/components/SchoolFormDialog";
import ContestFormDialog from "@/components/ContestFormDialog";
import UploadFileDialog from "@/components/UploadFileDialog";

export default {
  name: "DataPage",
  components: {
    Page,
    StudentFormDialog,
    JudgeFormDialog,
    SchoolFormDialog,
    ContestFormDialog,
    UploadFileDialog,
  },
  props: {
    title: {
      type: String,
      required: true,
    },
    headers: {
      type: Array,
      required: true,
    },
    itemKey: {
      type: String,
      required: true,
    },
    apiUrl: {
      type: String,
      required: true,
    },
    dialogComponent: String,
    noCrud: {
      type: Boolean,
      default: false,
    },
    noImportCsv: {
      type: Boolean,
      default: false,
    },
    noPrintButton: {
      type: Boolean,
      default: true,
    },
    // Params to be sent when requesting `apiUrl` with GET method
    getParamsFunc: {
      type: Function,
      default: () => ({}),
    },
    // Do not call `loadAll` on mounted
    lazyLoad: {
      type: Boolean,
      default: false,
    },
    templateHref: {
      type: String,
    },
    keyMappings: {
      type: Object,
      required: true,
    },
  },
  metaInfo() {
    return {
      title: this.title,
    };
  },
  data() {
    return {
      search: "",
      selected: [],
      is_loading: false,
      dialogUpdateMode: false,
      dialog: false,
      uploadFileDialog: false,
      processedHeaders: [
        ...this.headers,
        {
          text: "Tindakan",
          value: "actions",
          sortable: false,
          filterable: false,
        },
      ],
      items: [],
    };
  },
  methods: {
    async loadAll() {
      this.is_loading = true;
      this.axios
        .get(this.apiUrl, {
          params: this.getParamsFunc(),
        })
        .then((response) => {
          this.items = response.data["data"];
        })
        .catch(() => {
          this.fireErrorToast("Data pengguna tidak dapat dimuatkan.");
        });
      this.$refs.dataTable.page = 1;
      this.is_loading = false;
    },
    editItem(item) {
      this.$refs.dialog.setItem(item);
      this.dialogUpdateMode = true;
      this.dialog = true;
    },
    deleteItem(item) {
      this.axios
        .delete(this.apiUrl, {
          data: {
            [this.itemKey]: item[this.itemKey],
          },
        })
        .then((response) => {
          this.fireSuccessToast(response.data["message"]);
          this.loadAll();
        })
        .catch((error) => {
          this.fireErrorToast(error.response.data["message"]);
        });
    },
    exportCSV() {
      // noinspection JSUnresolvedFunction
      let csvContent = Papa.unparse({
        fields: this.headers.map((header) => header.text),
        data: this.selected.map((user) => Object.values(user)),
      });

      let prefix = this.title.toLowerCase().split(" ").join("_");
      let filename = `${prefix}_${moment().format("YYYY-MM-DD_HH-mm-ss")}.csv`;
      let file = new File([csvContent], filename, {
        type: "text/csv;charset=utf-8;",
      });

      this.download(file);
    },
    download(file) {
      let link = document.createElement("a");
      let url = URL.createObjectURL(file);

      link.href = url;
      link.download = file.name;
      document.body.appendChild(link);
      link.click();

      document.body.removeChild(link);
      window.URL.revokeObjectURL(url);
    },
    print() {
      window.print();
    },
  },
  mounted() {
    // Localisation: Change English to Malay manually
    document.getElementsByClassName(
      "v-data-footer__select"
    )[0].childNodes[0].nodeValue = "Bil. baris:";
    document
      .getElementsByClassName("v-data-footer__pagination")[0]
      .childNodes[0].addEventListener("DOMSubtreeModified", (event) => {
        let before = event.target.nodeValue;
        // drpd. === daripada
        let after = before.replaceAll("of", "drpd.");
        // Prevent max call stack size exceeded error
        if (before !== after) {
          event.target.nodeValue = after;
        }
      });

    if (sessionStorage.getItem("show_login_success_toast") === "1") {
      this.fireSuccessToast("Log masuk berjaya.");
      sessionStorage.removeItem("show_login_success_toast");
    }

    if (!this.lazyLoad) {
      this.loadAll();
    }
  },
};
</script>

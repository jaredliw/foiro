<template>
  <main class="d-flex" style="min-height: 100vh">
    <sidebar id="sidebar"></sidebar>

    <v-container>
      <v-row class="mb-2 mt-4 align-center">
        <v-col id="header" class="me-auto" cols="6">
          <h5 class="text-h5 font-weight-medium">{{ title }}</h5>
        </v-col>
        <v-col cols="6">
          <div class="d-flex justify-end">
            <v-btn class="me-3">
              <span class="d-none d-sm-inline text-uppercase">IMPORT CSV</span>
              <v-icon right>mdi-database-import</v-icon>
            </v-btn>
            <v-btn
              class="darken-1"
              color="success"
              @click.stop="
                dialog = true;
                dialogUpdateMode = false;
              "
            >
              <span class="d-none d-sm-inline text-uppercase">TAMBAH</span>
              <v-icon right>mdi-plus</v-icon>
            </v-btn>
            <student-form-dialog
              ref="dialog"
              :dialog="dialog"
              :updateMode="dialogUpdateMode"
              v-on:close="dialog = false"
              :api-url="apiUrl"
            ></student-form-dialog>
          </div>
        </v-col>
      </v-row>
      <div class="row">
        <div class="col-12 mb-4">
          <div class="data-table-container">
            <v-data-table
              v-model="selected"
              :headers="processedHeaders"
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
                  <v-col cols="6">
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
                  <v-col class="d-flex justify-end align-end" cols="6">
                    <v-btn
                      :style="{ opacity: selected.length >= 1 ? 1 : 0 }"
                      class="mx-4"
                      @click="exportCSV()"
                    >
                      <span class="d-none d-sm-inline text-uppercase">
                        EKSPORT CSV
                      </span>
                      <v-icon right>mdi-database-export</v-icon>
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
          </div>
        </div>
      </div>
    </v-container>
  </main>
</template>

<script>
import Papa from "papaparse";
import moment from "moment";
import Sidebar from "@/components/Sidebar";
import StudentFormDialog from "@/components/StudentFormDialog";

export default {
  name: "DataPage",
  components: {
    Sidebar,
    StudentFormDialog,
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
      is_loading: true,
      dialogUpdateMode: false,
      dialog: false,
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
    loadAll() {
      this.is_loading = true;
      this.axios
        .get(this.apiUrl)
        .then((response) => {
          this.items = response.data["data"];
        })
        .catch(() => {
          this.$swal.fire({
            icon: "error",
            title: "Data pengguna tidak dapat dimuatkan.",
          });
        });
      this.is_loading = false;
    },
    editItem(user) {
      this.$refs.dialog.setUsername(user.username);
      this.$refs.dialog.setName(user.name);
      this.$refs.dialog.setRole(user.role);
      this.dialogUpdateMode = true;
      this.dialog = true;
    },
    deleteItem(item) {
      console.log(item);
      console.log({
        [this.itemKey]: item[this.itemKey],
      });
      this.axios
        .delete(this.apiUrl, {
          data: {
            [this.itemKey]: item[this.itemKey],
          },
        })
        .then((response) => {
          this.$swal.fire({
            icon: "success",
            title: response.data["message"],
          });
          this.loadAll();
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
    exportCSV() {
      let csvContent = Papa.unparse({
        fields: ["Nama Pengguna", "Nama", "Peranan"],
        data: this.selected.map((user) => Object.values(user)),
      });

      let filename = `senarai_pengguna_${moment().format(
        "YYYY-MM-DD_HH-mm-ss"
      )}.csv`;
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
  },
  mounted() {
    if (sessionStorage.getItem("show_login_success_toast") === "1") {
      this.$swal.fire({
        icon: "success",
        title: "Log masuk berjaya.",
      });
      sessionStorage.removeItem("show_login_success_toast");
    }
    this.loadAll();
  },
};
</script>

<style scoped>
/* animation */
main {
  animation-name: fadeInFromTop;
  animation-duration: 0.4s;
  animation-delay: 50ms;
  animation-timing-function: ease-out;
}

@keyframes fadeInFromTop {
  from {
    opacity: 0;
    transform: translateY(-30px);
  }
  to {
    opacity: 1;
    transform: none;
  }
}

#sidebar {
  animation-name: fadeInFromLeft;
  animation-duration: 0.4s;
  animation-timing-function: ease-out;
}

@keyframes fadeInFromLeft {
  from {
    opacity: 0;
    transform: translateX(-80px);
  }
  to {
    opacity: 1;
    transform: none;
  }
}
</style>
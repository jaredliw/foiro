<template>
  <main class="d-flex" style="min-height: 100vh">
    <sidebar id="sidebar"></sidebar>

    <v-container>
      <v-row class="mb-2 mt-4 align-center">
        <v-col id="header" cols="6" class="me-auto">
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
            <user-form-dialog
              :dialog="dialog"
              v-on:close="dialog = false"
              :updateMode="dialogUpdateMode"
              ref="dialog"
            ></user-form-dialog>
          </div>
        </v-col>
      </v-row>
      <div class="row">
        <div class="col-12 mb-4">
          <div class="data-table-container">
            <v-data-table
              class="elevation-1"
              :headers="processedHeaders"
              :items="items"
              :items-per-page="5"
              :search="search"
              :loading="is_loading"
              loading-text="Data sedang dimuatkan..."
              v-model="selected"
              :item-key="itemKey"
              multi-sort
              show-select
            >
              <template v-slot:top>
                <v-row no-gutters>
                  <v-col cols="6">
                    <v-text-field
                      v-model="search"
                      prepend-inner-icon="mdi-magnify"
                      class="mx-4"
                      aria-label="Cari"
                      placeholder="Cari..."
                      hide-details
                    >
                    </v-text-field>
                  </v-col>
                  <v-col cols="6" class="d-flex justify-end align-end">
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
                <v-icon small color="blue" class="mr-2" @click="editItem(item)">
                  mdi-pencil
                </v-icon>
                <v-icon small color="red" @click="deleteItem(item)">
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
import UserFormDialog from "@/components/UserFormDialog";

export default {
  name: "DataPage",
  components: {
    Sidebar,
    UserFormDialog,
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

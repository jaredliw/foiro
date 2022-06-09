<template>
  <main class="d-flex" style="min-height: 100vh">
    <sidebar id="sidebar"></sidebar>

    <v-container>
      <v-row class="mb-2 mt-4 align-center">
        <v-col id="header" cols="6" sm="7" class="me-auto">
          <h5 class="text-h5 font-weight-medium">Senarai Pengguna</h5>
        </v-col>
        <v-col cols="6" sm="5">
          <div class="d-flex">
            <v-text-field
              id="searchBar"
              v-model="search"
              prepend-inner-icon="mdi-magnify"
              class="pe-3 d-none d-sm-block"
              aria-label="Cari"
              placeholder="Cari..."
              hide-details
              dense
            />
            <v-btn
              id="addUserBtn"
              class="darken-1"
              color="success"
              data-bs-toggle="modal"
              data-bs-target="#userDataModal"
            >
              <span class="d-none d-sm-inline text-uppercase">TAMBAH</span>
              <v-icon right>mdi-account-plus-outline</v-icon>
            </v-btn>
          </div>
        </v-col>
      </v-row>
      <div class="row">
        <div class="col-12 mb-4">
          <div class="data-table-container">
            <v-data-table
              class="elevation-1"
              :headers="headers"
              :items="users"
              :items-per-page="5"
              :search="search"
              multi-sort
            >
              <template v-slot:item.username="{ item }">
                <v-badge color="success" inline left dot small></v-badge>
                {{ item.username }}
              </template>
              <template v-slot:item.role="{ item }">
                <v-chip
                  class="text-capitalize"
                  :color="getColor(item.role)"
                  dark
                  small
                >
                  {{ item.role }}
                </v-chip>
              </template>
              <template v-slot:item.actions="{ item }">
                <v-icon small color="blue" class="mr-2" @click="editUser(item)">
                  mdi-pencil
                </v-icon>
                <v-icon
                  small
                  color="orange"
                  class="mr-2"
                  @click="suspendUser(item)"
                >
                  mdi-account-cancel
                </v-icon>
                <v-icon small color="red" @click="deleteUser(item)"
                  >mdi-delete
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
import Sidebar from "../components/Sidebar";

export default {
  name: "UserList",
  components: {
    Sidebar,
  },
  metaInfo: {
    title: "Senarai Pengguna",
  },
  data() {
    return {
      search: "",
      headers: [
        {
          text: "Nama Pengguna",
          align: "start",
          value: "username",
        },
        {
          text: "Nama",
          value: "name",
        },
        {
          text: "Peranan",
          value: "role",
        },
        {
          text: "Tindakan",
          value: "actions",
          sortable: false,
          filterable: false,
        },
      ],
      users: [],
    };
  },
  methods: {
    loadAllUsers() {
      this.axios
        .get("/api/admin/user")
        .then((response) => {
          this.users = response.data["data"];
        })
        .catch(() => {
          this.$swal.fire({
            icon: "error",
            title: "Data pengguna tidak dapat dimuatkan.",
          });
        });
    },
    getColor(text) {
      if (text === "admin") {
        return "#8390fa";
      } else if (text === "teacher") {
        return "#fac748";
      } else if (text === "student") {
        return "#f88dad";
      } else {
        return "#f9e9ec";
      }
    },
    editUser(user) {
      console.log(user);
    },
    suspendUser(user) {
      console.log(user);
    },
    deleteUser(user) {
      console.log(user);
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
    this.loadAllUsers();
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

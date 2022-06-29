<template>
  <v-container fluid fill-height class="pa-0">
    <sidebar ref="sidebar"></sidebar>
    <v-container fill-height class="align-content-start">
      <v-row class="mb-2 mt-4 align-center">
        <v-col class="me-auto" cols="12">
          <h5 class="text-h5 font-weight-medium">Papan Pemuka</h5>
        </v-col>
      </v-row>
      <v-row>
        <v-col cols="12" class="mb-4">
          <h6 class="text-h6 font-weight-regular">Maklumat Diri</h6>
          <p class="caption text--secondary">
            Sila menghubungi admin untuk mengemas kini data akaun.
          </p>
          <v-divider class="mb-3"></v-divider>
          <v-container>
            <v-row>
              <v-col cols="3" class="d-flex align-center">
                Nama Pengguna
              </v-col>
              <v-col cols="7">
                <v-text-field
                  outlined
                  dense
                  readonly
                  hide-details
                  v-model="username"
                ></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="3" class="d-flex align-center">Nama</v-col>
              <v-col cols="7">
                <v-text-field
                  outlined
                  dense
                  readonly
                  hide-details
                  v-model="name"
                ></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="3" class="d-flex align-center">Peranan</v-col>
              <v-col cols="7">
                <v-select outlined dense readonly hide-details></v-select>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="3" class="d-flex align-center">Sekolah</v-col>
              <v-col cols="2">
                <v-text-field
                  outlined
                  dense
                  readonly
                  hide-details
                  v-model="schoolCode"
                ></v-text-field>
              </v-col>
              <v-col cols="5">
                <v-text-field
                  outlined
                  dense
                  readonly
                  hide-details
                  v-model="schoolName"
                ></v-text-field>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="3" class="d-flex align-center">
                Pertandingan Terlibat
              </v-col>
              <v-col cols="7">
                <v-autocomplete
                  outlined
                  dense
                  readonly
                  hide-details
                  v-model="contests"
                ></v-autocomplete>
              </v-col>
            </v-row>
          </v-container>
        </v-col>
      </v-row>
    </v-container>
  </v-container>
</template>

<script>
import Sidebar from "@/components/Sidebar";

export default {
  name: "Dashboard",
  components: {
    Sidebar,
  },
  metaInfo: {
    title: "Papan Pemuka",
  },
  data() {
    return {
      name: "",
      username: "",
      role: "",
      schoolCode: "",
      schoolName: "",
      contests: [],
    };
  },
  mounted() {
    this.axios
      .get("/api/me")
      .then((response) => {
        console.log(response);
        this.username = response.data["data"]["username"];
        this.name = response.data["data"]["name"];
        this.role = response.data["data"]["role"];
      })
      .catch(() => {
        this.$swal.fire({
          icon: "error",
          title: "Data akaun anda tidak dapat dimuatkan.",
        });
      });
  },
};
</script>

<template>
  <page title="Papan Pemuka">
    <v-col class="mb-4" cols="12">
      <h6 class="text-h6 font-weight-regular">Maklumat Diri</h6>
      <p class="caption text--secondary">
        Sila menghubungi admin untuk mengemas kini data akaun.
      </p>
      <v-divider class="mb-3"></v-divider>
      <v-container>
        <v-row>
          <v-col class="d-flex align-center" cols="3">Nama Pengguna</v-col>
          <v-col cols="7">
            <v-text-field
              v-model="username"
              dense
              hide-details
              outlined
              readonly
            ></v-text-field>
          </v-col>
        </v-row>
        <v-row>
          <v-col class="d-flex align-center" cols="3">Nama</v-col>
          <v-col cols="7">
            <v-text-field
              v-model="name"
              dense
              hide-details
              outlined
              readonly
            ></v-text-field>
          </v-col>
        </v-row>
        <v-row>
          <v-col class="d-flex align-center" cols="3">Peranan</v-col>
          <v-col cols="7">
            <v-select
              v-model="role"
              :items="[role]"
              dense
              hide-details
              outlined
              readonly
            ></v-select>
          </v-col>
        </v-row>
        <v-row v-if="role === 'Pelajar'">
          <v-col class="d-flex align-center" cols="3">Sekolah</v-col>
          <v-col cols="2">
            <v-text-field
              v-model="schoolCode"
              dense
              hide-details
              outlined
              readonly
            ></v-text-field>
          </v-col>
          <v-col cols="5">
            <v-text-field
              v-model="schoolName"
              dense
              hide-details
              outlined
              readonly
            ></v-text-field>
          </v-col>
        </v-row>
        <v-row>
          <v-col class="d-flex align-center" cols="3">
            Pertandingan Terlibat
          </v-col>
          <v-col cols="7">
            <v-autocomplete
              v-model="contests"
              :items="contests"
              chips
              dense
              hide-details
              multiple
              outlined
              readonly
              small-chips
            ></v-autocomplete>
          </v-col>
        </v-row>
      </v-container>
    </v-col>
  </page>
</template>

<script>
import Page from "@/components/Page";

export default {
  name: "Dashboard",
  components: {
    Page,
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
        this.username = response.data["data"]["username"];
        this.name = response.data["data"]["name"];
        this.role = response.data["data"]["role"];
        this.contests = response.data["data"]["contests"].map((item) => {
          return item["name"];
        });
        this.schoolCode = response.data["data"]["school_code"] ?? "";
        this.schoolName = response.data["data"]["school_name"] ?? "";
      })
      .catch(() => {
        this.fireErrorToast("Data akaun tidak dapat dimuatkan.");
      });
  },
};
</script>

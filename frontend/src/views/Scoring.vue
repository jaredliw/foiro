<template>
  <page title="Pemarkahan">
    <v-row>
      <v-col cols="12">
        <contest-selector v-model="contest"></contest-selector>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12">
        <v-simple-table>
          <template v-slot:default>
            <thead>
              <tr>
                <th class="text-left">Nama Pengguna</th>
                <th class="text-left">Nama</th>
                <th class="text-left" style="max-width: 3ch">Markah</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="item in students" :key="item.username">
                <td>{{ item.student_username }}</td>
                <td>{{ item.student_name }}</td>
                <td style="max-width: 3ch">
                  <v-text-field
                    type="number"
                    min="0"
                    hide-details
                    class="pb-3 pt-2 mb-1"
                    v-model="item.score"
                  ></v-text-field>
                </td>
              </tr>
            </tbody>
          </template>
        </v-simple-table>
      </v-col>
    </v-row>
    <v-row>
      <v-col cols="12" class="d-flex justify-end">
        <v-btn class="darken-1" color="success" @click="save">
          <span class="text-uppercase">SIMPAN</span>
          <v-icon right>mdi-content-save</v-icon>
        </v-btn>
      </v-col>
    </v-row>
  </page>
</template>

<script>
import Page from "@/components/abstract/Page";
import ContestSelector from "@/components/ContestSelector";

export default {
  name: "Scoring",
  components: {
    Page,
    ContestSelector,
  },
  data() {
    return {
      contest: null,
      students: [],
    };
  },
  watch: {
    async contest() {
      this.students = await this.axios
        .get("/api/admin/contest/scoring", {
          params: {
            contest_id: this.contest,
          },
        })
        .then((response) => {
          return response.data["data"];
        })
        .catch((error) => {
          this.fireErrorToast(error.response.data["message"]);
        });
    },
  },
  methods: {
    save() {
      this.axios
        .put("/api/admin/contest/scoring", {
          contest_id: this.contest,
          records: this.students,
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

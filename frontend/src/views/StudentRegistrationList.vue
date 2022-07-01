<template>
  <data-page
    :headers="[
      {
        text: 'Nama Pengguna Pelajar',
        value: 'username',
      },
      {
        text: 'Nama Pelajar',
        value: 'name',
      },
    ]"
    api-url="/api/admin/contest/student"
    :get-params-func="params"
    item-key="username"
    title="Pendaftaran Pelajar"
    :no-crud="true"
    :no-import-csv="true"
    ref="dataPage"
    :lazy-load="true"
  >
    <v-select
      :items="contests"
      label="Pertandingan"
      class="px-6"
      v-model="contest"
    ></v-select>
  </data-page>
</template>

<script>
import DataPage from "@/components/DataPage";

export default {
  name: "StudentRegistrationList",
  components: {
    DataPage,
  },
  data() {
    return {
      contest: null,
      contests: null,
    };
  },
  methods: {
    params() {
      return {
        contest_id: this.contest,
      };
    },
  },
  watch: {
    contest() {
      this.$refs.dataPage.loadAll();
    },
  },
  async mounted() {
    this.contests = await this.axios
      .get("/api/admin/contest")
      .then((response) => {
        return response.data["data"].map((contest) => {
          return {
            text: contest["name"],
            value: contest["id"],
          };
        });
      })
      .catch((error) => {
        this.fireErrorToast(error.response.data["message"]);
      });
    this.contest = this.contests[0]?.value;
  },
};
</script>

<template>
  <data-page
    ref="dataPage"
    :get-params-func="params"
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
    :lazy-load="true"
    :no-crud="true"
    :no-import-csv="true"
    api-url="/api/contest/student"
    item-key="username"
    title="Pendaftaran Pelajar"
  >
    <v-select
      v-model="contest"
      :items="contests"
      class="px-6"
      label="Pertandingan"
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
      .get("/api/contest")
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

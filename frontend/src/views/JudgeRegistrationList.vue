<template>
  <data-page
    ref="dataPage"
    :get-params-func="params"
    :headers="[
      {
        text: 'Nama Pengguna Hakim',
        value: 'username',
      },
      {
        text: 'Nama Hakim',
        value: 'name',
      },
    ]"
    :lazy-load="true"
    :no-crud="true"
    :no-import-csv="true"
    api-url="/api/contest/judge"
    item-key="username"
    title="Pendaftaran Hakim"
  >
    <v-select
      v-model="contest"
      :items="contests"
      class="px-6"
      label="Pertandingan"
      no-data-text="Tiada rekod."
    ></v-select>
  </data-page>
</template>

<script>
import DataPage from "@/components/DataPage";

export default {
  name: "JudgeRegistrationList",
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

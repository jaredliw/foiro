<template>
  <data-page
    ref="dataPage"
    :get-params-func="params"
    :headers="[
      {
        text: 'Kedudukan',
        value: 'rank',
      },
      {
        text: 'Nama Pengguna Pelajar',
        value: 'username',
      },
      {
        text: 'Nama Pelajar',
        value: 'name',
      },
      {
        text: 'Kod Sekolah',
        value: 'school_code',
      },
      {
        text: 'Sekolah',
        value: 'school_name',
      },
    ]"
    :lazy-load="true"
    :no-crud="true"
    :no-import-csv="true"
    :no-print-button="false"
    api-url="/api/contest/result"
    item-key="username"
    title="Keputusan Pertandingan"
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
  name: "Result",
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
    contest(newValue) {
      if (newValue !== void 0) this.$refs.dataPage.loadAll();
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

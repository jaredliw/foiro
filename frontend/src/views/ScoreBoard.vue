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
      {
        text: 'Kod Sekolah',
        value: 'school_code',
      },
      {
        text: 'Sekolah',
        value: 'school_name',
      },
      {
        text: 'Jumlah Markah',
        value: 'total_score',
      },
    ]"
    api-url="/api/admin/contest/result"
    :get-params-func="params"
    item-key="username"
    title="Papan Markah"
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
  name: "ScoreBoard",
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
        this.$swal.fire({
          icon: "error",
          title:
            error.response.data["message"] ??
            "Ralat yang tidak diketahui berlaku.",
        });
      });
    this.contest = this.contests[0]?.value;
  },
};
</script>

<template>
  <v-select
    :items="contests"
    label="Pertandingan"
    class="px-6"
    v-model="contest"
    no-data-text="Tiada rekod."
  ></v-select>
</template>

<script>
export default {
  name: "ContestSelector",
  data() {
    return {
      contest: null,
      contests: null,
    };
  },
  watch: {
    contest() {
      this.$emit("input", this.contest);
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

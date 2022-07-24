<template>
  <data-page
    :headers="[
      {
        text: 'Nama Pengguna',
        value: 'username',
      },
      {
        text: 'Nama',
        value: 'name',
      },
      {
        text: 'Bil. Pertandingan Terlibat',
        value: 'involved_count',
      },
    ]"
    api-url="/api/admin/judge"
    dialog-component="judge-form-dialog"
    item-key="username"
    title="Senarai Hakim"
    template-href="/csv/hakim.csv"
    :key-mappings="{
      'Nama Pengguna': 'username',
      Nama: 'name',
      'Kata Laluan': 'password',
    }"
  ></data-page>
</template>

<script>
import DataPage from "@/components/DataPage";

export default {
  name: "JudgeList",
  components: {
    DataPage,
  },
};
</script>

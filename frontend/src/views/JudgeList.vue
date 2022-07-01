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
    item-key="username"
    title="Senarai Hakim"
    dialog-component="judge-form-dialog"
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

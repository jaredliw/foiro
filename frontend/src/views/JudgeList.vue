<template>
  <data-page
    title="Senarai Hakim"
    :headers="[
      {
        text: 'Nama Pengguna',
        value: 'username',
      },
      {
        text: 'Nama',
        value: 'name',
      },
    ]"
    item-key="username"
    api-url="/api/admin/judge"
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

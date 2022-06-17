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
        text: 'Jantina',
        value: 'gender',
      },
      {
        text: 'Sekolah',
        value: 'school',
      },
    ]"
    api-url="/api/admin/student"
    item-key="username"
    title="Senarai Pelajar"
  ></data-page>
</template>

<script>
import DataPage from "@/components/DataPage";

export default {
  name: "StudentList",
  components: {
    DataPage,
  },
};
</script>
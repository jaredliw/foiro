<template>
  <data-page
    title="Senarai Pelajar"
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
    item-key="username"
    api-url="/api/admin/student"
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

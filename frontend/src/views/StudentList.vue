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
        text: 'Sekolah',
        value: 'school',
      },
      {
        text: 'Bil. Penyertaan',
        value: 'participation_count',
      },
    ]"
    api-url="/api/admin/student"
    dialog-component="student-form-dialog"
    item-key="username"
    title="Senarai Pelajar"
    template-href="/csv/pelajar.csv"
    :key-mappings="{
      'Nama Pengguna': 'username',
      Nama: 'name',
      'Kata Laluan': 'password',
      'Kod Sekolah': 'school',
    }"
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

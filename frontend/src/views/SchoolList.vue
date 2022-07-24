<template>
  <data-page
    :headers="[
      {
        text: 'Kod',
        value: 'code',
      },
      {
        text: 'Nama',
        value: 'name',
      },
      {
        text: 'Bil. Pelajar',
        value: 'student_count',
      },
    ]"
    api-url="/api/admin/school"
    dialog-component="school-form-dialog"
    item-key="code"
    title="Senarai Sekolah"
    template-href="/csv/sekolah.csv"
    :key-mappings="{
      'Kod Sekolah': 'code',
      'Nama Sekolah': 'name',
    }"
  ></data-page>
</template>

<script>
import DataPage from "@/components/DataPage";

export default {
  name: "SchoolList",
  components: {
    DataPage,
  },
};
</script>

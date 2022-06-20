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
    item-key="code"
    title="Senarai Sekolah"
    dialog-component="school-form-dialog"
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
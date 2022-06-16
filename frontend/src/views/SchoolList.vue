<template>
  <data-page
    title="Senarai Sekolah"
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
    item-key="code"
    api-url="/api/admin/school"
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

<style scoped></style>

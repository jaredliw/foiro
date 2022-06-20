<template>
  <data-page
    :headers="[
      {
        text: 'Kod',
        value: 'id',
      },
      {
        text: 'Acara',
        value: 'name',
      },
      {
        text: 'Tarikh',
        value: 'date',
      },
    ]"
    api-url="/api/admin/contest"
    item-key="id"
    title="Senarai Pertandingan"
    dialog-component="contest-form-dialog"
  ></data-page>
</template>

<script>
import DataPage from "@/components/DataPage";

export default {
  name: "ContestList",
  components: {
    DataPage,
  },
};
</script>
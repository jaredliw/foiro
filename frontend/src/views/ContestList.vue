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
    dialog-component="contest-form-dialog"
    item-key="id"
    title="Senarai Pertandingan"
    template-href="/csv/pertandingan.csv"
    :key-mappings="{
      'Nama Pertandingan': 'name',
      'Tarikh': 'date',
    }"
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

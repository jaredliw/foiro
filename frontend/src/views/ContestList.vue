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
        text: 'Tarikh Mula',
        value: 'start_date',
      },
      {
        text: 'Tarikh Tamat',
        value: 'end_date',
      },
    ]"
    api-url="/api/admin/contest"
    item-key="id"
    title="Senarai Pertandingan"
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
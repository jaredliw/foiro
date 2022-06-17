<template>
  <data-page
    title="Senarai Pertandingan"
    :headers="[
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
    item-key="code"
    api-url="/api/admin/contest"
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

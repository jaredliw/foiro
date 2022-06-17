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
        text: 'Peranan',
        value: 'role',
      },
    ]"
    api-url="/api/admin/user"
    item-key="username"
    title="Senarai Pengguna"
  ></data-page>
</template>

<script>
import DataPage from "@/components/DataPage";

export default {
  name: "UserList",
  components: {
    DataPage,
  },
};
</script>
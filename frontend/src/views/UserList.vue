<template>
  <data-page
    title="Senarai Pengguna"
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
    item-key="username"
    api-url="/api/admin/user"
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

<template>
  <v-container
    class="align-center pa-0 pa-md-3"
    d-flex
    fill-height
    fluid
    justify-center
  >
    <component
      :is="$vuetify.breakpoint.xs ? 'div' : 'v-card'"
      class="container--fluid"
      elevation="8"
      height="fit-content"
      max-width="800"
    >
      <v-row>
        <v-col class="pe-0 d-none d-md-block" cols="6">
          <v-img v-if="is_loading_img" style="width: 9999999px"></v-img>
          <v-img
            src="../assets/img/cover.jpg"
            style="height: 100%"
            @load="is_loading_img = false"
          ></v-img>
        </v-col>
        <v-col class="px-0 px-sm-3 ps-md-0" cols="12" md="6">
          <v-container class="px-0 px-sm-8">
            <div class="mt-8 mb-4">
              <v-card-title class="display-1 pt-0">Log Masuk</v-card-title>
              <v-card-subtitle class="subtitle-1 primary--text text--darken-3">
                Sistem Pengurusan Pertandingan
              </v-card-subtitle>
            </div>
            <v-card-text>
              <v-row>
                <v-col>
                  <v-text-field
                    v-model="username"
                    :disabled="is_loading_state"
                    hide-details
                    label="Nama Pengguna"
                    solo
                  ></v-text-field>
                </v-col>
              </v-row>
              <v-row class="mt-5">
                <v-col>
                  <v-text-field
                    v-model="password"
                    :disabled="is_loading_state"
                    hide-details
                    label="Kata Laluan"
                    solo
                    type="password"
                  ></v-text-field>
                </v-col>
              </v-row>
              <v-row>
                <v-col>
                  <v-radio-group
                    v-model="role"
                    :disabled="is_loading_state"
                    class="mt-1 justify-content-around"
                    dense
                    hide-details
                    row
                  >
                    <v-radio label="Pelajar" value="student"></v-radio>
                    <v-radio label="Hakim" value="judge"></v-radio>
                    <v-radio label="Admin" value="admin"></v-radio>
                  </v-radio-group>
                </v-col>
              </v-row>
            </v-card-text>
            <v-card-actions class="mt-12 mb-8">
              <v-btn
                :loading="is_loading_state"
                block
                color="primary"
                @click="login"
                >Log Masuk
              </v-btn>
            </v-card-actions>
          </v-container>
        </v-col>
      </v-row>
    </component>
  </v-container>
</template>

<script>
export default {
  name: "Login",
  metaInfo: {
    title: "Log Masuk",
  },
  data() {
    return {
      username: "",
      password: "",
      role: "student",
      is_loading_state: false,
      is_loading_img: true,
    };
  },
  methods: {
    login(e) {
      e.preventDefault();

      this.is_loading_state = true;
      this.axios
        .post("/api/login", {
          username: this.username,
          password: this.password,
          role: this.role,
        })
        .then((response) => {
          this.fireSuccessToast(response.data["message"]);
          this.$router.push(response.data["data"]["redirect_url"]);
        })
        .catch((error) => {
          this.fireErrorToast(error.response.data["message"]);
        })
        .finally(() => {
          this.is_loading_state = false;
        });
    },
  },
};
</script>

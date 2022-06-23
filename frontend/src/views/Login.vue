<template>
  <v-container
    class="align-center"
    d-flex
    fluid
    justify-center
    style="height: 100vh"
  >
    <v-card
      class="container--fluid"
      elevation="8"
      max-width="800"
      style="height: fit-content"
    >
      <v-row>
        <v-col class="pe-0" cols="6">
          <v-img src="../assets/img/cover.jpg" style="height: 100%"></v-img>
        </v-col>
        <v-col class="ps-0" cols="6">
          <v-container class="px-8">
            <div class="mt-8 mb-4">
              <v-card-title class="display-1 pt-0"> Log Masuk</v-card-title>
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
                    class="mt-1"
                    dense
                    row
                  >
                    <v-radio
                      class="me-auto"
                      label="Pelajar"
                      value="student"
                    ></v-radio>
                    <v-radio
                      class="me-auto"
                      label="Hakim"
                      value="judge"
                    ></v-radio>
                    <v-radio label="Admin" value="admin"></v-radio>
                  </v-radio-group>
                </v-col>
              </v-row>
            </v-card-text>
            <v-card-actions class="mt-10 mb-8">
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
    </v-card>
  </v-container>
</template>

<script>
export default {
  name: "Login",
  data() {
    return {
      username: "",
      password: "",
      role: "student",
      is_loading_state: false,
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
          this.$swal.fire({
            icon: "success",
            title: response.data["message"],
          });
          this.$router.push(response.data["data"]["redirect_url"]);
        })
        .catch((error) => {
          this.$swal.fire({
            icon: "error",
            title:
              error.response.data["message"] ??
              "Ralat yang tidak diketahui berlaku.",
          });
        })
        .finally(() => {
          this.is_loading_state = false;
        });
    },
  },
};
</script>

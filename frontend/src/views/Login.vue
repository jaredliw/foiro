<template>
  <main
    id="loginCard"
    class="container position-absolute top-50 start-50 translate-middle"
  >
    <div class="row">
      <div id="left" class="col col-6 p-0">
        <div
          class="glass p-4 pb-1 m-4 mx-5 text-white position-relative top-50 d-flex flex-column justify-content-between"
        >
          <div>
            <h3 class="fw-light text-capitalize">
              Sistem<br />
              Pengurusan<br />
              Pertandingan
            </h3>
            <p id="subtitle" class="pt-3 lh-1">
              Mencungkil bakat dan minat anda melalui pertandingan.
            </p>
          </div>
          <p id="footer" class="pt-3 lh-1">SMK Tinggi Batu Pahat, 2022.</p>
        </div>
      </div>
      <div id="right" class="col col-6">
        <div class="container p-5 position-relative top-50 translate-middle-y">
          <h2 class="fw-bold mb-0">Log Masuk</h2>
          <p class="fs-6 fw-light pb-2">Selamat datang!</p>
          <form @submit="formSubmit">
            <div class="row">
              <div class="col">
                <label class="col-form-label fw-600" for="usernameField"
                  >Nama Pengguna</label
                >
                <input
                  id="usernameField"
                  v-model="username"
                  class="form-control"
                  name="username"
                  type="text"
                />
              </div>
            </div>
            <div class="row pt-2">
              <div class="col">
                <label class="col-form-label" for="passwordField"
                  >Kata Laluan</label
                >
                <input
                  id="passwordField"
                  v-model="password"
                  class="form-control"
                  name="password"
                  type="password"
                />
              </div>
            </div>
            <div class="row pt-2 pb-3">
              <div class="col">
                <input
                  id="remember"
                  v-model="remember"
                  class="align-middle me-1"
                  name="remember"
                  type="checkbox"
                />
                <label for="remember">Ingatkan saya</label>
              </div>
            </div>
            <div class="row pt-4">
              <div class="col d-grid">
                <button
                  :class="{ loading: is_loading_state }"
                  :disabled="is_loading_state"
                  class="btn btn-primary btn-block"
                  type="submit"
                >
                  Log Masuk
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
</template>

<script>
export default {
  name: "Login",
  data() {
    return {
      username: "",
      password: "",
      remember: false,
      is_loading_state: false,
    };
  },
  methods: {
    formSubmit(e) {
      e.preventDefault();

      this.is_loading_state = true;
      this.axios
        .post("/api/login", {
          username: this.username,
          password: this.password,
          remember: this.remember,
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

<style lang="scss" scoped>
$border-radius: 20px;

#loginCard {
  font-family: Montserrat, sans-serif;
}

img {
  max-width: 80%;
  max-height: 80%;
}

.glass {
  backdrop-filter: blur(5px);
  background-color: rgb(159 159 159 / 13%);
  border-radius: 8px;
  min-height: calc(80% - 1.5rem * 2);
  transform: translateY(calc(-50% - 1.5rem));
}

.glass * {
  font-family: MontserratLight, sans-serif;
}

main {
  box-shadow: 2px 1px 15px -3px rgba(0, 0, 0, 0.75);
  border-radius: $border-radius;
}

main,
#left,
#right {
  min-height: 75vh;
  max-width: 60vw !important;
}

#left {
  border-radius: $border-radius 0 0 $border-radius;
  background-image: url(../assets/img/cover.jpg);
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}

#right {
  background-color: white;
  border-radius: 0 $border-radius $border-radius 0;
}

#subtitle {
  font-size: 0.75rem;
}

#footer {
  font-size: 0.6rem;
}

label {
  font-size: 0.8rem !important;
}

label.col-form-label {
  font-weight: bold;
}

form button[type="submit"] {
  position: relative;
  display: block;
}

form button[type="submit"]::after {
  content: "";
  display: block;
  width: 1.2em;
  height: 1.2em;
  position: absolute;
  left: calc(50% - 0.75em);
  top: calc(50% - 0.75em);
  border: 0.15em solid transparent;
  border-right-color: white;
  border-radius: 50%;
  animation: loading-anim 0.7s linear infinite;
  opacity: 0;
}

@keyframes loading-anim {
  from {
    transform: rotate(0);
  }
  to {
    transform: rotate(360deg);
  }
}

.loading,
.loading:hover {
  color: transparent !important;
}

.loading::after {
  opacity: 1 !important;
}
</style>

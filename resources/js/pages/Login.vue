<script>
import { store } from "../store/store.js";
export default {
  name: "Login",
  data() {
    return {
      user: {
        email: "",
        password: "",
      },
      errors: {
        email: "",
        password: "",
      },
    };
  },
  methods: {
    submit() {
      axios
        .post("/api/login", this.user)
        .then(() => {
          store.is_logged = true;

          this.$router.push({ name: "home" });
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
        });
    },

    validateEmail() {
      const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+.[a-zA-Z]{2,}$/;

      if (!this.user.email) {
        this.errors.email = "L'email è obbligatoria.";
      } else if (!emailRegex.test(this.user.email)) {
        this.errors.email = "Inserisci una email valida.";
      } else {
        this.errors.email = "";
      }
    },

    validatePassword() {
      if (!this.user.password) {
        this.errors.password = "La password è obbligatoria.";
      } else if (this.user.password.length < 8) {
        this.errors.password =
          "La password deve essere lunga almeno 8 caratteri.";
      } else {
        this.errors.password = "";
      }
    },

    submitLogin() {
      this.validateEmail();
      this.validatePassword();

      if (Object.values(this.errors).every((error) => error === "")) {
        this.submit();
      }
    },
  },
};
</script>


<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-8 mt-5">
        <h2>Effettua il login</h2>
        <form class="mx-auto" @submit.prevent="submitLogin">
          <div class="input-container">
            <label class="form-label" for="email">Email</label>
            <input
              class="form-control"
              type="email"
              id="email"
              name="email"
              v-model="user.email"
            />
            <small v-if="errors.email" class="error-message">{{
              errors.email
            }}</small>
          </div>

          <div class="input-container">
            <label class="form-label" for="password">Password</label>
            <input
              class="form-control"
              type="password"
              id="password"
              name="password"
              v-model="user.password"
            />
            <small v-if="errors.password" class="error-message">{{
              errors.password
            }}</small>
          </div>
          <button class="btn btn-primary" type="submit">Login</button>
        </form>
      </div>
    </div>
  </div>
</template>


<style lang='scss' scoped>
// @use 'path' as *;
.input-container {
  padding: 10px 0;

  .error-message {
    color: red;
    font-size: 0.9em;
  }
}

label {
  display: block;
}
</style>

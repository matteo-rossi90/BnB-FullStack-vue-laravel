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
      errors: {},
    };
  },
  methods: {
    submit() {
      axios
        .post("/api/login", this.user)
        .then(() => {
          this.$router.push({ name: "dashboard" });
          store.is_logged = true;
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
        });
    },
  },
};
</script>
<template>
  <h2>Login</h2>
  <form @submit.prevent="submit">
    <!-- -- -->
    <label for="email">email</label>
    <input type="email" id="email" name="email" v-model="user.email" />
    <label for="password">password</label>
    <input
      type="password"
      id="password"
      name="password"
      v-model="user.password"
    />
    <button type="submit">submit</button>
  </form>
</template>
<style lang='scss' scoped>
// @use 'path' as *;
</style>

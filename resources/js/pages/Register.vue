<script>
export default {
  name: "Register",
  data() {
    return {
      user: {
        name: "",
        email: "",
        password: "",
        password: "",
        password_confirmation: "",
      },
      errors: {},
    };
  },
  methods: {
    submit() {
      axios
        .post("/api/register", this.user)
        .then(() => {
          this.$router.push({ name: "dashboard" });
        })
        .catch((err) => {
          this.errors = err.response.data.errors;
        });
    },
  },
};
</script>
<template>
  <h2>Register</h2>
  <ul v-if="errors">
    <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
  </ul>
  <form @submit.prevent="submit">
    <label for="name">name</label>
    <input type="text" id="name" name="name" v-model="user.name" />
    <label for="email">email</label>
    <input type="email" id="email" name="email" v-model="user.email" />
    <label for="password">password</label>
    <input
      type="password"
      id="password"
      name="password"
      v-model="user.password"
    />
    <label for="password_confirmation">password_confirmed</label>
    <input
      type="password"
      id="password_confirmation"
      name="password_confirmation"
      v-model="user.password_confirmation"
    />
    <button type="submit">submit</button>
  </form>
</template>
<style lang='scss' scoped>
// @use 'path' as *;
</style>

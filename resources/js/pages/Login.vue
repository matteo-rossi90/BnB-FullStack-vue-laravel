<script>
export default {
  name: "Login",
  data() {
    return {};
  },
  methods: {},
};
</script>
<template>
  <h2>Login</h2>
  <form @submit.prevent="">
    <label for="name">name</label>
    <input type="text" id="name" name="name" />
    <label for="email">email</label>
    <input type="email" id="email" name="email" />
    <label for="password">password</label>
    <input type="password" id="password" name="password" />
    <button type="submit">submit</button>
  </form>
</template>
<style lang='scss' scoped>
// @use 'path' as *;
</style>

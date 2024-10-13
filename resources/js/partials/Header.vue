<script>
export default {
  name: "Header",
  data() {
    return {};
  },
  methods: {},
};
</script>
<template>
  <header>
    <router-link :to="{ name: 'home' }">home</router-link>
    <router-link :to="{ name: 'login' }">login</router-link>
    <router-link :to="{ name: 'register' }">register</router-link>
    <router-link :to="{ name: 'dashboard' }">dashboard</router-link>
  </header>
</template>
<style lang="scss" scoped>
/* // @use 'path' as *; */
header {
  display: flex;
  gap: 1rem;
}
</style>

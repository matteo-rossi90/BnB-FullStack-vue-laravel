<script>
import Header from "./partials/Header.vue";
import Footer from "./partials/Footer.vue";
export default {
  name: "App",
  data() {
    return {};
  },
  components: {
    Header,
    Footer,
  },
  methods: {},
};
</script>
<template>
  <Header />
  <main>
    <router-view></router-view>
  </main>

  <!-- <Footer /> -->
</template>
<style scoped>
/* // @use 'path' as *; */
</style>

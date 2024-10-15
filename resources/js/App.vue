<script>
import { store } from "./store/store.js";
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
  mounted() {
    // get a data of user
    axios
      .get("/api/user")
      .then((response) => {
        store.user = response.data;
      })
      .catch((err) => {
        console.log(err);
      });
  },
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

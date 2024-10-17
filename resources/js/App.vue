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
    axios
      .get("api/home")
      .then((res) => {
        localStorage.setItem("allApartments", JSON.stringify(res.data));
        store.allApartments = JSON.parse(localStorage.getItem("allApartments"));
      })
      .catch((err) => {
        console.log(err);
      });
    window.addEventListener("load", () => {
      // get a data of user
      axios
        .get("/api/user")
        .then((response) => {
          store.user = response.data;
          localStorage.setItem("userName", response.data.name);
          store.userName = localStorage.getItem("userName");
        })
        .catch((err) => {
          localStorage.setItem("userName", "Accedi");
          console.log(err);
        });
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

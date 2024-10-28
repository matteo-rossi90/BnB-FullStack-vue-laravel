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
  methods: {
    fillData() {
      // fill data userApartment, allApartments, user, userName

      //   name and data of user logged
      //   if (!store.user) {
      axios
        .get("http://127.0.0.1:8000/api/user")
        .then((response) => {
          store.is_logged = true;
          store.user = response.data;
          console.log("user", store.user);
          if (response.data.name) {
            store.userName = response.data.name;
          } else {
            store.userName = "Profilo";
          }
          console.log("app- user e user name: ok");
        })
        .catch((err) => {
          store.is_logged = false;
          store.userName = "Accedi";
          console.log("app- user e user name:", err.message);
        });
      //   }
    },
  },
  mounted() {
    this.fillData();

    // window.addEventListener("load", function () {
    //   this.fillData();
    // });
    // window.addEventListener("load", () => {
    //   // get a data of user
    //   //   axios
    //   //     .get("api/home")
    //   //     .then((res) => {})
    //   //     .catch((err) => {
    //   //       console.log(err);
    //   //     });
    // });
  },
};
</script>
<template>
  <Header />
  <main>
    <router-view></router-view>
  </main>

  <Footer />
</template>
<style lang="scss" scoped>
/* // @use 'path' as *; */
main {
  padding-top: 6rem;
}

@media screen and (max-width: 632px) {
  main {
    padding-top: 5.5rem;
  }
}
</style>

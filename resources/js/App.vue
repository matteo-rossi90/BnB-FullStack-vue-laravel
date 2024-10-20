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

      //   all apartment
      axios
        .get("api/home")
        .then((res) => {
          console.log("app- all apartment");
          store.allApartments = res.data;
        })
        .catch((err) => {
          console.log(err);
        });

      //   name and data of user logged
      axios
        .get("/api/user")
        .then((response) => {
          store.user = response.data;
          store.userName = response.data.name;
          console.log("app- user e user name");
        })
        .catch((err) => {
          console.log(err);
        });
      // userApartment
      axios
        .get("api/user/utente/dashboard")
        .then((response) => {
          store.userApartment = response.data;
          console.log("app- user apartment");
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  mounted() {
    this.fillData();
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

  <!-- <Footer /> -->
</template>
<style lang="scss" scoped>
/* // @use 'path' as *; */
main {
  padding-top: 6.5rem;
}

@media screen and (max-width:632px) {
    main{
        padding-top: 5.5rem;
    }
}
</style>

<script>
import ApartmentCard from "./components/ApartmentCard.vue";
import axios from "axios";
import { store } from "../store/store";
export default {
  name: "Home",
  components: {
    ApartmentCard,
  },
  data() {
    return {
      store: store,
    };
  },
  methods: {},
  mounted() {
    // Chiamata per l'utente autenticato
    // axios
    //   .get("/api/user")
    //   .then((response) => {
    //     store.user = response.data;
    //     // axios
    //     //   .get("api/user/utente/dashboard")
    //     //   .then((response) => {
    //     //       store.allApartment = response.data;
    //     //
    //     //   })
    //     //   .catch((err) => {
    //     //     console.log(err);
    //     //   });
    //   })
    //   .catch((err) => {
    //     console.log(err);
    //   });
  },
  computed: {
    allApartmentsComputed() {},
  },
  //   beforeRouteEnter(to, from, next) {
  //     // Questo viene eseguito ogni volta che si accede a questa pagina tramite il router
  //     next((vm) => {
  //       // Puoi accedere al componente 'vm' e chiamare metodi o eseguire logica
  //       console.log("Entered the HomePage route");
  //       vm.fillAllApartment(); // Esegui una funzione che desideri
  //     });
  //   },
};
</script>
<template>
  <!-- <h1>Home dell'utente senza login</h1> -->

  <!-- <div class="container mt-4">
    <div class="row justify-content-center">
      <div class="col-md-6"></div>
    </div>
  </div> -->

  <!-- card -->
  <div class="container">
    <div class="row pt-5">
      <router-link
        class="col-lg-3 col-md-4 col-sm-6 mb-4"
        :to="{ name: 'showApartment', params: { id: index } }"
        v-for="(apartment, index) in store.allApartments"
        :key="index"
      >
        <div>
          <ApartmentCard :apartment="apartment" />
        </div>
      </router-link>
    </div>
  </div>
</template>
<style lang='scss' scoped>
// @use 'path' as *;
.card {
  max-width: 100%;
  margin: 10px auto;
}
</style>

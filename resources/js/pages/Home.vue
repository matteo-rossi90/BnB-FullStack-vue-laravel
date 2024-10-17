<script>
import { store } from "../store/store";
// importo il componente ApartmentCard
import ApartmentCard from './components/ApartmentCard.vue';
export default {
    name: "Home",
    components: {
        ApartmentCard,
    },
  data() {
      return {
        apartments: store.allApartments,
    };
  },
  methods: {},
    mounted() {
        // Chiamata per gli appartamenti pubblici
        // axios
        //     .get("/api/public/apartments")
        //     .then((response) => {
        //         this.apartments = response.data;
        //         console.log(this.apartments);
        //     })
        //     .catch((err) => {
        //         console.log(err);
        //     });

    // Chiamata per l'utente autenticato
    // axios
    //   .get("/api/user")
    //   .then((response) => {
    //     store.user = response.data;

    //     // axios
    //     //   .get("api/user/utente/dashboard")
    //     //   .then((response) => {
    //     //       store.allApartment = response.data;
    //     //       console.log(store.allApartment);
    //     //   })
    //     //   .catch((err) => {
    //     //     console.log(err);
    //     //   });
    //   })
    //   .catch((err) => {
    //     console.log(err);
    //   });
  },
};
</script>
<template>
    <!-- <h1>Home dell'utente senza login</h1> -->
      <!-- Barra di ricerca  -->
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="input-group stylish-input-group">
                    <input type="text" class="form-control" placeholder="Cerca appartamenti per indirizzo..."
                        v-model="searchQuery" />
                    <span class="input-group-addon">
                        <button class="btn btn-primary">
                            <i class="fas fa-search"></i>
                        </button>
                    </span>
                </div>
            </div>
        </div>
    </div>

    <!-- card -->
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4" v-for="(apartment, index) in apartments" :key="index">
                <ApartmentCard :apartment="apartment" />
            </div>
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

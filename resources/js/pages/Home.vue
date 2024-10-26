<script>
import ApartmentCard from "./Components/ApartmentCard.vue";
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
    //   all apartment
    axios
      .get("/api/home", {
        headers: {
          Accept: "application/json",
          "Cache-Control": "no-cache", // Disabilita il caching
        },
        params: {
          t: Date.now(), // Aggiungi un timestamp per evitare il caching
        },
      })
      .then((res) => {
        console.log("app- all apartment:ok", res.data);
        store.allApartments = res.data;
      })
      .catch((err) => {
        console.log("app- all apartment: ", err.message);
      });
  },
  computed: {
    sortedApartment() {
      return this.store.allApartments.sort((a, b) => {
        // Se l'appartamento A ha sponsor e B no, A viene prima
        if (a.sponsors.length > 0 && b.sponsors.length === 0) {
          return -1;
        }
        // Se l'appartamento B ha sponsor e A no, B viene prima
        if (a.sponsors.length === 0 && b.sponsors.length > 0) {
          return 1;
        }
        // Se entrambi hanno o non hanno sponsor, mantieni il loro ordine
        return 0;
      });
    },
  },
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
        :class="{ sponsor: apartment.sponsors.length }"
        :to="{
          name: 'showApartment',
          params: { slug: apartment.slug, id: apartment.id },
        }"
        v-for="(apartment, index) in sortedApartment"
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

.sponsor {
  border: 3px solid rgb(205, 127, 50);
}
</style>

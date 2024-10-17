<script>
import axios from "axios";
import { store } from "../store/store";
import { checkAdress } from "../store/store";
// importo il componente ApartmentCard
import ApartmentCard from "./components/ApartmentCard.vue";
export default {
  name: "Home",
  components: {
    ApartmentCard,
  },
  data() {
    return {
      apartments: store.allApartments,
      searchQuery: "",
      address: [],
      debounceTimeout: null,
    };
  },
  methods: {
    debouncedSearch() {
      // Cancella il timeout precedente (se esiste)
      clearTimeout(this.debounceTimeout);

      // Imposta un nuovo timeout
      this.debounceTimeout = setTimeout(() => {
        this.performSearch(); // Esegui la chiamata dopo un ritardo di 300ms
      }, 300); // Cambia questo valore per regolare il ritardo
    },
    performSearch() {
      if (!this.searchQuery.trim()) {
        return; // Non eseguire la ricerca se la query è vuota
      }
      let urlRequest = checkAdress(this.searchQuery);

      axios
        .get("http://127.0.0.1:8000/proxy-tomtom", {
          params: { url: urlRequest },
        })
        .then((response) => {
          this.address = response.data.results;
          console.log(this.address[0].address);
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  mounted() {
    // Chiamata per gli appartamenti pubblici
    axios
      .get("/api/home")
      .then((response) => {
        this.apartments = response.data;
        console.log(this.apartments);
      })
      .catch((err) => {
        console.log(err);
      });

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
  computed: {
    suggestAdress() {
      return this.address;
    },
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
          <div class="contInput">
            <input
              type="text"
              class="form-control"
              placeholder="Cerca appartamenti per indirizzo..."
              v-model="searchQuery"
              @input="debouncedSearch"
            />
            <div class="suggest" v-if="searchQuery">
              <ul>
                <li v-for="(addressObj, index) in suggestAdress" :key="index">
                  {{ addressObj.address.streetName }}, n°
                  {{
                    addressObj.address.streetNumber
                      ? addressObj.address.streetNumber
                      : index
                  }},
                  {{ addressObj.address.municipality }}
                  {{ addressObj.address.postalCode }}
                  {{ addressObj.address.neighbourhood }}
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- card -->
  <div class="container">
    <div class="row">
      <div
        class="col-lg-3 col-md-4 col-sm-6 mb-4"
        v-for="(apartment, index) in apartments"
        :key="index"
      >
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
.contInput {
  width: 70%;
  padding: 0.5rem;
  border-radius: 20px;
  border: 1px solid black;
  position: relative;
}
.suggest {
  position: absolute;
  width: 100%;
  top: 100%;
  background-color: rgb(237, 237, 237);
  border-radius: 20px;
  font-size: 0.75rem;
  z-index: 10;

  li {
    padding: 0.3rem 0.5rem;
    border-radius: 20px;
    margin-bottom: 0.1rem;
    &:hover {
      background-color: rgb(217, 217, 217);
      cursor: pointer;
    }
  }
}
</style>

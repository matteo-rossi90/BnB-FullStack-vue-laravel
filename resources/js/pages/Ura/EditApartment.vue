<script>
import { store } from "../../store/store";
import { checkAdress } from "../../store/store";

export default {
  name: "EditApartment",

  data() {
    return {
      apartment: {},
    };
  },
  methods: {
    findApartment() {
      // Recupera i dati dal localStorage
      let apartmentsJson = localStorage.getItem("apartments");

      // Verifica se i dati esistono e sono validi
      if (!apartmentsJson) {
        console.error("Nessun dato trovato nel localStorage");
        return;
      }

      // Converte i dati JSON in un array di oggetti JavaScript
      let apartments = JSON.parse(apartmentsJson);
      console.log("Array di appartamenti:", apartments);

      // Assicurati che l'array di appartamenti sia valido
      if (!Array.isArray(apartments)) {
        console.error("Dati non validi, non è un array");
        return;
      }

      // Cerca l'appartamento con l'ID corrispondente
      for (let i = 0; i < apartments.length; i++) {
        if (apartments[i].id == this.$route.params.id) {
          this.apartment = apartments[i];
          console.log(
            "Appartamento trovato: " + JSON.stringify(this.apartment, null, 2)
          );
        }
      }
    },
    submit() {
      let urlRequest = checkAdress(this.apartment.address);

      axios
        .get("http://127.0.0.1:8000/proxy-tomtom", {
          params: { url: urlRequest },
        })
        .then((response) => {
          this.apartment.lat = response.data.results[0].position.lat;
          this.apartment.lon = response.data.results[0].position.lon;

          axios
            .patch(
              `http://127.0.0.1:8000/api/user/utente/dashboard/${this.apartment.id}`,
              this.apartment
            )
            .then((res) => {
              this.$router.push({ name: "apartments" });
            })
            .catch((err) => {
              console.log(err);
            });
        })
        .catch((error) => {
          console.error("Errore:", error.response || error.message);
        });
    },
  },

  mounted() {
    this.findApartment();
  },
};
</script>

<template>
  <div class="container">
    <h1>Edit</h1>

    <form @submit.prevent="submit">
      <label for="title" class="form-label">Titolo</label>
      <input
        type="text"
        class="form-control"
        v-model="apartment.title"
        id="title"
        name="title"
      />

      <label for="" class="form-label">Numero di stanze</label>
      <input
        type="number"
        class="form-control"
        v-model="apartment.number_rooms"
        id="number_rooms"
        name="number_rooms"
      />

      <label for="" class="form-label">Numero di letti</label>
      <input
        type="number"
        class="form-control"
        v-model="apartment.number_beds"
        id="number_beds"
        name="number_beds"
      />

      <label for="" class="form-label">Numero di bagni</label>
      <input
        type="number"
        class="form-control"
        v-model="apartment.number_bathrooms"
        id="number_bathrooms"
        name="number_bathrooms"
      />

      <label for="" class="form-label">Indirizzo</label>
      <input
        type="text"
        class="form-control"
        v-model="apartment.address"
        id="address"
        name="address"
      />

      <label for="" class="form-label">Metri quadri</label>
      <input
        type="text"
        class="form-control"
        v-model="apartment.square_meters"
        id="square_meters"
        name="square_meters"
      />

      <!-- <label for="" class="form-label">Immagine</label>
      <input
        type="text"
        class="form-control"
        /> -->

      <button type="submit" class="btn btn-primary">Invia</button>
    </form>
  </div>
</template>



<style lang="scss" scoped>
button {
  margin-top: 30px;
}
</style>

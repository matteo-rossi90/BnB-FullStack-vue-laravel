<script>
import { store } from "../../store/store";

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
  },

  mounted() {
    this.findApartment();
    console.log(this.apartment);
  },
};
</script>

<template>
  <div class="container">
    <h1>Edit</h1>

    <form action="">
      <label for="title" class="form-label">Titolo</label>
      <input
        type="text"
        class="form-control"
        :value="apartment.title"
        id="title"
        name="title"
      />

      <label for="" class="form-label">Numero di stanze</label>
      <input
        type="number"
        class="form-control"
        :value="apartment.numbe"
        id="title"
        name="title"/>

      <label for="" class="form-label">Numero di letti</label>
      <input type="number" class="form-control" />

      <label for="" class="form-label">Numero di bagni</label>
      <input type="number" class="form-control" />

      <label for="" class="form-label">Indirizzo</label>
      <input type="text" class="form-control" />

      <label for="" class="form-label">Immagine</label>
      <input type="text" class="form-control" />

      <button type="submit" class="btn btn-primary">Invia</button>
    </form>
  </div>
</template>



<style lang="scss" scoped>
</style>

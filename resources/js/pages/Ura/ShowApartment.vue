<script>
import { store } from "../../store/store";
export default {
  name: "ShowApartment",

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
  },
};
</script>

<template>
  <div>
    <!-- <p>{{ apartment.title }}</p> -->
    <p>titolo: {{ apartment.title }}</p>
    <p>immagine se vuota è path: {{ apartment.image }}</p>
    <p>numero di camere: {{ apartment.number_rooms }}</p>
    <p>numero di letti: {{ apartment.number_beds }}</p>
    <p>numero di bagni: {{ apartment.number_bathrooms }}</p>
    <p>metri quadri: {{ apartment.square_meters }}</p>
    <p>indirizzo {{ apartment.address }}</p>
    <p>latitudine {{ apartment.lat }}</p>
    <p>longitudine: {{ apartment.lon }}</p>
  </div>
</template>

<style lang="scss" scoped>
</style>

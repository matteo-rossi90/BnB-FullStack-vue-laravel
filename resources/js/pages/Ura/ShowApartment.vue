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

<!-- <template>
  <div>
    <p>{{ apartment.title }}</p>
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
</template> -->

<template>
  <div class="container mt-5">
    <!-- ID dell'appartamento -->
    <div class="row">
      <div class="col-12 text-center">
        <h1>ID Appartamento: {{ apartment.id }}</h1>
      </div>
    </div>

    <!-- Galleria di immagini -->
    <div class="row my-4">
      <div class="col-12 text-center">
        <!-- Se c'è un'immagine valida, la mostra -->
        <div v-if="apartment.image && apartment.image.trim().length > 0" class="mb-4">
          <img :src="apartment.image" alt="Immagine dell'appartamento" class="img-fluid rounded">
        </div>
        <!-- Altrimenti, mostra un'immagine di placeholder -->
        <div v-else class="mb-4">
          <img src="https://app-assets.outeast.com/assets/modules/Shared/placeholder_house-b1447eab513e59327c82175ec088599a3c16f80a51501f59d8b89bd60cb00112.png" alt="Placeholder" class="img-fluid rounded">
        </div>
      </div>
    </div>

    <!-- Indirizzo dell'appartamento -->
    <div class="row mb-4">
      <div class="col-12 text-center">
        <h3>Indirizzo: {{ apartment.address }}</h3>
      </div>
    </div>

    <!-- Informazioni dell'appartamento -->
    <div class="row text-center">
      <!-- Numero di camere -->
      <div class="col-6 col-md-3 mb-3">
        <i class="fas fa-door-closed" style="font-size: 2rem;"></i>
        <p>Camere: {{ apartment.number_rooms }}</p>
      </div>

      <!-- Numero di letti -->
      <div class="col-6 col-md-3 mb-3">
        <i class="fas fa-bed" style="font-size: 2rem;"></i>
        <p>Letti: {{ apartment.number_beds }}</p>
      </div>

      <!-- Numero di bagni -->
      <div class="col-6 col-md-3 mb-3">
        <i class="fas fa-bath" style="font-size: 2rem;"></i>
        <p>Bagni: {{ apartment.number_bathrooms }}</p>
      </div>

      <!-- Metri quadri -->
      <div class="col-6 col-md-3 mb-3">
        <i class="fas fa-ruler-combined" style="font-size: 2rem;"></i>
        <p>Metri quadri: {{ apartment.square_meters }} m²</p>
      </div>
    </div>
  </div>
</template>






<style lang="scss" scoped>
.container {
  max-width: 900px;
}

h1 {
  font-size: 2.5rem;
  margin-bottom: 20px;
}

img {
  max-width: 100%;
  height: auto;
  border-radius: 10px;
}

i {
  color: #ff385c;
  margin-bottom: 10px;
}

p {
  font-size: 1.1rem;
}

</style>

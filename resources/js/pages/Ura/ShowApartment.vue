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
  computed: {
    exist() {
      return this.apartment.title;
    },
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
  <div v-if="exist">
    <div class="container mt-5">
      <!-- Titolo riepilogativo dell'appartamento -->
      <div class="row">
        <div class="col-12 text-center">
          <h1 class="apartment-title">{{ apartment.title }}</h1>
        </div>
      </div>

      <!-- Immagini -->
      <div class="row my-4">
        <div class="col-12 text-center">
          <div v-if="apartment.image" class="image-container mb-4">
            <img :src="apartment.image" alt="Immagine dell'appartamento" class="img-fluid rounded shadow-sm" />
          </div>
          <div v-else class="image-container mb-4">
            <img src="https://app-assets.outeast.com/assets/modules/Shared/placeholder_house-b1447eab513e59327c82175ec088599a3c16f80a51501f59d8b89bd60cb00112.png" alt="Placeholder" class="img-fluid rounded shadow-sm" />
          </div>
        </div>
      </div>

      <!-- Indirizzo completo dell'appartamento con latitudine e longitudine -->
      <div class="row mb-4">
        <div class="col-12 text-center">
          <h3 class="apartment-address">
            Indirizzo: {{ apartment.address }} <br />
            Latitudine: {{ apartment.lat }}, Longitudine: {{ apartment.lon }}
          </h3>
        </div>
      </div>

      <!-- Informazioni dell'appartamento -->
      <div class="row text-center info-section">
        <div class="col-6 col-md-3 mb-3">
          <i class="fas fa-door-closed icon"></i>
          <p>Camere: {{ apartment.number_rooms }}</p>
        </div>

        <div class="col-6 col-md-3 mb-3">
          <i class="fas fa-bed icon"></i>
          <p>Letti: {{ apartment.number_beds }}</p>
        </div>

        <div class="col-6 col-md-3 mb-3">
          <i class="fas fa-bath icon"></i>
          <p>Bagni: {{ apartment.number_bathrooms }}</p>
        </div>

        <div class="col-6 col-md-3 mb-3">
          <i class="fas fa-ruler-combined icon"></i>
          <p>Metri quadri: {{ apartment.square_meters }} m²</p>
        </div>
      </div>

      <div class="row">
        <!-- Colonna sinistra per Servizi e Visibilità -->
        <div class="col-md-4 mb-4">
          <div class="row">
            <!-- Servizi Aggiuntivi -->
            <div class="col-12 mb-3">
              <h3>Servizi Aggiuntivi</h3>
              <ul>
                <!-- <li v-for="service in services" :key="service.id">{{ service.name }}</li> -->
                 <li><i class="fas fa-wifi icon"></i> WiFi</li>
                <li><i class="fas fa-parking icon"></i> Posto Macchina</li>
                <li><i class="fas fa-swimmer icon"></i> Piscina</li>
                <li><i class="fas fa-door-open icon"></i> Portineria</li>
                <li><i class="fas fa-hot-tub icon"></i> Sauna</li>
                <li><i class="fas fa-water icon"></i> Vista Mare</li>

              </ul>
            </div>

            <!-- Stato di Visibilità -->
            <div class="col-12">
              <h3>Disponibile: {{ apartment.visible ? "Sì" : "No" }}</h3>
            </div>
          </div>
        </div>

        <!-- Colonna destra per il Form di messaggio -->
        <div class="col-md-8">
          <div class="row">
            <div class="col-12 text-center">
              <h2 class="form-title">Invia un messaggio al proprietario</h2>
            </div>

            <div class="col-12 col-md-10 mx-auto">
              <form class="message-form p-4 shadow-sm rounded">
                <!-- Campo per l'email -->
                <div class="mb-3">
                  <label for="email" class="form-label">La tua email</label>
                  <input type="email" id="email" class="form-control" placeholder="Inserisci la tua email" required />
                </div>

                <!-- Campo per il messaggio -->
                <div class="mb-3">
                  <label for="message" class="form-label">Il tuo messaggio</label>
                  <textarea id="message" class="form-control" rows="5" placeholder="Scrivi il tuo messaggio..." required></textarea>
                </div>

                <!-- Bottone invia -->
                <button type="submit" class="btn btn-primary btn-lg w-100">
                  Invia il messaggio
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  <div v-else>Appartamento non trovato</div>
</template>


<style lang="scss" scoped>
.container {
  max-width: 900px;
}

h1,
h2,
h3 {
  color: #333;
}

.apartment-title {
  font-size: 2.5rem;
  font-weight: bold;
  margin-bottom: 20px;
    //   color: #ff385c;

}

.apartment-address {
  font-size: 1.5rem;
  font-weight: 500;
}

.image-container img {
  max-width: 100%;
  height: auto;
  border-radius: 10px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.info-section {
  margin-bottom: 40px;
}

.additional-services {
  margin-bottom: 40px;
}

.icon {
  color: #ff385c;
  font-size: 2rem;
  margin-bottom: 10px;
}

p {
  font-size: 1.1rem;
}

.form-title {
  margin-bottom: 20px;
  color: #ff385c;
  font-size: 1.8rem;
  font-weight: 600;
}

.message-form {
  background-color: #f9f9f9;
  border-radius: 10px;
}

.form-control {
  border-radius: 5px;
  padding: 10px;
  font-size: 1rem;
}

.btn {
  background-color: #ff385c;
  border: none;
  padding: 15px;
  font-size: 1.1rem;
  font-weight: bold;
}

.btn:hover {
  background-color: #e0324a;
}
</style>

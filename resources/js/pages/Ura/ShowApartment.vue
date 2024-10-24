<script>
import { store } from "../../store/store";
export default {
  name: "ShowApartment",

  data() {
    return {
      apartment: "",
      src:"",
      alt:"",
      name:"",

     //   dati messaggio
     name:'',
     surname:'',
     email:'',
     message:'',

     errors: {
        name: "",
        surname: "",
        email: "",
        message:""
      },

      toastMessage:''

    };


  },
    methods: {
        // imageUrl(path) {
        //   return `http://127.0.0.1:8000/${path}`; // URL completo dell'immagine
        // },
        getMap() {
            const tt = window.tt; //accesso alla libreria TomTom
            let center = [this.apartment.lon, this.apartment.lat]; //centro della mappa in base alle coordinate dell'appartamento
            let size = 50; //dimensioni del popup

            const map = tt.map({
                key: "qNjsW3gGJOBNhFoXhBzsGRJAk5RJMJhI",
                center: center,
                container: "map",
                zoom: 12,
            });

            //accesso alle coordinate nel JSON generato dall'API

            const lat = this.apartment.lat; //valore della latitudine di ogni appartamento
            const lon = this.apartment.lon; //valore dalla longitudine di ogni appartamento

            if (!lat || !lon) {
                console.error("Coordinate non valide per l'appartamento");
                return;
            }

            let boxContent = document.createElement("div");
            boxContent.innerHTML = `
                    <div class="card-body">
                        <h5 class="title-popup"><strong>${this.apartment.title}</strong></h5>
                        <p class="title-popup">${this.apartment.address}</p>
                        <small>8000 euro</small>
                    </div>`;

            let popup = new tt.Popup({
                closeButton: true, //permettere la chiusura il popup
                closeOnClick: true, //chiudere il popup al click su un'altra parte della mappa
                offset: size,
                // anchor: 'none'
            }).setDOMContent(boxContent); //contenuto dinamico del popup in base alle cards degli appartamenti

            //creare il marker per l'appartamento
            let marker = new tt.Marker().setLngLat([lon, lat]).setPopup(popup); //collegare il popup al marker

            marker.addTo(map);

            const bounds = [
                [10.501, 40.7994], //estremi sud-ovest (longitudine, latitudine)
                [13.9894, 42.8995], //estremi nord-est (longitudine, latitudine)
            ];

            map.setMaxBounds(bounds);

            map.addControl(new tt.FullscreenControl());
            map.addControl(new tt.NavigationControl());

        },

        validateName() {
            if (!this.name) {
                this.errors.name = "";
            } else if (!/^[a-zA-Z]+$/.test(this.name)) {
                this.errors.name = "Il nome deve contenere solo lettere";
            } else if (this.name.length < 4) {
                this.errors.name =
                "il nome non può avere una lunghezza inferiore di 4 caratteri";
            } else {
                this.errors.name = "";
            }
        },

        validateSurname() {
            if (!this.surname) {
                this.errors.surname = "";
            } else if (!/^[a-zA-Z]+$/.test(this.surname)) {
                this.errors.surname = "Il cognome deve contenere solo lettere";
            } else if (this.surname.length < 4) {
                this.errors.surname =
                "Il cognome non può avere una lunghezza inferiore di 4 caratteri";
            } else {
                this.errors.surname = "";
            }
        },

        validateEmail() {
            const emailRegex = /^[a-zA-Z0-9.]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

            if (!this.email) {
                this.errors.email = "L'email è obbligatoria.";
            } else if (!emailRegex.test(this.email)) {
                this.errors.email =
                "Inserisci una email valida, ad esempio: nome.cognome@mail.com";
            } else {
                this.errors.email = "";
            }
        },

        validateMessage() {
            if (!this.message) {
                this.errors.message = "";
            } else if (this.message.length < 10) {
                this.errors.message =
                "Il messaggio non può avere una lunghezza inferiore a 10 caratteri";
            } else {
                this.errors.message = "";
            }
        },

        showToast(text, type = "success") {//metodo che permette di mostrare il toast

            this.toastMessage = text;
            const toastEl = this.$refs.liveToast;

            toastEl.classList.remove("text-bg-success", "text-bg-danger");

            if (type === "success") {
                toastEl.classList.add("text-bg-success");
            } else {
                toastEl.classList.add("text-bg-danger");
            }
            const toast = new bootstrap.Toast(toastEl);

            toast.show();

            setTimeout(() => {
            toast.hide();
            }, 5000);
        },

        hideToast() {//metodo che permette di nascondere il toast

            const toastEl = this.$refs.liveToast;

            const toast = new bootstrap.Toast(toastEl);

            toast.hide();
        },

        submitMessage(){
            const messageData = {
                name: this.name,
                surname: this.surname,
                email: this.email,
                message: this.message
            }

            axios.post(`http://127.0.0.1:8000/api/apartments/${this.apartment.id}/send-message`, messageData)
                .then(res=>{
                    console.log(res.data);
                    if(res.data.success){
                        this.showToast('Messaggio inviato correttamente', 'success');
                        this.errors = {
                            name:'',
                            surname:'',
                            email:'',
                            message:''
                        };
                    }else{
                        this.showToast("Errore durante l'invio del messaggio", 'error');
                        this.errors = res.data.errors;
                    }
                })
                .catch(er=>{
                    console.log(er.message);
                    this.showToast("Errore durante l'invio del messaggio", 'error');
                })
            console.log(messageData);

        },

        submitForm(){
            this.validateName();
            this.validateSurname();
            this.validateEmail();
            this.validateMessage();

            this.submitMessage();
        }

    },
  beforeRouteEnter(to, from, next) {
    next((vm) => {
      // 'vm' è l'istanza del componente
      if (from.name === "home") {
        vm.apartment = store.allApartments[to.params.id];
      }
      if (from.name === "apartmentsMap") {
        vm.apartment = store.allApartments[--to.params.id];
      }
      if (from.name === "apartments") {
        vm.apartment = store.allApartments[--to.params.id];
      }
    });
  },
  computed: {
    exist() {
      return !!this.apartment;
    },
  },
  mounted() {
  // nextTick fa in modo che il DOM sia completamente pronto
  this.$nextTick(() => {
      this.getMap();
   });
},
};
</script>


<template>
  <div v-if="exist">
    <div class="container mt-5">
      <!-- Titolo riepilogativo dell'appartamento -->
      <div class="row">
        <div class="col-12 text-center">
          <h1 class="apartment-title">titolo: {{ apartment.title }}</h1>
        </div>
      </div>

      <!-- Immagini -->
      <div class="row my-4">
        <div class="col-12 text-center">
          <div v-if="apartment.image" class="image-container mb-4">
            <img
              :src="apartment.image"
              :alt="apartment.name"
              class="img-fluid rounded shadow-sm"
            />
          </div>
          <div v-else class="image-container mb-4">
            <img
              src="img/no-image.png"
              alt="Placeholder"
              class="img-fluid rounded shadow-sm"
            />
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
              <h3>Disponibile: {{ apartment.is_visible ? "Sì" : "No" }}</h3>
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
              <form class="message-form p-4 shadow-sm rounded" @submit.prevent="submitForm">
                <div class="mb-3">
                  <label for="name" class="form-label">Il tuo nome</label>
                  <input
                    type="text"
                    id="name"
                    class="form-control"
                    placeholder="Inserisci il tuo nome"
                    v-model="name"
                    @input="validateName"
                  />
                  <small v-if="errors.name" class="error-message">{{errors.name}}</small>
                </div>
                <div class="mb-3">
                  <label for="surname" class="form-label">Il tuo cognome</label>
                  <input
                    type="text"
                    id="surname"
                    class="form-control"
                    placeholder="Inserisci il tuo cognome"
                    v-model="surname"
                    @input="validateSurname"
                  />
                  <small v-if="errors.surname" class="error-message">{{errors.surname}}</small>
                </div>
                <!-- Campo per l'email -->
                <div class="mb-3">
                  <label for="email" class="form-label">La tua email</label>
                  <input
                    type="email"
                    id="email"
                    class="form-control"
                    placeholder="Inserisci la tua email"
                    v-model="email"
                    @input="validateEmail"
                  />
                  <small v-if="errors.email" class="error-message">{{errors.email}}</small>
                </div>

                <!-- Campo per il messaggio -->
                <div class="mb-3">
                  <label for="message" class="form-label"
                    >Il tuo messaggio</label
                  >
                  <textarea
                    id="message"
                    class="form-control"
                    rows="5"
                    placeholder="Scrivi il tuo messaggio..."
                    v-model="message"
                    @input="validateMessage"
                  ></textarea>
                  <small v-if="errors.message" class="error-message">{{errors.message}}</small>
                </div>

                <!-- Bottone invia -->
                <button type="submit" class="btn btn-primary btn-lg w-100">
                  Invia il messaggio
                </button>
              </form>
            </div>
          </div>
        </div>
        <!-- mappa per la geolocalizzazione dell'appartamento -->
        <div class="row g-2">
          <div class="my-4 col">
            <div id="map"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div v-else>Appartamento non trovato</div>

  <!-- codice del toast -->
  <div
        ref="liveToast"
        class="toast align-items-center text-bg-success position-fixed bottom-0 end-0 p-2 m-3"
        role="alert"
        aria-live="assertive"
        aria-atomic="true"
        style="z-index: 1050;"
        >
        <div class="d-flex">
            <div class="toast-body">
                {{ toastMessage }}
            </div>
            <button
            type="button"
            class="btn-close btn-close-white me-2 m-auto"
            @click="hideToast"
            aria-label="Close"
            ></button>
        </div>
    </div>
</template>


<style lang="scss" scoped>
.container {
  max-width: 80%;
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

#map {
  width: 100%;
  height: 500px;
  border-radius: 10px;
}

.error-message {
    color: red;
    font-size: 0.9em;
}

.toast {
  position: fixed;
  bottom: 0;
  right: 0;
  z-index: 1050;
}
</style>

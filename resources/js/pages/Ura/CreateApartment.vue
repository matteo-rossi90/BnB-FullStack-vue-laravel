<script>
import Routinglist from "./partials/Routinglist.vue";
import { checkAdress } from "../../store/store";
export default {
  name: "CreateApartment",
  components: {
    Routinglist,
  },
  data() {
    return {
      //
      apartment: {
        title: "",
        address: "",
        lat: "",
        lon: "",
        number_rooms: "",
        number_beds: "",
        number_bathrooms: "",
        image: null,
        square_meters: "",
        // services:[]
      },
      services: [],

      imagePreview: "", // Aggiunto per gestire l'anteprima dell'immagine
      isAproveStreet: false,
      errors: {},
      street: "via lemonia",
      number: "45",
      city: "bologna",
      postalCode: "40133",
      place: "italia",
      resultOfSearch: "",
    };
  },
  methods: {
    savePhoto(event) {
      //   this.apartment.image = event.target.files[0];

      //   let reader = new FileReader();
      //   reader.addEventListener(
      //     "load",
      //     function () {
      //       this.imagePreview = reader.result;
      //     }.bind(this),
      //     false
      //   );

      //   if (this.apartment.image) {
      //     if (/\.(jpe?g|png|gif)$/i.test(this.apartment.image.name)) {
      //       reader.readAsDataURL(this.apartment.image);
      //     }
      //   }

      const file = event.target.files[0]; // Salva il file caricato

      if (file && /\.(jpe?g|png|gif)$/i.test(file.name)) {
        this.apartment.image = file; // Assegna il file a apartment.image

        let reader = new FileReader();
        reader.onload = (e) => {
          this.imagePreview = e.target.result; // Carica l'anteprima dell'immagine
        };
        reader.readAsDataURL(file); // Converte il file immagine per l'anteprima
      } else {
        this.apartment.image = null;
        this.imagePreview = "";
      }
    },

    submit() {
      let streetComplete =
        this.street +
        " " +
        this.city +
        " " +
        this.postalCode +
        " " +
        this.place;
      let urlRequest = checkAdress(streetComplete);

      axios
        .get("http://127.0.0.1:8000/proxy-tomtom", {
          params: { url: urlRequest },
        })
        .then((response) => {
          this.resultOfSearch = response.data.results;

          //   this.apartment.lat = response.data.results[0].position.lat;
          //   this.apartment.lon = response.data.results[0].position.lon;

          //   axios
          //     .post("api/user/utente/dashboard", this.apartment)
          //     .then((res) => {
          //       this.$router.push({ name: "apartments" });
          //     })
          //     .catch((err) => {
          //       console.log(err);
          //     });

          // Creiamo FormData per inviare dati inclusi i file
          //   let formData = new FormData();
          //   // Aggiungi i dati dell'appartamento
          //   for (let key in this.apartment) {
          //     formData.append(key, this.apartment[key]);
          //   }
          //   if (this.services) {
          //     // Aggiungi i servizi selezionati
          //     this.services.forEach((service) => {
          //       if (service.selected) {
          //         formData.append("services[]", service.id); // Supponendo che "id" sia il campo identificativo
          //       }
          //     });
          //   }

          //   // Invio dei dati tramite POST con FormData
          //   axios
          //     .post("api/user/utente/dashboard", formData)
          //     .then((res) => {
          //       this.$router.push({ name: "apartments" });
          //     })
          //     .catch((err) => {
          //       console.error(err.message);
          //     });
        })

        .catch((error) => {
          console.error("Errore:", error.response || error.message);
        });
    },
    activeForm(index) {
      this.apartment.address =
        this.street +
        " " +
        this.city +
        " " +
        this.postalCode +
        " " +
        this.place;
      this.apartment.lat = this.resultOfSearch[index].position.lat;
      this.apartment.lon = this.resultOfSearch[index].position.lon;
      this.isAproveStreet = true;
    },
    createApartment() {
      axios
        .post("api/user/utente/dashboard", this.apartment)
        .then((res) => {
          this.$router.push({ name: "apartments" });
        })
        .catch((err) => console.log(err.message));
    },
  },
  mounted() {
    axios
      .get("api/services")
      .then((response) => {
        this.services = response.data;
      })
      .catch((error) => {
        console.error("Errore durante il caricamento dei dati:", error);
      });
  },
  computed: {},
};
</script>

<template>
  <div class="wrapper d-flex">
    <aside>
      <Routinglist />
    </aside>
    <div class="dashboard-box">
      <div class="container-fluid p-5 d-flex justify-content-center gap-2">
        <div class="row">
          <div class="col-12">
            <h1>Inserisci un appartamento</h1>
          </div>
          <div class="col-12 col-sm-6">
            <form @submit.prevent="submit" enctype="multipart/form-data">
              <div class="mb-3">
                <label v-if="isAproveStreet" for="title" class="col-form-label"
                  >Nome appartamento:</label
                >
                <input
                  v-if="isAproveStreet"
                  type="text"
                  class="form-control"
                  id="title"
                  name="title"
                  maxlength="500"
                  min="1"
                  v-model="apartment.title"
                  required
                />
              </div>
              <div v-if="!isAproveStreet" class="mb-3">
                <label for="address" class="col-form-label">Via:</label>
                <input
                  type="text"
                  class="form-control"
                  id="address"
                  name="address"
                  v-model="street"
                  required
                />
              </div>
              <div v-if="!isAproveStreet" class="mb-3">
                <label for="address" class="col-form-label">Numero</label>
                <input
                  type="number"
                  class="form-control"
                  id="address"
                  name="address"
                  v-model="number"
                  required
                />
              </div>
              <div v-if="!isAproveStreet" class="mb-3">
                <label for="address" class="col-form-label">Citta</label>
                <input
                  type="text"
                  class="form-control"
                  id="address"
                  name="address"
                  v-model="city"
                  required
                />
              </div>
              <div v-if="!isAproveStreet" class="mb-3">
                <label for="address" class="col-form-label"
                  >Codice Postale</label
                >
                <input
                  type="number"
                  class="form-control"
                  id="address"
                  name="address"
                  v-model="postalCode"
                  required
                />
              </div>

              <div class="mb-3">
                <label
                  v-if="isAproveStreet"
                  for="number_rooms"
                  class="col-form-label"
                  >numero stanze:</label
                >
                <input
                  v-if="isAproveStreet"
                  type="number"
                  class="form-control"
                  id="number_rooms"
                  name="number_rooms"
                  min="1"
                  max="65535"
                  v-model="apartment.number_rooms"
                  required
                />
              </div>
              <div class="mb-3">
                <label
                  v-if="isAproveStreet"
                  for="number_beds"
                  class="col-form-label"
                  >numero letti:</label
                >
                <input
                  v-if="isAproveStreet"
                  type="number"
                  class="form-control"
                  id="number_beds"
                  name="number_beds"
                  min="0"
                  max="65535"
                  v-model="apartment.number_beds"
                  required
                />
              </div>
              <div class="mb-3">
                <label
                  v-if="isAproveStreet"
                  for="number_bathrooms"
                  class="col-form-label"
                  >numero bagni:</label
                >
                <input
                  v-if="isAproveStreet"
                  type="number"
                  class="form-control"
                  id="number_bathrooms"
                  name="number_bathrooms"
                  min="0"
                  max="65535"
                  v-model="apartment.number_bathrooms"
                  required
                />
              </div>
              <div v-if="isAproveStreet" class="mb-3">
                <label for="square_meters" class="col-form-label"
                  >metri quadri:</label
                >
                <input
                  type="number"
                  class="form-control"
                  id="square_meters"
                  name="square_meters"
                  min="0"
                  max="65535"
                  v-model="apartment.square_meters"
                  required
                />
              </div>
              <div v-if="isAproveStreet" class="input-group mb-3">
                <input
                  type="file"
                  class="form-control"
                  id="image"
                  name="image"
                  @change="savePhoto"
                />
                <label class="input-group-text" for="image">carica</label>
              </div>

              <!-- Anteprima immagine caricata -->
              <div v-if="imagePreview && isAproveStreet">
                <img
                  :src="imagePreview"
                  alt="Anteprima immagine"
                  class="img-fluid mb-3"
                />
              </div>

              <div
                v-if="isAproveStreet"
                class="input-group mb-3 d-flex justify-content-between"
              >
                <div v-for="item in services" :key="item.id">
                  <input
                    type="checkbox"
                    class="btn-check"
                    :id="item.id"
                    autocomplete="off"
                  />
                  <label class="btn btn-outline-dark" :for="item.id"
                    >{{ item.name }}
                  </label>
                </div>
              </div>
              <div v-if="resultOfSearch && !isAproveStreet">
                <ul>
                  <li
                    v-for="(street, index) in resultOfSearch"
                    :key="index"
                    @click="activeForm(index)"
                  >
                    {{
                      street.address.streetName +
                      " " +
                      street.address.countrySubdivisionCode +
                      " " +
                      street.address.municipality +
                      " " +
                      street.address.neighbourhood +
                      " " +
                      street.address.postalCode
                    }}
                  </li>
                </ul>
              </div>
              <button
                v-if="!isAproveStreet"
                @click="submit"
                class="btn btn-dark"
              >
                Approva indirizzo
              </button>
              <button
                v-if="isAproveStreet"
                class="btn btn-dark"
                @click="createApartment"
              >
                inserisci appartamento
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style lang='scss' scoped>
img {
  max-height: 500px;
}
</style>

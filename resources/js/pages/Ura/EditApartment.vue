<script>
import { store } from "../../store/store";
import { checkAdress } from "../../store/store";

export default {
  name: "EditApartment",

  data() {
    return {
      apartment: [],
      errors: {},
    };
  },
  methods: {
    findApartment(id) {
      axios
        .get("http://127.0.0.1:8000/api/show-apartment", {
          params: {
            id: id,
          },
        })
        .then((res) => {
          this.apartment = res.data;
        })
        .catch((err) => {
          console.log(err);
        });
    },

    changeVisibility() {
      // Cambia il valore booleano di is_visible
      this.apartment.is_visible = !this.apartment.is_visible;
    },

    validate() {
      this.errors = {};

      if (!this.apartment.title) {
        this.errors.title = "Il titolo è obbligatorio.";
      }
      if (
        !this.apartment.number_rooms ||
        isNaN(this.apartment.number_rooms) ||
        this.apartment.number_rooms <= 0
      ) {
        this.errors.number_rooms = "Inserisci un numero di stanze valido.";
      }
      if (
        !this.apartment.number_beds ||
        isNaN(this.apartment.number_beds) ||
        this.apartment.number_beds <= 0
      ) {
        this.errors.number_beds = "Inserisci un numero di letti valido.";
      }
      if (
        !this.apartment.number_bathrooms ||
        isNaN(this.apartment.number_bathrooms) ||
        this.apartment.number_bathrooms <= 0
      ) {
        this.errors.number_bathrooms = "Inserisci un numero di bagni valido.";
      }
      if (!this.apartment.address) {
        this.errors.address = "L'indirizzo è obbligatorio.";
      }
      if (
        !this.apartment.square_meters ||
        isNaN(this.apartment.square_meters) ||
        this.apartment.square_meters <= 0
      ) {
        this.errors.square_meters =
          "Inserisci un valore di metri quadri valido.";
      }

      return Object.keys(this.errors).length === 0;
    },

    submit() {
      if (!this.validate()) {
        console.log("Errore di validazione", this.errors);
        return;
      }

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
              this.$router.push({
                name: "apartments",
                query: {
                  toastMessage: `Appartamento ${this.apartment.title}  modificato con successo`,
                  toastType: "success",
                },
              });
            })
            .catch((err) => {
              console.log(err);
              this.$router.push({
                name: "apartments",
                query: {
                  toastMessage: `Errore durante la modifica dell'appartamento ${this.apartment.title}`,
                  toastType: "error",
                },
              });
            });
        })
        .catch((error) => {
          console.error("Errore:", error.response || error.message);
        });
    },
  },
  computed: {
    apartamentFiltred() {
      return this.apartment;
    },
  },
  mounted() {
    this.findApartment(this.$route.params.id);
  },
};
</script>

<template>
  <div class="container">
    <h1 class="my-5">Modifica di {{ apartamentFiltred.title }}</h1>

    <form @submit.prevent="submit" class="mb-4">
      <label for="title" class="form-label">Titolo</label>
      <input
        type="text"
        class="form-control"
        v-model="apartamentFiltred.title"
        id="title"
        name="title"
      />
      <div v-if="errors.title" class="text-error">
        <small>
          {{ errors.title }}
        </small>
      </div>

      <label for="" class="form-label">Numero di stanze</label>
      <input
        type="number"
        class="form-control"
        v-model="apartamentFiltred.number_rooms"
        id="number_rooms"
        name="number_rooms"
      />
      <div v-if="errors.number_rooms" class="text-error">
        <small>
          {{ errors.number_rooms }}
        </small>
      </div>

      <label for="" class="form-label">Numero di letti</label>
      <input
        type="number"
        class="form-control"
        v-model="apartamentFiltred.number_beds"
        id="number_beds"
        name="number_beds"
      />
      <div v-if="errors.number_beds" class="text-error">
        <small>
          {{ errors.number_beds }}
        </small>
      </div>

      <label for="" class="form-label">Numero di bagni</label>
      <input
        type="number"
        class="form-control"
        v-model="apartamentFiltred.number_bathrooms"
        id="number_bathrooms"
        name="number_bathrooms"
      />
      <div v-if="errors.number_bathrooms" class="text-error">
        <small>
          {{ errors.number_bathrooms }}
        </small>
      </div>

      <label for="" class="form-label">Indirizzo</label>
      <input
        type="text"
        class="form-control"
        v-model="apartamentFiltred.address"
        id="address"
        name="address"
      />
      <div v-if="errors.address" class="text-error">
        <small>
          {{ errors.address }}
        </small>
      </div>

      <label for="" class="form-label">Metri quadri</label>
      <input
        type="text"
        class="form-control"
        v-model="apartamentFiltred.square_meters"
        id="square_meters"
        name="square_meters"
      />
      <div v-if="errors.square_meters" class="text-error">
        <small>
          {{ errors.square_meters }}
        </small>
      </div>

      <!-- <label for="" class="form-label">Immagine</label>
      <input
        type="text"
        class="form-control"
        /> -->

      <label class="form-check-label" for="flexSwitchCheckDefault"
        >Visibilità</label
      >
      <div class="form-check form-switch">
        <input
          @click="changeVisibility"
          class="form-check-input"
          type="checkbox"
          role="switch"
          :checked="!apartment.is_visible"
        />

        <span v-if="apartment.is_visible">Appartamento visibile</span>
        <span v-else>Appartamento non visibile</span>
      </div>

      <button type="submit" class="btn btn-primary">Invia</button>
    </form>
  </div>
</template>



<style lang="scss" scoped>
label {
  margin-top: 20px;
}
button {
  margin-top: 30px;
}

.text-error {
  color: red;
}
</style>

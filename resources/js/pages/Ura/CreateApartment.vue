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
        image: "",
        square_meters: "",
        // services:[]

      },
      services:[],

      errors: {},
    };
  },
  methods: {
    savePhoto(event) {
      this.apartment.image = event.target.files[0];

      let reader = new FileReader();
      reader.addEventListener(
        "load",
        function () {
          this.imagePreview = reader.result;
        }.bind(this),
        false
      );

      if (this.apartment.image) {
        if (/\.(jpe?g|png|gif)$/i.test(this.apartment.image.name)) {
          reader.readAsDataURL(this.apartment.image);
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
            .post("api/user/utente/dashboard", this.apartment)
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
    axios
      .get("api/services")
      .then((response) => {
        this.services = response.data;
        //   console.log(this.services[0]);
      })
      .catch(error => {
        console.error('Errore durante il caricamento dei dati:', error);
      });



  },
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
                <label for="title" class="col-form-label"
                  >Nome appartamento:</label
                >
                <input
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
              <div class="mb-3">
                <label for="address" class="col-form-label">Indirizzo:</label>
                <input
                  type="text"
                  class="form-control"
                  id="address"
                  name="address"
                  v-model="apartment.address"
                  required
                />
              </div>

              <div class="mb-3">
                <label for="number_rooms" class="col-form-label"
                  >numero stanze:</label
                >
                <input
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
                <label for="number_beds" class="col-form-label"
                  >numero letti:</label
                >
                <input
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
                <label for="number_bathrooms" class="col-form-label"
                  >numero bagni:</label
                >
                <input
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
              <div class="mb-3">
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
              <div class="input-group mb-3">
                <input
                  type="file"
                  class="form-control"
                  id="image"
                  name="image"
                  @change="savePhoto"
                />
                <label class="input-group-text" for="image">carica</label>
              </div>

                            <div class="mb-3">
                                <label for="number_rooms" class="col-form-label"
                                >numero stanze:</label
                                >
                                <input
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
                                <label for="number_beds" class="col-form-label"
                                >numero letti:</label
                                >
                                <input
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
                                <label for="number_bathrooms" class="col-form-label"
                                >numero bagni:</label
                                >
                                <input
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
                            <div class="mb-3">
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
                            <div class="input-group mb-3">
                                <input
                                type="file"
                                class="form-control"
                                id="image"
                                name="image"
                                />
                                <label class="input-group-text" for="image"
                                >carica</label
                                >
                            </div>

                            <div class="input-group mb-3 d-flex justify-content-between">
                             <div  v-for="item in services" :key="item.id">
                                <input  type="checkbox" class="btn-check" v-model="item.name" autocomplete="off" value="item.id">
                                <label class="btn btn-outline-dark" :for="item.id" >{{ item.name }} </label>
                             </div>

                            </div>

                        <button type="submit"  class="btn btn-dark">inserisci appartamento</button>

            </form>
                  </div>
                </div>
              <button type="submit" class="btn btn-dark">
                inserisci appartamento
              </button>

      </div>

          </div>
        </div>



</template>
<style lang='scss' scoped>
img {
  max-height: 500px;
}
</style>

<script>
export default {
  name: "CreateApartment",
  data() {
    return {
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
      },
      errors: {},
    };
  },
  methods: {
    submit() {
      console.log(this.apartment);

      axios
        .post("api/user/utente/dashboard", this.apartment)
        .then((res) => {
          //    this.$router.push({ name: "dashboard" });
          console.log("funziona", res.data);
        })
        .catch((err) => {
          this.errors = err.response;
          console.log(err.response);
        });
    },
  },
};
</script>
<template>
  <div class="container-fluid p-5 d-flex justify-content-center gap-2">
    <div class="row">
      <div class="col-12">
        <h1>Inserisci un appartamento</h1>
      </div>
      <div class="col-12 col-sm-6">
        <button
          type="button"
          class="btn btn-dark"
          data-bs-toggle="modal"
          data-bs-target="#exampleModal"
          data-bs-whatever="@mdo"
        >
          diventa Host di BolBnB
        </button>

        <div
          class="modal fade"
          id="exampleModal"
          tabindex="-1"
          aria-labelledby="exampleModalLabel"
          aria-hidden="true"
        >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">
                  Dati Appartamento
                </h1>
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="modal"
                  aria-label="Close"
                ></button>
              </div>
              <div class="modal-body">
                <form @submit.prevent="submit">
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
                      v-model="apartment.title"
                      required
                    />
                  </div>
                  <div class="mb-3">
                    <label for="address" class="col-form-label"
                      >Indirizzo:</label
                    >
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
                    <label for="lat" class="col-form-label">latitudine:</label>
                    <input
                      type="text"
                      class="form-control"
                      id="lat"
                      name="lat"
                      disabled
                    />
                  </div>
                  <div class="mb-3">
                    <label for="lon" class="col-form-label">longitudine:</label>
                    <input
                      type="text"
                      class="form-control"
                      id="lon"
                      name="lon"
                      disabled
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
                    />
                    <label class="input-group-text" for="image">carica</label>
                  </div>

                  <div class="modal-footer">
                    <button
                      type="button"
                      class="btn btn-secondary"
                      data-bs-dismiss="modal"
                    >
                      chiudi
                    </button>
                    <button type="submit" class="btn btn-dark">
                      inserisci appartamento
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 col-sm-6">
        <img
          class="img-fluid"
          src="../../../../public/img/bed_and_breakfast_image.jpg"
          alt="imgBnB"
        />
      </div>
    </div>
  </div>
</template>
<style lang='scss' scoped>
img {
  max-height: 500px;
}
</style>

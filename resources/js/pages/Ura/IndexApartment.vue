<script>
import { RouterLink } from "vue-router";
import Routinglist from "./partials/Routinglist.vue";
import { store } from "../../store/store";

export default {
  name: "IndexApartment",
  components: {
    Routinglist,
  },
  data() {
    return {
      name: "",
      apartments: store.userApartment,
    };
  },
  methods: {
    // // mostra toast
    // showToast() {
    //   const toastEl = this.$refs.liveToast; // Riferimento al toast
    //   const toast = new bootstrap.Toast(toastEl); // Creazione dell'istanza Toast di Bootstrap
    //   toast.show(); // Mostra il toast
    // },
    // hideToast() {
    //   const toastEl = this.$refs.liveToast;
    //   const toast = new bootstrap.Toast(toastEl);
    //   toast.hide();
    // },
    deleteApartment(apartment) {
       axios
         .delete(`/api/user/utente/dashboard/${apartment.id}`) //chiamata API al backend con DELETE
         .then((res) => {
           //elimina l'appartamento dalla lista locale (frontend)
            this.apartments = this.apartments.filter(
              (a) => a.id !== apartment.id
            );
           //aggiorna il localStorage e lo store
           store.userApartment = store.userApartment.filter(
             (a) => a.id !== apartment.id
           );
           localStorage.setItem(
             "apartments",
             JSON.stringify(store.userApartment)
           );
           this.message = `Appartamento "${apartment.title}" eliminato con successo`;
           this.messageType = "success";
         })
         .catch((err) => {
           console.error(err);
           this.message = `Errore durante l'eliminazione dell'appartamento "${apartment.title}"`;
           this.messageType = "error";
         });
     },
  },
  //   detailApartment(id) {},

  mounted() {
    axios
      .get("/api/user")
      .then((res) => {
        this.name = res.data.name;
      })
      .catch((err) => {
        console.log(err);
      });

    // axios
    //   .get("api/user/utente/dashboard")
    //   .then((response) => {
    //
    //     this.apartments = response.data;
    //   })
    //   .catch((err) => {
    //     console.log(err);
    //   });

    axios
      .get("api/user/utente/dashboard")
      .then((response) => {
        console.log(response.data);
        store.userApartment = response.data;
        this.apartments = store.userApartment;
      })
      .catch((err) => {
        console.log(err);
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
      <div class="container-fluid my-3">
        <div class="row">
          <div class="col-lg-12 col-md-12">
            <h2 class="my-4">I miei appartamenti</h2>

            <h4 class="my-5">Appartamenti totali: {{ apartments.length }}</h4>

            <div
              v-if="message"
              :class="[
                'alert',
                messageType === 'success' ? 'alert-success' : 'alert-danger',
              ]"
            >
              {{ message }}
            </div>

            <div class="table-responsive">
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">#id</th>
                    <th scope="col">Immagine</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Disponibilità</th>
                    <th scope="col">Messaggi</th>
                    <th scope="col">Statistiche</th>
                    <th scope="col">Azioni</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="apartment in apartments" :key="apartment.id">
                    <td scope="row" class="align-middle">
                      {{ apartment.id }}
                    </td>
                    <td class="img-container" scope="row">
                      <img
                        class="img-fluid"
                        src="../../../../public/img/bed_and_breakfast_image.jpg"
                        alt=""
                      />
                    </td>
                    <td scope="row" class="align-middle">
                      {{ apartment.title }}
                    </td>
                    <td scope="row" class="align-middle">
                      <p
                        class="badge text-bg-success"
                        v-if="apartment.is_visible === 1"
                      >
                        Disponibile
                      </p>
                      <p class="badge text-bg-danger" v-else>Occupato</p>
                    </td>
                    <td scope="row" class="align-middle">
                      <i class="fa-solid fa-envelope"></i>
                    </td>
                    <td scope="row" class="align-middle">
                      <i class="fa-solid fa-chart-simple"></i>
                    </td>
                    <td scope="row" class="actions align-middle">
                      <router-link
                        :to="{
                          name: 'showApartment',
                          params: { id: apartment.id },
                        }"
                      >
                        <div class="btn btn-primary">
                          <i class="fa-solid fa-eye"></i>
                        </div>
                      </router-link>
                      <router-link
                        class="link"
                        :to="{
                          name: 'EditApartment',
                          params: { id: apartment.id },
                        }"
                      >
                        <div class="btn btn-warning">
                          <i class="fa-solid fa-pencil"></i>
                        </div>
                      </router-link>

                      <div class="d-inline-block">
                        <button
                          type="button"
                          class="btn btn-danger"
                          id="liveToastBtn"
                          data-bs-toggle="modal"
                          data-bs-target="#exampleModal"
                        >
                          <i class="fa-solid fa-trash"></i>
                        </button>

                        <!-- Modal -->
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
                                <h5 class="modal-title" id="exampleModalLabel">
                                  Sei sicuro di voler eliminare l'appartamento?
                                </h5>
                                <button
                                  type="button"
                                  class="btn-close"
                                  data-bs-dismiss="modal"
                                  aria-label="Close"
                                ></button>
                              </div>
                              <div class="modal-body">
                                In questo modo {{ apartment.title }} non sarà
                                più disponibile
                              </div>
                              <div class="modal-footer">
                                <button
                                  type="button"
                                  class="btn btn-secondary"
                                  data-bs-dismiss="modal"
                                >
                                  Chiudi
                                </button>
                                <button
                                  @click="deleteApartment(apartment)"
                                  type="button"
                                  class="btn btn-danger"
                                  data-bs-dismiss="modal"
                                >
                                  Elimina
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style lang='scss' scoped>
@use "../../../scss/variables" as *;
@use "../../../scss/dashboard" as *;

td {
  height: 100px;
}

.img-container {
  width: 5%;
}

.btn {
  margin-right: 10px;
}

// @use 'path' as *;
</style>

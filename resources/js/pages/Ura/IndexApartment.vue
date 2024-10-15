<script>
import Routinglist from './partials/Routinglist.vue';
import routinglist from './partials/Routinglist.vue';
export default {
  name: "IndexApartment",
  components:{
    routinglist
  },
  data() {
    return {
      name: "",
      apartments: [],
    };
  },
  methods: {},
  mounted() {
    axios
      .get("/api/user")
      .then((res) => {
        // console.log(res);
        this.name = res.data.name;
      })
      .catch((err) => {
        console.log(err);
      });

    axios
      .get("api/user/utente/dashboard")
      .then((response) => {
        console.log(response);
        this.apartments = response.data;
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
        <routinglist />
    </aside>
    <div class="dashboard-box">
      <div class="container-fluid my-3">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <h2 class="mb-3">I miei appartamenti</h2>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#id</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Message</th>
                            <th scope="col">Luogo</th>
                            <th scope="col">Azioni</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="apartment in apartments" :key="apartment.id">
                            <td scope="row">
                                {{ apartment.id }}
                            </td>
                            <td scope="row">
                                {{ apartment.title }}
                            </td>
                            <td scope="row">-</td>
                            <td scope="row">
                                {{ apartment.address }}
                            </td>
                            <td scoper="row" class="actions d-flex gap-2">
                                <a href="#" class="btn btn-primary">
                                <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="#" class="btn btn-warning">
                                <i class="fa-solid fa-pencil"></i>
                                </a>
                                <a href="#" class="btn btn-danger">
                                <i class="fa-solid fa-trash"></i>
                                </a>
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

@use '../../../scss/variables' as *;
@use '../../../scss/dashboard' as *;

// @use 'path' as *;
</style>

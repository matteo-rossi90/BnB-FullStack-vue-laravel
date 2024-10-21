<script>
import IndexApartment from "./IndexApartment.vue";
import Messages from "./Messages.vue";
import Sponsor from "./Sponsor.vue";
import Routinglist from "./partials/Routinglist.vue";
import { store } from "../../store/store.js";

export default {
  name: "Dashboard",
  components: {
    IndexApartment,
    Messages,
    Sponsor,
    Routinglist,
  },
  data() {
    return {
      name: "",
      apartments: store.userApartment,
    };
  },
  methods: {},

  mounted() {
    this.apartments = store.userApartment;
    axios
      .get("api/user/utente/dashboard")
      .then((response) => {
        console.log("dash- user apartment");
        store.userApartment = response.data;
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
      <div class="container-fluid my-5">
        <h1>Dashboard di {{ name }}</h1>
        <h4 class="my-5">
          Al momento hai registrato {{ apartments.length }} appartmanenti su
          BoolBnb
        </h4>
      </div>
    </div>
  </div>
</template>
<style lang='scss' scoped>
@use "../../../scss/variables" as *;
@use "../../../scss/dashboard" as *;

// @use 'path' as *;
</style>

<script>
import IndexApartment from "./IndexApartment.vue";
import routinglist from "./partials/Routinglist.vue";

export default {
  name: "Dashboard",
  components: {
    IndexApartment,
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
        this.name = res.data.name;
      })
      .catch((err) => {
        console.log(err);
      });

    axios
      .get("api/user/utente/dashboard")
      .then((response) => {
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
        <h1>Dashboard di {{ name }}</h1>
      </div>
    </div>
  </div>
</template>
<style lang='scss' scoped>

@use '../../../scss/variables' as *;
@use '../../../scss/dashboard' as *;

// @use 'path' as *;
</style>

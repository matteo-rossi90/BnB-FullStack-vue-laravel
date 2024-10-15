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
    <div id="dashboard-box">
      <div class="container my-3">
        <h1>Dashboard di {{ name }}</h1>
      </div>
    </div>
  </div>
</template>
<style lang='scss' scoped>

@use '../../../scss/variables' as *;

.wrapper {
  height: calc(100vh - 48px);
  width: 100%;
  overflow: hidden;
}

aside {
  width: 350px;
  height: 100%;
  border-right: 1px solid $color;
}

#dashboard-box {
  width: 100%;
}

// @use 'path' as *;
</style>

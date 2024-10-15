<script>
import IndexApartment from "./IndexApartment.vue";

export default {
  name: "Dashboard",
  components: {
    IndexApartment,
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
      <ul>
        <li>
          <router-link :to="{ name: 'apartments' }"
            >I miei appartamenti</router-link
          >
        </li>
        <li>
          <router-link class="link" :to="{ name: 'createApartment' }"
            >create apartment</router-link
          >
        </li>
      </ul>
    </aside>
    <div id="dashboard-box">
      <div class="container my-3">
        <h1>Dashboard di {{ name }}</h1>
      </div>
    </div>
  </div>
</template>
<style lang='scss' scoped>
.wrapper {
  height: calc(100vh - 48px);
  width: 100%;
  overflow: hidden;
}

aside {
  width: 200px;
  height: 100%;
  background-color: rgb(219, 219, 219);
}

#dashboard-box {
  width: 100%;
}

// @use 'path' as *;
</style>

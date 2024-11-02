<script>
export default {
  name: "Routinglist",
  methods: {
    logout() {
      axios.get("/sanctum/csrf-cookie").then(() => {
        axios
          .post("/api/logout")
          .then((response) => {
            axios
              .get("/api/user")
              .then((response) => {
                store.user = response.data;
                if (response.data.name) {
                  store.userName = response.data.name;
                } else {
                  store.userName = "Profilo";
                }
                console.log("app- user e user name: ok");
              })
              .catch((err) => {
                store.is_logged = false;
                store.userName = "Accedi";
                console.log("app- user e user name:", err.message);
              });
            this.$router.push({ name: "login" });
          })
          .catch((err) => {
            console.log("Errore nel logout:", err);
          });
      });
    },
  },
  props: {
    visible: {
      typeof: Boolean,
    },
  },
};
</script>

<template>
  <div class="mt-2 container-fluid">
    <ul class="d-flex flex-column justify-content-center">
      <li class="py-3 d-flex align-items-center" v-if="visible">
        <router-link
          class="link d-flex align-items-center gap-3"
          :to="{ name: 'dashboard' }"
        >
          <i class="fa-solid fa-gauge"></i>
          <span class="d-none d-xl-inline d-lg-inline"
            >Dashboard</span
          ></router-link
        >
      </li>
      <li class="py-3 d-flex align-items-center">
        <router-link
          class="link d-flex align-items-center gap-3"
          :to="{ name: 'home' }"
        >
          <i class="fa-solid fa-house"></i>
          <span class="d-none d-xl-inline d-lg-inline"
            >Pagina principale</span
          ></router-link
        >
      </li>
      <li @click="logout" class="py-3 d-flex align-items-center gap-3 click link">
        <i class="fa-solid fa-arrow-right-from-bracket"></i>
        <!-- <font-awesome-icon :icon="['fas', 'arrow-right-from-bracket']" /> -->
        <span class="d-none d-xl-inline d-lg-inline">Disconnetti</span>
      </li>
      <!-- <li class="py-3 d-flex align-items-center"> -->
      <!-- <router-link -->
      <!-- class="link d-flex align-items-center gap-2" -->
      <!-- :to="{ name: 'messages' }" -->
      <!-- > -->
      <!-- <i class="fa-solid fa-envelope"></i> -->
      <!-- <span class="d-none d-xl-inline d-lg-inline" -->
      <!-- >Messaggi</span -->
      <!-- ></router-link -->
      <!-- > -->
      <!-- </li> -->
      <!-- <li class="py-3 d-flex align-items-center"> -->
      <!-- <router-link -->
      <!-- class="link d-flex align-items-center gap-2" -->
      <!-- :to="{ name: 'sponsor' }" -->
      <!-- > -->
      <!-- <i class="fa-solid fa-money-check"></i> -->
      <!-- <span class="d-none d-xl-inline d-lg-inline" -->
      <!-- >Sponsorizzazione</span -->
      <!-- ></router-link -->
      <!-- > -->
      <!-- </li> -->
    </ul>
  </div>
</template>

<style lang="scss" scoped>
@use "../../../../scss/dashboard" as *;

.click{
    cursor: pointer;
}

</style>

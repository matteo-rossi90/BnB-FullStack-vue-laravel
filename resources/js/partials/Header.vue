<script>
export default {
  name: "Header",
  data() {
    return {
      name: "",
    };
  },
  methods: {
    logout() {
      axios
        .post("/api/logout")
        .then((response) => {
          this.$router.push({ name: "home" });
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  mounted() {
    axios
      .get("/api/user")
      .then((response) => {
        this.name = response.data.name;
      })
      .catch((err) => {
        console.log(err);
      });
  },
};
</script>
<template>
  <header>
    <nav>
      <div class="container">
        <div class="row">
          <div class="col">
            <h2>logo</h2>
          </div>
          <div class="col">
            <router-link class="link" :to="{ name: 'home' }">home</router-link>
            <router-link class="link" :to="{ name: 'login' }"
              >login</router-link
            >
            <router-link class="link" :to="{ name: 'register' }"
              >register</router-link
            >
            <router-link class="link" :to="{ name: 'dashboard' }"
              >dashboard</router-link
            >
            <router-link class="link" :to="{ name: 'createApartment' }"
              >create apartment</router-link
            >
            <a href="#" @click="logout">Logout {{ name }}</a>
          </div>
        </div>
      </div>
    </nav>
  </header>
</template>
<style lang="scss" scoped>
/* // @use 'path' as *; */
header {
  display: flex;
  gap: 1rem;
}
</style>

<script>
export default {
  name: "Dashboard",
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
        console.log(response);
        this.name = response.data.name;
      })
      .catch((err) => {
        console.log(err);
      });
  },
};
</script>
<template>
  <h1>Dashboard di {{ name }}</h1>
  <a href="#" @click="logout">Logout</a>
</template>
<style lang='scss' scoped>
// @use 'path' as *;
</style>

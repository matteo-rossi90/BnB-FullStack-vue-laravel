<script>
import { store } from "../store/store";
export default {
  name: "Home",
  data() {
    return {};
  },
  methods: {},
  mounted() {
    axios
      .get("/api/user")
      .then((response) => {
        store.user = response.data;

        axios
          .get("api/user/utente/dashboard")
          .then((response) => {
            store.allApartment = response.data;
          })
          .catch((err) => {
            console.log(err);
          });
      })
      .catch((err) => {
        console.log(err);
      });
  },
};
</script>
<template>
  <h1>Home dell'utente senza login</h1>
</template>
<style lang='scss' scoped>
// @use 'path' as *;
</style>

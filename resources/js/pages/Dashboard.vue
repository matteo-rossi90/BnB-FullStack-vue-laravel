<script>
export default {
  name: "Dashboard",
  data() {
    return {
      name: "",
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

    axios.get("api/user/utente/dashboard")
    .then((response) =>{
        console.log(response);
    })
    .catch((err) => {
        console.log(err);
    });

  },
};
</script>
<template>
  <h1>Dashboard di {{ name }}</h1>
</template>
<style lang='scss' scoped>
// @use 'path' as *;
</style>

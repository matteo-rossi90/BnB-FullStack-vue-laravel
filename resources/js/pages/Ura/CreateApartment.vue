<script>

export default {
  name: "CreateApartment",
  data() {
    return {
        // apartment:{
        //     title:""
        // },
        errors: {},
    };
  },
  methods: {
    // submit() {
    //   axios
    //     .post("api/user/utente/dashboard", this.apartment)
    //     .then(() => {
    //       this.$router.push({ name: "dashboard" });
    //     })
    //     .catch((err) => {
    //       this.errors = err.response.data.errors;
    //     });
  //}
},
}

</script>
<template>
  <div class="container">
    <h1>Inserisci il tuo appartamento</h1>
        <form @submit.prevent="submit">
            <label for="title">Titolo</label>
            <input type="text" id="title" name="title"  />

        </form>
  </div>

</template>
<style lang='scss' scoped>
// @use 'path' as *;
</style>

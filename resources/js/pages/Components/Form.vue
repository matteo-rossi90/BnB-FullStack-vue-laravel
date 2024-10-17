<script>
import { checkAdress } from '../../store/store';
import { store } from '../../store/store';
export default {

  name: "Form",

  data() {
    return {
      //
      apartment: {
        title: "",
        address: "",
        lat: "",
        lon: "",
        number_rooms: "",
        number_beds: "",
        number_bathrooms: "",
        image: "",
        square_meters: "",
      },
      errors: {},
    };
  },
  methods: {
    submit() {
      let urlRequest = checkAdress(this.apartment.address);

      axios
        .get("http://127.0.0.1:8000/proxy-tomtom", {
          params: { url: urlRequest },
        })
        .then((response) => {
          this.apartment.lat = response.data.results[0].position.lat;
          this.apartment.lon = response.data.results[0].position.lon;

          axios
            .post("api/user/utente/dashboard", this.apartment)
            .then((res) => {

                this.$router.push({ name: "apartments" });

            })
            .catch((err) => {
              console.log(err);
            });
        })
        .catch((error) => {
          console.error("Errore:", error.response || error.message);
        });


    },
  },
  mounted() {

  },
};
</script>

<template>
<h1>form create</h1>

</template>
<style lang='scss' scoped>
img {
  max-height: 500px;
}
</style>

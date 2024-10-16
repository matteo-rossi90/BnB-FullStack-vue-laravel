<script>
import axios from 'axios';
import Routinglist from './partials/Routinglist.vue';

    export default {
        name: 'EditApartment',
        components:{
                 Routinglist
    },
    data() {
    return {
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
    mounted() {
            axios.get(`api/user/utente/dashboard/${apartment}`)
            .then((res) => {
         console.log(res);

    })
    .catch((err) => {
        console.log(err);
    });

    },
    }

</script>

<template>
    <h1>edit</h1>

</template>



<style lang="scss" scoped>

</style>

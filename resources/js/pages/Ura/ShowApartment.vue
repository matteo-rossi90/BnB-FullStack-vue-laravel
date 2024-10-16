<script>
import {store} from '../../store/store';
export default {
    name: 'ShowApartment',

    data(){
        return {
        //     apartment:{
        //      title:"",
        //      address:"",
        //      lat:"",
        //      lon:"",
        //      number_rooms:"",
        //      number_beds:"",
        //      number_bathrooms:"",
        //      original_name:"",
        //      image:"",
        //      square_meters:"",
        //  },

        apartment: [],
        };
    },

    methods: {
        fetchApartment(id) {
            // try {
            //     const response = await axios.get(`/api/apartment/${id}`);
            //     console.log(response);

            //     // this.apartment = response.data;
            //     // console.log(this.apartment);

            // } catch (error) {
            //     console.error("Errore nel recupero del post:", error);
            // }


            // axios.get(`api/user/utente/dashboard/${id}`)
            //     .then(res=>{
            //         // console.log(res);

            //     })
        },

        findApartment(){
            const apartments = store.allApartmentGlobal;

            console.log('tutti app ' + apartments);
            console.log(store.allApartmentGlobal);

            this.apartment= apartments.find(apartment => apartment.id === this.$route.params.id);

            console.log('singolo app ' + this.apartment);


        }
    },

    mounted(){
        // const apartmentId = this.$route.params.id;
        // this.fetchApartment(apartmentId);

        // function findApartment(){
        //     const apartments = store.allApartmentGlobal;

        //     this.apartment= apartments.filter(apartment => apartment.id === this.$route.params.id);
        // }

        this.findApartment();
        console.log(this.$route.params.id);
        // console.log(this.apartment);


    }
}

</script>

<template>
<h1>pagina show</h1>
<div>

    <!-- <p>{{ apartment.title }}</p> -->
</div>

</template>

<style lang="scss" scoped>

</style>

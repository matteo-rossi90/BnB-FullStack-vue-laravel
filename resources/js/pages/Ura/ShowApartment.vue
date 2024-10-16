<script>
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

        apartment: null,
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


            axios.get(`api/user/utente/dashboard/${id}`)
                .then(res=>{
                    // console.log(res);

                })
        }
    },

    mounted(){
        const apartmentId = this.$route.params.id;
        this.fetchApartment(apartmentId);
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

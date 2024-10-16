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
        // async fetchPost(id) {
        //     try {
        //         const response = await axios.get(`/api/apartment/${id}`);
        //         this.post = response.data;
        //     } catch (error) {
        //         console.error("Errore nel recupero del post:", error);
        //     }
        // }
    },

    mounted(){
        // const postId = this.$route.params.id;
        // this.fetchPost(postId);
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

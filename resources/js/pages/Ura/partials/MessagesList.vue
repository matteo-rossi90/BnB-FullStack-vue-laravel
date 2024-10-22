<script>
import axios from 'axios';
export default{
    name: 'MessageList',
    data(){

    },
    mounted() {
        axios
            .get("api/user/utente/messaggi")
            .then((res) => {
            this.messages = res.data;
            })
            .catch((err) => {
            console.log(err);
            });
        },
}
</script>

<template>

<!-- <div> -->
    <!-- <ul v-for="(message, index) in messages" :key="index"> -->
        <!-- <li>{{ message.message }}</li> -->
    <!-- </ul> -->
<!-- </div> -->
</template>

<style lang="scss">

</style>

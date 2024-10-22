<script>
import axios from 'axios';
export default{
    name: 'MessageList',
    data(){
        return{
            messages:[]
        }
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

<div>
    <ul class="list-group list-group-flush">
        <li class="list-group-item d-flex align-items-center" v-for="(message, index) in messages" :key="index">
            <div class="image mx-3">
                <img src="profile-circle.svg" alt="">
            </div>
            <div class="text-box my-3">
                <div class="d-flex">
                    <h6>{{ message.name }} {{ message.surname }}</h6>
                    <small>{{ message.created_at }}</small>
                </div>
                <small>{{ message.email }}</small>
                <p class="message-email">{{ message.message }}</p>
            </div>
        </li>
    </ul>
</div>
</template>

<style lang="scss">
@use '../../../../scss/message' as*;

</style>

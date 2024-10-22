<script>
import axios from "axios";
import MessagesList from "./partials/MessagesList.vue";

export default {
  name: "Messages",
  components: {
    MessagesList,
  },
  data() {
    return {
      messages: [],
    };
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
};
</script>

<template>
  <div class="wrapper d-flex">
    <aside>
        <div class="container">
            <div class="d-flex justify-content-center my-4">
                <h4>Tutti i messaggi</h4>
            </div>

            <div class="d-flex mx-4">
                <input type="search" class="form-control" id="box-search">
                <button type="submit" class="search-button">
                    <i class="fa-solid fa-search"></i>
                </button>
            </div>
            <div class="message-list mt-4">
                <MessagesList />
            </div>

        </div>

    </aside>
    <div class="dashboard-box">
      <div class="container-fluid my-3">

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
    </div>
  </div>
</template>

<style lang="scss" scoped>
@use "../../../scss/variables" as *;
@use "../../../scss/message" as *;

input{
    border-radius: 50px;
}

#box-search{
    position: relative;
}

.search-button{
    position: absolute;
    right:2.5rem;
    padding:5px;
    background-color: transparent;
    border: none;
}

.message-list{
    height: calc(100vh - 300px);
    padding:10px;
    width: 100%;
    overflow-y:auto;

    //personalizzazione scrollbar per Chrome
    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    ::-webkit-scrollbar-thumb {
        background-color: #888;
        border-radius: 10px;
        border: 2px solid #f1f1f1;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }

    //personalizzazione scrollbar per Forefox
    scrollbar-width: thin;
    scrollbar-color: #888 #f1f1f1;
}
</style>

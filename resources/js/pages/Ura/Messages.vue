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

            <div class="d-flex">
                <input type="search" class="form-control" id="box-search">
                <button type="submit" class="search-button">
                    <i class="fa-solid fa-search"></i>
                </button>
            </div>

            <MessagesList />
        </div>

    </aside>
    <div class="dashboard-box">
      <div class="container-fluid my-3">

        <!-- lista già implementata dei messaggi -->
        <!-- <ul v-for="(message, index) in messages" :key="index"> -->
        <!-- <li> -->
        <!-- {{ message.name }} {{ message.surname }} - {{ message.email }} -->
        <!-- <p>{{ message.message }}</p> -->
        <!-- </li> -->
        <!-- </ul> -->
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
    position:relative;
}

.search-button{
    position:absolute;
    background-color: transparent;
    border: none;
}
</style>

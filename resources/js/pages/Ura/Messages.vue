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
      <MessagesList />
    </aside>
    <div class="dashboard-box">
      <div class="container-fluid my-3">
        <h1>Messaggi</h1>

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
@use "../../../scss/dashboard" as *;
</style>

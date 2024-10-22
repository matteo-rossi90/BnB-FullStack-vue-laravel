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
      selectedMessage: null,
      selectedImage: null,
      images: [
        "https://picsum.photos/seed/profile1/80/80",
        "https://picsum.photos/seed/profile2/80/80",
        "https://picsum.photos/seed/profile3/80/80",
        "https://picsum.photos/seed/profile4/80/80",
        "https://picsum.photos/seed/profile5/80/80",
        "https://picsum.photos/seed/profile6/80/80",
        "https://picsum.photos/seed/profile7/80/80",
        "https://picsum.photos/seed/profile8/80/80",
        "https://picsum.photos/seed/profile9/80/80",
        "https://picsum.photos/seed/profile10/80/80",
      ],
    };
  },
  methods:{
    formatDate(dateStr){
      const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
      const date = new Date(dateStr);
      return date.toLocaleDateString('it-IT', options);
    },
    getImage(index) {
      return this.images[index % this.images.length];
    },
    selectMessage(message) {
      this.selectedMessage = message;
      this.selectedImage = this.getImage(index)
    },
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
          <MessagesList :messages="messages" @selectMessage="selectMessage" />
        </div>

      </div>

    </aside>

    <div class="dashboard-box">
      <div class="container py-4">

        <div v-if="selectedMessage">
          <h5>{{ selectedMessage.name }}</h5>

          <div class="d-flex align-items-center">
            <div class="image mx-3">
              <img :src="selectedImage" alt="utente">
            </div>

            <div class="text-box my-3">
              <h6>{{ selectedMessage.name }} {{ selectedMessage.surname }}</h6>
              <small>{{ formatDate(selectedMessage.created_at) }}</small>
              <small>{{ selectedMessage.email }}</small>
              <p>{{ selectedMessage.message }}</p>
            </div>

          </div>

        </div>

        <div v-else>
          <p>Seleziona un messaggio dalla lista</p>
        </div>

      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
@use "../../../scss/variables" as *;
@use "../../../scss/message" as *;

input {
  border-radius: 50px;
}

#box-search {
  position: relative;
}

.search-button {
  position: absolute;
  right: 2.5rem;
  padding: 5px;
  background-color: transparent;
  border: none;
}

.message-list {
  height: calc(100vh - 300px);
  padding: 10px;
  width: 100%;
  overflow-y: auto;

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

  scrollbar-width: thin;
  scrollbar-color: #888 #f1f1f1;
}
</style>

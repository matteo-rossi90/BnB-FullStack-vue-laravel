<script>
import axios from "axios";
import MessagesList from "./partials/MessagesList.vue";
import { store } from "../../store/store";

export default {
  name: "Messages",
  components: {
    MessagesList,
  },
  data() {
    return {
        message:"",
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
    //   searchQuery:""
    };
  },
  methods:{
    showMessage(message, index){
        this.message = message;
        this.selectedImage = index;
    },
    formatDate(dateStr){
       const options = { year: 'numeric', month: 'long', day: 'numeric' };
       const date = new Date(dateStr);
       return date.toLocaleDateString('it-IT', options);
     },
     formatDateTime(dateStr){
        const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
        const date = new Date(dateStr);
        return date.toLocaleDateString('it-IT', options);
    },
    getImage(index) {
       return this.images[index % this.images.length];
     }
  },
  computed:{

        filteredApartment() {

            return store.userApartment.filter(apartment => apartment.id == this.$route.params.id)[0]

    }

  },
  mounted() {

    console.log(store.userApartment.filter(apartment => apartment.id == this.$route.params.id)[0])



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
          <input type="search" class="form-control" id="box-search" placeholder="Cerca un contatto" v-model="searchQuery">
          <button type="submit" class="search-button">
            <i class="fa-solid fa-search"></i>
          </button>
        </div>

        <!-- lista messaggi -->
        <div class="message-list mt-4" v-if="filteredApartment">
           <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex align-items-center"
                v-for="(message, index) in filteredApartment.messages" :key="index" @click="showMessage(message, index)">
                    <div class="image me-3">
                        <img :src="getImage(index)" alt="utente">
                    </div>
                    <div class="text-box my-2">
                        <div class="d-flex justify-content-between">
                            <h6>{{ message.name }} {{ message.surname }}</h6>
                            <small>{{ formatDate(message.created_at) }}</small>
                        </div>
                        <small>{{ message.email }}</small>
                        <small class="message-email">{{ message.message }}</small>
                    </div>
                </li>
           </ul>
        </div>

      </div>

    </aside>

    <!-- dettaglio messaggio -->
    <div class="dashboard-box">
      <div class="container-fluid py-4">

        <div class="row" v-if="message">
            <div class="col">
                <div class="d-flex align-items-center mx-5">
                    <div class="main-image me-3">
                        <img :src="getImage(selectedImage)" alt="utente">
                    </div>
                    <div class="text-box my-3">
                        <div class="d-flex flex-column">
                            <h6>{{ message.name }} {{ message.surname }}</h6>
                            <small>{{ formatDateTime(message.created_at) }}</small>
                        </div>
                        <small>{{ message.email }}</small>
                    </div>
                </div>
                <div class="m-5">
                    <p>{{ message.message }}</p>
                </div>

                <!-- <div v-if="selectedMessage">
                    <div v-for="(message, index) in selectedMessage.messages" :key="index">
                        <h5>{{ message.name }}</h5>

                <div class="d-flex align-items-center mx-5">
                    <div class="main-image me-3">
                    <img :src="selectedImage" alt="utente">
                    </div>

                    <div class="text-box my-3">
                        <div class="d-flex flex-column">
                            <h6>{{ message.name }} {{ message.surname }}</h6>
                            <small>{{ formatDate(message.created_at) }}</small>
                        </div>
                        <small>{{ message.email }}</small>
                    </div>

                </div>

                <div class="m-5">
                    <p>{{ message.message }}</p>
                </div>

                    </div> -->

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
  padding: 6px;
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

small{
    color:#555;
}
</style>

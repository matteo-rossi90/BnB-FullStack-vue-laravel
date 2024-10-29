<script>
import axios from "axios";
import Avatar from "./partials/Avatar.vue";
import { store } from "../../store/store";

export default {
  name: "Messages",
  components: {
    Avatar
  },
  data() {
    return {
      message: "",
      selectedImage: null,
      showSidenav: true,
      showContent: false,
    //   images: [
        // "https://picsum.photos/seed/profile1/80/80",
        // "https://picsum.photos/seed/profile2/80/80",
        // "https://picsum.photos/seed/profile3/80/80",
        // "https://picsum.photos/seed/profile4/80/80",
        // "https://picsum.photos/seed/profile5/80/80",
        // "https://picsum.photos/seed/profile6/80/80",
        // "https://picsum.photos/seed/profile7/80/80",
        // "https://picsum.photos/seed/profile8/80/80",
        // "https://picsum.photos/seed/profile9/80/80",
        // "https://picsum.photos/seed/profile10/80/80",
    //   ],
      searchQuery: "",
    };
  },
  methods: {
    showMessage(message, index) {
      this.message = message;
      this.selectedImage = index;
      this.showSidenav = false;
      this.showContent = true;
    },
    goBackToMessages() {
      this.showSidenav = true;
      this.showContent = false;
    },
    formatDate(dateStr) {
      const options = { year: "numeric", month: "long", day: "numeric" };
      const date = new Date(dateStr);
      return date.toLocaleDateString("it-IT", options);
    },
    formatDateTime(dateStr) {
      const options = {
        year: "numeric",
        month: "long",
        day: "numeric",
        hour: "2-digit",
        minute: "2-digit",
      };
      const date = new Date(dateStr);
      return date.toLocaleDateString("it-IT", options);
    },
    // getImage(index) {
    //   return this.images[index % this.images.length] || null;
    // },
  },
  computed: {
    filteredApartment() {
      return store.userApartment.filter(
        (apartment) => apartment.id == this.$route.params.id
      )[0];
    },
    filteredNameAp() {
      return store.userApartment.filter(
        (apartment) => apartment.title == this.$route.params.id
      )[0];
    },
    filteredMessages() {
      return this.filteredApartment.messages
        .filter((message) => {
          const name = `${message.name} ${message.surname}`.toLowerCase();
          return name.includes(this.searchQuery.toLowerCase());
        })
        .sort((a, b) => new Date(b.created_at) - new Date(a.created_at)); // Ordina dal più recente, crea oggetti data in base a created at e li sottrae per vedere il più recente
    },
  },
  mounted() {
    //console.log(store.userApartment.filter(apartment => apartment.id == this.$route.params.id)[0])
  },
};
</script>

<template>
  <div class="wrapper-message d-flex">
    <aside class="sidenav-message" :class="{ 'show-sidenav': showSidenav }">
      <div class="container-fluid">
        <div class="d-flex justify-content-center mx-4 my-3">
          <h5>{{ filteredApartment.title }}</h5>
        </div>

        <div class="d-flex mx-4 mt-3">
          <input
            type="search"
            class="form-control"
            id="box-search"
            placeholder="Cerca un messaggio"
            v-model="searchQuery"
          />
          <button type="submit" class="search-button">
            <i class="fa-solid fa-search"></i>
          </button>
        </div>

        <!-- lista messaggi -->
        <div class="message-list mt-2" v-if="filteredApartment">
          <ul class="list-group list-group-flush">
            <li
              class="list-group-item d-flex align-items-center w-100"
              v-for="(message, index) in filteredMessages"
              :key="index"
              @click="showMessage(message, index)"
            >
              <div class="image me-3">
                <Avatar :name="message.name" :surname="message.surname" :index="index" />
              </div>
              <div class="text-box my-2 w-100">
                <div class="d-flex justify-content-between">
                  <h6>{{ message.name }} {{ message.surname }}</h6>
                  <small>{{ formatDate(message.created_at) }}</small>
                </div>
                <!-- <small>{{ message.email }}</small> -->
                <small class="message-email">{{ message.message }}</small>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </aside>

    <!-- dettaglio messaggio -->
    <div class="content-box" :class="{ 'show-content': showContent }">
      <div class="container-fluid mt-5">
        <div class="row" v-if="message">
          <div class="col-xs-8 col-sm-12 col-md-12 col-lg-12">
            <div
              class="d-flex justify-content-between container container-details"
            >
              <div class="d-flex align-items-center box-user">
                <div class="main-image d-flex align-items-center">
                  <Avatar :name="message.name" :surname="message.surname" :index="selectedImage" />
                </div>
                <div class="text-box my-3">
                  <div class="d-flex flex-column">
                    <h6>{{ message.name }} {{ message.surname }}</h6>
                    <small>{{ formatDateTime(message.created_at) }}</small>
                  </div>
                  <small
                    ><a :href="'mailto:' + message.email">{{
                      message.email
                    }}</a>
                  </small>
                </div>
              </div>
              <button
                v-if="showContent"
                @click="goBackToMessages"
                class="btn-close btn-back me-3"
              >
                <i class="fa-solid fa-xmark"></i>
              </button>
            </div>
            <div class="container container-message mt-3 message-details">
              <p>{{ message.message }}</p>
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

li:hover {
  background-color: #f1f1f1;
}

.active {
  background-color: #e0e0e0;
  color: black;
}

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

small {
  color: #555;
}
</style>

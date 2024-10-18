<script>
import { store } from "../store/store.js";
import { checkAdress } from "../store/store";
export default {
  name: "Header",
  data() {
    return {
      //   // name user
      //   name: store.user.name,
      searchQuery: "",
      address: [],
      debounceTimeout: null,
    };
  },
  methods: {
    // call axios for logout
    logout() {
      axios.get("/sanctum/csrf-cookie").then(() => {
        axios
          .post("/api/logout")
          .then((response) => {
            localStorage.setItem("is_logged", false);
            store.is_logged = localStorage.getItem("is_logged");
            localStorage.setItem("userName", "Accedi");
            store.userName = localStorage.getItem("userName");
            this.$router.push({ name: "home" });
          })
          .catch((err) => {
            console.log("Errore nel logout:", err);
          });
      });
    },
    openDrop() {
      store.is_open = store.is_open ? false : true;
    },
    debouncedSearch() {
      // Cancella il timeout precedente (se esiste)
      clearTimeout(this.debounceTimeout);

      // Imposta un nuovo timeout
      this.debounceTimeout = setTimeout(() => {
        this.performSearch(); // Esegui la chiamata dopo un ritardo di 300ms
      }, 300); // Cambia questo valore per regolare il ritardo
    },
    performSearch() {
      if (!this.searchQuery.trim()) {
        return;
      }
      let urlRequest = checkAdress(this.searchQuery);

      axios
        .get("http://127.0.0.1:8000/proxy-tomtom", {
          params: { url: urlRequest },
        })
        .then((response) => {
          this.address = response.data.results;
          console.log(this.address[0].address);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    clearData() {
      this.searchQuery = "";
    },
  },
  mounted() {
    window.addEventListener("click", () => {
      store.is_open = false;
    });
  },
  computed: {
    isLogged() {
      //   boolean login control for show right link
      return store.is_logged;
    },
    isOpen() {
      //   boolean login control for show right link
      return store.is_open;
    },
    userName() {
      return store.userName;
    },
    loggedUserApartment() {
      return localStorage.getItem("is_logged") && store.allApartment.length;
    },
    suggestAdress() {
      return this.address;
    },
  },
};
</script>
<template>
  <header>
    <nav>
      <div class="container">
        <div class="row justify-content-between align-items-center">
          <div class="col">
            <router-link :to="{ name: 'home' }">logo</router-link>
          </div>

          <div class="col d-flex gap-2 justify-content-end">
            <router-link class="link" :to="{ name: 'home' }">Home</router-link>

            <!-- user click dropdown class -->
            <div class="contDropDown" @click.stop="openDrop()">
              <div
                class="profile d-flex justify-content-between align-items-center gap-1 m-0"
              >
                <p class="nameUser">{{ userName }}</p>

                <font-awesome-icon :icon="['fas', 'caret-down']" />
              </div>
              <div class="dropDown" :class="isOpen ? 'active' : 'disactive'">
                <router-link class="link" :to="{ name: 'login' }"
                  >Login</router-link
                >
                <router-link class="link" :to="{ name: 'register' }"
                  >Register</router-link
                >
                <router-link class="link" :to="{ name: 'dashboard' }"
                  >Dashboard</router-link
                >
                <a href="#" class="link" @click="logout">Logout </a>
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-center align-items-center">
          <div class="col-sm-10 col-lg-8">
            <div class="input-group stylish-input-group">
              <div class="contInput">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Cerca appartamenti per indirizzo..."
                  v-model="searchQuery"
                  @input="debouncedSearch"
                />
                <div class="suggest" v-if="searchQuery">
                  <ul>
                    <li
                      v-for="(addressObj, index) in suggestAdress"
                      :key="index"
                    >
                      <router-link
                        class="link"
                        @click="clearData"
                        :to="{
                          name: 'apartmentsMap',
                          params: { city: 'rome' },
                        }"
                      >
                        {{ addressObj.address.streetName }}, n°
                        {{
                          addressObj.address.streetNumber
                            ? addressObj.address.streetNumber
                            : 0
                        }},
                        {{ addressObj.address.municipality }}
                        {{ addressObj.address.postalCode }}
                        {{ addressObj.address.neighbourhood }}
                      </router-link>
                    </li>
                  </ul>
                </div>
                <div
                  class="col-lg-3 col-md-4 col-sm-6 mb-4"
                  v-for="(apartment, index) in apartments"
                  :key="index"
                ></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>
</template>
<style lang="scss" scoped>
/* // @use 'path' as *; */
header {
  display: flex;
  gap: 1rem;
  z-index: 100;
  border-bottom: 1px solid black;
  padding: 0.5rem;
  nav {
    width: 100%;
    height: 100%;
    .profile,
    .link {
      padding: 0.5rem 1rem;
      margin-top: 0.5rem;
    }
    .contDropDown {
      position: relative;
      border-radius: 20px;
      cursor: pointer;
      display: block;
      z-index: 100;
      border: 1px solid black;
      &:hover {
      }
      .profile {
        position: relative;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
      }

      .dropDown.active {
        background-color: red;
        position: absolute;
        left: -62px;
        padding: 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        border-radius: 20px;
      }
      .dropDown.disactive {
        display: none;
      }
    }
  }
}
p,
.profile,
.link {
  margin: 0;
  padding: 0;
}

.disactive {
  display: none;
}
.contInput {
  width: 70%;
  padding: 0.5rem;
  border-radius: 20px;
  border: 1px solid black;
  position: relative;
}
.suggest {
  position: absolute;
  width: 100%;
  top: 100%;
  background-color: rgb(237, 237, 237);
  border-radius: 20px;
  font-size: 0.75rem;
  z-index: 10;

  li {
    padding: 0.3rem 0.5rem;
    border-radius: 20px;
    margin-bottom: 0.1rem;
    &:hover {
      background-color: rgb(217, 217, 217);
      cursor: pointer;
    }
  }
}
</style>

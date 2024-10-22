<script>
import { store } from "../store/store.js";
import { checkAdress } from "../store/store";
import { componeUrlString } from "../store/store";
import { findZone } from "../store/store";
// import { throttle } from "lodash";

export default {
  name: "Header",
  data() {
    return {
      //   // name user
      //   name: store.user.name,
      //   auto compiled v model input
      searchQuery: "",
      //   data of all adress
      address: [],
      //   timeout for bettere request after user write
      debounceTimeout: null,
      //   query url with simbol - when start event send this data in params
      urlSearchQuery: "",
      isThrottled: false,
      isClose: false,
    };
  },
  methods: {
    // call axios for logout
    logout() {
      axios.get("/sanctum/csrf-cookie").then(() => {
        axios
          .post("/api/logout")
          .then((response) => {
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
      this.isClose = true;
      axios
        .get("http://127.0.0.1:8000/proxy-tomtom", {
          params: { url: urlRequest },
        })
        .then((response) => {
          this.address = response.data.results;
          this.urlSearchQuery = this.searchQuery;
        })
        .catch((err) => {
          console.log(err);
        });
    },
    sendAdress(addressObj) {
      let urlString = componeUrlString(addressObj);

      if (urlString) {
        this.isClose = false;
        store.center = [addressObj.position.lon, addressObj.position.lat];
        findZone(addressObj.position.lon, addressObj.position.lat);
        this.searchQuery = "";

        this.$router.push({
          name: "apartmentsMap",
          params: { id: urlString },
        });
      } else {
        console.warn("Stringa indirizzo vuota, non reindirizzo");
      }
    },
  },
  mounted() {
    window.addEventListener("click", () => {
      store.is_open = false;
    });
    // window.addEventListener("scroll", () => {
    //   if (!this.isThrottled) {
    //     let firstRow = document.getElementById("firstRow");
    //     let scrollAmount = window.scrollY;

    //     if (scrollAmount > 20) {
    //       firstRow.classList.add("hidden");
    //     } else {
    //       firstRow.classList.remove("hidden");
    //     }

    //     this.isThrottled = true;
    //     setTimeout(() => {
    //       this.isThrottled = false;
    //     }, 100); // 100ms di pausa tra un evento scroll e il successivo
    //   }
    // });
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
      return store.userName !== "Accedi";
    },
    suggestAdress() {
      return this.address;
    },
    urlRequest() {
      return this.urlSearchQuery;
    },
  },
};
</script>
<template>
  <header>
    <nav>
      <div class="container-fluid">
        <div
          class="row justify-content-between align-items-center"
          id="firstRow"
        >
          <div class="col">
            <router-link
              class="contLogo d-flex align-items-center"
              :to="{ name: 'home' }"
            >
              <img class="logo" src="Boolnb_circle.png" alt="airbnb photo" />
              <span><strong>BoolBnb</strong></span>
            </router-link>
          </div>

          <div class="col d-flex gap-2 justify-content-end">
            <!-- user click dropdown class -->
            <div class="contDropDown" @click.stop="openDrop()">
              <div
                class="profile d-flex justify-content-between align-items-center gap-1 m-0"
              >
                <p class="nameUser">
                  {{ userName !== "null" ? userName : "Profilo" }}
                </p>

                <font-awesome-icon :icon="['fas', 'caret-down']" />
              </div>
              <div class="dropDown" :class="isOpen ? 'active' : 'disactive'">
                <router-link class="link" :to="{ name: 'home' }"
                  >Home</router-link
                >
                <router-link v-if="!isLogged" class="link" :to="{ name: 'login' }"
                  >Login</router-link
                >
                <router-link  v-if="!isLogged" class="link" :to="{ name: 'register' }"
                  >Register</router-link
                >
                <router-link class="link" :to="{ name: 'dashboard' }"
                  >Dashboard</router-link
                >
                <p  v-if="isLogged" class="link" @click="logout">Logout</p>
              </div>
            </div>
          </div>
        </div>
        <div class="row justify-content-center align-items-center">
          <div class="col-sm-10 col-lg-8">
            <!-- search input for adress -->
            <div class="input-group stylish-input-group">
              <div class="contInput d-flex">
                <input
                  type="text"
                  class="form-control"
                  placeholder="Cerca appartamenti per indirizzo..."
                  v-model="searchQuery"
                  @input="debouncedSearch"
                />
                <span class="button">invia</span>

                <div class="suggest" v-if="isClose">
                  <ul>
                    <li
                      v-for="(addressObj, index) in suggestAdress"
                      :key="index"
                    >
                      <p class="link" @click="sendAdress(addressObj)">
                        {{ addressObj.address.streetName }}
                        {{ addressObj.address.municipality }}
                        {{ addressObj.address.postalCode }}
                        {{ addressObj.address.neighbourhood }}
                      </p>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <nav class="responsiveNavBar">navbar</nav>
</template>
<style lang="scss" scoped>
/* // @use 'path' as *; */
header {
  display: flex;
  gap: 1rem;
  z-index: 100;
  border-bottom: 1px solid black;
  padding: 0.5rem;
  position: fixed;
  width: 100%;
  background-color: white;
  padding: 1rem;

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
      z-index: 101;
      &:hover {
      }
      .profile {
        position: relative;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
      }

      .dropDown.active {
        background-color: white;
        position: absolute;
        left: -62px;
        padding: 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        border-radius: 20px;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        .link {
          border-radius: 20px;
          &:hover {
            background-color: rgb(241, 240, 240);
            color: black;
          }
        }
      }
      .dropDown.disactive {
        display: none;
      }
    }
    a.contLogo {
      color: #ff5757;

      img.logo {
        height: 50px;
        width: 50px;
      }

      strong {
        font-size: 20px;
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
//#inputAdress
.contInput {
  width: 70%;
  padding: 0.5rem;
  border-radius: 20px;
  border: 1px solid black;
  position: relative;
  left: 50%;
  transform: translate(-50%);
  //   width: 70%;
  //   padding: 0.5rem;
  //   border-radius: 20px;
  //   border: 1px solid black;
  //   position: relative;
}
.button {
  display: none;
  background-color: white;
  border: 1px solid grey;
  padding: 0.5rem;
  border-top-left-radius: 10px;
  border-bottom-left-radius: 10px;
  border-top-right-radius: 20px;
  border-bottom-right-radius: 20px;
  margin-left: 5px;
  cursor: pointer;
  &:hover {
    background-color: black;
    color: white;
  }
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
@media all and (max-width: 623px) {
  .responsiveNavBar {
    height: 4rem;
    width: 100%;
    background-color: red;
    position: fixed;
    bottom: 0;
    z-index: 100;
  }
  #firstRow {
    display: none;
  }
  .contInput {
    width: 100%;
  }
  .button {
    display: block;
  }
}
</style>

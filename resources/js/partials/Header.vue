<script>
import { store } from "../store/store.js";
export default {
  name: "Header",
  data() {
    return {
      //   // name user
      //   name: store.user.name,
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
  },
};
</script>
<template>
  <header>
    <nav>
      <div class="container">
        <div class="row justify-content-between align-items-center">
          <div class="col">
            <h2>logo</h2>
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
</style>

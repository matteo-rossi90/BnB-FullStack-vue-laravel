<script>
export default {
  name: "Header",
  data() {
    return {
      // name user
      name: "",
      //   boolean dropdown
      is_open: false,
    };
  },
  methods: {
    // call axios for logout
    logout() {
      axios
        .post("/api/logout")
        .then((response) => {
          this.$router.push({ name: "home" });
        })
        .catch((err) => {
          console.log(err);
        });
    },
    openDrop() {
      this.is_open = this.is_open ? false : true;
      console.log(this.is_open);
    },
  },
  mounted() {
    axios
      .get("/api/user")
      .then((response) => {
        this.name = response.data.name;
      })
      .catch((err) => {
        console.log(err);
      });
    window.addEventListener("click", () => {
      if (this.is_open) {
        this.is_open = false;
      }
    });
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
          <div class="col d-flex gap-2">
            <router-link class="link" :to="{ name: 'home' }">home</router-link>
            <router-link class="link" :to="{ name: 'login' }"
              >login</router-link
            >
            <router-link class="link" :to="{ name: 'register' }"
              >register</router-link
            >
            <router-link class="link" :to="{ name: 'dashboard' }"
              >dashboard</router-link
            >
            <router-link class="link" :to="{ name: 'createApartment' }"
              >create apartment</router-link
            >
            <div class="contDropDown" @click.stop="openDrop()">
              <div
                class="profile d-flex justify-content-between align-items-center gap-1"
              >
                <p>{{ name }}</p>
                <font-awesome-icon :icon="['fas', 'caret-down']" />
              </div>
              <div class="dropDown" :class="{ active: is_open }">
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

      .profile {
        border-radius: 20px;
        cursor: pointer;

        &:hover {
          background-color: blue;
          color: white;
        }
      }
      .dropDown {
        background-color: red;
        position: absolute;
        padding: 1rem;
        display: flex;
        flex-direction: column;
        align-items: center;
        border-radius: 20px;
        display: none;
      }
      .dropDown.active {
        display: block;
      }
    }
  }
}
p {
  margin: 0;
}
</style>

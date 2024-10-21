<script>
import { store } from "../store/store.js";
export default {
  name: "Register",
  data() {
    return {
      user: {
        name: "",
        surname: "",
        date_of_birth: "",
        email: "",
        password: "",
        password_confirmation: "",
      },
      password_confirmed: "",
      errors: {
        name: "",
        surname: "",
        date_of_birth: "",
        email: "",
        password: "",
        password_confirmation: "",

        // email_verified_at: "",
      },
    };
  },
  methods: {
    submit() {
      axios
        .post("/api/register", this.user)
        .then(() => {
          localStorage.setItem("is_logged", "true");
          store.is_logged = localStorage.getItem("is_logged") === "true";

          // get a data of user
          axios
            .get("/api/user")
            .then((response) => {
              store.user = response.data;

              localStorage.setItem("userName", response.data.name);

              store.userName = localStorage.getItem("userName");
            })
            .catch((err) => {
              localStorage.setItem("userName", "Accedi");
              console.log(err);
            });
          this.$router.push({ name: "home" });
        })
        .catch((err) => {
          localStorage.setItem("is_logged", "false");
          store.is_logged = localStorage.getItem("is_logged") === "false";

          if (err.response) {
            // Errore con risposta dal server
            console.log("Errore:", err.response.data);
            console.log("Stato HTTP:", err.response.status);
            console.log("Headers:", err.response.headers);
          } else if (err.request) {
            // La richiesta è stata fatta ma non ha ricevuto risposta
            console.log("Nessuna risposta dal server:", err.request);
          } else {
            // Errore che è successo prima di fare la richiesta
            console.log(
              "Errore nella configurazione della richiesta:",
              err.message
            );
          }
        });
    },

    validateName() {
      if (!this.user.name) {
        this.errors.name = "";
      } else if (!/^[a-zA-Z]+$/.test(this.user.name)) {
        this.errors.name = "Il nome deve contenere solo lettere";
      } else if (this.user.name.length < 4) {
        this.errors.name =
          "il nome non può avere una lunghezza inferiore di 4 caratteri";
      } else {
        this.errors.name = "";
      }
    },

    validateSurname() {
      if (!this.user.surname) {
        this.errors.surname = "";
      } else if (!/^[a-zA-Z]+$/.test(this.user.surname)) {
        this.errors.surname = "Il cognome deve contenere solo lettere";
      } else if (this.user.surname.length < 4) {
        this.errors.surname =
          "Il cognome non può avere una lunghezza inferiore di 4 caratteri";
      } else {
        this.errors.surname = "";
      }
    },

    validateDateOfBirth() {
      const dobDate = new Date(this.user.date_of_birth);
      const today = new Date();
      const age = today.getFullYear() - dobDate.getFullYear();
      const month = today.getMonth() - dobDate.getMonth();
      const day = today.getDate() - dobDate.getDate();

      if (!this.user.date_of_birth) {
        this.errors.date_of_birth = "";
      } else if (
        age < 18 ||
        (age === 18 && (month < 0 || (month === 0 && day < 0)))
      ) {
        this.errors.date_of_birth = "Devi avere almeno 18 anni.";
      } else {
        this.errors.date_of_birth = "";
      }
    },

    validateEmail() {
      const emailRegex = /^[a-zA-Z0-9.]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

      if (!this.user.email) {
        this.errors.email = "L'email è obbligatoria.";
      } else if (!emailRegex.test(this.user.email)) {
        this.errors.email =
          "Inserisci una email valida, ad esempio: nome.cognome@mail.com";
      } else {
        this.errors.email = "";
      }
    },

    validatePassword() {
      if (!this.user.password) {
        this.errors.password = "La password è obbligatoria.";
      } else if (this.user.password.length < 8) {
        this.errors.password =
          "La password deve essere lunga almeno 8 caratteri.";
      } else {
        this.errors.password = "";
      }
    },

    validatePasswordConfirmation() {
      if (!this.user.password_confirmation) {
        this.errors.password_confirmation =
          "La conferma password è obbligatoria.";
      } else if (this.user.password_confirmation !== this.user.password) {
        this.errors.password_confirmation = "Le password non coincidono.";
      } else {
        this.errors.password_confirmation = "";
      }
    },

    submitForm() {
      this.validateName();
      this.validateSurname();
      this.validateDateOfBirth();
      this.validateEmail();
      this.validatePassword();
      this.validatePasswordConfirmation();

      this.submit();
    },
  },
};
// validazioni che fa fortify
// Validator::make($input, [
//             'name' => ['required', 'string', 'max:255'],
//             'email' => [
//                 'required',
//                 'string',
//                 'email',
//                 'max:255',
//                 Rule::unique(User::class),
//             ],
//             'surname' => ['required', 'string', 'max:255'],
//             'date_of_birth' => ['required', 'date', 'before:today'],
//             'email_verified_at' =>['required', 'date'],
//             'password' => $this->passwordRules(),
//         ])->validate();

//         return User::create([
//             'name' => $input['name'],
//             'email' => $input['email'],
//             'surname' => $input['surname'],
//             'date_of_birth' => $input['date_of_birth'],
//             'email_verified_at' => $input['email_verified_at'],
//             'password' => Hash::make($input['password']),

//         ]);
</script>

<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-8 mt-5">
        <h2>Compila il form per registrarti</h2>
        <!-- <ul v-if="errors">
                    <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
                </ul> -->
        <form @submit.prevent="submitForm">
          <div class="input-container">
            <label class="form-label" for="name">Nome</label>
            <input
              class="form-control"
              type="text"
              id="name"
              name="name"
              v-model="user.name"
              @input="validateName"
            />
            <small v-if="errors.name" class="error-message">{{
              errors.name
            }}</small>
          </div>

          <div class="input-container">
            <label class="form-label" for="surname">Cognome</label>
            <input
              class="form-control"
              type="text"
              id="surname"
              name="surname"
              v-model="user.surname"
              @input="validateSurname"
            />
            <small v-if="errors.surname" class="error-message">{{
              errors.surname
            }}</small>
          </div>

          <div class="input-container">
            <label class="form-label" for="date_of_birth"
              >Data di nascita</label
            >
            <input
              class="form-control"
              type="date"
              id="date_of_birth"
              name="date_of_birth"
              v-model="user.date_of_birth"
            />
            <small v-if="errors.date_of_birth" class="error-message">{{
              errors.date_of_birth
            }}</small>
          </div>

          <div class="input-container">
            <label class="form-label" for="email">Email*</label>
            <input
              class="form-control"
              type="email"
              id="email"
              name="email"
              v-model="user.email"
              @input="validateEmail"
            />
            <small v-if="errors.email" class="error-message">{{
              errors.email
            }}</small>
          </div>

          <div class="input-container">
            <label class="form-label" for="password">Password*</label>
            <input
              class="form-control"
              type="password"
              id="password"
              name="password"
              v-model="user.password"
              @input="validatePassword"
            />
            <small v-if="errors.password" class="error-message">{{
              errors.password
            }}</small>
          </div>

          <div class="input-container">
            <label class="form-label" for="password_confirmation"
              >Conferma la password*</label
            >
            <input
              class="form-control"
              type="password"
              id="password_confirmation"
              name="password_confirmation"
              v-model="user.password_confirmation"
              @input="validatePasswordConfirmation"
            />
            <small v-if="errors.password_confirmation" class="error-message">{{
              errors.password_confirmation
            }}</small>
          </div>

          <button type="submit" class="btn btn-primary">Registrati</button>
        </form>
      </div>
    </div>
  </div>
</template>


<style lang='scss' scoped>
// @use 'path' as *;
.input-container {
  padding: 10px 0;

  .error-message {
    color: red;
    font-size: 0.9em;
  }
}

label {
  display: block;
}
</style>

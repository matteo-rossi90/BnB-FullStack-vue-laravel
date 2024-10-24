<script>
import PaymentBrain from "./PaymentBrain.vue";
import axios from "axios";
import { store } from "../../store/store";

export default {
  name: "CheckoutPayment",
  data() {
    return {
      userApartments: store.userApartment,
      tokenApi: "",
      form: {
        token: "",
        sponsor: "",
        apartment: this.$route.params.id,
      },
      isLoad: false,
      successPayment: false,
    };
  },
  methods: {
    payment(id) {
      axios
        .post("api/order/make/payment", {
          token: "fake-valid-nonce",
          sponsor: id,
        })
        .then((res) => {
          console.log(res);
        })
        .catch((err) => {
          console.log(err);
        });
    },
    paymentOnSuccess(nonce) {
      console.log("nonce token", nonce);
      this.form.token = nonce;
      this.buy();
    },
    paymentOnError(error) {},
    // beforeBuy() {
    //   this.$refs.paymentRef.$refs.paymentBtnRef.click();
    // },
    async buy() {
      try {
        axios
          .post(
            "http://127.0.0.1:8000/api/order/make/payment",
            {
              ...this.form,
            },
            { withCredentials: true }
          )
          .then((res) => {
            console.log(res);
            this.successPayment = true;
            this.$router.push({ name: "apartments" });
          })
          .catch((err) => {
            console.log(err);
          });
      } catch {
        // disabilita i bottoni
      }
    },
    // Invoca il metodo submitPayment del componente figlio
    procediAlPagamento() {
      this.$refs.paymentRef.submitPayment(); // Richiama il metodo submitPayment
    },
  },
  components: {
    PaymentBrain,
  },

  mounted() {
    this.isLoad = false;
    axios
      .get("http://localhost:8000/api/order/generate")
      .then((res) => {
        console.log(res.data.token);
        this.tokenApi = res.data.token;
        this.form.token = res.data.token;
        this.isLoad = this.form.token;
      })
      .catch((err) => {
        console.log(err);
      });
    this.form.sponsor = this.$route.params.sponsor;
  },
  computed: {
    token() {
      return this.tokenApi;
    },
    userApartment() {
      return this.userApartments.filter(
        (apartment) => apartment.id == this.$route.params.id
      )[0];
    },
    sponsorSelect() {
      switch (this.$route.params.sponsor) {
        case "1":
          return "Bronzo";
        case "2":
          return "Argento";
        case "3":
          return "Oro";
      }
    },
    price() {
      switch (this.$route.params.sponsor) {
        case "1":
          return "2.99";
        case "2":
          return "5.99";
        case "3":
          return "9.99";
      }
    },
  },
};
</script>
<template>
  {{ form }}

  <div class="container">
    <p>
      Pagamento per {{ userApartment.title }} sponsor
      {{ this.$route.params.sponsor }}
    </p>
    <p>Tipo di piano abbonamento scelto: {{ sponsorSelect }}</p>
    <p>Totale: {{ price }}</p>
  </div>
  <div
    class="container pb-4 d-flex flex-column justify-content-center align-items-center"
  >
    <div v-if="isLoad">
      <PaymentBrain
        ref="paymentRef"
        :authorization="token"
        @onSuccess="paymentOnSuccess"
        @onError="paymentOnError"
      />
      <button @click="procediAlPagamento" v-if="!successPayment">
        procedi con il pagamento
      </button>
    </div>
    <div class="loader" v-else></div>
  </div>
</template>
<style lang='scss' scoped>
// @use 'path' as *;
/* HTML: <div class="loader"></div> */
.loader {
  width: 50px;
  --b: 8px;
  aspect-ratio: 1;
  border-radius: 50%;
  padding: 1px;
  background: conic-gradient(#0000 10%, #f03355) content-box;
  -webkit-mask: repeating-conic-gradient(
      #0000 0deg,
      #000 1deg 20deg,
      #0000 21deg 36deg
    ),
    radial-gradient(
      farthest-side,
      #0000 calc(100% - var(--b) - 1px),
      #000 calc(100% - var(--b))
    );
  -webkit-mask-composite: destination-in;
  mask-composite: intersect;
  animation: l4 1s infinite steps(10);
}
@keyframes l4 {
  to {
    transform: rotate(1turn);
  }
}
</style>

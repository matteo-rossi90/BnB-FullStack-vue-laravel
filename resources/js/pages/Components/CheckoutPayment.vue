<script>
import PaymentBrain from "./PaymentBrain.vue";
import axios from "axios";
export default {
  name: "CheckoutPayment",
  data() {
    return {
      tokenApi: "",
      form: {
        token: "",
        sponsor: "",
      },
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
  //   async asyncData({ app }) {
  //     let tokenApi = null;
  //     const response = await this.$axios.$get(
  //       "http://localhost:8000/api/order/generate"
  //     );
  //     tokenApi = response.token;
  //     console.log(tokenApi);
  //   },
  mounted() {
    axios
      .get("http://localhost:8000/api/order/generate")
      .then((res) => {
        console.log(res.data.token);
        this.tokenApi = res.data.token;
        this.form.token = res.data.token;
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
  },
};
</script>
<template>
  {{ form }}
  <h1>
    appartamento {{ this.$route.params.id }} sponsor
    {{ this.$route.params.sponsor }}
  </h1>
  <PaymentBrain
    v-if="token"
    ref="paymentRef"
    :authorization="token"
    @onSuccess="paymentOnSuccess"
    @onError="paymentOnError"
  />
  <button @click="procediAlPagamento">procedi con il pagamento</button>
</template>
<style lang='scss' scoped>
// @use 'path' as *;
</style>

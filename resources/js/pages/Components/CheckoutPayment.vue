<script>
import PaymentBrain from "./PaymentBrain.vue";
export default {
  name: "CheckoutPayment",
  data() {
    return {
      tokenApi: "fasdfasdf",
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
  },
  components: {
    PaymentBrain,
  },
  mounted() {
    axios
      .get("api/order/generate")
      .then((res) => {
        console.log(res);
        this.tokenApi = res.token;
      })
      .catch((err) => {
        console.log(err);
      });
  },
};
</script>
<template>
  <h1>
    appartamento {{ this.$route.params.id }} sponsor
    {{ this.$route.params.sponsor }}
  </h1>
  <PaymentBrain :authorization="tokenApi" />
  <button>procedi con il pagamento</button>
</template>
<style lang='scss' scoped>
// @use 'path' as *;
</style>

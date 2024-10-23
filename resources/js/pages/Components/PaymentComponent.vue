<script>
import axios from "axios";

export default {
  name: "PaymentComponent",
  data() {
    return {};
  },
  methods: {
    payment(price) {
      axios
        .post("api/order/make/payment", {
          token: "fake-valid-nonce",
          amount: price,
        })
        .then((res) => {
          console.log(res);
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
  mounted() {
    axios
      .get("api/order/generate")
      .then((res) => {
        console.log(res);
      })
      .catch((err) => {
        console.log(err);
      });
  },
};
</script>
<template>
  <div class="container">
    <div class="row justify-content-center p-3">
      <div class="col">
        <h3>Piano di pagamento barboni</h3>
        <ul>
          <li>24h di sponsorizzazione</li>
          <li>2.99</li>
        </ul>
        <button @click="payment(2.99)">Sponsorizza</button>
      </div>
      <div class="col">
        <h3>Piano di pagamento medio</h3>
        <ul>
          <li>72h di sponsorizzazione</li>
          <li>5.99</li>
        </ul>
        <button @click="payment(5.99)">Sponsorizza</button>
      </div>
      <div class="col">
        <h3>Piano di pagamento ricco</h3>
        <ul>
          <li>144h di sponsorizzazione</li>
          <li>9.99</li>
        </ul>
        <button @click="payment(9.99)">Sponsorizza</button>
      </div>
    </div>
  </div>
</template>
<style lang='scss' scoped>
// @use 'path' as *;
</style>x

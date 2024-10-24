<script>
export default {
  name: "PaymentComponent",
  data() {
    return {};
  },
  methods: {},
  mounted() {},
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
        <router-link :to="{ name: 'checkout', params: { sponsor: 1 } }"
          >sponsorizza</router-link
        >
      </div>
      <div class="col">
        <h3>Piano di pagamento medio</h3>
        <ul>
          <li>72h di sponsorizzazione</li>
          <li>5.99</li>
        </ul>
        <router-link :to="{ name: 'checkout', params: { sponsor: 2 } }"
          >sponsorizza</router-link
        >
      </div>
      <div class="col">
        <h3>Piano di pagamento ricco</h3>
        <ul>
          <li>144h di sponsorizzazione</li>
          <li>9.99</li>
        </ul>
        <router-link :to="{ name: 'checkout', params: { sponsor: 3 } }"
          >sponsorizza</router-link
        >
      </div>
    </div>
  </div>
</template>
<style lang='scss' scoped>
// @use 'path' as *;
</style>x

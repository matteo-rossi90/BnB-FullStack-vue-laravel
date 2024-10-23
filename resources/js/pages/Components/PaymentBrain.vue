<script>
export default {
  name: "PaymentBrain",
  data() {
    return {};
  },
  props: {
    authorization: {
      required: true,
      type: String,
    },
  },
  methods: {
    onSuccess(payload) {
      let nonce = payload.nonce;
      this.$emit("onSuccess", nonce);
      // Do something great with the nonce...
    },
    onError(error) {
      let message = error.message;
      // Whoops, an error has occured while trying to get the nonce
    },
  },
};
</script>
<template>
  <v-braintree
    :authorization="authorization"
    @success="onSuccess"
    @error="onError"
    locale="it_IT"
  ></v-braintree>
  componente
</template>
<style lang='scss' scoped>
// @use 'path' as *;
</style>

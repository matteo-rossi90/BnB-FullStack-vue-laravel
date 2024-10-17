<script>
import Routinglist from "./partials/Routinglist.vue";
import Form from "../Components/Form.vue";
export default {
  name: "CreateApartment",
  components: {
    Routinglist,
    Form,
  },
  data() {
    return {
      //

    };
  },
  methods: {

  },
  mounted() {

  },
};
</script>

<template>
  <div class="wrapper d-flex justify-content-center">
        <aside>
            <Routinglist />
        </aside>
        <div>
            <Form/>
        </div>
  </div>
</template>
<style lang='scss' scoped>
img {
  max-height: 500px;
}
</style>

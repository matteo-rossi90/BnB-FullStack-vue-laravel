<script>
export default {
  name: "Footer",
  data() {
    return {};
  },
  methods: {},
};
</script>
<template>
    <div class="container-fluid d-flex justify-content-around  ms_container">

  <h1 class="p-5">footer</h1>

  <router-link class="align-content-center" to="chi-siamo"> chi siamo</router-link>
  <router-link class="align-content-center" to="/">Home</router-link>

    </div>
</template>
<style lang='scss' scoped>
// @use 'path' as *;

.ms_container{
    margin-top: 2%;
    height: 10%;
    background-color: black;
    color: white;
    a{
       color: white;
       text-decoration: none;
       &:hover{
        text-decoration: underline;
        color: red;
       }
    }

}
</style>

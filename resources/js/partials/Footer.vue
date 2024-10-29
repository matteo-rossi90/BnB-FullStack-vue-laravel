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

        <h1 class="p-5 align-content-center ">footer</h1>
        <router-link class="align-content-center" to="chi-siamo"> chi siamo</router-link>
        <router-link class="align-content-center" to="/">Home</router-link>


    </div>
</template>
<style lang='scss' scoped>
// @use 'path' as *;

.ms_container{
    // position: absolute;
    // bottom: 0;
    padding:20px;
    height: 100px;
    background-color: rgb(103, 100, 100);
    color: white;
    a, h1{

       color: white;
       text-decoration: none;
       align-items: center;
       &:hover{
        text-decoration: underline;
        color: red;
        transform: scale(1.3);
        transition: transform 1s cubic-bezier(0.25, 0.1, 0.25, 1);
       }
    }

}
</style>

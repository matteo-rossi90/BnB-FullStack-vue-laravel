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
    <div class="container-fluid d-flex gap-3  ms_container">

        <div class="align-content-center">&copy; BolBnb 2024</div>
        <router-link class="align-content-center" to="/">Home</router-link>
        <router-link class="align-content-center" to="/chi-siamo"> chi siamo</router-link>
        <router-link class="align-content-center" to="/privacy-policy"> Privacy policy</router-link>
        <router-link class="align-content-center" to="/company"> La nostra azienda</router-link>




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
    a{

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

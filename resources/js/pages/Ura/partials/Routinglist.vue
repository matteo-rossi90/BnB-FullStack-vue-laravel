<script>
export default{
    name:'Routinglist'
}
</script>

<template>
    <div class="container-fluid">
        <ul class="mt-3 d-flex flex-column justify-content-center px-4">
            <li class="py-3">
                <router-link class="link" :to="{ name: 'apartments' }"
                >
                <i class="fa-solid fa-list pe-2"></i>
                <span class="d-none d-lg-inline">I miei appartamenti</span></router-link
                >
            </li>
            <li>
                <router-link class="link" :to="{ name: 'createApartment' }"
                >
                <i class="fa-solid fa-circle-plus pe-2"></i>
                <span class="d-none d-lg-inline">I miei appartamenti</span></router-link
                >
            </li>
        </ul>

    </div>
</template>

<style lang="scss" scoped>

    ul{
        padding-left: 0;
        // font-size: 18px;
    }



</style>

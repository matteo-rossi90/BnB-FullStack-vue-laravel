<script>
export default{
    name:'Routinglist'
}
</script>

<template>
    <div class="container">
        <ul class="my-4 d-flex flex-column justify-content-center p-4">
            <li class="py-3">
                <router-link class="link" :to="{ name: 'apartments' }"
                >
                <i class="fa-solid fa-list"></i>
                I miei appartamenti</router-link
                >
            </li>
            <li>
                <router-link class="link" :to="{ name: 'createApartment' }"
                >
                <i class="fa-solid fa-circle-plus"></i>
                Nuovo appartamento</router-link
                >
            </li>
        </ul>

    </div>
</template>

<style lang="scss" scoped>

    ul{
        padding-left: 0;
    }



</style>

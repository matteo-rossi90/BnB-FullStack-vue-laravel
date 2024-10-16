<script>
export default{
    name:'Routinglist'
}
</script>

<template>
    <div class="mt-2 container-fluid">
        <ul class="d-flex flex-column justify-content-center">
            <li class="py-3 d-flex align-items-center">
                <router-link class="link d-flex  align-items-center gap-2" :to="{ name: 'apartments' }"
                >
                <i class="fa-solid fa-list"></i>
                <span class="d-none d-xl-inline d-lg-inline">I miei appartamenti</span></router-link
                >
            </li>
            <li class="py-3 d-flex align-items-center">
                <router-link class="link d-flex align-items-center gap-2" :to="{ name: 'createApartment' }"
                >
                <i class="fa-solid fa-circle-plus"></i>
                <span class="d-none d-xl-inline d-lg-inline">Nuovo appartamento</span></router-link
                >
            </li>
        </ul>

    </div>
</template>

<style lang="scss" scoped>
@use '../../../../scss/dashboard' as *;

</style>

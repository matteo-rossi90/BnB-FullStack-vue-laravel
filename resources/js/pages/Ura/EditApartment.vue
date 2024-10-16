<script>
import axios from 'axios';
import Routinglist from './partials/Routinglist.vue';
import { store } from '../../store/store';

    export default {
        name: 'EditApartment',

    }





</script>

<template>
    <div class="container">
        <h1>Edit</h1>

        <form action="">
            <label for="" class="form-label">Titolo</label>
            <input type="text" class="form-control">

            <label for="" class="form-label">Numero di stanze</label>
            <input type="number" class="form-control" >

            <label for=""class="form-label" >Numero di letti</label>
            <input type="number" class="form-control">

            <label for="" class="form-label">Numero di bagni</label>
            <input type="number" class="form-control">

            <label for="" class="form-label" >Indirizzo</label>
            <input type="text" class="form-control">

            <label for="" class="form-label">Immagine</label>
            <input type="text" class="form-control">

            <button type="submit" class="btn btn-primary">Invia</button>


        </form>

    </div>

</template>



<style lang="scss" scoped>

</style>

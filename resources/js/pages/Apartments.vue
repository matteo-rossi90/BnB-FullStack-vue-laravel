<script>
import axios from 'axios';
import { store } from '../store/store';

export default{
    name:'Apartments',
    data(){
        return{
            apartments: store.allApartment
        }
    },
    methods:{

        getMap(){
            const tt = window.tt;  //accesso alla libreria TomTom
            let center = [12.4964, 41.9028]; //centro della mappa

            const map = tt.map({
                key: 'qNjsW3gGJOBNhFoXhBzsGRJAk5RJMJhI',
                center: center,
                container: 'map',
                zoom: 10,
            });

            //estrapolazione delle proprietà che si riferiscono a "position" nel JSON generato dall'API
            this.apartments.forEach(apartment => {
                const lat = apartment.lat; //valore della latitudine di ogni appartamento
                const lon = apartment.lon; //valore dalla longitudine di ogni appartamento

                new tt.Marker().setLngLat([lon, lat]).addTo(map);
            });

            const bounds = [
                [10.5010, 40.7994],  // estremi sud-ovest (longitudine, latitudine)
                [13.9894, 42.8995]   // estremi nord-est (longitudine, latitudine)
            ];


            map.setMaxBounds(bounds);

            map.addControl(new tt.FullscreenControl());
            map.addControl(new tt.NavigationControl());
        },
    },
    mounted(){
        this.getMap();
    }
}
</script>

<template>
    <div class="container">
        <div class="row py-3">
            <h3 class="my-3">Ecco gli appartamenti che soddisfano la tua ricerca</h3>
            <small>Appartamenti trovati: {{ apartments.length }} </small>
            <div class="my-3 col-sm-12 col-md-12 col-lg-6 scrollable-cards">

                <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-12 mb-4" v-for="(apartment, index) in apartments" :key="index">

                        <div class="card shadow-sm border-0 rounded">
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="Appart-Img">
                            <div class="card-body">
                                <h5 class="card-title">{{ apartment.title }}</h5>
                                <p class="card-text">{{ apartment.address }}</p>
                                <p class="card-text">Descrizione: Appartamento con 2 camere da letto e 1 bagno.</p>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <div class="my-3 col">
                <div id="map"></div>
            </div>
        </div>
    </div>
</template>

<style lang="scss">

// .scrollable-cards{
    // max-height: 650px;
//   overflow-y: auto;
//   padding-right: 15px;
// }

.card {
    max-width: 100%;
    margin: 10px 0;
    border-radius: 10px;
    transition: transform 0.3s ease;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.15);
}

.card-img-top {
    border-bottom: 2px solid #e0e0e0;
    transition: transform 0.3s ease;
}

.card:hover .card-img-top {
    transform: scale(1.05);
}

.card-body {
    padding: 20px;
}

.card-title {
    font-size: 1.25rem;
    font-weight: bold;
    color: #333;
}

.card-text {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 10px;
}

.card-text:last-child {
    margin-bottom: 0;
}

img{
    object-fit:cover;
    height: 200px;
    width: 200px;
}

#map {
    width: 100%;
    height: 500px;
    border-radius: 20px;
}


</style>

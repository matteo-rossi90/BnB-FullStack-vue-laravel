<script>
export default{
    name:'Apartments',
    data(){
        return{
            cards:[
                {
                    "name": "La Residenza del Sole",
                    "ratings": 4.3,
                    "img": "https://picsum.photos/200/300?random=1"
                },
                {
                    "name": "Villa Paradiso",
                    "ratings": 3.7,
                    "img": "https://picsum.photos/200/300?random=2"
                },
                {
                    "name": "Casa dei Fiori",
                    "ratings": 3.7,
                    "img": "https://picsum.photos/200/300?random=3"
                },
                {
                    "name": "Appartamento Luna",
                    "ratings": 3.6,
                    "img": "https://picsum.photos/200/300?random=4"
                },
                {
                    "name": "La Dimora Elegante",
                    "ratings": 4.4,
                    "img": "https://picsum.photos/200/300?random=5"
                },
                {
                    "name": "Attico Vista Mare",
                    "ratings": 2.3,
                    "img": "https://picsum.photos/200/300?random=6"
                },
            ]
        }
    },
    methods:{},
    mounted(){}
}
</script>

<template>
    <div class="container">
        <div class="row py-3">
            <h2 class="my-3">Ecco gli appartamenti che soddisfano la tua ricerca</h2>
            <small>Totale ricercati: n </small>
            <div class="my-3 col-sm-12 col-md-6 col-lg-8">
                <div class="cards-wrapper">
                    <div id="box-scrollable">
                        <div class="row">

                            <div class="col-lg-4 col-md-6 col-sm-12 mb-4" v-for="(card, index) in cards" :key="index">

                                <div class="card shadow-sm border-0 rounded">
                                    <img :src="card.img" class="card-img-top" alt="Appart-Img">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ card.name }}</h5>
                                        <p class="card-text">{{ card.ratings }}</p>
                                        <p class="card-text">Descrizione: Appartamento con 2 camere da letto e 1 bagno.</p>
                                    </div>
                                </div>

                            </div>

                        </div>
                </div>

                </div>

            </div>
            <div class="my-3 col">
                mappa
            </div>
        </div>
    </div>
</template>

<style lang="scss">

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
    height: 250px;
    width: 250px;
}


</style>

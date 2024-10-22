<script>
import { store } from "../store/store";
import { filterApartment } from "../store/store";
import { findZone } from "../store/store";
import { createDataUrl } from "../store/store";
import { updateUrl } from "../store/store";
import { createPage } from "../store/store";
import { filterUserApartment } from "../store/store";

export default {
  name: "Apartments",

  data() {
    return {
      filtredApartment: store.filtredApartment,
      number_rooms: store.room,
      number_beds: store.bed,
      square_meters: store.square,
      sliderValue: store.distance,
      isFill: false,
      services: "",
      src: "",
    };
  },
  methods: {
    // getMap() {
    //   const tt = window.tt; //accesso alla libreria TomTom
    //   let center = store.center; //centro della mappa
    //   let size = 50; //dimensioni del popup
    //   const map = tt.map({
    //     key: "qNjsW3gGJOBNhFoXhBzsGRJAk5RJMJhI",
    //     center: center,
    //     container: "map",
    //     zoom: 10,
    //   });
    //   //estrapolazione delle proprietà che si riferiscono a "position" nel JSON generato dall'API
    //   this.filtredApartment.forEach((apartment) => {
    //     const lat = apartment.lat; //valore della latitudine di ogni appartamento
    //     const lon = apartment.lon; //valore dalla longitudine di ogni appartamento
    //     let boxContent = document.createElement("div");
    //     boxContent.innerHTML = `
    //             <div class="card-body">
    //                 <h5 class="title-popup"><strong>${apartment.title}</strong></h5>
    //                 <p class="title-popup">${apartment.address}</p>
    //                 <small>8000 euro</small>
    //             </div>`;
    //     let popup = new tt.Popup({
    //       closeButton: true, //permettere la chiusura il popup
    //       closeOnClick: true, //chiudere il popup al click su un'altra parte della mappa
    //       offset: size,
    //       // anchor: 'none'
    //     }).setDOMContent(boxContent); //contenuto dinamico del popup in base alle cards degli appartamenti
    //     //creare il marker per l'appartamento
    //     let marker = new tt.Marker().setLngLat([lon, lat]).setPopup(popup); //collegare il popup al marker
    //     marker.addTo(map);
    //   });
    //   //   const bounds = [
    //   //     [10.501, 40.7994], //estremi sud-ovest (longitudine, latitudine)
    //   //     [13.9894, 42.8995], //estremi nord-est (longitudine, latitudine)
    //   //   ];
    //   //   map.setMaxBounds(bounds);
    //   map.addControl(new tt.FullscreenControl());
    //   map.addControl(new tt.NavigationControl());
    // },
    activeFilter() {
      store.room = this.number_rooms;
      store.bed = this.number_beds;
      store.square = this.square_meters;
      store.distance = this.sliderValue;
      let objStringUrl = updateUrl(this.$route.params.id);
      console.log(objStringUrl);
      let objData = createDataUrl(objStringUrl.stringUrl);
      createPage(objData);
      filterUserApartment(store.filtredApartment, objStringUrl.objUpdate);
      this.$router.push({ params: { id: objStringUrl.stringUrl } });
      this.$forceUpdate();

      //   if (this.number_rooms) {
      //     this.filtredApartment = this.filtredApartment.filter(
      //       (apartment) => apartment.number_rooms >= this.number_rooms
      //     );
      //   }
      //   if (this.number_beds) {
      //     this.filtredApartment = this.filtredApartment.filter(
      //       (apartment) => apartment.number_beds >= this.number_beds
      //     );
      //   }
      //   if (this.square_meters) {
      //     this.filtredApartment = this.filtredApartment.filter(
      //       (apartment) => apartment.square_meters >= this.square_meters
      //     );
      //   }
      //   if (this.sliderValue !== 20) {
      //     let newUrl = createPageWithUrl(this.$route.params.id, this.sliderValue);
      //     this.filtredApartment = store.filtredApartment;
      //     ;
      //     localStorage.setItem(
      //       "routeParams",
      //       JSON.stringify(this.$route.params.id)
      //     );
      //   }
      //   store.filtredApartment = console.log("rotta", this.$route.params.id);
    },
    // },
  },

  //   mounted() {
  //     localStorage.setItem("routeParams", JSON.stringify(this.$route.params.id));
  //     window.addEventListener("load", () => {
  //       const routeParams = JSON.parse(localStorage.getItem("routeParams"));
  //       createPageWithUrl(routeParams, this.sliderValue);

  //       // Sovrascrivi i dati con quelli filtrati
  //       this.filtredApartment = store.filtredApartment;

  //       // Attiva automaticamente il filtro
  //       this.activeFilter();
  //     });

  // this.getMap();
  //   all apartment
  //   all apartment
  //   all apartment
  // axios
  //   .get("/api/home", {
  //     headers: {
  //       Accept: "application/json",
  //       "Cache-Control": "no-cache", // Disabilita il caching
  //     },
  //     params: {
  //       t: Date.now(), // Aggiungi un timestamp per evitare il caching
  //     },
  //   })
  //   .then((res) => {
  //     console.
  // "apartment- all apartment:ok", res;
  //     store.allApartments = res.data;
  //   })
  //   .catch((err) => {
  //     console.log("app- all apartment: ", err.message);
  //   });
  //   },

  computed: {
    apartmensFiltred() {
      return store.filtredApartment;
    },
  },
  watch: {
    "$store.filtredApartment": function () {},
  },
};
</script>

<template>
  <div class="container">
    <div class="row">
      <label for="number_rooms">number_rooms</label>
      <input
        type="number"
        placeholder="inserisci numero"
        id="number_rooms"
        v-model.trim="number_rooms"
      />
      <label for="number_beds">number_beds</label>
      <input
        type="number"
        placeholder="inserisci numero"
        id="number_beds"
        v-model.trim="number_beds"
      />
      <label for="square_meters">Metri quadri</label>
      <input
        type="number"
        placeholder="inserisci numero"
        id="square_meters"
        v-model.trim="square_meters"
      />
      <input
        type="range"
        min="1"
        max="200"
        value="20"
        v-model.trim="sliderValue"
      />
      <span>{{ sliderValue }} km dal punto scelto</span>
      <span v-for="(service, index) in services" :key="index">{{
        service.name
      }}</span>
      <button @click="activeFilter">Filtra</button>
    </div>
    <div class="row py-3">
      <h3 class="my-3">Ecco gli appartamenti che soddisfano la tua ricerca</h3>
      <small>Appartamenti trovati: {{ apartmensFiltred.length }} </small>
      <div class="my-3 col-sm-12 col-md-12 col-lg-6 scrollable-cards">
        <div class="row" v-if="apartmensFiltred.length">
          <div
            class="col-lg-6 col-md-6 col-sm-12 mb-4"
            v-for="(apartment, index) in apartmensFiltred"
            :key="index"
          >
            <router-link
              :to="{ name: 'showApartment', params: { id: apartment.id } }"
            >
              <div class="card shadow-sm border-0 rounded">
                <img
                  :src="apartment.image"
                  class="apartment-image card-img-top"
                  alt="Appart-Img"
                />
                <div class="card-body">
                  <h5 class="card-title">{{ apartment.title }}</h5>
                  <p class="card-text">{{ apartment.address }}</p>
                  <p class="card-text">Camere: {{ apartment.number_rooms }}</p>
                  <p class="card-text">Letti: {{ apartment.number_beds }}</p>
                  <p class="card-text">
                    Superficie: {{ apartment.square_meters }} m²
                  </p>
                </div>
              </div>
            </router-link>
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

img {
  object-fit: cover;
  height: 200px;
  width: 200px;
}

#map {
  width: 100%;
  height: 500px;
  border-radius: 20px;
}

.title-popup {
  font-size: 10px;
}

a {
  text-decoration: none;
}
</style>

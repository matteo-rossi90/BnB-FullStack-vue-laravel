<script>
export default {
  name: "ApartmentCard",
  props: {
    apartment: Object,
  },

  methods: {
    // imageUrl(path) {
    //   return `${image}`; // URL completo dell'immagine
    // }
  }
};
</script>


<template>
  <!-- <div class="card shadow-sm border-0 rounded">
        <img src="https://via.placeholder.com/150" class="card-img-top" alt="Appart-Img">
        <div class="card-body">
            <h5 class="card-title">Appartamento 1</h5>
            <p class="card-text">Indirizzo: Via Roma, 123</p>
            <p class="card-text">Descrizione: Appartamento con 2 camere da letto e 1 bagno.</p>
        </div>
    </div> -->

  <!-- <div class="card shadow-sm border-0 rounded">
    <img
      :src="apartment.image"
      class="card-img-top"
      alt="Appart-Img"
    />
    <div class="card-body">
      <h5 class="card-title">{{ apartment.title }}</h5>
      <p class="card-text">{{ apartment.address }}</p>
      <p class="card-text">Stanze n° {{ apartment.number_beds }}</p>
    </div>
  </div> -->

  <div class="card-container">
    <div class="card-image-wrapper">
        <img :src="apartment.image" class="card-image" alt="Appart-Img" />
    </div>
    <div class="card-info">
      <h5 class="card-title">{{ apartment.title }}</h5>
      <p class="card-text">{{ apartment.address }}</p>
      <p class="card-text">Stanze n° {{ apartment.number_beds }}</p>
    </div>
  </div>
</template>

<style scoped lang="scss">
.card-container {
  width: 100%;
  min-height: 100%;
  margin: 10px 0;
  border-radius: 15px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  background: none;
  box-shadow: none;

}

.card-image-wrapper {
  width: 100%;
  aspect-ratio: 4 / 4;
  overflow: hidden;
  border-radius: 15px;
}

.card-image {
    height: 100%;
  width: 100%;
  border-radius: 15px;
  object-fit: cover;
}

.card-info {
  padding: 10px;
  height: 45%;
  text-align: left;
}

.card-title {
  font-size: 1rem;
  font-weight: 600;
  color: #333;
  margin-bottom: 5px;
}

.card-text {
  font-size: 0.8rem;
  color: #666;
  margin-bottom: 0px;
  padding: 2px 0;
}

/* Query per centrare la card sui dispositivi mobili */
@media (max-width: 576px) {
  .card-container {
    margin: 0 auto;
    display: flex;
    justify-content: center;
  }
}


</style>

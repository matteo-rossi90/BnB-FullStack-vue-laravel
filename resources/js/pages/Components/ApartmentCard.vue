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
    <img :src="apartment.image" class="card-image" alt="Appart-Img" />
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
  max-width: 300px;
  height: 400px;
  margin: 10px 0;
  border-radius: 15px;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  background: none;
  box-shadow: none;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-container:hover {
  transform: translateY(-5px);
  box-shadow: 0 4px 15px #e4c4c4;
}

.card-image {
  width: 100%;
  height: 50%;
  border-radius: 15px;
  object-fit: cover;
  transition: transform 0.3s ease;
}

.card-container:hover .card-image {
  transform: scale(1.05);
}

.card-info {
  padding: 10px;
  height: 45%;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  text-align: left;
}

.card-title {
  font-size: 1.2rem;
  font-weight: 600;
  color: #333;
  margin-bottom: 5px;
}

.card-text {
  font-size: 0.9rem;
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

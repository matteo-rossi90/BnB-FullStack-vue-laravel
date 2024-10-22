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

  <div class="card shadow-sm border-0 rounded">
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
  </div>
</template>

<style scoped lang="scss">
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
</style>

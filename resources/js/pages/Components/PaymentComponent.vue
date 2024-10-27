<script>
export default {
  name: "PaymentComponent",
  data() {
    return {};
  },
  methods: {},
  mounted() {},
};
</script>
<template>
  <div class="container">
    <h2>Scegli il piano Premium che preferisci</h2>
    <div class="wrapper">
      <div class="cardT">
        <h3 class="card-title">Bronzo</h3>
        <p class="card-content">
          Lavora di più con noi! Con l'abbonamento Bronzo, avrai maggiore
          visibilità e più opportunità di essere scelto rispetto alla
          concorrenza. Sponsorizza un appartamento alla volta e fai crescere il
          tuo fatturato.
        </p>
        <div class="contInfo">
          <p>Vantaggi:</p>
          <ul>
            <li>Aumento delle visualizzazioni</li>
            <li>Aumento delle prenotazioni</li>
          </ul>
          <p>Costi e dettagli:</p>
          <ul>
            <li>Costo: 2.99€</li>
            <li>24 ore di sponsorizzazione</li>
            <li>Un abbonamento per profilo</li>
          </ul>
        </div>
        <router-link :to="{ name: 'checkout', params: { sponsor: 1 } }">
          <button class="card-btn">Vai al pagamento</button>
        </router-link>
      </div>
      <div class="cardT">
        <h3 class="card-title">Argento</h3>
        <p class="card-content">
          Lavora di più con noi! Con l'abbonamento Argento, avrai maggiore
          visibilità e più opportunità di essere scelto rispetto alla
          concorrenza. Sponsorizza un appartamento alla volta e fai crescere il
          tuo fatturato.
        </p>
        <div class="contInfo">
          <p>Vantaggi:</p>
          <ul>
            <li>Aumento delle visualizzazioni</li>
            <li>Aumento delle prenotazioni</li>
          </ul>
          <p>Costi e dettagli:</p>
          <ul>
            <li>Costo: 5.99€</li>
            <li>72 ore di sponsorizzazione</li>
            <li>Un abbonamento per profilo</li>
          </ul>
        </div>
        <router-link :to="{ name: 'checkout', params: { sponsor: 2 } }">
          <button class="card-btn">Vai al pagamento</button>
        </router-link>
      </div>
      <div class="cardT">
        <h3 class="card-title">Oro</h3>
        <p class="card-content">
          Lavora di più con noi! Con l'abbonamento Oro, avrai maggiore
          visibilità e più opportunità di essere scelto rispetto alla
          concorrenza. Sponsorizza un appartamento alla volta e fai crescere il
          tuo fatturato.
        </p>
        <div class="contInfo">
          <p>Vantaggi:</p>
          <ul>
            <li>Aumento delle visualizzazioni</li>
            <li>Aumento delle prenotazioni</li>
          </ul>
          <p>Costi e dettagli:</p>
          <ul>
            <li>Costo: 9.99€</li>
            <li>144 ore di sponsorizzazione</li>
            <li>Un abbonamento per profilo</li>
          </ul>
        </div>
        <router-link :to="{ name: 'checkout', params: { sponsor: 3 } }">
          <button class="card-btn">Vai al pagamento</button>
        </router-link>
      </div>
    </div>

    <!-- <div class="col">
        <h3>Piano di pagamento argento</h3>
        <ul>
          <li>72h di sponsorizzazione</li>
          <li>5.99</li>
        </ul>
        <router-link :to="{ name: 'checkout', params: { sponsor: 2 } }"
          >sponsorizza</router-link
        >
      </div>
      <div class="col">
        <h3>Piano di pagamento oro</h3>
        <ul>
          <li>144h di sponsorizzazione</li>
          <li>9.99</li>
        </ul>
        <router-link :to="{ name: 'checkout', params: { sponsor: 3 } }"
          >sponsorizza</router-link
        >
      </div> -->
  </div>
</template>
<style lang='scss' scoped>
// @use 'path' as *;

h2 {
  text-align: center;
  color: #4181ee;
}
.wrapper {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
}
.card-title {
  font-size: 1.5rem;
  margin-bottom: 1rem;
}
.cardT {
  max-width: 300px;
  min-height: 250px;
  background-color: rgb(205, 127, 50);
  padding: 30px;
  border-radius: 3px;
  box-sizing: border-box;
  color: black;
  margin: 20px;

  box-shadow: rgb(50 50 93 / 25%) 0px 30px 60px -12px,
    rgb(0 0 0 / 30%) 0px 18px 36px -18px;
}
.cardT:nth-child(2) {
  background-color: rgb(192, 192, 192);
}
.cardT:last-child {
  background-color: rgb(255, 215, 0);
}

.card-btn {
  all: unset;
  display: block;
  margin-left: auto;
  border: 2px solid #fff;
  padding: 10px 15px;
  border-radius: 25px;
  font-size: 10px;
  font-weight: 600;
  transition: all 0.5s;
  cursor: pointer;
  letter-spacing: 1.2px;
}
.card-btn:hover {
  color: red;
  background: #fff;
}
.card:nth-child(2) .card-btn:hover {
  color: #4181ee;
  background: #fff;
}
.card:last-child .card-btn:hover {
  color: #673ab7;
  background: #fff;
}
.contInfo {
  padding: 0;
  p {
    font-size: 1.3rem;
    font-weight: 600;
  }
  ul {
    padding: 0;
    padding-left: 1rem;
    list-style-type: circle;
  }
}
</style>

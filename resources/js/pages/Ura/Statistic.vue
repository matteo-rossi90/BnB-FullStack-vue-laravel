<script>
import { Chart } from "chart.js";
export default {
  name: "Statistic",
  data() {
    return {};
  },
  mounted() {
    const ctx = document.getElementById("myChart").getContext("2d");
    new Chart(ctx, {
      type: "bar",
      data: {
        labels: ["Gennaio", "Febbraio", "Marzo", "Aprile", "Maggio", "Giugno"],
        datasets: [
          {
            label: "Vendite",
            data: [65, 59, 80, 81, 56, 55],
            backgroundColor: "rgba(75, 192, 192, 0.2)",
            borderColor: "rgba(75, 192, 192, 1)",
            borderWidth: 1,
          },
        ],
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
          },
        },
      },
    });
  },
  methods: {},
};
</script>
<template>
  <div>
    <canvas id="myChart"></canvas>
  </div>
</template>
<style lang='scss' scoped>
// @use 'path' as *;
</style>

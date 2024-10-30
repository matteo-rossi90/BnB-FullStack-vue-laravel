<script>
import { Chart } from "chart.js";
import dayjs from "dayjs";
export default {
  name: "Statistic",
  data() {
    return {
      allData: [],
    };
  },
  mounted() {
    this.statisticCall(
      this.$route.params.id,
      "2023-01-01 00:00:00",
      Date.now()
    );
    // this.createTable();
  },
  methods: {
    statisticCall(idApartment, startDate, endDate) {
      // Formatta le date nel formato `YYYY-MM-DD HH:mm:ss`
      const formattedStartDate = dayjs(startDate).format("YYYY-MM-DD HH:mm:ss");
      const formattedEndDate = dayjs(endDate).format("YYYY-MM-DD HH:mm:ss");

      axios
        .get("http://127.0.0.1:8000/api/user/view", {
          params: {
            id: idApartment,
            start_date: formattedStartDate,
            end_date: formattedEndDate,
          },
        })
        .then((res) => {
          this.allData = res.data;
          this.createTable(this.createDataTable(this.allData));
          console.log(res.data); // Visualizza i risultati
        })
        .catch((err) => {
          console.log(err);
        });
    },
    createDataTable(data) {
      // mesi
      let month = data.map((date) => {
        switch (date.month) {
          case 1:
            return "Gennaio";
          case 2:
            return "Febbraio";
          case 3:
            return "Marzo";
          case 4:
            return "Aprile";
          case 5:
            return "Maggio";
          case 6:
            return "Giugno";
          case 7:
            return "Luglio";
          case 8:
            return "Agosto";
          case 9:
            return "Settembre";
          case 10:
            return "Ottobre";
          case 11:
            return "Novembre";
          case 12:
            return "Dicembre";
        }
      });

      // view
      let view = data.map((date) => {
        return date.view_count;
      });

      return {
        month,
        view,
      };
    },
    createTable(data) {

        if (this.chartInstance) {
        this.chartInstance.destroy();  // Distrugge il grafico precedente
      }
      const ctx = document.getElementById("myChart").getContext("2d");
      new Chart(ctx, {
        type: "bar",
        data: {
          labels: data.month,
          datasets: [
            {
              label: "Visualizzazioni",
              data: data.view,
              backgroundColor: "#FF5757",
              borderColor: "#FF5757",
              borderWidth: 1,
            },
          ],
        },
        options: {
            responsive: true,
          maintainAspectRatio: false,
          scales: {
            y: {
              beginAtZero: true,
            },
          },
        },
      });
    },
  },
};
</script>
<template>
  <div class="ms_container">
    <div class="container my-1">

    <canvas id="myChart"></canvas>
    </div>
  </div>
</template>
<style lang='scss' scoped>

    .ms_container{
        width: 100%;
          height: calc(100vh - 200px);
          #myChart{
            height: 400px;
          }
    }

// @use 'path' as *;
</style>

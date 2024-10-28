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
      const ctx = document.getElementById("myChart").getContext("2d");
      new Chart(ctx, {
        type: "bar",
        data: {
          labels: data.month,
          datasets: [
            {
              label: "Visualizzazioni",
              data: data.view,
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
  },
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

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head, useForm } from "@inertiajs/inertia-vue3";
import BreezeValidationErrors from "@/Components/ValidationErrors.vue";
import { Chart, registerables } from "chart.js";

export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        BreezeValidationErrors,
    },

     props: {
         reports: Array,
         branches: Array,
         employees: Array,
         temperatures: Array

    // chartdata
    },
   created() {},
    mounted() {



    console.log("mounted");
    Chart.register(...registerables);
    // Area Chart Example
    // var ctx = document.getElementById("myAreaChart");
    this.myLineChart = new Chart(this.$refs.chart, {
      type: "line",
      data: {
        labels: [
          "0 Mins",
          "30 Mins",
          "1 Hrs",
          "1.5 Hrs.",
          "2 Hrs",
          "2.5 Hrs",
          "3 Hrs",
          "3.5 Hrs",
          "4 Hrs",
          "4.5 Hrs",
          "5 Hrs",
          "5.5 Hrs"
        ],
        datasets: [
          {
            label: "Centigrade",
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(78, 115, 223, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(78, 115, 223, 1)",
            pointBorderColor: "rgba(78, 115, 223, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
            pointHitRadius: 5,
            pointBorderWidth: 2,
            data: [0, 10, 20, 30, 40, 50, 50, 55, 40, 90, 100],
          },
        ],
      },
      options: {
        maintainAspectRatio: false,
        layout: {
          padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0,
          },
        },
        scales: {
          xAxes: [
            {
              time: {
                unit: "date",
              },
              gridLines: {
                display: false,
                drawBorder: false,
              },
              ticks: {
                maxTicksLimit: 7,
              },
            },
          ],
          yAxes: [
            {
              ticks: {
                maxTicksLimit: 5,
                padding: 10,
                // Include a dollar sign in the ticks
                callback: function (value, index, values) {
                  return number_format(value) + "°C";
                },
              },
              gridLines: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: false,
                borderDash: [2],
                zeroLineBorderDash: [2],
              },
            },
          ],
        },
        legend: {
          display: false,
        },
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          titleMarginBottom: 10,
          titleFontColor: "#6e707e",
          titleFontSize: 14,
          borderColor: "#dddfeb",
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          intersect: false,
          mode: "index",
          caretPadding: 10,
          callbacks: {
            label: function (tooltipItem, chart) {
              var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || "";
              return datasetLabel + ": °C" + number_format(tooltipItem.yLabel);
            },
          },
        },
      },
    });

    // this.renderChart(myLineChart.data, myLineChart.options);
  },
  data() {
    return {
      myLineChart: {},
      chartData: {
        labels: [
          "0 Mins",
          "30 Mins",
          "1 Hrs",
          "1.5 Hrs.",
          "2 Hrs",
          "2.5 Hrs",
          "3 Hrs",
          "3.5 Hrs",
          "4 Hrs",
          "4.5 Hrs",
          "5 Hrs",
          "5.5 Hrs",
        ],
        datasets: [
          {
            label: "Centigrade",
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(78, 115, 223, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(78, 115, 223, 1)",
            pointBorderColor: "rgba(78, 115, 223, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
            pointHitRadius: 5,
            pointBorderWidth: 2,
            data: [0, 10, 20, 30, 40, 50, 50, 55, 40, 90, 100],
          },
        ],
      },
      chartOptions: {
        maintainAspectRatio: false,
        layout: {
          padding: {
            left: 10,
            right: 25,
            top: 25,
            bottom: 0,
          },
        },
        scales: {
          xAxes: [
            {
              time: {
                unit: "date",
              },
              gridLines: {
                display: false,
                drawBorder: false,
              },
              ticks: {
                maxTicksLimit: 7,
              },
            },
          ],
          yAxes: [
            {
              ticks: {
                maxTicksLimit: 5,
                padding: 10,
                // Include a dollar sign in the ticks
                callback: function (value, index, values) {
                  return number_format(value) + "°C";
                },
              },
              gridLines: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: false,
                borderDash: [2],
                zeroLineBorderDash: [2],
              },
            },
          ],
        },
        legend: {
          display: false,
        },
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          titleMarginBottom: 10,
          titleFontColor: "#6e707e",
          titleFontSize: 14,
          borderColor: "#dddfeb",
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          intersect: false,
          mode: "index",
          caretPadding: 10,
          callbacks: {
            label: function (tooltipItem, chart) {
              var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || "";
              return datasetLabel + ": °C" + number_format(tooltipItem.yLabel);
            },
          },
        },
      },
    };
  },

  methods: {},
}

</script>
<template>
<BreezeAuthenticatedLayout>
    <div>
    <div class="card">
      <div class="card__header">
        <div class="card__header-title">BRANCH A</div>
      </div>
      <div class="card__main">
        <div class="card__row">
          <div class="user-card"  >
            <div class="card-body" >
            <div class="chart-area">

              <canvas id="myAreaChart1" ref="chart" ></canvas>
            </div>
          </div>
            <div class="user-card__info">


            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="card">
      <div class="card__header">
        <div class="card__header-title">BRANCH B</div>
      </div>
      <div class="card__main">
        <div class="card__row">
          <div class="user-card"  >
            <div class="card-body" >
            <div class="chart-area">

              <canvas id="myAreaChart" ref="chart" ></canvas>
            </div>
          </div>
            <div class="user-card__info">


            </div>
          </div>

        </div>
      </div>
    </div>
    </div>
    </BreezeAuthenticatedLayout>
</template>

<style>




.main-overview {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(265px, 1fr));
  grid-auto-rows: 100px;
  grid-gap: 30px;
  margin: 20px;
}

.overviewCard {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 30px;
  background-color: orange;
  border-radius: 1em;




}

.card {
  display: flex;
  flex-direction: column;
  width: 100%;
  background-color: #fff;
  margin-bottom: 20px;
  -webkit-column-break-inside: avoid;
  padding: 24px;
  box-sizing: border-box;






}

.user-card{
  display: flex;
  align-items: center;
  justify-content: flex-start;
  margin-top: 10px;
  padding: 12px;
  width: 100%;

}

.card:first-child {
  height: 400px;
}

.card:nth-child(2) {
  height: 400px;
}



.calendar {
  width: max-content;
  height: 300px;
  font-size: 11px;
  min-width: 0;
}





.title {
  font-weight: lighter;
  font-size: x-large;
  color: white;
  text-align: end;
}

@media only screen and (min-width: 65.625em) {

}


@media screen and (max-width: 720px) {
  .main, .footer {
    margin-left: 0;
  }
  .overviewCard-info{
    width: 17rem;
  }
  .main-overview {
    width: 17rem;
  }
  .overviewCard{
    width: 17rem;
  }

}




</style>

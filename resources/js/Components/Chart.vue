<template>
  <LineChart :options="chartOptions" :chart-data="chartData" />
</template>
<script>
import { Line } from "vue-chartjs";
import {
  Chart as ChartJs,
  Title,
  Tooltip,
  Legend,
  LineElement,
  CategoryScale,
  LinearScale,
} from "chart.js";
ChartJs.register(Title, Tooltip, Legend, LineElement, CategoryScale, LinearScale);
export default {
  extends: Line,
  name: "LineChart",

  props: {
    chartdata: {
      type: Object,
      default: null,
    },
    options: {
      type: Object,
      default: null, 
    },
  },

  data() {},

  mounted() {
    this.renderChart(this.chartdata, this.options);
  },
};
</script>

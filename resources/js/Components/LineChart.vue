<template>
  <div>
    <apexchart type="line" :options="chartOptions" :series="chartData" height="400" />
  </div>
</template>

<script>
import { defineComponent } from 'vue';
import VueApexCharts from 'vue3-apexcharts';

export default defineComponent({
  components: {
    apexchart: VueApexCharts,
  },
  data() {
    return {
      chartData: [
        {
          name: 'Série 1',
          data: [10, 42, 35, 51, 24, 42, 19],
        },
        {
          name: 'Série 2',
          data: [15, 25, 30, 45, 38, 29, 36],
        },
      ],
      chartOptions: {
        chart: {
          type: 'line',
        },
        title: {
          text: 'Gráfico de Linhas',
          align: 'center'
        },
        xaxis: {
          categories: ['Day 1', 'Day 2', 'Day 3', 'Day 4', 'Day 5', 'Day 6', 'Day 7'],
        },
        yaxis: {
          title: {
            text: 'Valores',
          },
        },
      },
    };
  },
});
</script>

<template>
  <div class="bg-white shadow-md p-6 rounded-lg">
    <div class="chart-container">
      <apexchart type="bar" :options="chartOptions" :series="chartData" height="400" />
    </div>
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
          data: [100, 80, 60],
        },
      ],
      chartOptions: {
        colors: ['#FFF', '#d1d5db', '#9F9F9F'],
        chart: {
          type: 'funnel',
          height: 350,
          toolbar: {
            show: false
          }
        },
        plotOptions: {
          bar: {
            borderRadius: 12,
            horizontal: true,
            barHeight: "80%",
            isFunnel: true,
            distributed: true,
          }
        },
        title: {
          text: 'Gráfico de Funil (Estilo Funnel)',
          align: 'center'
        },
        xaxis: {
          categories: ['Categoria 1', 'Categoria 2', 'Categoria 3'],
        },
        yaxis: {
          title: {
            text: 'Valores',
          },
        },
        dataLabels: {
          enabled: true,
          formatter: function (val, opt) {
            return opt.w.globals.labels[opt.dataPointIndex] + ":  " + val;
          },
          style: {
            colors: ['#000', '#000', '#fff'],
            fontSize: '16px',
          },
        },
        legend: {
          show: false
        },
      },
    };
  },
});
</script>

<style>
.apexcharts-bar-shadows {
  fill: transparent;
}

.apexcharts-bar-area {
  filter: drop-shadow(0px 0px 10px rgba(0, 0, 0, 0.25));
}
</style>
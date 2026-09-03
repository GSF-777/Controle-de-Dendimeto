<script setup>
import AppLayout from '../Pages/layouts/layouts.vue';
import { Line } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, LineElement, PointElement, CategoryScale, LinearScale } from 'chart.js'

// Registra os elementos específicos para gráficos de linha (Line e Point)
ChartJS.register(Title, Tooltip, Legend, LineElement, PointElement, CategoryScale, LinearScale)

const chartData = {
  labels: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio'],
  datasets: [
    {
      label: 'Vendas 2026',
      backgroundColor: '#42b883',
      borderColor: '#42b883',
      data: [40, 39, 10, 40, 39],
      tension: 0.3 // Deixa a linha levemente curvada
    }
  ]
}

const chartOptions = {
  responsive: true,
  maintainAspectRatio: false
}
</script>

<template>
  <AppLayout>
  <div style="height: 300px;">
    <Line :data="chartData" :options="chartOptions" />
  </div>
  </AppLayout>
</template>

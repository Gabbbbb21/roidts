<template>
  <Bar
    :data="chartData"
    :options="chartOptions"
  />
</template>

<script setup>
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'
import { computed } from 'vue'

// 1. Register the required elements from Chart.js
ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

// 2. Define the props passed from the parent component
const props = defineProps({
  data: {
    type: Object,
    required: true,
  },
})

// 3. Define the chart data structure
const chartData = computed(() => ({
  labels: props.data.labels, // e.g., ['Jan', 'Feb', 'Mar', ...]
  datasets: [
    {
      label: 'Created Documents',
      backgroundColor: '#4299e1', // Tailwind's blue-500
      data: props.data.data, // e.g., [65, 59, 80, ...]
    }
  ]
}))

// 4. Define the chart options (Tailwind-friendly styling)
const chartOptions = {
  responsive: true,
  maintainAspectRatio: false,
  scales: {
    y: {
      beginAtZero: true,
      grid: {
        color: '#e2e8f0' // Tailwind's gray-200 for grid lines
      },
      ticks: {
        color: '#4a5568' // Tailwind's gray-700 for axis labels
      }
    },
    x: {
      grid: {
        display: false // Hide vertical grid lines
      },
      ticks: {
        color: '#4a5568'
      }
    }
  },
  plugins: {
    legend: {
      labels: {
        color: '#2d3748' // Tailwind's gray-800
      }
    }
  }
}
</script>
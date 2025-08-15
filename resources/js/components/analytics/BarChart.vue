<script>
import { Bar } from 'vue-chartjs'
import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

const labels = ['January', 'February', 'March', 'April', 'May', 'June', 'July'];
const data = {
    labels: labels,
    datasets: [{
        label: 'My First Dataset',
        data: [65, 59, 80, 81, 56, 55, 40],
        backgroundColor: 'rgba(0, 172, 37, 0.5)',
        borderColor: 'rgba(0, 176, 38, 1)',
        borderWidth: 1
    }]
};


export default {
    name: 'BarChart',
    components: { Bar },
    data() {
        return {
            chartData: {
                labels: data.labels,
                datasets: data.datasets
            },
            chartOptions: {
                responsive: true
            }
        }
    }
}
</script>

<template>
    <Bar id="my-chart-id" :options="chartOptions" :data="chartData" />
</template>
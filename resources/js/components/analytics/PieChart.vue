<script>
import { Pie } from 'vue-chartjs'
import {
    Chart as ChartJS,
    Title,
    Tooltip,
    Legend,
    ArcElement
} from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, ArcElement)

const labels = ['Red', 'Blue', 'Yellow']
const data = {
    labels: labels,
    datasets: [{
        label: 'My First Dataset',
        data: [300, 50, 100],
        backgroundColor: [
            'rgb(255, 99, 132)',
            'rgb(54, 162, 235)',
            'rgb(255, 205, 86)'
        ],
        hoverOffset: 4
    }]
}

export default {
    name: 'PieChart',
    components: { Pie },
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
    <Pie id="my-chart-id" :options="chartOptions" :data="chartData" />
</template>
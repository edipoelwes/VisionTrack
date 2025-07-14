<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

import dayjs from 'dayjs'
import 'dayjs/locale/pt-br' // importa a localização
dayjs.locale('pt-br')

import { Bar, Pie } from 'vue-chartjs'
import {
    Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement
} from 'chart.js'
import {formatCurrencyBR} from "@/Utils/formatters.js";

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale, ArcElement)

const props = defineProps({
    total_clients: Number,
    total_sales: Number,
    total_sales_month: Number,
    total_revenue: Number,
    pending_installments: Number,
    overdue_installments: Number,
    sales_per_month: Array,
    payment_type_stats: Array,
})

const barData = {
    labels: props.sales_per_month.map(d => dayjs(d.period).format('MMM/YY')),
    datasets: [{
        label: 'Total de Vendas (R$)',
        backgroundColor: '#6366f1',
        data: props.sales_per_month.map(d => d.total),
    }]
}

const pieData = {
    labels: props.payment_type_stats.map(d => d.payment_type === 'cash' ? 'À vista' : 'Parcelado'),
    datasets: [{
        backgroundColor: ['#22c55e', '#3b82f6'],
        data: props.payment_type_stats.map(d => d.total),
    }]
}
</script>

<template>
    <AppLayout title="home">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Home
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">
                <!-- Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="bg-white dark:bg-gray-800 p-4 rounded shadow text-center">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Clientes</p>
                        <p class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">{{ total_clients }}</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-4 rounded shadow text-center">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Total de Vendas</p>
                        <p class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">{{ total_sales }}</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-4 rounded shadow text-center">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Vendas do Mês</p>
                        <p class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">{{ formatCurrencyBR(total_sales_month) }}</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-4 rounded shadow text-center">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Receita Total</p>
                        <p class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">{{ formatCurrencyBR(total_revenue) }}</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-4 rounded shadow text-center">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Parcelas Pendentes</p>
                        <p class="text-2xl font-bold text-yellow-500">{{ pending_installments }}</p>
                    </div>
                    <div class="bg-white dark:bg-gray-800 p-4 rounded shadow text-center">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Parcelas Vencidas</p>
                        <p class="text-2xl font-bold text-red-500">{{ overdue_installments }}</p>
                    </div>
                </div>

                <!-- Gráficos -->
                <<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Vendas por Mês -->
                <div class="bg-white dark:bg-gray-800 p-4 rounded shadow h-[400px] flex flex-col">
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Vendas por Mês</h3>
                    <div class="flex-1">
                        <Bar
                            :data="barData"
                            :options="{ responsive: true, maintainAspectRatio: false }"
                            style="height: 100%;"
                        />
                    </div>
                </div>

                <!-- Forma de Pagamento -->
                <div class="bg-white dark:bg-gray-800 p-4 rounded shadow h-[400px] flex flex-col">
                    <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Forma de Pagamento</h3>
                    <div class="flex-1">
                        <Pie
                            :data="pieData"
                            :options="{ responsive: true, maintainAspectRatio: false }"
                            style="height: 100%;"
                        />
                    </div>
                </div>
            </div>
            </div>
        </div>
    </AppLayout>
</template>

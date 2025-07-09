<script setup>
import SaleSummary from './SaleSummary.vue'
import InstallmentsTable from './InstallmentsTable.vue'

const props = defineProps({
    sales: Array,
})
</script>

<template>
    <div class="space-y-6">
        <div
            v-for="sale in sales"
            :key="sale.id"
            class="bg-white dark:bg-gray-800 shadow rounded p-6 space-y-4"
        >
            <!-- Resumo da venda -->
            <SaleSummary :sale="sale" />

            <!-- Tabela de parcelas -->
            <InstallmentsTable :installments="sale.installments" />
        </div>
    </div>
</template>

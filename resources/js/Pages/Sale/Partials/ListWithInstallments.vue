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
            <!-- Cabeçalho com dados do cliente -->
<!--            <div>-->
<!--                <h3 class="text-lg font-bold text-gray-800 dark:text-white">-->
<!--                    {{ sale.client.name }}-->
<!--                </h3>-->
<!--                <p class="text-sm text-gray-500 dark:text-gray-400">{{ sale.client.cpf }}</p>-->
<!--            </div>-->

            <!-- Resumo da venda -->
            <SaleSummary :sale="sale" />

            <!-- Tabela de parcelas -->
            <InstallmentsTable :installments="sale.installments" />
        </div>
    </div>
</template>

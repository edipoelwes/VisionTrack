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
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Lado esquerdo: resumo da venda (25%) -->
                <div class="md:col-span-1">
                    <SaleSummary :sale="sale" />
                </div>

                <!-- Lado direito: parcelas (75%) -->
                <div class="md:col-span-3">
                    <InstallmentsTable :installments="sale.installments" />
                </div>
            </div>
        </div>
    </div>
</template>

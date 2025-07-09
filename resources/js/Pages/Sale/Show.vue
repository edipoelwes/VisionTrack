<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import SaleSummary from './Partials/SaleSummary.vue'
import InstallmentsTable from './Partials/InstallmentsTable.vue'

const props = defineProps({
    sale: Object,
})
</script>

<template>
    <AppLayout title="Detalhes da Venda">
        <template #header>
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">Detalhes da Venda</h2>
        </template>

        <div class="py-8">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

                <!-- Cliente -->
                <div class="bg-white dark:bg-gray-800 shadow rounded p-6">
                    <p class="text-lg font-bold text-gray-800 dark:text-white">{{ sale.client.name }}</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ sale.client.cpf }}</p>
                </div>

                <!-- Dados da venda -->
                <SaleSummary :sale="sale" />

                <!-- Parcelas -->
                <InstallmentsTable :installments="sale.installments" />

            </div>
        </div>
    </AppLayout>
</template>

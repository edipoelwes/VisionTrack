<script setup>
import { Link } from '@inertiajs/vue3'
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
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

                <!-- Grid: Cliente + Venda -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    <!-- Cliente -->
                    <div class="bg-white dark:bg-gray-800 shadow rounded p-6">
                        <div class="flex items-center gap-4">
                            <!-- Avatar (com inicial) -->
                            <div class="flex-shrink-0">
                                <div class="w-14 h-14 rounded-full bg-indigo-600 text-white flex items-center justify-center text-xl font-bold uppercase">
                                    {{ sale.client.name.charAt(0) }}
                                </div>
                            </div>

                            <!-- Dados do cliente -->
                            <div>
                                <div class="mt-2">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Nome</p>
                                    <Link
                                        :href="route('clients.show', sale.client.id)"
                                        class="text-base font-medium text-indigo-600 dark:text-indigo-400 hover:underline"
                                    >
                                        {{ sale.client.name }}
                                    </Link>
                                </div>

                                <div class="mt-1">
                                    <p class="text-sm text-gray-500 dark:text-gray-400">CPF</p>
                                    <p class="text-base font-medium text-gray-800 dark:text-gray-200">{{ sale.client.cpf }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Dados da venda (ocupa 2 colunas) -->
                    <div class="md:col-span-2">
                        <SaleSummary :sale="sale" />
                    </div>

                </div>

                <!-- Parcelas -->
                <InstallmentsTable :installments="sale.installments" />
            </div>
        </div>
    </AppLayout>
</template>

<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { DocumentIcon } from '@heroicons/vue/24/outline'

import Tooltip from '@/Components/Tooltip.vue'

const props = defineProps({
    client: Object,
    prescriptions: Array,
})
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Detalhes do Cliente
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-5">
                    <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
                        <!-- Painel do Cliente (20%) -->
                        <div class="md:col-span-1">
                            <div class="p-4 bg-gray-100 dark:bg-gray-700 rounded shadow text-sm text-gray-800 dark:text-gray-200">
                                <h3 class="font-semibold text-lg mb-2">{{ client.name }}</h3>
                                <p><strong>Nome:</strong> {{ client.name }}</p>
                                <p><strong>CPF:</strong> {{ client.cpf }}</p>
                                <p><strong>Telefone:</strong> {{ client.phone }}</p>
                            </div>
                        </div>

                        <!-- Painel de PDFs (80%) -->
                        <div class="md:col-span-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                <a
                                    v-for="prescription in prescriptions"
                                    :key="prescription.id"
                                    :href="`/storage/${prescription.image_path}`"
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    class="flex flex-col items-center p-4 bg-gray-50 dark:bg-gray-700 rounded hover:shadow-md cursor-pointer transition"
                                >
                                    <Tooltip :content="prescription.notes">
                                        <DocumentIcon class="w-10 h-10 text-red-600 dark:text-red-400 mb-2" />
                                        <p class="text-xs text-center text-gray-700 dark:text-gray-200 truncate w-full">
                                            {{ prescription.issued_at }}
                                        </p>
                                    </Tooltip>
                                </a>

                                <div v-if="!prescriptions || prescriptions.length === 0" class="col-span-full text-gray-500 dark:text-gray-400 text-center">
                                    Nenhum documento encontrado.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

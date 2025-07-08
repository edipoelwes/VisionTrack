<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { DocumentIcon } from '@heroicons/vue/24/outline'

import Tooltip from '@/Components/Tooltip.vue'
import {router} from "@inertiajs/vue3";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import Modal from "@/Components/Modal.vue";
import AddPrescriptionForm from "@/Pages/Client/Partials/AddPrescriptionForm.vue";
import {ref} from "vue";

const props = defineProps({
    client: Object,
    prescriptions: Array,
})

const showPrescriptionModal = ref(false)

function openPrescriptionModal() {
    showPrescriptionModal.value = true
}

function closePrescriptionModal() {
    showPrescriptionModal.value = false
}

function removePrescription(id) {
    if (confirm('Tem certeza que deseja deletar esta receita?')) {
        router.delete(route('prescriptions.destroy', id))
    }
}
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
                <div class="mb-4 flex justify-end">
                    <PrimaryButton type="button" @click="openPrescriptionModal">Nova Receita</PrimaryButton>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-5">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <!-- Painel do Cliente (20%) -->
                        <div class="md:col-span-1">
                            <div class="p-6 bg-white dark:bg-gray-800 rounded-lg shadow text-sm text-gray-800 dark:text-gray-100">
                                <!-- Avatar + Nome -->
                                <div class="flex items-center space-x-4 mb-4">
                                    <div
                                        class="w-12 h-12 rounded-full bg-indigo-600 text-white flex items-center justify-center text-lg font-bold uppercase shadow-md"
                                    >
                                        {{ client.name.charAt(0) }}
                                    </div>
                                    <div>
                                        <h3 class="text-xl font-semibold">{{ client.name }}</h3>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Cliente registrado</p>
                                    </div>
                                </div>

                                <!-- Dados Pessoais -->
                                <ul class="space-y-1 text-sm">
                                    <li><strong>CPF:</strong> {{ client.cpf }}</li>
                                    <li><strong>Telefone:</strong> {{ client.phone }}</li>
                                    <li><strong>Email:</strong> {{ client.email || 'Não informado' }}</li>
                                </ul>

                                <!-- Endereços -->
                                <div v-if="client.addresses && client.addresses.length" class="mt-4">
                                    <h4 class="font-semibold text-sm mb-2 text-gray-700 dark:text-gray-300">Endereços</h4>
                                    <ul class="space-y-2 text-sm">
                                        <li
                                            v-for="(address, index) in client.addresses"
                                            :key="index"
                                            class="border-l-4 pl-2 border-indigo-500 dark:border-indigo-400"
                                        >
                                            <span class="block font-medium text-gray-800 dark:text-gray-100">{{ address.type }}</span>
                                            <span class="text-gray-600 dark:text-gray-300">
                                                {{ address.street }}, {{ address.number }}
                                                <span v-if="address.complement"> - {{ address.complement }}</span>,
                                                {{ address.neighborhood }}, {{ address.city }} - {{ address.state }}<br>
                                                {{ address.zip_code }}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Painel de PDFs (80%) -->
                        <div class="md:col-span-3">
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                                <div
                                    v-for="(prescription) in prescriptions"
                                    :key="prescription.id"
                                    class="relative flex flex-col items-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg hover:shadow-lg cursor-pointer transition group"
                                >
                                    <!-- Botão remover -->
                                    <button
                                        @click.prevent="removePrescription(prescription.id)"
                                        class="absolute top-1 right-1 text-gray-400 hover:text-red-500 dark:hover:text-red-400 focus:outline-none"
                                        aria-label="Remover receita"
                                        title="Remover receita"
                                    >
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>

                                    <a
                                        :href="`/storage/${prescription.image_path}`"
                                        target="_blank"
                                        rel="noopener noreferrer"
                                        class="flex flex-col items-center w-full"
                                        @click.stop
                                    >
                                        <Tooltip :content="prescription.notes">
                                            <DocumentIcon class="w-14 h-14 text-red-600 dark:text-red-400 mb-1" />
                                        </Tooltip>
                                        <p
                                            class="text-xs text-center text-gray-700 dark:text-gray-200 truncate w-full"
                                            :title="prescription.issued_at"
                                        >
                                            {{ prescription.issued_at }}
                                        </p>
                                    </a>
                                </div>

                                <div
                                    v-if="!prescriptions || prescriptions.length === 0"
                                    class="col-span-full text-gray-500 dark:text-gray-400 text-center py-8"
                                >
                                    Nenhum documento encontrado.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
    <Modal :show="showPrescriptionModal" max-width="2xl" @close="closePrescriptionModal">
        <AddPrescriptionForm :client-id="client.id" @submitted="closePrescriptionModal" @close="closePrescriptionModal"/>
    </Modal>
</template>

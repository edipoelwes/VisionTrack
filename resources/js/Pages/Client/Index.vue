<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import Modal from '@/Components/Modal.vue';
import AddPrescriptionForm from './Partials/AddPrescriptionForm.vue';

import {ref, watch} from "vue";
import {Link, router} from '@inertiajs/vue3';
import debounce from 'lodash/debounce';

import {
    ClipboardDocumentIcon,
    EllipsisVerticalIcon,
    PencilSquareIcon,
    TrashIcon,
    EyeIcon
} from '@heroicons/vue/24/solid'
import {Menu, MenuButton, MenuItem, MenuItems} from '@headlessui/vue'
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SelectInput from "@/Components/SelectInput.vue";
import Pagination from "@/Components/Pagination.vue";

const props = defineProps({
    clients: Object,
    perPage: Number,
})

const search = ref(props.clients.meta?.search || '')
const selectedPerPage = ref(props.perPage)

const showPrescriptionModal = ref(false)
const selectedClientId = ref(null)

function openPrescriptionModal(client) {
    selectedClientId.value = client.id
    showPrescriptionModal.value = true
}

function closePrescriptionModal() {
    showPrescriptionModal.value = false
    selectedClientId.value = null
}

function deleteClient(client) {
    if (confirm('Tem certeza que deseja deletar este cliente?')) {
        router.delete(route('clients.destroy', client.id))
    }
}

const applySearch = debounce((value) => {
    router.get(route('clients.index'), {
        search: value,
        per_page: selectedPerPage.value,
    }, {
        preserveState: true,
        replace: true,
    })
}, 500)

watch(selectedPerPage, (value) => {
    router.get(route('clients.index'), { per_page: value }, { preserveState: true })
})

watch(search, (value) => applySearch(value))
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Clientes
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-5">
                        <div class="mb-4 flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                            <input
                                v-model="search"
                                type="text"
                                placeholder="Buscar por nome ou CPF"
                                class="w-full md:w-1/3 rounded border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring focus:ring-indigo-300 text-sm px-3 py-2"
                            />

                            <PrimaryButton :href="route('clients.create')" type="button">Novo Cliente</PrimaryButton>
                        </div>
                        <div class="overflow-x-auto border border-gray-200 dark:border-gray-700 rounded shadow bg-white dark:bg-gray-800">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-xs">
                                <tr>
                                    <th class="px-6 py-3 text-left">Name</th>
                                    <th class="px-6 py-3 text-left">Cpf</th>
                                    <th class="px-6 py-3 text-left">Contato</th>
                                    <th class="px-6 py-3 text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                <tr
                                    v-for="client in clients.data"
                                    :key="client.id"
                                    class="hover:bg-gray-50 dark:hover:bg-gray-700"
                                >
                                    <td class="px-6 py-4 text-gray-800 dark:text-gray-100 whitespace-nowrap">
                                        <Link :href="route('clients.show', { client: client.id })">
                                            {{ client.name }}
                                        </Link>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300 whitespace-nowrap">
                                        {{ client.cpf }}
                                    </td>
                                    <td class="px-6 py-4">
                                      <span
                                          class="inline-block px-2 py-1 text-xs font-medium rounded-full bg-indigo-100 text-indigo-700 dark:bg-indigo-700 dark:text-indigo-100"
                                      >
                                        {{ client.phone }}
                                      </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <Menu as="div" class="relative inline-block text-left">
                                            <MenuButton
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none"
                                            >
                                                <EllipsisVerticalIcon class="w-5 h-5 text-gray-700 dark:text-gray-300" />
                                            </MenuButton>

                                            <MenuItems
                                                class="absolute right-0 z-10 mt-2 w-36 origin-top-right rounded-md bg-white dark:bg-gray-700 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                            >
                                                <MenuItem v-slot="{ active }">
                                                    <button
                                                        @click="router.get(route('clients.show', { client: client.id }))"
                                                        :class="[
                                                            'group flex items-center w-full px-4 py-2 text-sm',
                                                            active
                                                              ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-600 dark:text-white'
                                                              : 'text-gray-700 dark:text-gray-200',
                                                          ]"
                                                    >
                                                        <EyeIcon class="w-4 h-4 mr-2" />
                                                        Detalhes
                                                    </button>
                                                </MenuItem>
                                                <MenuItem v-slot="{ active }">
                                                    <button
                                                        @click="openPrescriptionModal(client)"
                                                        :class="[
                                                            'group flex items-center w-full px-4 py-2 text-sm',
                                                            active
                                                              ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-600 dark:text-white'
                                                              : 'text-gray-700 dark:text-gray-200',
                                                          ]"
                                                    >
                                                        <ClipboardDocumentIcon class="w-4 h-4 mr-2" />
                                                        Nova Receita
                                                    </button>
                                                </MenuItem>
                                                <MenuItem v-slot="{ active }">
                                                    <button
                                                        @click="() => router.get(route('clients.edit', { client: client.id }))"
                                                        :class="[
                                                            'group flex items-center w-full px-4 py-2 text-sm',
                                                            active
                                                              ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-600 dark:text-white'
                                                              : 'text-gray-700 dark:text-gray-200',
                                                          ]"
                                                    >
                                                        <PencilSquareIcon class="w-4 h-4 mr-2" />
                                                        Editar
                                                    </button>
                                                </MenuItem>

                                                <MenuItem v-slot="{ active }">
                                                    <button
                                                        @click="deleteClient(client)"
                                                        :class="[
                                                            'group flex items-center w-full px-4 py-2 text-sm',
                                                            active
                                                              ? 'bg-red-100 text-red-700 dark:bg-red-600 dark:text-white'
                                                              : 'text-red-600 dark:text-red-400',
                                                          ]"
                                                    >
                                                        <TrashIcon class="w-4 h-4 mr-2" />
                                                        Delete
                                                    </button>
                                                </MenuItem>
                                            </MenuItems>
                                        </Menu>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <SelectInput
                                v-model="selectedPerPage"
                                :options="[
                                    { value: 5, label: '5' },
                                    { value: 10, label: '10' },
                                    { value: 15, label: '15' },
                                    { value: 20, label: '20' },
                                    { value: 25, label: '25' },
                                ]"
                                class="w-full md:w-auto"
                            />
                            <Pagination :links="clients.links" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
    <Modal :show="showPrescriptionModal" max-width="2xl" @close="closePrescriptionModal">
        <AddPrescriptionForm :client-id="selectedClientId" @submitted="closePrescriptionModal" @close="closePrescriptionModal"/>
    </Modal>
</template>

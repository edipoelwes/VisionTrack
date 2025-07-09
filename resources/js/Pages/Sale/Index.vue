<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Vendas
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-5">
                        <div class="mb-4 flex flex-col md:flex-row md:items-end md:justify-between gap-4">
                            <!-- Campo de busca e data -->
                            <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
                                <!-- Buscar por nome ou CPF -->
                                <div class="flex flex-col w-full sm:w-80 md:w-96">
                                    <label for="search" class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Buscar por Nome ou CPF
                                    </label>
                                    <input
                                        id="search"
                                        v-model="search"
                                        type="text"
                                        placeholder="Digite o nome ou CPF"
                                        class="w-full rounded border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring focus:ring-indigo-300 text-sm px-4 py-2"
                                    />
                                </div>

                                <!-- Data da venda -->
                                <div class="flex flex-col w-full sm:w-44">
                                    <label for="searchDate" class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Data da Venda
                                    </label>
                                    <input
                                        id="searchDate"
                                        v-model="searchDate"
                                        type="date"
                                        class="w-full rounded border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-white focus:ring focus:ring-indigo-300 text-sm px-4 py-2"
                                    />
                                </div>
                            </div>

                            <!-- Botão -->
                            <div>
                                <PrimaryButton @click="showSaleModal = true" type="button">
                                    Nova Venda
                                </PrimaryButton>
                            </div>
                        </div>
                        <div class="overflow-x-auto border border-gray-200 dark:border-gray-700 rounded shadow bg-white dark:bg-gray-800">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-xs">
                                <tr>
                                    <th class="px-6 py-3 text-left">Cliente</th>
                                    <th class="px-6 py-3 text-left">Data da Venda</th>
                                    <th class="px-6 py-3 text-left">Tipo Pagamento</th>
                                    <th class="px-6 py-3 text-left">Total</th>
                                    <th class="px-6 py-3 text-left">Parcelas</th>
                                    <th class="px-6 py-3 text-right">Ações</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                <tr
                                    v-for="sale in sales.data"
                                    :key="sale.id"
                                    class="hover:bg-gray-50 dark:hover:bg-gray-700"
                                >
                                    <td class="px-6 py-4 text-gray-800 dark:text-gray-100 whitespace-nowrap">
                                        <Link :href="route('clients.show', {  client: sale.client.id  })" class="flex items-center gap-3 group">
                                            <!-- Avatar -->
                                            <div class="flex-shrink-0">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-indigo-600 text-white flex items-center justify-center text-sm font-bold uppercase group-hover:scale-105 transition-transform"
                                                >
                                                    {{ sale.client.name.charAt(0) }}
                                                </div>
                                            </div>
                                            <div>
                                                <div class="text-sm font-semibold text-gray-900 dark:text-white leading-tight">
                                                    {{ sale.client.name }}
                                                </div>
                                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                                    CPF: {{ sale.client.cpf }}
                                                </div>
                                            </div>
                                        </Link>
                                    </td>
                                    <td class="px-4 py-2 text-gray-600 dark:text-gray-300">
                                        {{ formatDateBR(sale.sold_at) }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300 whitespace-nowrap">
                                        <div class="flex items-center gap-2">
                                            <BanknotesIcon
                                                v-if="sale.payment_type === 'cash'"
                                                class="w-5 h-5 text-green-600 dark:text-green-400"
                                            />
                                            <CreditCardIcon
                                                v-else
                                                class="w-5 h-5 text-blue-600 dark:text-blue-400"
                                            />
                                            <span>
                                                {{ sale.payment_type === 'cash' ? 'À vista' : 'Parcelado' }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300 whitespace-nowrap">
                                        {{ formatCurrencyBR(sale.total) }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <Link :href="route('sales.show', {  sale: sale.id  })" class="block">
                                            <div v-if="sale.installments_count"
                                                 class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-800 dark:text-yellow-200">
                                                {{ sale.installments_count }}x
                                            </div>
                                            <div v-else
                                                 class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-gray-200 text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                                                —
                                            </div>
                                        </Link>
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
                                                        @click="router.get(route('sales.show', { sale: sale.id }))"
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
                            <Pagination :links="sales.links" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
    <ModalSale
        :show="showSaleModal"
        :clients="clients"
        @close="showSaleModal = false"
        @submitted="showSaleModal = false"
    />
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import ModalSale from './Partials/ModalSale.vue';

import {ref, watch} from "vue";
import {Link, router} from '@inertiajs/vue3';
import debounce from 'lodash/debounce';

import {
    EllipsisVerticalIcon,
    EyeIcon,
    CreditCardIcon,
    BanknotesIcon,
} from '@heroicons/vue/24/solid'
import {Menu, MenuButton, MenuItem, MenuItems} from '@headlessui/vue'
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SelectInput from "@/Components/SelectInput.vue";
import Pagination from "@/Components/Pagination.vue";
import {formatDateBR, formatCurrencyBR} from "@/Utils/formatters.js";

const props = defineProps({
    sales: Object,
    clients: Array,
    perPage: Number,
})

const showSaleModal = ref(false)
const search = ref(props.sales.meta?.search || '')
const searchDate = ref('')
const selectedPerPage = ref(props.perPage)

const applySearch = debounce(() => {
    router.get(route('sales.index'), {
        search: search.value,
        date: searchDate.value,
        per_page: selectedPerPage.value,
    }, {
        preserveState: true,
        replace: true,
    })
}, 500)

watch(selectedPerPage, (value) => {
    router.get(route('sales.index'), { per_page: value }, { preserveState: true })
})

watch([search, searchDate], applySearch)
</script>

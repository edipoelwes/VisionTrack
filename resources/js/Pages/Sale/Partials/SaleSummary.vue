<script setup>
import { CreditCardIcon, BanknotesIcon } from '@heroicons/vue/24/solid'

const props = defineProps({
    sale: Object,
})
</script>

<template>
    <div class="bg-white dark:bg-gray-800 shadow rounded p-6 space-y-4">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-2">
                <component
                    :is="sale.payment_type === 'cash' ? BanknotesIcon : CreditCardIcon"
                    class="w-6 h-6"
                    :class="sale.payment_type === 'cash' ? 'text-green-600 dark:text-green-400' : 'text-blue-600 dark:text-blue-400'"
                />
                <span class="text-sm text-gray-700 dark:text-gray-300">
                    {{ sale.payment_type === 'cash' ? 'À vista' : 'Parcelado' }}
                </span>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Valor Total</p>
                <p class="text-lg font-semibold text-gray-800 dark:text-white">R$ {{ Number(sale.total).toFixed(2) }}</p>
            </div>
            <div>
                <p class="text-sm text-gray-500 dark:text-gray-400">Data da Venda</p>
                <p class="text-lg font-semibold text-gray-800 dark:text-white">{{ sale.sold_at }}</p>
            </div>
            <div v-if="sale.installments_count">
                <p class="text-sm text-gray-500 dark:text-gray-400">Parcelas</p>
                <p class="text-lg font-semibold text-gray-800 dark:text-white">{{ sale.installments_count }}</p>
            </div>
        </div>
    </div>
</template>

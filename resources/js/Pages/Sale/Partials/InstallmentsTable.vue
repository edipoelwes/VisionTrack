<script setup>
const props = defineProps({
    installments: Array,
})
</script>

<template>
    <div v-if="installments?.length" class="bg-white dark:bg-gray-800 shadow rounded p-6">
        <h3 class="text-lg font-bold mb-4 text-gray-800 dark:text-gray-100">Parcelas</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-100 dark:bg-gray-700">
                <tr class="text-left text-sm font-semibold text-gray-600 dark:text-gray-300">
                    <th class="px-4 py-2">#</th>
                    <th class="px-4 py-2">Valor</th>
                    <th class="px-4 py-2">Vencimento</th>
                    <th class="px-4 py-2">Status</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                <tr v-for="installment in installments" :key="installment.id" class="hover:bg-gray-50 dark:hover:bg-gray-700">
                    <td class="px-4 py-2 text-gray-800 dark:text-white">{{ installment.number }}</td>
                    <td class="px-4 py-2 text-gray-600 dark:text-gray-300">R$ {{ Number(installment.amount).toFixed(2) }}</td>
                    <td class="px-4 py-2 text-gray-600 dark:text-gray-300">{{ installment.due_date }}</td>
                    <td class="px-4 py-2">
                            <span
                                class="px-2 py-1 text-xs rounded font-semibold"
                                :class="installment.paid_at
                                    ? 'bg-green-100 text-green-700 dark:bg-green-700 dark:text-white'
                                    : 'bg-yellow-100 text-yellow-700 dark:bg-yellow-700 dark:text-white'"
                            >
                                {{ installment.paid_at ? 'Pago' : 'Pendente' }}
                            </span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div v-else class="text-center text-gray-500 dark:text-gray-400 italic">
        Nenhuma parcela registrada.
    </div>
</template>

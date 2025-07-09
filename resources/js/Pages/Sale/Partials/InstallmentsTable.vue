<script setup>
import { ref } from 'vue'
import { formatDateBR, formatCurrencyBR } from '@/Utils/formatters'
import { useForm } from '@inertiajs/vue3'
import Modal from '@/Components/Modal.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { CurrencyDollarIcon } from '@heroicons/vue/24/solid'

const props = defineProps({
    installments: Array,
})

const showModal = ref(false)
const selectedInstallment = ref(null)

const form = useForm({
    paid_at: new Date().toISOString().slice(0, 10),
})

function openPaymentModal(installment) {
    selectedInstallment.value = installment
    form.paid_at = new Date().toISOString().slice(0, 10)
    showModal.value = true
}

function submitPayment() {
    if (!selectedInstallment.value) return
    form.put(route('installments.pay', { installment: selectedInstallment.value.id }), {
        onSuccess: () => {
            showModal.value = false
        },
    })
}
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
                    <th class="px-4 py-2">Data de Pagamento</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Ações</th>
                </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                <tr
                    v-for="installment in installments"
                    :key="installment.id"
                    class="hover:bg-gray-50 dark:hover:bg-gray-700"
                >
                    <td class="px-4 py-2 text-gray-800 dark:text-white">{{ installment.number }}</td>
                    <td class="px-4 py-2 text-gray-600 dark:text-gray-300">
                        {{ formatCurrencyBR(installment.amount) }}
                    </td>
                    <td class="px-4 py-2 text-gray-600 dark:text-gray-300">
                        {{ formatDateBR(installment.due_date) }}
                    </td>
                    <td class="px-4 py-2 text-gray-600 dark:text-gray-300 text-sm">
                        <template v-if="installment.paid_at">
                            {{ formatDateBR(installment.paid_at) }}
                        </template>
                        <template v-else>
                                <span class="inline-flex items-center gap-1 text-gray-400 dark:text-gray-500 italic">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor" />
                                    —
                                </span>
                        </template>
                    </td>
                    <td class="px-4 py-2">
                            <span
                                class="px-2 py-1 text-xs rounded font-semibold"
                                :class="[
                                    installment.paid_at
                                        ? 'bg-green-100 text-green-700 dark:bg-green-700 dark:text-white'
                                        : new Date(installment.due_date) < new Date()
                                            ? 'bg-red-100 text-red-700 dark:bg-red-700 dark:text-white'
                                            : 'bg-yellow-100 text-yellow-700 dark:bg-yellow-700 dark:text-white'
                                ]"
                            >
                                {{
                                    installment.paid_at
                                        ? 'Pago'
                                        : new Date(installment.due_date) < new Date()
                                            ? 'Vencido'
                                            : 'Pendente'
                                }}
                            </span>
                    </td>
                    <td class="px-4 py-2">
                        <button
                            v-if="!installment.paid_at"
                            @click="openPaymentModal(installment)"
                            class="text-green-600 hover:text-green-700 dark:text-green-400 dark:hover:text-white"
                            title="Registrar pagamento"
                        >
                            <CurrencyDollarIcon class="w-6 h-6" />
                        </button>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div v-else class="text-center text-gray-500 dark:text-gray-400 italic">
        Nenhuma parcela registrada.
    </div>

    <!-- Modal de pagamento -->
    <Modal :show="showModal" max-width="sm" @close="showModal = false">
        <form @submit.prevent="submitPayment" class="p-6 space-y-4">
            <h2 class="text-lg font-semibold text-gray-800 dark:text-white">Registrar Pagamento</h2>

            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Data do Pagamento</label>
                <input
                    v-model="form.paid_at"
                    type="date"
                    class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2"
                    required
                />
            </div>

            <div class="flex justify-end gap-2">
                <SecondaryButton type="button" @click="showModal = false">Cancelar</SecondaryButton>
                <PrimaryButton type="submit">Confirmar</PrimaryButton>
            </div>
        </form>
    </Modal>
</template>

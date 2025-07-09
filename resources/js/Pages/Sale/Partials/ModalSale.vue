<script setup>
import { useForm } from '@inertiajs/vue3'
import Modal from '@/Components/Modal.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import SecondaryButton from '@/Components/SecondaryButton.vue'
import FilteredSelect from '@/Components/FilteredSelect.vue'

const props = defineProps({
    clients: Array,
    show: Boolean,
})

const emit = defineEmits(['close', 'submitted'])

const saleForm = useForm({
    client_id: props.clients.length === 1 ? props.clients[0].id : null,
    total: null,
    payment_type: 'cash',
    installments_count: null,
    sold_at: new Date().toISOString().slice(0, 10),
})

function submitSale() {
    saleForm.post(route('sales.store'), {
        onSuccess: () => {
            emit('submitted')
            saleForm.reset()
        },
    })
}
</script>

<template>
    <Modal :show="props.show" @close="emit('close')" max-width="2xl">
        <form @submit.prevent="submitSale" class="p-6 space-y-4">
            <h2 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Nova Venda</h2>

            <!-- Cliente -->
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Cliente</label>
                <FilteredSelect
                    v-model="saleForm.client_id"
                    :options="clients.map(c => ({ value: c.id, label: `${c.name} - ${c.cpf}` }))"
                    placeholder="Selecione um cliente"
                />
            </div>

            <!-- Valor Total & Data da Venda -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <!-- Valor total -->
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Valor Total (R$)</label>
                    <input
                        v-model.lazy="saleForm.total"
                        v-money="{
                          decimal: ',',
                          thousands: '.',
                          prefix: 'R$ ',
                          precision: 2,
                          masked: false
                        }"
                        class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2"
                    />
                </div>

                <!-- Data da venda -->
                <div>
                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Data da Venda</label>
                    <input
                        v-model="saleForm.sold_at"
                        type="date"
                        class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2"
                    />
                </div>
            </div>

            <!-- Tipo de Pagamento -->
            <div>
                <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Tipo de Pagamento</label>
                <select
                    v-model="saleForm.payment_type"
                    class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2"
                >
                    <option value="cash">À vista</option>
                    <option value="installment">Parcelado</option>
                </select>
            </div>

            <!-- Parcelas -->
            <div v-if="saleForm.payment_type === 'installment'">
                <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Quantidade de Parcelas</label>
                <input
                    v-model="saleForm.installments_count"
                    type="number"
                    min="1"
                    max="36"
                    class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2"
                />
            </div>

            <!-- Botões -->
            <div class="flex justify-end gap-2 pt-4">
                <SecondaryButton @click="$emit('close')" type="button">Cancelar</SecondaryButton>
                <PrimaryButton type="submit">Salvar</PrimaryButton>
            </div>
        </form>
    </Modal>
</template>

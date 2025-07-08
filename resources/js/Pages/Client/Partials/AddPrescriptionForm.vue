<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
    clientId: Number,
})
const emit = defineEmits(['submitted', 'close'])

const form = useForm({
    prescription: {
        file: null,
        issued_at: '',
        notes: '',
    }
})

function handleFileChange(e) {
    form.prescription.file = e.target.files[0]
}

function submit() {
    form.post(route('clients.prescriptions.store', props.clientId), {
        forceFormData: true,
        onSuccess: () => {
            emit('submitted')
            form.reset()
        },
    })
}
</script>

<template>
    <form @submit.prevent="submit" class="p-6 space-y-4">
        <h2 class="text-lg font-bold text-gray-800 dark:text-white mb-2">Nova Receita</h2>

        <div>
            <div class="border rounded p-4 mb-4 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input
                        type="file"
                        accept="image/*,.pdf"
                        @change="handleFileChange"
                        class="w-full text-sm text-gray-900 dark:text-gray-100"
                    />
                    <input
                        type="date"
                        v-model="form.prescription.issued_at"
                        class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2"
                    />
                    <textarea
                        v-model="form.prescription.notes"
                        placeholder="Notas da receita"
                        class="col-span-1 md:col-span-2 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2"
                    ></textarea>
                </div>
            </div>
        </div>

        <div class="flex justify-end">
            <button
                type="button"
                @click="emit('close')"
                class="inline-flex mr-2 items-center px-4 py-2 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md font-semibold text-xs text-gray-800 dark:text-white uppercase tracking-widest hover:bg-gray-100 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
            >
                Fechar
            </button>
            <button
                type="submit"
                class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-50 transition ease-in-out duration-150"
                :disabled="form.processing"
            >
                Salvar
            </button>
        </div>
    </form>
</template>

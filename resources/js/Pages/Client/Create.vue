<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm, router } from '@inertiajs/vue3'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'

const form = useForm({
    name: '',
    cpf: '',
    phone: '',
    email: '',
    addresses: [
        {
            type: '',
            street: '',
            city: '',
            state: '',
            zip: '',
        },
    ],
    prescriptions: [],
})

function addAddress() {
    form.addresses.push({
        type: '',
        street: '',
        city: '',
        state: '',
        zip: '',
    });
}
function removeAddress(index) {
    form.addresses.splice(index, 1);
}
function submit() {
    form.post(route('clients.store'), {
        forceFormData: true,
    })
}
</script>

<template>
    <AppLayout title="Novo Cliente">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Novo Cliente</h2>
        </template>

        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                <form @submit.prevent="submit" class="bg-white dark:bg-gray-800 shadow rounded p-6 space-y-8" enctype="multipart/form-data">

                    <!-- Seção: Dados do Cliente -->
                    <div>
                        <h3 class="text-lg font-bold mb-4 text-gray-800 dark:text-gray-100">Informações do Cliente</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <InputLabel for="name" value="Nome" />
                                <TextInput id="name" v-model="form.name" class="mt-1 block w-full" required autofocus />
                            </div>

                            <div>
                                <InputLabel for="cpf" value="CPF" />
                                <TextInput id="cpf" v-model="form.cpf" v-mask="'###.###.###-##'" class="mt-1 block w-full" required />
                            </div>

                            <div>
                                <InputLabel for="phone" value="Telefone" />
                                <TextInput id="phone" v-model="form.phone" v-mask="'(##) #####-####'" class="mt-1 block w-full" />
                            </div>

                            <div>
                                <InputLabel for="email" value="Email" />
                                <TextInput id="email" v-model="form.email" type="email" class="mt-1 block w-full" />
                            </div>
                        </div>
                    </div>

                    <!-- Seção: Endereços -->
                    <div>
                        <h3 class="text-lg font-bold mb-4 text-gray-800 dark:text-gray-100">Endereços</h3>
                        <div v-for="(address, index) in form.addresses" :key="index" class="p-4 mb-4 border rounded dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                            <div class="flex justify-between items-center mb-2">
                                <h4 class="font-semibold text-sm text-gray-700 dark:text-gray-300">Endereço {{ index + 1 }}</h4>
                                <button type="button" @click="removeAddress(index)" class="text-red-600 dark:text-red-400 hover:underline text-sm">Remover</button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input v-model="address.type" placeholder="Tipo (ex: Casa, Trabalho)" class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2" />
                                <input v-model="address.street" placeholder="Rua" class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2" />
                                <input v-model="address.city" placeholder="Cidade" class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2" />
                                <input v-model="address.state" placeholder="Estado" class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2" />
                                <input v-model="address.zip" placeholder="CEP" class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2" />
                            </div>
                        </div>
                        <button type="button" @click="addAddress" class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm">+ Adicionar Endereço</button>
                    </div>

                    <!-- Seção: Upload de Receitas -->
                    <div>
                        <h3 class="text-lg font-bold mb-4 text-gray-800 dark:text-gray-100">Receitas</h3>
                        <input
                            id="prescriptions"
                            type="file"
                            multiple
                            @change="e => form.prescriptions = Array.from(e.target.files)"
                            class="block w-full text-gray-900 dark:text-gray-100 dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded px-3 py-2"
                            accept="image/*,.pdf"
                        />
                        <p class="text-sm mt-1 text-gray-500 dark:text-gray-400">Você pode enviar múltiplas imagens ou PDFs.</p>
                    </div>

                    <!-- Botão Final -->
                    <div class="flex justify-end">
                        <PrimaryButton :disabled="form.processing">Salvar Cliente</PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

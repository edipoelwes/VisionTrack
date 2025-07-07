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
            type: 'residential',
            street: '',
            number: '',
            complement: '',
            neighborhood: '',
            city: '',
            state: '',
            zip: '',
        },
    ],
    prescriptions: [],
})

function addAddress() {
    form.addresses.push({
        type: 'residential',
        street: '',
        number: '',
        complement: '',
        neighborhood: '',
        city: '',
        state: '',
        zip: '',
    });
}
function removeAddress(index) {
    form.addresses.splice(index, 1);
}

function addPrescription() {
    form.prescriptions.push({
        file: null,
        issued_at: '',
        notes: '',
    })
}

function removePrescription(index) {
    form.prescriptions.splice(index, 1)
}

function handleFileChange(e, index) {
    form.prescriptions[index].file = e.target.files[0]
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

                    <!-- Dados Pessoais -->
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

                    <!-- Endereços -->
                    <div>
                        <h3 class="text-lg font-bold mb-4 text-gray-800 dark:text-gray-100">Endereços</h3>
                        <div
                            v-for="(address, index) in form.addresses"
                            :key="index"
                            class="p-4 mb-4 border rounded dark:border-gray-700 bg-gray-50 dark:bg-gray-900"
                        >
                            <div class="flex justify-between items-center mb-2">
                                <h4 class="font-semibold text-sm text-gray-700 dark:text-gray-300">Endereço {{ index + 1 }}</h4>
                                <button type="button" @click="removeAddress(index)" class="text-red-600 dark:text-red-400 hover:underline text-sm">
                                    Remover
                                </button>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                                <!-- Tipo -->
                                <div class="md:col-span-2">
                                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Tipo</label>
                                    <select
                                        v-model="address.type"
                                        class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2"
                                    >
                                        <option value="residential">Residencial</option>
                                        <option value="commercial">Comercial</option>
                                    </select>
                                </div>

                                <!-- Rua -->
                                <div class="md:col-span-4">
                                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Rua</label>
                                    <input
                                        v-model="address.street"
                                        placeholder="Rua"
                                        class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2"
                                    />
                                </div>

                                <!-- Número -->
                                <div class="md:col-span-2">
                                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Número</label>
                                    <input
                                        v-model="address.number"
                                        placeholder="Número"
                                        class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2"
                                    />
                                </div>

                                <!-- Complemento -->
                                <div class="md:col-span-4">
                                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Complemento</label>
                                    <input
                                        v-model="address.complement"
                                        placeholder="Complemento"
                                        class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2"
                                    />
                                </div>

                                <!-- Bairro -->
                                <div class="md:col-span-3">
                                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Bairro</label>
                                    <input
                                        v-model="address.neighborhood"
                                        placeholder="Bairro"
                                        class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2"
                                    />
                                </div>

                                <!-- Cidade -->
                                <div class="md:col-span-3">
                                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Cidade</label>
                                    <input
                                        v-model="address.city"
                                        placeholder="Cidade"
                                        class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2"
                                    />
                                </div>

                                <!-- Estado -->
                                <div class="md:col-span-2">
                                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Estado</label>
                                    <input
                                        v-model="address.state"
                                        placeholder="UF"
                                        maxlength="2"
                                        class="w-full uppercase rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2"
                                    />
                                </div>

                                <!-- CEP -->
                                <div class="md:col-span-4">
                                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">CEP</label>
                                    <input
                                        v-model="address.zip_code"
                                        placeholder="CEP"
                                        v-mask="'#####-###'"
                                        class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2"
                                    />
                                </div>
                            </div>
                        </div>

                        <button
                            type="button"
                            @click="addAddress"
                            class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm"
                        >
                            + Adicionar Endereço
                        </button>
                    </div>

                    <!-- Receitas -->
                    <div>
                        <h3 class="text-lg font-bold mb-4 text-gray-800 dark:text-gray-100">Receitas</h3>
                        <div v-for="(prescription, index) in form.prescriptions" :key="index" class="border rounded p-4 mb-4 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                            <div class="flex justify-between items-center mb-2">
                                <h4 class="text-sm font-medium text-gray-800 dark:text-gray-200">Receita {{ index + 1 }}</h4>
                                <button type="button" @click="removePrescription(index)" class="text-red-500 hover:underline text-sm">Remover</button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="file" accept="image/*,.pdf" @change="e => handleFileChange(e, index)" class="w-full text-sm text-gray-900 dark:text-gray-100" />
                                <input type="date" v-model="prescription.issued_at" class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2" />
                                <textarea
                                    v-model="prescription.notes"
                                    placeholder="Notas da receita"
                                    class="col-span-1 md:col-span-2 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2"
                                ></textarea>
                            </div>
                        </div>
                        <button type="button" @click="addPrescription" class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm">+ Adicionar Receita</button>
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

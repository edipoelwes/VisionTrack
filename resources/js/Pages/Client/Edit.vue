<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { useForm } from '@inertiajs/vue3'
import InputLabel from '@/Components/InputLabel.vue'
import TextInput from '@/Components/TextInput.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'

const props = defineProps({
    client: Object,
})

const form = useForm({
    name: props.client.name,
    cpf: props.client.cpf,
    phone: props.client.phone,
    email: props.client.email,
    addresses: props.client.addresses || [],
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
        zip_code: '',
    });
}

function removeAddress(index) {
    form.addresses.splice(index, 1);
}

function submit() {
    form.put(route('clients.update', { client: props.client.id }), {
        onSuccess: () => {
            form.reset();
        },
    });
}
</script>

<template>
    <AppLayout :title="`Editar Cliente: ${client.name}`">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Editar Cliente</h2>
        </template>

        <div class="py-12">
            <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
                <form @submit.prevent="submit" class="bg-white dark:bg-gray-800 shadow rounded p-6 space-y-8" enctype="multipart/form-data">

                    <!-- Informacoes Pessoais -->
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

                    <!-- Enderecos -->
                    <div>
                        <h3 class="text-lg font-bold mb-4 text-gray-800 dark:text-gray-100">Endereços</h3>
                        <div v-for="(address, index) in form.addresses" :key="index" class="p-4 mb-4 border rounded dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                            <div class="flex justify-between items-center mb-2">
                                <h4 class="font-semibold text-sm text-gray-700 dark:text-gray-300">Endereço {{ index + 1 }}</h4>
                                <button type="button" @click="removeAddress(index)" class="text-red-600 dark:text-red-400 hover:underline text-sm">Remover</button>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-6 gap-4">
                                <div class="md:col-span-2">
                                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Tipo</label>
                                    <select v-model="address.type" class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2">
                                        <option value="residential">Residencial</option>
                                        <option value="commercial">Comercial</option>
                                    </select>
                                </div>
                                <div class="md:col-span-4">
                                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Rua</label>
                                    <input v-model="address.street" placeholder="Rua" class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2" />
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Número</label>
                                    <input v-model="address.number" placeholder="Número" class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2" />
                                </div>
                                <div class="md:col-span-4">
                                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Complemento</label>
                                    <input v-model="address.complement" placeholder="Complemento" class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2" />
                                </div>
                                <div class="md:col-span-3">
                                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Bairro</label>
                                    <input v-model="address.neighborhood" placeholder="Bairro" class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2" />
                                </div>
                                <div class="md:col-span-3">
                                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Cidade</label>
                                    <input v-model="address.city" placeholder="Cidade" class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2" />
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">Estado</label>
                                    <input v-model="address.state" maxlength="2" placeholder="UF" class="w-full uppercase rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2" />
                                </div>
                                <div class="md:col-span-4">
                                    <label class="block mb-1 text-sm font-medium text-gray-700 dark:text-gray-300">CEP</label>
                                    <input v-model="address.zip_code" placeholder="CEP" v-mask="'#####-###'" class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2" />
                                </div>
                            </div>
                        </div>
                        <button type="button" @click="addAddress" class="text-indigo-600 dark:text-indigo-400 hover:underline text-sm">
                            + Adicionar Endereço
                        </button>
                    </div>

                    <!-- Botao -->
                    <div class="flex justify-end">
                        <PrimaryButton :disabled="form.processing">Salvar Alterações</PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

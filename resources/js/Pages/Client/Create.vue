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
            <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                <form @submit.prevent="submit" class="bg-white dark:bg-gray-800 shadow rounded p-6 space-y-4">
                    <div>
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
                            <TextInput id="email" v-model="form.email" class="mt-1 block w-full" type="email" />
                        </div>
                    </div>



                    <div>
                        <label class="block font-semibold mb-2 dark:text-gray-200">Addresses</label>

                        <div v-for="(address, index) in form.addresses" :key="index" class="mb-4 p-3 border rounded dark:border-gray-700">
                            <div class="flex justify-between items-center mb-2">
                                <h4 class="font-semibold dark:text-gray-300">Address {{ index + 1 }}</h4>
                                <button type="button" @click="removeAddress(index)" class="text-red-600 dark:text-red-400 hover:underline">Remove</button>
                            </div>

                            <input
                                v-model="address.type"
                                placeholder="Type (e.g., Home, Work)"
                                class="w-full mb-2 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white px-3 py-2"
                            />
                            <input
                                v-model="address.street"
                                placeholder="Street"
                                class="w-full mb-2 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white px-3 py-2"
                            />
                            <input
                                v-model="address.city"
                                placeholder="City"
                                class="w-full mb-2 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white px-3 py-2"
                            />
                            <input
                                v-model="address.state"
                                placeholder="State"
                                class="w-full mb-2 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white px-3 py-2"
                            />
                            <input
                                v-model="address.zip"
                                placeholder="ZIP"
                                class="w-full mb-2 rounded border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-white px-3 py-2"
                            />
                        </div>

                        <button type="button" @click="addAddress" class="text-indigo-600 dark:text-indigo-400 hover:underline">Add Address</button>
                    </div>

                    <!-- Upload múltiplo de receitas -->
                    <div>
                        <label class="block font-semibold mb-2 dark:text-gray-200" for="prescriptions">Upload Prescriptions (Receitas)</label>
                        <input
                            id="prescriptions"
                            type="file"
                            multiple
                            @change="e => form.prescriptions = Array.from(e.target.files)"
                            class="block w-full text-gray-900 dark:text-gray-100"
                            accept="image/*,.pdf"
                        />
                    </div>

                    <div class="flex mt-4 justify-end">
                        <PrimaryButton :disabled="form.processing">Salvar</PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

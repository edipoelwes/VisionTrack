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
})

function submit() {
    form.post(route('clients.store'))
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

                    <div class="flex mt-4 justify-end">
                        <PrimaryButton :disabled="form.processing">Salvar</PrimaryButton>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

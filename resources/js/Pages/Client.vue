<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

import {
    EllipsisVerticalIcon,
    PencilSquareIcon,
    TrashIcon,
} from '@heroicons/vue/24/solid'
import {Menu, MenuButton, MenuItem, MenuItems} from '@headlessui/vue'

defineProps({ clients: Object })

function editUser(user) {
    alert(`Editing ${user.name}`)
}

function deleteUser(user) {
    if (confirm(`Delete ${user.name}?`)) {
        alert(`Deleted ${user.name}`)
    }
}
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Clientes
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="p-6">
                        <div class="overflow-x-auto border border-gray-200 dark:border-gray-700 rounded shadow bg-white dark:bg-gray-800">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <thead class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 uppercase text-xs">
                                <tr>
                                    <th class="px-6 py-3 text-left">Name</th>
                                    <th class="px-6 py-3 text-left">Cpf</th>
                                    <th class="px-6 py-3 text-left">Contato</th>
                                    <th class="px-6 py-3 text-right">Actions</th>
                                </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                <tr
                                    v-for="client in clients.data"
                                    :key="client.id"
                                    class="hover:bg-gray-50 dark:hover:bg-gray-700"
                                >
                                    <td class="px-6 py-4 text-gray-800 dark:text-gray-100 whitespace-nowrap">
                                        {{ client.name }}
                                    </td>
                                    <td class="px-6 py-4 text-gray-600 dark:text-gray-300 whitespace-nowrap">
                                        {{ client.cpf }}
                                    </td>
                                    <td class="px-6 py-4">
                                      <span
                                          class="inline-block px-2 py-1 text-xs font-medium rounded-full bg-indigo-100 text-indigo-700 dark:bg-indigo-700 dark:text-indigo-100"
                                      >
                                        {{ client.phone }}
                                      </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <Menu as="div" class="relative inline-block text-left">
                                            <MenuButton
                                                class="inline-flex items-center justify-center w-8 h-8 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none"
                                            >
                                                <EllipsisVerticalIcon class="w-5 h-5 text-gray-700 dark:text-gray-300" />
                                            </MenuButton>

                                            <MenuItems
                                                class="absolute right-0 z-10 mt-2 w-36 origin-top-right rounded-md bg-white dark:bg-gray-700 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none"
                                            >
                                                <MenuItem v-slot="{ active }">
                                                    <button
                                                        @click="editUser(client)"
                                                        :class="[
                                                            'group flex items-center w-full px-4 py-2 text-sm',
                                                            active
                                                              ? 'bg-indigo-100 text-indigo-700 dark:bg-indigo-600 dark:text-white'
                                                              : 'text-gray-700 dark:text-gray-200',
                                                          ]"
                                                    >
                                                        <PencilSquareIcon class="w-4 h-4 mr-2" />
                                                        Edit
                                                    </button>
                                                </MenuItem>

                                                <MenuItem v-slot="{ active }">
                                                    <button
                                                        @click="deleteUser(client)"
                                                        :class="[
                                                            'group flex items-center w-full px-4 py-2 text-sm',
                                                            active
                                                              ? 'bg-red-100 text-red-700 dark:bg-red-600 dark:text-white'
                                                              : 'text-red-600 dark:text-red-400',
                                                          ]"
                                                    >
                                                        <TrashIcon class="w-4 h-4 mr-2" />
                                                        Delete
                                                    </button>
                                                </MenuItem>
                                            </MenuItems>
                                        </Menu>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

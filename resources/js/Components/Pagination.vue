<script setup>
import { Link } from '@inertiajs/vue3'
import { ArrowLeftIcon, ArrowRightIcon } from '@heroicons/vue/20/solid'

defineProps({
    links: Array,
})
</script>

<template>
    <div class="flex justify-between items-center mt-4 flex-wrap gap-2">
        <!-- Previous -->
        <div>
            <Link
                v-if="links[0].url"
                :href="links[0].url"
                class="flex items-center gap-1 text-sm px-3 py-1 rounded border transition
               border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700
               text-gray-800 dark:text-gray-200"
            >
                <ArrowLeftIcon class="w-4 h-4" />
                Previous
            </Link>
        </div>

        <!-- Page Links -->
        <div class="flex flex-wrap justify-center gap-1">
            <template v-for="(link, index) in links.slice(1, -1)" :key="index">
                <component
                    :is="link.url ? Link : 'span'"
                    :href="link.url"
                    v-html="link.label"
                    class="px-3 py-1 text-sm border rounded transition"
                    :class="{
                        'bg-indigo-600 text-white border-indigo-600': link.active,
                        'text-gray-500 dark:text-gray-300': !link.active && !link.url,
                        'hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200 border-gray-300 dark:border-gray-600':
                          link.url && !link.active,
                      }"
                />
            </template>
        </div>

        <!-- Next -->
        <div>
            <Link
                v-if="links[links.length - 1].url"
                :href="links[links.length - 1].url"
                class="flex items-center gap-1 text-sm px-3 py-1 rounded border transition
               border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700
               text-gray-800 dark:text-gray-200"
            >
                Next
                <ArrowRightIcon class="w-4 h-4" />
            </Link>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import { SunIcon, MoonIcon } from '@heroicons/vue/24/solid'

const isDark = ref(false)

onMounted(() => {
    isDark.value = localStorage.theme === 'dark' || (
        !('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches
    )
    updateTheme()
})

function toggleTheme() {
    isDark.value = !isDark.value
    updateTheme()
}

function updateTheme() {
    const root = document.documentElement
    if (isDark.value) {
        root.classList.add('dark')
        localStorage.theme = 'dark'
    } else {
        root.classList.remove('dark')
        localStorage.theme = 'light'
    }
}
</script>

<template>
    <button
        @click="toggleTheme"
        class="text-sm px-3 py-2 rounded bg-gray-200 dark:bg-gray-700 dark:text-white"
        title="Toggle theme"
    >
        <component
            :is="isDark ? SunIcon : MoonIcon"
            :class="[
                'w-5 h-5 transition-colors',
                isDark ? 'text-yellow-400' : 'text-blue-600'
              ]"
        />
    </button>
</template>

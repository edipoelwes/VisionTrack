<script setup>
import { ref, computed, watch } from 'vue'

const props = defineProps({
    modelValue: [String, Number, null],
    options: {
        type: Array,
        default: () => [],
    },
    placeholder: {
        type: String,
        default: 'Selecione...',
    },
})

const emit = defineEmits(['update:modelValue'])

const search = ref('')
const showDropdown = ref(false)
const selectedLabel = ref('')

watch(
    () => props.modelValue,
    (newVal) => {
        const found = props.options.find(opt => opt.value === newVal)
        selectedLabel.value = found ? found.label : ''
        search.value = selectedLabel.value
    },
    { immediate: true }
)

const filteredOptions = computed(() => {
    return props.options.filter(option =>
        option.label.toLowerCase().includes(search.value.toLowerCase())
    )
})

function selectOption(option) {
    emit('update:modelValue', option.value)
    search.value = option.label
    showDropdown.value = false
}

function closeDropdownWithDelay() {
    setTimeout(() => {
        showDropdown.value = false
    }, 200)
}
</script>

<template>
    <div class="relative">
        <input
            type="text"
            v-model="search"
            @focus="showDropdown = true"
            @blur="closeDropdownWithDelay"
            :placeholder="placeholder"
            class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-800 dark:text-white px-3 py-2"
        />

        <ul
            v-if="showDropdown && filteredOptions.length"
            class="absolute z-10 mt-1 w-full bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg max-h-60 overflow-auto"
        >
            <li
                v-for="option in filteredOptions"
                :key="option.value"
                @click="selectOption(option)"
                class="px-4 py-2 hover:bg-indigo-100 dark:hover:bg-indigo-700 dark:text-white cursor-pointer"
            >
                {{ option.label }}
            </li>
        </ul>

        <p
            v-if="showDropdown && filteredOptions.length === 0"
            class="mt-1 text-sm text-gray-500 dark:text-gray-400"
        >
            Nenhum resultado
        </p>
    </div>
</template>

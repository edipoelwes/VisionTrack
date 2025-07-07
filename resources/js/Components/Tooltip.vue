<script setup>
import { onMounted, ref } from 'vue'
import tippy from 'tippy.js'
import 'tippy.js/dist/tippy.css'
import 'tippy.js/themes/light-border.css'

const props = defineProps({
    content: {
        type: String,
        required: true,
    },
    placement: {
        type: String,
        default: 'top',
    },
    theme: {
        type: String,
        default: 'light-border',
    },
    animation: {
        type: String,
        default: 'shift-away',
    },
})

const el = ref(null)

onMounted(() => {
    tippy(el.value, {
        content: props.content,
        placement: props.placement,
        theme: props.theme,
        animation: props.animation,
        arrow: true,
        delay: [100, 50],
    })
})
</script>

<template>
  <span ref="el">
    <slot />
  </span>
</template>

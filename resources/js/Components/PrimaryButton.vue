<script setup>
import { router } from '@inertiajs/vue3'

const props = defineProps({
    href: {
        type: String,
        required: false,
    },
})

const clickHandler = () => {
    if (props.href) router.get(props.href)
}
</script>

<template>
    <button
        @click="clickHandler"
        class="inline-flex items-center rounded-md border border-transparent bg-primary px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-orange-500 focus:bg-orange-500 focus:outline-none focus:ring-2 focus:ring-orange-300 focus:ring-offset-2 active:bg-orange-500 disabled:pointer-events-none disabled:opacity-50"
    >
        <slot />
    </button>
</template>

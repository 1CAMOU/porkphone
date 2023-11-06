<script setup>
import { computed } from 'vue'
import { Link } from '@inertiajs/vue3'

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
    },
})

const classes = computed(() =>
    props.active
        ? 'py-2 px-4 relative rounded sm:p-0 bg-pork sm:bg-transparent my-1.5 sm:my-0 inline-flex items-center px-1 pt-1 sm:text-sm font-medium sm:leading-5 text-gray-900 focus:outline-none cursor-default transition duration-150 ease-in-out'
        : 'py-2 px-4 relative rounded sm:p-0 bg-pork sm:bg-transparent my-1.5 sm:my-0 inline-flex items-center px-1 pt-1 sm:text-sm font-medium sm:leading-5 text-gray-500 hover:text-gray-700 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out'
)
</script>

<template>
    <Link :href="href" :class="classes">
        <slot />

        <div
            v-if="active"
            class="absolute left-1/2 hidden h-3 w-0.5 -translate-x-1/2 translate-y-[2.35rem] cursor-default rounded-full bg-primary sm:block"
        />
    </Link>
</template>

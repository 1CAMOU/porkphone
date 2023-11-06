<script setup>
import { Link } from '@inertiajs/vue3'

defineProps({
    href: {
        type: String,
        required: true,
    },
    method: {
        type: String,
        default: 'GET',
    },
})
</script>

<template>
    <Link
        :href="href"
        :method="method"
        :as="method !== 'GET' ? 'button' : 'a'"
        class="hover:bg-pork focus:bg-pork block flex w-full items-center space-x-2 px-4 py-2 text-left text-sm leading-5 text-gray-900 transition duration-150 ease-in-out focus:outline-none"
    >
        <slot />
    </Link>
</template>

<script setup>
defineProps({
    width: {
        type: String,
        default: 'w-16'
    }
})
</script>

<template>
    <img :class="width" src="/favicon.png" alt="Porkphone Logo" />
</template>

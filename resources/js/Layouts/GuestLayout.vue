<script setup>
import ApplicationLogo from "@/Components/ApplicationLogo.vue";
</script>

<template>
    <div class="w-full max-w-5xl bg-white px-4 py-2.5 shadow-pink rounded-b-lg mx-auto">
        <ApplicationLogo />
    </div>

    <div class="mt-8">
        <slot />
    </div>
</template>

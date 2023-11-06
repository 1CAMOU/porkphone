<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import NavLink from '@/Components/NavLink.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { ref } from 'vue'

const mobileMenuOpen = ref(false)
</script>

<template>
    <div
        class="shadow-pink relative mx-auto flex w-full max-w-5xl items-center justify-between rounded-b-lg bg-white px-4 py-2.5"
    >
        <div class="flex items-center">
            <ApplicationLogo />
            <span
                class="ml-3 text-lg font-semibold tracking-tight text-gray-900"
            >
                PorkPhone
            </span>
        </div>

        <div class="hidden space-x-3 sm:flex">
            <NavLink :href="route('home')" :active="route().current('home')">
                Home
            </NavLink>

            <NavLink>How it Works</NavLink>
            <NavLink>Numbers</NavLink>
        </div>

        <div class="hidden space-x-3 sm:flex">
            <NavLink :href="route('login')" :active="route().current('login')">
                Login
            </NavLink>

            <PrimaryButton :href="route('register')">Register</PrimaryButton>
        </div>

        <!-- Mobile Menu Button -->
        <button
            @click="() => (mobileMenuOpen = !mobileMenuOpen)"
            :class="[
                mobileMenuOpen ? 'rotate-90' : '',
                'bg-pork block rounded p-3 shadow transition duration-150 active:scale-95 sm:hidden',
            ]"
        >
            <svg
                width="20"
                height="16"
                viewBox="0 0 20 16"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
            >
                <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M0.762338 0C0.342449 0 0 0.33428 0 0.74916C0 1.16403 0.342448 1.49832 0.762338 1.49832H19.2377C19.6576 1.49832 20 1.16404 20 0.74916C20 0.33429 19.6576 0 19.2377 0H0.762338ZM0.762338 7.25084C0.342449 7.25084 0 7.58512 0 8C0 8.4149 0.342448 8.7492 0.762338 8.7492H19.2377C19.6576 8.7492 20 8.4149 20 8C20 7.58513 19.6576 7.25084 19.2377 7.25084H0.762338ZM0.762338 14.5017C0.342449 14.5017 0 14.836 0 15.2508C0 15.6657 0.342448 16 0.762338 16H19.2377C19.6576 16 20 15.6657 20 15.2508C20 14.836 19.6576 14.5017 19.2377 14.5017H0.762338Z"
                    fill="#201F29"
                />
            </svg>
        </button>
    </div>

    <transition
        enter-active-class="transition duration-250"
        enter-from-class="opacity-0 -translate-y-4"
        enter-to-class="opacity-100 translate-y-0"
        leave-active-class="transition duration-150"
        leave-from-class="opacity-100"
        leave-to-class="opacity-0"
    >
        <div
            v-if="mobileMenuOpen"
            class="fixed block flex w-full flex-col border-t border-gray-100 bg-white px-4 py-2.5 sm:hidden"
        >
            <NavLink :href="route('home')" :active="route().current('home')">
                Home
            </NavLink>

            <NavLink>How it Works</NavLink>
            <NavLink>Numbers</NavLink>
        </div>
    </transition>

    <div class="mx-auto mt-8 max-w-5xl">
        <slot />
    </div>
</template>

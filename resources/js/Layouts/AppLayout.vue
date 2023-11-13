<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import NavLink from '@/Components/NavLink.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import { ref } from 'vue'
import Dropdown from '@/Components/Dropdown.vue'
import DropdownLink from '@/Components/DropdownLink.vue'

const mobileMenuOpen = ref(false)
</script>

<template>
    <div class="flex min-h-screen w-full flex-col">
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
                <NavLink
                    :href="route('home')"
                    :active="route().current('home')"
                >
                    Home
                </NavLink>

                <NavLink>How it Works</NavLink>
                <NavLink>Numbers</NavLink>
            </div>

            <div v-if="!$page.props.auth.user" class="hidden space-x-3 sm:flex">
                <NavLink
                    :href="route('login')"
                    :active="route().current('login')"
                >
                    Login
                </NavLink>

                <PrimaryButton :href="route('register')"
                    >Register</PrimaryButton
                >
            </div>

            <div v-else class="hidden items-center space-x-3 sm:flex">
                <Dropdown>
                    <template #trigger>
                        <button
                            class="rounded px-4 py-3 transition duration-150 hover:bg-pork"
                        >
                            <svg
                                width="2"
                                height="12"
                                viewBox="0 0 2 12"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M0 11C0 10.4477 0.44771 10 1 10C1.5523 10 2 10.4477 2 11C2 11.5523 1.5523 12 1 12C0.44771 12 0 11.5523 0 11ZM0 6.0001C0 5.44778 0.44772 5.00006 1 5.00006C1.5523 5.00006 2 5.44778 2 6.0001C2 6.5523 1.5523 7.0001 1 7.0001C0.44771 7.0001 0 6.5523 0 6.0001ZM0 1C0 0.44772 0.44772 0 1 0C1.5523 0 2 0.44772 2 1C2 1.55228 1.5523 2 1 2C0.44772 2 0 1.55228 0 1Z"
                                    fill="#201F29"
                                />
                            </svg>
                        </button>
                    </template>

                    <template #content>
                        <DropdownLink
                            :href="route('logout')"
                            method="POST"
                            as="button"
                        >
                            <svg
                                class="h-4 w-4"
                                viewBox="0 0 18 18"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M9.6783 3.62107e-07H7.10558C5.6432 -1.56379e-05 4.46901 -2.864e-05 3.54646 0.12412C2.59046 0.25277 1.79236 0.52707 1.15946 1.16054C0.52657 1.79401 0.25253 2.5928 0.124 3.54964C-2.86847e-05 4.47302 -1.56377e-05 5.64825 3.62299e-07 7.11197V10.888C-1.56377e-05 12.3517 -2.86847e-05 13.527 0.124 14.4504C0.25253 15.4072 0.52657 16.206 1.15946 16.8395C1.79236 17.4729 2.59046 17.7472 3.54646 17.8759C4.46902 18 5.6432 18 7.10559 18H9.6783C11.8647 18 13.637 16.226 13.637 14.0379C13.637 13.6202 13.2986 13.2814 12.8812 13.2814C12.4637 13.2814 12.1254 13.6202 12.1254 14.0379C12.1254 15.3906 11.0297 16.4872 9.6783 16.4872H7.16165C5.63038 16.4872 4.55801 16.4855 3.74789 16.3765C2.95955 16.2704 2.53362 16.0753 2.22837 15.7698C1.92312 15.4642 1.72812 15.0379 1.62213 14.2488C1.51321 13.4379 1.5116 12.3646 1.5116 10.8319V7.1681C1.5116 5.63544 1.51321 4.56208 1.62213 3.75121C1.72812 2.96212 1.92312 2.53577 2.22837 2.23024C2.53362 1.92472 2.95955 1.72956 3.74789 1.62347C4.55801 1.51446 5.63038 1.51285 7.16165 1.51285H9.6783C11.0297 1.51285 12.1254 2.60938 12.1254 3.96215C12.1254 4.37985 12.4637 4.71857 12.8812 4.71857C13.2986 4.71857 13.637 4.37985 13.637 3.96215C13.637 1.77398 11.8647 3.62107e-07 9.6783 3.62107e-07ZM11.5816 6.15533C11.2844 5.86198 10.8058 5.86536 10.5127 6.16287L8.22491 8.48525C8.08417 8.62812 8.00591 8.82109 8.00733 9.0217C8.00876 9.2223 8.08974 9.4141 8.2325 9.555L10.5203 11.8123C10.8176 12.1057 11.2961 12.1022 11.5892 11.8047C11.8822 11.5072 11.8788 11.0283 11.5815 10.735L10.6063 9.7728L17.2442 9.7729C17.6617 9.7729 18 9.4342 18 9.0165C18 8.59875 17.6617 8.26003 17.2442 8.26002L10.5696 8.25992L11.5891 7.225C11.8822 6.92753 11.8788 6.44863 11.5816 6.15533Z"
                                    fill="#201F29"
                                />
                            </svg>

                            <p>Logout</p>
                        </DropdownLink>
                    </template>
                </Dropdown>

                <PrimaryButton :href="route('profile.edit')">
                    Profile
                </PrimaryButton>
            </div>

            <!-- Mobile Menu Button -->
            <button
                @click="() => (mobileMenuOpen = !mobileMenuOpen)"
                :class="[
                    mobileMenuOpen ? 'rotate-90' : '',
                    'block rounded bg-pork p-3 shadow transition duration-150 active:scale-95 sm:hidden',
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
                <NavLink
                    :href="route('home')"
                    :active="route().current('home')"
                >
                    Home
                </NavLink>

                <NavLink>How it Works</NavLink>
                <NavLink>Numbers</NavLink>
                <div class="mt-1 flex flex-col border-t border-gray-100">
                    <NavLink :href="route('profile.edit')">Profile</NavLink>
                    <NavLink :href="route('logout')" method="POST"
                        >Logout</NavLink
                    >
                </div>
            </div>
        </transition>

        <div class="mx-auto mt-8 w-full max-w-5xl">
            <slot />
        </div>

        <footer
            class="mx-auto mt-auto flex w-full max-w-5xl flex-col justify-between bg-pork px-4 py-8 sm:flex-row"
        >
            <div class="flex flex-col items-center gap-4 sm:items-start">
                <ApplicationLogo class="h-10 w-10" />
                <p class="text-sm text-gray-900">
                    &copy; {{ new Date().getFullYear() }} PorkPhone, LLC. All
                    rights reserved.
                </p>
            </div>

            <div class="mx-auto mt-4 flex flex-wrap sm:m-0 sm:flex-col">
                <NavLink
                    :href="route('home')"
                    :active="route().current('home')"
                    :active-line="false"
                >
                    Home
                </NavLink>

                <NavLink>Privacy Policy</NavLink>
                <NavLink>Terms of Service</NavLink>
                <NavLink>Contact</NavLink>
            </div>
        </footer>
    </div>
</template>

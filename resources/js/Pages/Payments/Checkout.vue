<script setup>
import { Head, Link } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import { ref } from 'vue'

const amount = ref(20)
</script>

<template>
    <Head title="Your Balance" />

    <AppLayout>
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                <h2 class="pb-8 text-xl">
                    Current Balance:
                    <span class="ml-1 font-semibold">
                        {{
                            new Intl.NumberFormat('en-US', {
                                style: 'currency',
                                currency: 'USD',
                            }).format($page.props.auth.user.balance)
                        }}
                    </span>
                </h2>

                <hr />

                <div class="mt-8">
                    <h2 class="text-lg">Top up your Balance</h2>

                    <div class="mt-6 flex flex-wrap gap-3 md:flex-nowrap">
                        <button
                            class="rounded-md border border-gray-300 bg-white px-8 py-3.5 transition focus:border-primary focus:outline-none focus:ring-orange-300 active:translate-y-0 active:scale-95"
                            :class="
                                amount === 5
                                    ? 'cursor-default border-primary bg-orange-50 opacity-100'
                                    : 'opacity-80 hover:-translate-y-1 hover:opacity-100 hover:shadow-sm'
                            "
                            @click="amount = 5"
                        >
                            $5
                        </button>

                        <button
                            class="rounded-md border border-gray-300 bg-white px-8 py-3.5 transition focus:border-primary focus:outline-none focus:ring-orange-300 active:translate-y-0 active:scale-95"
                            :class="
                                amount === 10
                                    ? 'cursor-default border-primary bg-orange-50 opacity-100'
                                    : 'opacity-80 hover:-translate-y-1 hover:opacity-100 hover:shadow-sm'
                            "
                            @click="amount = 10"
                        >
                            $10
                        </button>

                        <button
                            class="rounded-md border border-gray-300 bg-white px-8 py-3.5 transition focus:border-primary focus:outline-none focus:ring-orange-300 active:translate-y-0 active:scale-95"
                            :class="
                                amount === 20
                                    ? 'cursor-default border-primary bg-orange-50 opacity-100'
                                    : 'opacity-80 hover:-translate-y-1 hover:opacity-100 hover:shadow-sm'
                            "
                            @click="amount = 20"
                        >
                            $20
                        </button>

                        <button
                            class="rounded-md border border-gray-300 bg-white px-8 py-3.5 transition focus:border-primary focus:outline-none focus:ring-orange-300 active:translate-y-0 active:scale-95"
                            :class="
                                amount === 50
                                    ? 'cursor-default border-primary bg-orange-50 opacity-100'
                                    : 'opacity-80 hover:-translate-y-1 hover:opacity-100 hover:shadow-sm'
                            "
                            @click="amount = 50"
                        >
                            $50
                        </button>

                        <button
                            class="rounded-md border border-gray-300 bg-white px-8 py-3.5 transition focus:border-primary focus:outline-none focus:ring-orange-300 active:translate-y-0 active:scale-95"
                            :class="
                                amount === 100
                                    ? 'cursor-default border-primary bg-orange-50 opacity-100'
                                    : 'opacity-80 hover:-translate-y-1 hover:opacity-100 hover:shadow-sm'
                            "
                            @click="amount = 100"
                        >
                            $100
                        </button>

                        <div class="relative">
                            <input
                                type="number"
                                step="1"
                                min="1"
                                max="1000000"
                                placeholder="150"
                                class="h-full rounded-md border-gray-300 px-8 py-3.5 text-sm placeholder-gray-400 shadow-sm focus:border-primary focus:ring-orange-300"
                                :class="
                                    amount !== 5 &&
                                    amount !== 10 &&
                                    amount !== 20 &&
                                    amount !== 50 &&
                                    amount !== 100
                                        ? 'border-primary bg-orange-50'
                                        : ''
                                "
                                v-model="amount"
                            />

                            <p class="absolute left-4 top-1/2 -translate-y-1/2">
                                $
                            </p>
                        </div>
                    </div>

                    <div class="mt-8 flex gap-3">
                        <Link
                            :href="route('checkout.stripe', { amount })"
                            method="POST"
                            as="button"
                            class="flex w-48 items-center justify-center rounded-md bg-[#5433ff] px-6 py-2.5 text-white opacity-90 transition hover:opacity-100"
                        >
                            Pay with
                            <svg
                                class="ml-0.5 mt-0.5 w-12 fill-white"
                                xmlns="http://www.w3.org/2000/svg"
                                x="0"
                                y="0"
                                viewBox="0 0 468 222.5"
                                xml:space="preserve"
                            >
                                <path
                                    d="M414 113.4c0-25.6-12.4-45.8-36.1-45.8-23.8 0-38.2 20.2-38.2 45.6 0 30.1 17 45.3 41.4 45.3 11.9 0 20.9-2.7 27.7-6.5v-20c-6.8 3.4-14.6 5.5-24.5 5.5-9.7 0-18.3-3.4-19.4-15.2h48.9c0-1.3.2-6.5.2-8.9zm-49.4-9.5c0-11.3 6.9-16 13.2-16 6.1 0 12.6 4.7 12.6 16h-25.8zM301.1 67.6c-9.8 0-16.1 4.6-19.6 7.8l-1.3-6.2h-22v116.6l25-5.3.1-28.3c3.6 2.6 8.9 6.3 17.7 6.3 17.9 0 34.2-14.4 34.2-46.1-.1-29-16.6-44.8-34.1-44.8zm-6 68.9c-5.9 0-9.4-2.1-11.8-4.7l-.1-37.1c2.6-2.9 6.2-4.9 11.9-4.9 9.1 0 15.4 10.2 15.4 23.3 0 13.4-6.2 23.4-15.4 23.4zM223.8 61.7l25.1-5.4V36l-25.1 5.3zM223.8 69.3h25.1v87.5h-25.1zM196.9 76.7l-1.6-7.4h-21.6v87.5h25V97.5c5.9-7.7 15.9-6.3 19-5.2v-23c-3.2-1.2-14.9-3.4-20.8 7.4zM146.9 47.6l-24.4 5.2-.1 80.1c0 14.8 11.1 25.7 25.9 25.7 8.2 0 14.2-1.5 17.5-3.3V135c-3.2 1.3-19 5.9-19-8.9V90.6h19V69.3h-19l.1-21.7zM79.3 94.7c0-3.9 3.2-5.4 8.5-5.4 7.6 0 17.2 2.3 24.8 6.4V72.2c-8.3-3.3-16.5-4.6-24.8-4.6C67.5 67.6 54 78.2 54 95.9c0 27.6 38 23.2 38 35.1 0 4.6-4 6.1-9.6 6.1-8.3 0-18.9-3.4-27.3-8v23.8c9.3 4 18.7 5.7 27.3 5.7 20.8 0 35.1-10.3 35.1-28.2-.1-29.8-38.2-24.5-38.2-35.7z"
                                />
                            </svg>
                        </Link>

                        <Link
                            :href="route('checkout.coinbase', { amount })"
                            method="POST"
                            as="button"
                            class="flex w-48 items-center justify-center rounded-md bg-[#011082] px-6 py-2.5 text-white opacity-90 transition hover:opacity-100"
                        >
                            Pay with Crypto
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

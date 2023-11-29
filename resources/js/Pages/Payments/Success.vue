<script setup>
import { Head } from '@inertiajs/vue3'
import AppLayout from '@/Layouts/AppLayout.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
</script>

<template>
    <Head title="Payment succeeded" />

    <AppLayout>
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                <h3 class="text-lg font-medium leading-6 text-gray-900">
                    Payment succeeded
                </h3>
                <p class="mb-4 mt-1 max-w-2xl text-sm text-gray-500">
                    Thank you for your payment.
                </p>

                <hr />

                <p class="mb-4 mt-4 max-w-2xl text-sm text-gray-500">
                    Please wait up to 24 hours for your payment to be processed.
                    If your payment is not processed within 24 hours, please
                    contact us at
                    <a href="mailto:contact@porkphone.com">
                        contact@porkphone.com
                    </a>
                </p>

                <PrimaryButton :href="route('checkout.index')">
                    View Balance
                </PrimaryButton>
            </div>
        </div>
    </AppLayout>
</template>

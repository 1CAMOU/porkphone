<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import { Head, useForm } from '@inertiajs/vue3'

defineProps({
    status: {
        type: String,
    },
})

const form = useForm({
    email: '',
})

const submit = () => {
    form.post(route('password.email'))
}
</script>

<template>
    <GuestLayout>
        <Head title="Forgot Password" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>

        <h1 class="my-12 text-center font-heading text-4xl text-gray-900">
            Lost your Password? Don't Worry!
        </h1>

        <form @submit.prevent="submit" class="mx-4 max-w-md sm:mx-auto">
            <div class="mb-4 text-sm text-gray-600">
                Hey, we've all been there. Just enter your email, and we'll help
                you reset your password, so you can get back to what really
                matters.
            </div>

            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    placeholder="your@email.com"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4 flex">
                <PrimaryButton
                    class="w-full justify-center text-center"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing || !form.email"
                >
                    Email Password Reset Link
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>

<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.transform(data => ({
        ...data,
        remember: form.remember ? 'on' : '',
    })).post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <Head title="Log in" />
    <form @submit.prevent="submit">

        <div class="mt-2 relative">
            <InputLabel for="email" value="E-mail" />
            <div class="relative shadow-input rounded-lg">
                <TextInput id="email" v-model="form.email" type="email"
                    class="pr-10 mt-1 block w-full text-gray-button focus:border-yellow" required autocomplete="username" />
                <img src="/assets/img/login/icon-email.svg"
                    class="absolute inset-y-0 right-0 transform -translate-y-1/2 mr-0.5 text-gray-500 top-1/2">
            </div>
            <InputError class="mt-2" :message="form.errors.email" />
        </div>

        <div class="mt-2 relative">
            <InputLabel class="text-[12px] font-bold" for="password" :value="$t('password')" />
            <div class="relative shadow-input rounded-lg">
                <TextInput id="password" v-model="form.password" type="password"
                    class="pr-10 mt-1 block w-full text-gray-button focus:border-yellow" required
                    autocomplete="new-password" />
                <img src="/assets/img/login/icon-password.svg"
                    class="absolute inset-y-0 right-0 transform -translate-y-1/2 mr-0.5 text-gray-500 top-1/2">
            </div>
            <InputError class="mt-2" :message="form.errors.password" />
        </div>

        <div class="flex items-center justify-end mt-5">
            <PrimaryButton class="flex justify-center grad-gray items-center w-full px-8 mt-1 py-3"
                :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                {{ $t('login') }}
            </PrimaryButton>
        </div>

        <div class="flex items-center justify-center mt-5">
            <a href="forgot-password"
                class="underline text-sm text-[#191919] hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ $t('forgot_your_password') }}
            </a>
        </div>
    </form>
</template>

<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    email: String,
    token: String,
});

const form = useForm({
    token: props.token,
    email: props.email,
    password: '',
    password_confirmation: '',
});

const submit = () => {
    form.post(route('password.update'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};
</script>

<template>
    <Head title="Reset Password" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div class="flex flex-col-reverse md:flex-row justify-center items-center">
            <div class="relative max-w-[21rem]">

                <div class="text-white rounded-lg w-full max-w-xl flex flex-col items-center">
                    <img src="/assets/img/login/logo-foco.png" class="max-w-full h-auto mb-4">
                    <img src="/assets/img/login/organizer.png" class="max-w-full h-auto">
                </div>
                <div class="mt-4 text-gray-600 font-bold">
                    {{ $t('reset_password_title') }}
                </div>

                <div class="mt-4 text-gray-600 ">
                    {{ $t('reset_password_text') }}
                </div>

                <form @submit.prevent="submit" class="mt-4 relative">
                    <div>
                        <TextInput id="email" v-model="form.email" type="hidden" class="mt-1 block w-full" required
                            autofocus autocomplete="username" />
                        <InputError class="mt-2" :message="form.errors.email" />
                    </div>

                    <div class="mt-2 relative">
                        <InputLabel for="password" :value="$t('password')" />
                        <div class="relative shadow-input rounded-lg">
                            <TextInput id="password" v-model="form.password" type="password"
                                class="pr-10 mt-1 block w-full text-gray-button focus:border-yellow" required
                                autocomplete="new-password" />
                            <img src="/assets/img/login/icon-password.svg"
                                class="absolute inset-y-0 right-0 transform -translate-y-1/2 mr-0.5 text-gray-500 top-1/2">
                        </div>
                        <InputError class="mt-2" :message="form.errors.password" />
                    </div>

                    <div class="mt-2 relative">
                        <InputLabel for="password_confirmation" :value="$t('confirm_password')" />
                        <div class="relative shadow-input rounded-lg">
                            <TextInput id="password_confirmation" v-model="form.password_confirmation" type="password"
                                class="pr-10 mt-1 block w-full text-gray-button focus:border-yellow" required
                                autocomplete="new-password" />
                            <img src="/assets/img/login/icon-password.svg"
                                class="absolute inset-y-0 right-0 transform -translate-y-1/2 mr-0.5 text-gray-500 top-1/2">
                        </div>
                        <InputError class="mt-2" :message="form.errors.password_confirmation" />
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <PrimaryButton class="flex justify-center grad-gray items-center w-full px-8 mt-1 py-3">
                            {{ $t('confirm') }}
                        </PrimaryButton>
                    </div>
                </form>
            </div>

            <div class="text-white p-4 rounded-r-lg mb-4 md:mb-0 md:mr-4 order-last">
                <img src="/assets/img/login/banner-login.png" class="max-w-full h-auto">
            </div>
        </div>
    </AuthenticationCard>
</template>

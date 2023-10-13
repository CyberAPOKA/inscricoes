<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import LogoLogin from '@/Pages/Svgs/LogoLogin.vue';
import LogoOrganizador from '@/Pages/Svgs/LogoOrganizador.vue';

defineProps({
    status: String,
});

const form = useForm({
    email: '',
});

const submit = () => {
    form.post(route('password.email'));
};
</script>

<template>
    <Head title="Forgot Password" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div class="flex flex-col-reverse md:flex-row justify-center items-center">
            <div class="text-white rounded-l-lg">

                <div class="text-white rounded-lg w-[21rem] flex flex-col items-center">
                    <LogoLogin />
                    <LogoOrganizador />
                </div>

                <div class="relative w-[21rem]">

                    <div class="mt-4 text-gray-600 font-bold">
                        {{ $t('recover_password') }}
                    </div>

                    <div class="mt-4 text-[14px] text-gray-600 ">
                        {{ $t('recover_text') }}
                    </div>

                    <div v-if="status" class="mb-4 font-medium text-sm text-green-600 text-dark bg-[#8EFEB4] p-3 mt-2">
                        <p v-if="status === 'passwords.user'">{{ $t('passwords_sent') }}</p>
                        <p v-if="status === 'passwords.sent'">{{ $t('passwords_sent') }}</p>
                        <p v-if="status === 'passwords.throttled'">{{ $t('passwords_sent') }}</p>
                    </div>

                    <form @submit.prevent="submit" class="mt-4 relative">
                        <InputLabel for="email" value="E-mail" />
                        <div class="relative shadow-input rounded-lg">
                            <TextInput id="email" v-model="form.email" type="email"
                                class="pr-10 mt-1 block w-full text-gray-button focus:border-yellow" required
                                autocomplete="username" />
                            <img src="/assets/img/login/icon-email.svg"
                                class="absolute inset-y-0 right-0 transform -translate-y-1/2 mr-0.5 text-gray-500 top-1/2">
                        </div>
                        <InputError class="mt-2" :message="form.errors.email" />

                        <div class="flex items-center justify-end mt-4">
                            <PrimaryButton class="flex justify-center grad-gray items-center w-full px-8 mt-1 py-3">
                                {{ $t('send') }}
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Image banner-login -->
            <div class="text-white p-4 rounded-r-lg mb-4 md:mb-0 md:mr-4 order-last">
                <img src="/assets/img/login/banner-login.png" class="max-w-full h-auto">
            </div>
        </div>

    </AuthenticationCard>
</template>
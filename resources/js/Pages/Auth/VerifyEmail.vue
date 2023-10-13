<script setup>
import { computed } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    status: String,
});

const form = useForm({});

const submit = () => {
    form.post(route('verification.send'));
};

const verificationLinkSent = computed(() => props.status === 'verification-link-sent');
</script>

<template>
    <Head title="Email Verification" />

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div class="flex flex-col-reverse md:flex-row justify-center items-center">
            <div class="text-white rounded-l-lg">

                <div class="text-white rounded-lg w-full max-w-xl flex flex-col items-center">
                    <img src="/assets/img/login/logo-foco.png" class="max-w-full h-auto mb-4">
                    <img src="/assets/img/login/organizer.png" class="max-w-full h-auto">
                </div>

                <div class="relative max-w-[21rem]">
                    <div class="mt-4 text-dark font-bold text-center py-3 bg-green-info">
                        {{ $t('registration_completed') }}
                    </div>

                    <div v-if="verificationLinkSent" class="mb-4 font-medium text-sm text-green-600 mt-2">
                        {{ $t('registration_text_link') }}
                    </div>

                    <div class="mt-4 text-[14px] text-gray-600 ">
                        {{ $t('registration_text') }}
                    </div>

                    <form @submit.prevent="submit" class="mt-4 relative">
                        <div class="flex items-center mt-4 w-auto">
                            <PrimaryButton class="flex justify-center grad-gray items-center w-full px-8 mt-1 py-3">
                                {{ $t('registration_btn') }}
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

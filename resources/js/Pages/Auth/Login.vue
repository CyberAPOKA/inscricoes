<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AuthenticationCard from '@/Components/AuthenticationCard.vue';
import AuthenticationCardLogo from '@/Components/AuthenticationCardLogo.vue';
import Login from '@/Components/Login.vue';
import Register from '@/Components/Register.vue';
import BannerLogin from '@/Pages/Svgs/BannerLogin.vue';
import LogoLogin from '@/Pages/Svgs/LogoLogin.vue';
import LogoOrganizador from '@/Pages/Svgs/LogoOrganizador.vue';

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

    <AuthenticationCard>
        <template #logo>
            <AuthenticationCardLogo />
        </template>

        <div class="flex flex-col-reverse md:flex-row justify-center items-center">
            <div class="text-white rounded-l-lg">
                <div class="text-white rounded-lg w-full max-w-xl flex flex-col items-center">
                    <LogoLogin />
                    <LogoOrganizador />
                </div>
                <div class="flex flex-wrap">
                    <div class="w-full">

                        <div class="mt-4">
                            <ul class="flex mb-0 list-none flex-wrap pt-3 pb-4 flex-row">
                                <li class="flex-1 -mb-px mr-2 last:mr-0 text-center">
                                    <a class="text-[18px] w-auto border border-gray-button font-bold uppercase cursor-pointer px-5 py-3 rounded-lg  block leading-normal"
                                        v-on:click="toggleTabs(1)"
                                        v-bind:class="{ 'text-gray-button bg-white': openTab !== 1, 'text-white bg-gray-button': openTab === 1 }">
                                        {{ $t('login') }}
                                    </a>
                                </li>
                                <li class="flex-1 -mb-px mr-2 last:mr-0 text-center">
                                    <a class="text-[18px] w-full border border-gray-button font-bold uppercase cursor-pointer px-5 py-3 rounded-lg block leading-normal"
                                        v-on:click="toggleTabs(2)"
                                        v-bind:class="{ 'text-gray-button bg-white': openTab !== 2, 'text-white bg-gray-button': openTab === 2 }">
                                        {{ $t('register') }}
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="flex flex-col break-words bg-white mb-6 rounded">
                            <div class="">
                                <div class="tab-content tab-space">
                                    <div v-bind:class="{ 'hidden': openTab !== 1, 'block': openTab === 1 }">
                                        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
                                            {{ status }}
                                        </div>
                                        <Login />
                                    </div>
                                    <div v-bind:class="{ 'hidden': openTab !== 2, 'block': openTab === 2 }">
                                        <Register />
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Image banner-login -->
            <div class="text-white p-4 rounded-r-lg mb-4 md:mb-0 md:mr-4 order-last">
                <BannerLogin />
            </div>
        </div>

    </AuthenticationCard>
</template>
  
<script>
export default {
    name: "pink-tabs",
    data() {
        return {
            openTab: 1
        }
    },
    methods: {
        toggleTabs: function (tabNumber) {
            this.openTab = tabNumber
        }
    }
}
</script>
<script setup>
import { Head, Link, useForm } from '@inertiajs/vue3';
import Checkbox from '@/Components/Checkbox.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { mask } from "vue-the-mask";

const form = useForm({
    name: '',
    email: '',
    cellphone: '',
    cnpj: '',
    password: '',
    password_confirmation: '',
    terms: false,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

</script>

<template>
    <Head title="Register" />
    <form @submit.prevent="submit">
        <div class="mt-2 relative ">
            <InputLabel for="name" :value="$t('fantasy')" />
            <div class="relative shadow-input rounded-lg">
                <TextInput id="name" v-model="form.name" type="text"
                    class="pr-10 mt-1 block w-full text-gray-button focus:border-yellow" required autofocus
                    autocomplete="name" />
                <img src="/assets/img/login/icon-name.svg"
                    class="absolute inset-y-0 right-0 transform -translate-y-1/2 mr-0.5 text-gray-500 top-1/2">
            </div>
            <InputError class="mt-2" :message="form.errors.name" />
        </div>

        <div class="mt-2 relative">
            <InputLabel for="cnpj" value="CNPJ" />
            <div class="relative shadow-input rounded-lg">
                <TextInput id="cellphone" v-model="form.cnpj" type="text" v-mask="['##.###.###/####-##']"
                    class="pr-10 mt-1 block w-full text-gray-button focus:border-yellow" required autocomplete="cnpj" />
                <img src="/assets/img/login/icon-cnpj.svg"
                    class="absolute inset-y-0 right-0 transform -translate-y-1/2 mr-0.5 text-gray-500 top-1/2">
            </div>
            <InputError class="mt-2" :message="form.errors.cnpj" />
        </div>

        <div class="mt-2 relative">
            <InputLabel for="cellphone" :value="$t('cellphone')" />
            <div class="relative shadow-input rounded-lg">
                <TextInput id="cellphone" v-model="form.cellphone" type="text" v-mask="['(##) #####-####']"
                    class="pr-10 mt-1 block w-full text-gray-button focus:border-yellow" required
                    autocomplete="cellphone" />
                <img src="/assets/img/login/icon-cellphone.svg"
                    class="absolute inset-y-0 right-0 transform -translate-y-1/2 mr-0.5 text-gray-500 top-1/2">
            </div>
            <InputError class="mt-2" :message="form.errors.cellphone" />
        </div>

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
            <InputError class="mt-2" :message="form.errors.password" />
        </div>

        <div class="mt-4">
            <div class="block text-[12px] text-[#616161]">
                <div class="flex items-center shadow-input p-4 rounded-lg ml-0">
                    <Checkbox id="terms" v-model:checked="form.terms" name="terms" required />

                    <div class="px-2 ml-[5px] max-w-xs text-[#9F9F9F]">
                        {{ $t('by_clicking_one') }} <a target="_blank" :href="route('terms.show')"
                            class="underline font-bold text-sm text-[12px] text-[#9F9F9F] hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ $t('terms') }}
                        </a>
                        {{ $t('by_clicking_two') }}
                        <a target="_blank" :href="route('policy.show')"
                            class="underline text-sm font-bold text-[12px] text-[#9F9F9F] hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ $t('policy') }}
                        </a>
                    </div>
                </div>
                <InputError class="mt-2" :message="form.errors.terms" />
            </div>
        </div>

        <div class="flex items-center justify-end mt-4">
            <PrimaryButton class="flex justify-center items-center w-full px-8 mt-1 py-3"
                :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                {{ $t('register') }}
            </PrimaryButton>
        </div>
    </form>
</template>

<script>
export default {
    directives: { mask },
};
</script>
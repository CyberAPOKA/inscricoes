<template>
    <form @submit.prevent="submit">
        <div class="grid gap-6 mb-6 md:grid-cols-12">
            <div class="col-span-12 md:col-span-6 xl:col-span-3">
                <label for="zip_code" class="block mb-2 text-sm font-medium text-gray-900">CEP*</label>
                <input type="text" id="zip_code" v-model="form.zip_code"
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
                    @change="handleZipCodeChange" v-mask="['#####-###']" />
                <div v-if="form.invalid('zip_code')">
                    <p class="text-red-600 font-bold">{{ form.errors.zip_code }}</p>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 xl:col-span-6">
                <label for="city" class="block mb-2 text-sm font-medium text-gray-900">Cidade*</label>
                <input type="text" id="city" v-model="form.city"
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
                    @change="form.validate('city')" />
                <div v-if="form.invalid('city')">
                    <p class="text-red-600 font-bold">{{ form.errors.city }}</p>
                </div>
            </div>
            <div class="col-span-12 xl:col-span-3">
                <label for="state" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado*</label>
                <select id="state"
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
                    v-model="form.state">
                    <option v-for="option in stateOptions" :value="option" selected>
                        {{ option }}
                    </option>
                </select>

                <div v-if="form.invalid('state')">
                    <p class="text-red-600 font-bold">{{ form.errors.state }}</p>
                </div>
            </div>
        </div>
        <div class="grid gap-6 mb-6 md:grid-cols-12">
            <div class="col-span-12 md:col-span-6 xl:col-span-6">
                <label for="street" class="block mb-2 text-sm font-medium text-gray-900">Rua/Av.*</label>
                <input type="text" id="street" v-model="form.street"
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
                    @change="form.validate('street')" />
                <div v-if="form.invalid('street')">
                    <p class="text-red-600 font-bold">{{ form.errors.street }}</p>
                </div>
            </div>
            <div class="col-span-12 md:col-span-6 xl:col-span-2">
                <label for="number" class="block mb-2 text-sm font-medium text-gray-900">Número*</label>
                <input type="number" id="number" v-model="form.number"
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
                    @change="form.validate('number')" v-mask="['######']" />
                <div v-if="form.invalid('number')">
                    <p class="text-red-600 font-bold">{{ form.errors.number }}</p>
                </div>
            </div>
            <div class="col-span-12 xl:col-span-4">
                <label for="complement" class="block mb-2 text-sm font-medium text-gray-900">Complemento</label>
                <input type="text" id="complement" v-model="form.complement"
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
                    @change="form.validate('complement')" />
                <div v-if="form.invalid('complement')">
                    <p class="text-red-600 font-bold">{{ form.errors.complement }}</p>
                </div>
            </div>
        </div>
        <div class="mb-6">
            <div class="flex gap-2">
                <p>Link do Google Maps</p>
                <button data-popover-target="popover-info-google-maps" type="button">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M0 9C0 4.032 4.032 0 9 0C13.968 0 18 4.032 18 9C18 13.968 13.968 18 9 18C4.032 18 0 13.968 0 9ZM9.9 12.6V14.4H8.1V12.6H9.9ZM9 16.2C5.031 16.2 1.8 12.969 1.8 9C1.8 5.031 5.031 1.8 9 1.8C12.969 1.8 16.2 5.031 16.2 9C16.2 12.969 12.969 16.2 9 16.2ZM5.4 7.2C5.4 5.211 7.011 3.6 9 3.6C10.989 3.6 12.6 5.211 12.6 7.2C12.6 8.35462 11.889 8.97599 11.1967 9.58099C10.5399 10.1549 9.9 10.7142 9.9 11.7H8.1C8.1 10.0609 8.94791 9.41093 9.6934 8.83951C10.2782 8.39125 10.8 7.99129 10.8 7.2C10.8 6.21 9.99 5.4 9 5.4C8.01 5.4 7.2 6.21 7.2 7.2H5.4Z"
                            fill="#9F9F9F" />
                    </svg>
                </button>
                <div data-popover id="popover-info-google-maps" role="tooltip"
                    class="absolute z-50 invisible inline-block max-w-3xl text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                    <div
                        class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                        <h3 class="font-semibold text-gray-900 dark:text-white">
                            Título
                        </h3>
                    </div>
                    <div class="px-3 py-2">
                        <p class="text-[#191919] font-normal text-sm">
                            <span class="font-black">Info</span> Info
                        </p>
                    </div>
                    <div data-popper-arrow></div>
                </div>
            </div>
            <div class="shadow-all rounded-xl">
                <div class="p-6">
                    <input type="text" id="google_maps_link" v-model="form.google_maps_link"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all placeholder:text-center"
                        @change="form.validate('google_maps_link')" placeholder="Insira o link aqui" />
                    <div v-if="form.invalid('google_maps_link')">
                        <p class="text-red-600 font-bold">{{ form.errors.google_maps_link }}</p>
                    </div>
                    <div v-if="iframeError">error svg</div>
                    <iframe v-else v-if="form.google_maps_link" :src="form.google_maps_link" @error="onIframeError"
                        style="border: 0" allowfullscreen="" loading="lazy"
                        class="w-full h-[600px] mt-4 shadow-all"></iframe>
                </div>
            </div>
        </div>
        <div class="flex justify-between pt-12">
            <a :href="route('events')" v-if="step === 1" class="bg-red-300 px-8 py-2 rounded-xl text-white font-bold">
                Cancelar
            </a>
            <button type="button" v-if="step > 1" @click="step--"
                class="bg-red-300 px-8 py-2 rounded-xl text-white font-bold">
                Voltar
            </button>
            <button type="submit" class="bg-green px-8 py-2 rounded-xl text-white font-bold" :disabled="locationDisabled">
                Avançar {{ step }}
            </button>
        </div>
    </form>
</template>
<script setup>
import { ref, watch, computed } from "vue";
import { useForm as usePrecognitionForm } from "laravel-precognition-vue";
import { step } from "@/Pages/Event/step.js";

const props = defineProps({
    eventId: Number,
    location: Object,
});

const form = usePrecognitionForm(
    "post",
    route("event.location.save", {
        id: props.eventId,
    }),
    {
        zip_code: props.location?.zip_code,
        city: props.location?.city,
        state: props.location?.state,
        street: props.location?.street,
        number: props.location?.number,
        complement: props.location?.complement,
        google_maps_link: props.location?.google_maps_link,
    }
);

const locationDisabled = computed(() => {
    return Object.keys(form.errors).length > 0 ||
        !form.zip_code ||
        !form.city ||
        !form.state ||
        !form.street ||
        !form.number ||
        !form.google_maps_link
});

const handleZipCodeChange = async () => {
    form.validate("zip_code");
    await fetchAddressData();
};

const fetchAddressData = async () => {
    const response = await fetch(`https://viacep.com.br/ws/${form.zip_code}/json/`);
    const data = await response.json();

    if (response.ok) {
        form.city = data.localidade;
        form.state = data.uf;
        form.street = data.logradouro;
        form.number = data.gia;
        form.complement = data.complemento;
    } else {
        console.error("Erro ao buscar o endereço");
    }
};

const stateOptions = [
    "AC",
    "AL",
    "AP",
    "AM",
    "BA",
    "CE",
    "DF",
    "ES",
    "GO",
    "MA",
    "MT",
    "MS",
    "MG",
    "PA",
    "PB",
    "PR",
    "PE",
    "PI",
    "RJ",
    "RN",
    "RS",
    "RO",
    "RR",
    "SC",
    "SP",
    "SE",
    "TO",
];

const submit = () =>
    form
        .submit()
        // .then((response) => {
        //   alert("Localização salva com sucesso!");
        // })
        .finally(() => {
            step.value++;
        });

const iframeError = ref(false);

function onIframeError() {
    iframeError.value = true;
}

function extractURLFromIframe(input) {
    const match = input.match(/<iframe.*?src="(.*?)"/);
    if (match && match[1]) {
        return match[1];
    }
    return input;
}

async function checkURL() {
    if (!form.google_maps_link) return;

    const actualURL = extractURLFromIframe(form.google_maps_link);

    try {
        const response = await fetch(actualURL, {
            method: "GET",
        });

        console.log("Response status:", response.status);

        if (response.ok) {
            iframeError.value = false;
            form.google_maps_link = actualURL;
        } else {
            iframeError.value = true;
        }
    } catch (error) {
        console.error("Fetch error:", error);
        iframeError.value = true;
    }
}

watch(
    () => form.google_maps_link,
    (newValue) => {
        if (!newValue || newValue.trim() === "") {
            iframeError.value = false;
        } else {
            checkURL();
        }
    }
);
</script>
<script>
import { mask } from "vue-the-mask";
export default {
    directives: { mask },
};
</script>

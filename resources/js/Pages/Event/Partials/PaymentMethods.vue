<template>
    <div>
        <form @submit.prevent="paymentMethods">
            <h1 class="text-[#000000] text-2xl font-extrabold">CONFIGURAR A FORMA DE PAGAMENTO</h1>
            <div class="flex flex-col gap-1 mt-4">
                <p class="text-[#616161] text-xs font-semibold">Taxa de Comodidade*</p>
                <p class="bg-[#616161] py-2 px-10 text-white font-bold text-sm rounded-xl w-32 text-center">10%</p>
            </div>
            <h1 class="text-[#000000] text-lg font-bold mt-6">Escolha as formas de pagamento que vai disponibilizar no
                evento:
            </h1>

            <!-- boleto -->
            <div class="shadow-all rounded-3xl mt-2">
                <div class="bg-[#F1F1F1] p-4 flex items-center justify-between rounded-t-3xl">
                    <div class="flex items-center">
                        <input id="boleto" type="checkbox" v-model="boleto"
                            class="w-5 h-5 text-[#616161] bg-white border-2 border-[#616161] rounded focus:ring-[#616161] focus:ring-2" />
                        <label for="boleto" class="ml-2 text-[#191919] font-bold text-base">Boleto bancário {{ boleto
                        }}</label>
                    </div>
                    <div>
                        SVG
                    </div>
                </div>
                <div>
                    <div class="py-4 px-6">
                        <p class="text-[#000000]">
                            O boleto será emitido com 2 dias de prazo para pagamento sendo o reconhecimento automático pelo
                            sistema em até 3 dias úteis após pago. Se o boleto não for pedido é automaticamente cancelado e
                            o
                            cliente
                            notificado por e-mail.
                        </p>
                        <div v-if="boleto" class="mt-4">
                            <hr>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label for="boleto-available-until"
                                        class="block mb-2 text-sm font-medium text-gray-900">Método de pagamento
                                        disponível até:*</label>
                                    <input type="date" id="boleto-available-until" v-model="event.boleto_available_until"
                                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all" />
                                </div>
                                <div>
                                    <label for="boleto-discount"
                                        class="block mb-2 text-sm font-medium text-gray-900">Desconto para pagamento em
                                        boleto: (OPCIONAL)</label>
                                    <div class="relative">
                                        <p
                                            class="absolute right-0 bg-[#616161] text-white h-full p-4 flex items-center justify-center rounded-r-lg font-bold text-lg">
                                            %</p>
                                        <input type="number" id="boleto-discount" v-model="event.boleto_discount"
                                            class="border border-gray-300 font-bold text-sm rounded-lg block w-full p-2.5 shadow-all" />

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- pix -->
            <div class="shadow-all rounded-3xl mt-8">
                <div class="bg-[#F1F1F1] p-4 flex items-center justify-between rounded-t-3xl">
                    <div class="flex items-center">
                        <input id="pix" type="checkbox" v-model="pix"
                            class="w-5 h-5 text-[#616161] bg-white border-2 border-[#616161] rounded focus:ring-[#616161] focus:ring-2" />
                        <label for="pix" class="ml-2 text-[#191919] font-bold text-base">Pagamento Instantâneo (PIX) {{ pix
                        }}</label>
                    </div>
                    <div>
                        SVG
                    </div>
                </div>
                <div>
                    <div class="py-4 px-6">
                        <p class="text-[#000000]">
                            O boleto será emitido com 2 dias de prazo para pagamento sendo o reconhecimento automático pelo
                            sistema em até 3 dias úteis após pago. Se o boleto não for pedido é automaticamente cancelado e
                            o
                            cliente
                            notificado por e-mail.
                        </p>
                        <div v-if="pix" class="mt-4">
                            <hr>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label for="pix-available-until"
                                        class="block mb-2 text-sm font-medium text-gray-900">Método de
                                        pagamento
                                        disponível até:*</label>
                                    <input type="date" id="pix-available-until" v-model="event.pix_available_until"
                                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all" />
                                </div>
                                <div>
                                    <label for="pix-discount" class="block mb-2 text-sm font-medium text-gray-900">Desconto
                                        para pagamento no PIX: (OPCIONAL)</label>
                                    <div class="relative">
                                        <p
                                            class="absolute right-0 bg-[#616161] text-white h-full p-4 flex items-center justify-center rounded-r-lg font-bold text-lg">
                                            %</p>
                                        <input type="number" id="pix-discount" v-model="event.pix_discount"
                                            class="border border-gray-300 font-bold text-sm rounded-lg block w-full p-2.5 shadow-all" />

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- credit card -->
            <div class="shadow-all rounded-3xl mt-8">
                <div class="bg-[#F1F1F1] p-4 flex items-center justify-between rounded-t-3xl">
                    <div class="flex items-center">
                        <input id="credit-card" type="checkbox" v-model="credit_card"
                            class="w-5 h-5 text-[#616161] bg-white border-2 border-[#616161] rounded focus:ring-[#616161] focus:ring-2" />
                        <label for="credit-card" class="ml-2 text-[#191919] font-bold text-base">Cartão de crédito (Master,
                            Visa, Elo e Hipercard) {{ credit_card
                            }}</label>
                    </div>
                    <div>
                        SVG
                    </div>
                </div>
                <div>
                    <div class="py-4 px-6">
                        <p class="text-[#000000]">
                            O boleto será emitido com 2 dias de prazo para pagamento sendo o reconhecimento automático pelo
                            sistema em até 3 dias úteis após pago. Se o boleto não for pedido é automaticamente cancelado e
                            o
                            cliente
                            notificado por e-mail.
                        </p>
                        <div v-if="credit_card" class="mt-4">
                            <hr>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label for="credit-card-credit-card-allow-payment-in-up-to"
                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Permitir
                                        parcelar em até:*</label>
                                    <select id="credit-card-credit-card-allow-payment-in-up-to"
                                        v-model="event.credit_card_allow_payment_in_up_to"
                                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all">
                                        <option selected>{{ event.credit_card_allow_payment_in_up_to }}</option>
                                        <option>1</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                        <option>6</option>
                                        <option>7</option>
                                        <option>8</option>
                                        <option>9</option>
                                        <option>10</option>
                                        <option>11</option>
                                        <option>12</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="credit-card-installments-permitted-for-amounts-above"
                                        class="block mb-2 text-sm font-medium text-gray-900">Parcelamento permitido para
                                        valores acima de:(OPCIONAL)</label>
                                    <div class="relative">
                                        <p
                                            class="absolute left-0 bg-[#616161] text-white h-full p-4 flex items-center justify-center rounded-l-lg font-bold text-lg">
                                            R$</p>
                                        <input type="number" id="credit-card-installments-permitted-for-amounts-above"
                                            v-model="event.credit_card_installments_permitted_for_amounts_above"
                                            class="border border-gray-300 font-bold text-sm rounded-lg block w-full p-2.5 shadow-all pl-16" />

                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label for="credit-card-minimum-installment-value"
                                        class="block mb-2 text-sm font-medium text-gray-900">Valor mínimo da
                                        parcela:(OPCIONAL)</label>
                                    <div class="relative">
                                        <p
                                            class="absolute left-0 bg-[#616161] text-white h-full p-4 flex items-center justify-center rounded-l-lg font-bold text-lg">
                                            R$</p>
                                        <input type="number" id="credit-card-minimum-installment-value"
                                            v-model="event.credit_card_minimum_installment_value"
                                            class="border border-gray-300 font-bold text-sm rounded-lg block w-full p-2.5 shadow-all pl-16" />

                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-4">
                                <div>
                                    <label for="credit-card-available-until"
                                        class="block mb-2 text-sm font-medium text-gray-900">Método de
                                        pagamento
                                        disponível até:*</label>
                                    <input type="date" id="credit-card-available-until"
                                        v-model="event.credit_card_available_until"
                                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all" />
                                </div>
                                <div>
                                    <label for="credit-card-discount"
                                        class="block mb-2 text-sm font-medium text-gray-900">Desconto para pagamento em 1x:
                                        (OPCIONAL)</label>
                                    <div class="relative">
                                        <p
                                            class="absolute right-0 bg-[#616161] text-white h-full p-4 flex items-center justify-center rounded-r-lg font-bold text-lg">
                                            %</p>
                                        <input type="number" id="credit-card-discount" v-model="event.credit_card_discount"
                                            class="border border-gray-300 font-bold text-sm rounded-lg block w-full p-2.5 shadow-all" />

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="rounded-3xl mt-6 shadow-all">
                <div class="bg-gradient-to-b from-[#0DCD71] to-[#008847] p-4 rounded-t-3xl">
                    <h1 class="text-center text-white text-base font-semibold">ESCOLHA AS FORMAS DE PAGAMENTO PARA CADA
                        INSCRIÇÃO</h1>
                </div>
                <div class="px-4 pt-2 pb-8">
                    <div class="grid grid-cols-12 items-center text-center mt-2">
                        <h1 class="col-span-2 text-[#191919] font-semibold text-sm">Inscrições</h1>
                        <h1 class="col-span-2 text-[#191919] font-semibold text-sm">Boleto</h1>
                        <h1 class="col-span-2 text-[#191919] font-semibold text-sm">PIX</h1>
                        <div class="col-span-5 grid grid-cols-2 shadow-all rounded-3xl mx-8">
                            <h1 class="text-[#191919] font-semibold text-sm">Cartão de crédito</h1>
                            <h1 class="text-[#191919] font-semibold text-sm">Quantidade de parcela</h1>
                        </div>
                        <h1 class="col-span-1 text-[#191919] font-semibold text-sm text-center">Data personalizada</h1>
                    </div>
                    <div class="bg-[#9F9F9F] rounded-xl p-4 mt-4 flex flex-col gap-y-4">
                        <div v-for="inscription in inscriptionsWithPayments">
                            <div class="bg-white rounded-xl grid grid-cols-12 text-center py-4 items-center relative">
                                <h1 class="col-span-2 text-[#191919] font-normal text-sm">
                                    {{ inscription.name }}
                                </h1>
                                <div class="col-span-2">
                                    <input :id="'boleto-' + inscription.id" type="checkbox"
                                        v-model="inscription.selectedBoleto" :disabled="!boleto"
                                        :class="{ 'opacity-50': !boleto }"
                                        class="w-5 h-5 text-[#616161] bg-white border-2 border-[#616161] rounded focus:ring-[#616161] focus:ring-2" />
                                    {{ inscription.selectedBoleto }}
                                </div>
                                <div class="col-span-2">
                                    <input :id="'pix-' + inscription.id" type="checkbox" v-model="inscription.selectedPix"
                                        :disabled="!pix" :class="{ 'opacity-50': !pix }"
                                        class="w-5 h-5 text-[#616161] bg-white border-2 border-[#616161] rounded focus:ring-[#616161] focus:ring-2" />
                                    {{ inscription.selectedPix }}

                                </div>
                                <div class="col-span-5 grid grid-cols-2 items-center">
                                    {{ inscription.number_of_installments }}
                                    <div>
                                        <input :id="'credit-card-' + inscription.id" type="checkbox"
                                            :checked="inscription.selectedCreditCard" :disabled="!credit_card"
                                            :class="{ 'opacity-50': !credit_card }"
                                            class="w-5 h-5 text-[#616161] bg-white border-2 border-[#616161] rounded focus:ring-[#616161] focus:ring-2"
                                            @change="handleCheckboxClick(inscription)" />
                                        {{ inscription.selectedCreditCard }}

                                    </div>
                                    <div class="relative">
                                        <input :id="'credit-card-' + inscription.id" type="number"
                                            v-model="inscription.credit_card.number_of_installments"
                                            :disabled="!credit_card || !inscription.selectedCreditCard"
                                            :class="['installments-input', { 'opacity-50': !credit_card || !inscription.selectedCreditCard }]"
                                            class="text-[#616161] bg-white font-bold w-20 shadow-all border-none rounded-2xl focus:ring-[#616161] focus:ring-2 text-center"
                                            @input="validateInstallments(inscription)" />

                                        <div class="absolute right-8 -mt-2 top-0 flex flex-col items-center justify-center gap-2">
                                            <button type="button" class="p-2 rounded-t-lg"
                                                @click="increaseInstallments(inscription)"
                                                :class="(!credit_card || !inscription.selectedCreditCard) ? 'bg-[#a5a3a3]' : 'bg-[#616161]'"
                                                :disabled="!credit_card || !inscription.selectedCreditCard">
                                                <svg width="14" height="9" viewBox="0 0 14 9" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M12.7485 8.10526L14 6.87592L7 -7.54592e-06L1.46596e-08 6.87592L1.25152 8.10526L7 2.45866L12.7485 8.10526Z"
                                                        fill="white" />
                                                </svg>
                                            </button>
                                            <button type="button" class="p-2 rounded-b-lg"
                                                @click="decreaseInstallments(inscription)"
                                                :class="(!credit_card || !inscription.selectedCreditCard) ? 'bg-[#a5a3a3]' : 'bg-[#616161]'"
                                                :disabled="!credit_card || !inscription.selectedCreditCard">
                                                <svg width="14" height="9" viewBox="0 0 14 9" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M1.25151 0.894744L8.31543e-07 2.12408L7 9.00001L14 2.12408L12.7485 0.894745L7 6.54134L1.25151 0.894744Z"
                                                        fill="white" />
                                                </svg>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                                        class="w-6 h-6">
                                        <path
                                            d="M12.75 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM7.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM8.25 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM9.75 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM10.5 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM12.75 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM14.25 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 13.5a.75.75 0 100-1.5.75.75 0 000 1.5z" />
                                        <path fill-rule="evenodd"
                                            d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="flex justify-between pt-12">
                <button type="button" v-if="step > 1" @click="step--"
                    class="bg-red-300 px-8 py-2 rounded-xl text-white font-bold">
                    Voltar
                </button>
                <button type="submit" class="bg-green px-8 py-2 rounded-xl text-white font-bold">
                    Avançar {{ step }}
                </button>
            </div>

        </form>
    </div>
</template>
<script setup>
import { reactive, ref, watch, computed } from "vue";
import { step } from "@/Pages/Event/step.js";
import moment from "moment";
import { useForm as usePrecognitionForm } from "laravel-precognition-vue";
import { router, useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const toast = useToast();

const props = defineProps({
    inscriptions: Array,
    event: Object,
});

const boleto = ref(false);
const pix = ref(false);
const credit_card = ref(false);

const inscriptionsWithPayments = computed(() => {
    return props.inscriptions.map(inscription => {

        const isCreditCardNull = inscription.credit_card === null;

        if (isCreditCardNull) {
            inscription.credit_card = { number_of_installments: 1 };
        } else if (!inscription.credit_card.number_of_installments) {
            inscription.credit_card.number_of_installments = 1;
        }

        return {
            ...inscription,
            selectedBoleto: inscription.boleto !== null,
            selectedPix: inscription.pix !== null,
            selectedCreditCard: !isCreditCardNull
        };
    });
});


function validateInstallments(inscription) {
    // if (!inscription.selectedCreditCard) return;

    if (inscription.credit_card.number_of_installments < 1) {
        inscription.credit_card.number_of_installments = 1;
    } else if (inscription.credit_card.number_of_installments > 12) {
        inscription.credit_card.number_of_installments = 12;
    }
}


watch(inscriptionsWithPayments, (newValue) => {
    newValue.forEach(validateInstallments);
}, { deep: true });

function increaseInstallments(inscription) {
    inscription.credit_card.number_of_installments++;
    validateInstallments(inscription);
}

function decreaseInstallments(inscription) {
    inscription.credit_card.number_of_installments--;
    validateInstallments(inscription);
}


boleto.value = inscriptionsWithPayments.value.some(inscription => inscription.selectedBoleto);
pix.value = inscriptionsWithPayments.value.some(inscription => inscription.selectedPix);
credit_card.value = inscriptionsWithPayments.value.some(inscription => inscription.selectedCreditCard);


watch(boleto, (newVal) => {
    inscriptionsWithPayments.value.forEach(inscription => {
        inscription.selectedBoleto = newVal;
    });
});
watch(pix, (newVal) => {
    inscriptionsWithPayments.value.forEach(inscription => {
        inscription.selectedPix = newVal;
    });
});
watch(credit_card, (newVal) => {
    inscriptionsWithPayments.value.forEach(inscription => {
        inscription.selectedCreditCard = newVal;
    });
});

function handleCheckboxClick(inscription) {

    inscription.selectedCreditCard = !inscription.selectedCreditCard;

    inscription.credit_card.number_of_installments++;
    inscription.credit_card.number_of_installments--;

    console.log(inscription.id, inscription.selectedCreditCard);
    if (inscription.selectedCreditCard) {
        inscription.credit_card.number_of_installments = 1;
    }
}

function paymentMethods() {

    const formData = {
        boleto: boleto.value,
        boleto_available_until: props.event.boleto_available_until,
        boleto_discount: props.event.boleto_discount,
        pix: pix.value,
        pix_available_until: props.event.pix_available_until,
        pix_discount: props.event.pix_discount,
        credit_card: credit_card.value,
        credit_card_allow_payment_in_up_to: props.event.credit_card_allow_payment_in_up_to,
        credit_card_installments_permitted_for_amounts_above: props.event.credit_card_installments_permitted_for_amounts_above,
        credit_card_minimum_installment_value: props.event.credit_card_minimum_installment_value,
        credit_card_available_until: props.event.credit_card_available_until,
        credit_card_discount: props.event.credit_card_discount,
        inscriptions: inscriptionsWithPayments.value.map(inscription => {
            return {
                id: inscription.id,
                selectedBoleto: inscription.selectedBoleto,
                selectedPix: inscription.selectedPix,
                selectedCreditCard: inscription.selectedCreditCard,
                number_of_installments: inscription.credit_card.number_of_installments
            };
        })

    };

    router.post(
        route("event.payment.methods", { id: props.event.id }),
        formData,
        {
            preserveScroll: true,
        }
    );

    toast.success("Métodos de pagamentos salvos com Sucesso!", {
        position: "top-right",
        duration: 5000,
    });
}
</script>
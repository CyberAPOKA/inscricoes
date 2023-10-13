<template>
    <div>

        <form @submit.prevent="productUpdate">
            <div class="flex flex-col gap-8">
                <div v-for="(inscription, index) in inscriptions" :key="inscription.id"
                    class="bg-[#616161] rounded-2xl shadow-all">
                    <div :id="'accordion-collapse-' + inscription.id" data-accordion="collapse">
                        <div class="flex flex-col md:flex-row justify-center md:justify-between items-center rounded-xl relative p-4 bg-white gap-2"
                            :class="{ 'md:shadow-xt': expandedInscriptionItems.includes(inscription.id) }">
                            <div class="flex items-center gap-4 pl-4 border-r-2 pr-20">
                                <div class="target-item-inscriptions cursor-grab" draggable="true"
                                    @dragstart="dragStartInscription(inscription.index)"
                                    @drop="dragDropInscription(inscription.index)" @dragover="dragOverInscription"
                                    @dragleave="dragLeaveInscription" @dragend="dragEndInscription">

                                    <svg class="h-4 w-4" viewBox="0 0 7 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="5.375" cy="1.49164" r="1.125" fill="#616161" />
                                        <circle cx="5.375" cy="4.86664" r="1.125" fill="#616161" />
                                        <circle cx="5.375" cy="8.24164" r="1.125" fill="#616161" />
                                        <circle cx="1.125" cy="1.49164" r="1.125" fill="#616161" />
                                        <circle cx="1.125" cy="4.86664" r="1.125" fill="#616161" />
                                        <circle cx="1.125" cy="8.24164" r="1.125" fill="#616161" />
                                    </svg>
                                </div>
                                <h1 class="text-[#616161] font-bold text-base">{{ inscription.name }}</h1>
                            </div>
                            <div class="flex gap-2">
                                <p class="text-[#616161] font-medium text-base">{{ inscription.participants }} Atleta(s)
                                </p>
                                <p class="bg-[#616161] px-2 rounded-md text-white">
                                    {{ inscription.modality }}
                                </p>
                            </div>
                            <div class="border-l-2 pl-20">
                                <h2 class="" :id="'accordion-collapse-heading-' + inscription.id">
                                    <button type="button" @click="toggleInscriptionAccordionItem(inscription.id)"
                                        :aria-expanded="expandedInscriptionItems.includes(inscription.id)"
                                        :aria-controls="'accordion-collapse-body-' + inscription.id">
                                        <svg data-accordion-icon class="w-4 h-4"
                                            :class="{ 'rotate-180': expandedInscriptionItems.includes(inscription.id) }"
                                            viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M1.645 8.8667L7 3.92203L12.355 8.8667L14 7.34443L7 0.8667L-1.30708e-07 7.34443L1.645 8.8667Z"
                                                fill="#191919" />
                                        </svg>
                                    </button>
                                </h2>
                            </div>
                        </div>
                        <div :id="'accordion-collapse-body-' + inscription.id" class="block"
                            v-show="expandedInscriptionItems.includes(inscription.id)"
                            :aria-labelledby="'accordion-collapse-heading-' + inscription.id">
                            <div class="bg-[#616161] -mt-2 px-2 flex flex-col items-center pb-6 rounded-b-xl gap-20 pt-6">
                               
                              
                                <div class="p-2 w-full rounded-xl flex flex-col gap-4">
                                    <div v-for="(kitInscription, kitIndex) in inscription.kits" :key="kitInscription.id">
                                        <div :id="'accordion-collapse-' + kitInscription.id"
                                            :data-accordion="'collapse-' + kitInscription.id">
                                            <div
                                                class="bg-[#FFF9AE] flex flex-col md:flex-row justify-center md:justify-between items-center rounded-2xl relative gap-2 w-full shadow-lg p-4">
                                                <div class="flex gap-2 ml-4 justify-center items-center">
                                                    <div class="target-item-kit-inscription cursor-grab" draggable="true"
                                                        @dragstart="dragStartKitInscription(index, kitIndex)"
                                                        @drop="dragDropKitInscription(index, kitIndex)"
                                                        @dragover="dragOverKitInscription"
                                                        @dragleave="dragLeaveKitInscription"
                                                        @dragend="dragEndKitInscription">
                                                        <svg class="h-4 w-4" viewBox="0 0 7 10" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <circle cx="5.375" cy="1.49164" r="1.125" fill="#616161" />
                                                            <circle cx="5.375" cy="4.86664" r="1.125" fill="#616161" />
                                                            <circle cx="5.375" cy="8.24164" r="1.125" fill="#616161" />
                                                            <circle cx="1.125" cy="1.49164" r="1.125" fill="#616161" />
                                                            <circle cx="1.125" cy="4.86664" r="1.125" fill="#616161" />
                                                            <circle cx="1.125" cy="8.24164" r="1.125" fill="#616161" />
                                                        </svg>
                                                    </div>
                                                    <h2 class="text-[#191919] font-bold text-base">
                                                        {{ kitInscription.kit.name }}
                                                    </h2>
                                                </div>
                                                <div class="grid grid-cols-2 gap-2 md:grid-cols-3 lg:grid-cols-4 py-2">
                                                    <div v-for="productRelation in kitInscription.kit.products"
                                                        :key="productRelation.id">
                                                        <p class="bg-[#616161] px-2 rounded-md text-white">
                                                            {{ productRelation.product.name }}
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="block"></div>
                                                <h2 :id="'accordion-collapse-heading-kit-' + kitInscription.id"
                                                    class="bg-[#191919] top-0 right-0 absolute rounded-r-2xl h-full flex items-center justify-center">

                                                    <button type="button"
                                                        class="flex items-center justify-between w-full p-5 font-medium text-left text-white bg-[#191919] rounded-r-2xl"
                                                        @click="toggleKitAccordionItem(kitInscription.id)">
                                                        <svg data-accordion-icon class="w-3 h-3 shrink-0"
                                                            :class="expandedKitItems.includes(kitInscription.id) ? 'rotate-180' : 'rotate-0'"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 10 6">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                                        </svg>

                                                    </button>
                                                </h2>
                                            </div>
                                            <div :id="'accordion-collapse-body-kit-' + kitInscription.id" class="block"
                                                v-show="expandedKitItems.includes(kitInscription.id)">
                                                <div class="p-4 bg-[#F9F9F9] pt-8 rounded-b-xl flex flex-col gap-4 -mt-4">
                                                    <div v-for="productRelation in kitInscription.kit.products"
                                                        :key="productRelation.id">
                                                        <div
                                                            class="shadow-all w-full flex items-center justify-between relative rounded-2xl">
                                                            <p class="ml-2 text-[#616161] font-normal text-sm">
                                                                {{ productRelation.product.name }}
                                                            </p>
                                                            <!-- {{ productRelation.quantity }} - {{ inscription.participants }} -->
                                                            <div class="bg-[#FFEC00] flex gap-3 px-4 py-1 rounded-3xl"
                                                                v-show="productRelation.quantity !== inscription.participants">
                                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M9 0C4.032 0 0 4.032 0 9C0 13.968 4.032 18 9 18C13.968 18 18 13.968 18 9C18 4.032 13.968 0 9 0ZM8.1 13.5V11.7H9.9V13.5H8.1ZM8.1 4.5V9.9H9.9V4.5H8.1Z"
                                                                        fill="#191919" />
                                                                </svg>
                                                                <p class="text-[#191919] text-xs font-normal">Quantidade do
                                                                    produto diferente da quantidade de atletas na inscrição.
                                                                </p>
                                                            </div>
                                                            <div class="flex items-center justify-center h-full px-2 gap-1 rounded-r-2xl"
                                                                :class="{ 'bg-[#FFEC00]': productRelation.quantity !== inscription.participants, 'bg-[#65DC2E]': productRelation.quantity === inscription.participants }">
                                                                <p class="text-[#191919] font-medium text-xs">Quantidade:
                                                                </p>
                                                                <div
                                                                    class=" text-gray-900 text-sm rounded-lg block w-full text-center">
                                                                    <div
                                                                        class="flex justify-center items-center py-2 gap-1">
                                                                        <button type="button"
                                                                            @click="decreaseNumberProductQuantity(productRelation)"
                                                                            class="bg-[#277901] text-white py-[0.35rem] w-4 rounded-l-md text-xl">
                                                                            <p class="mb-[0.05rem]">-</p>
                                                                        </button>
                                                                        <input type="number" id="product-quantity"
                                                                            v-model="productRelation.quantity"
                                                                            class="text-black font-bold text-base text-center w-10 max-h-full border-none px-0"
                                                                            @input="handleInputChange(productRelation)" />


                                                                        <button type="button"
                                                                            @click="increaseNumberProductQuantity(productRelation)"
                                                                            class="bg-[#277901] text-white py-[0.35rem] w-4 rounded-r-md text-xl">
                                                                            <p class="mb-[0.05rem]">+</p>
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
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
import { ref, watch } from "vue";
import { router } from "@inertiajs/vue3";
import { step } from "@/Pages/Event/step.js";

const props = defineProps({
    inscriptions: Array,
    eventId: Number,
});

// START DRAG INSCRIPTIONS
let draggedItemIndex = ref(null);
function dragStartInscription(index) {
    draggedItemIndex.value = index;
}
function dragOverInscription(event) {
    event.preventDefault();
    event.target.closest(".target-item-inscriptions");
}
function dragLeaveInscription(event) {
    event.target.closest(".target-item-inscriptions");
}
function dragEndInscription() {
    draggedItemIndex.value = null;
}
function dragDropInscription(targetIndex) {
    event.target.closest(".target-item-inscriptions");
    if (draggedItemIndex.value !== null && draggedItemIndex.value !== targetIndex) {
        let sourceIndex = draggedItemIndex.value;
        let temp = props.inscriptions[sourceIndex];
        props.inscriptions.splice(sourceIndex, 1);
        props.inscriptions.splice(targetIndex, 0, temp);

        for (let i = 0; i < props.inscriptions.length; i++) {
            props.inscriptions[i].index = i;
        }

        router.put(
            route("event.inscription.order", { id: props.eventId }),
            { inscriptions: props.inscriptions },
            {
                preserveScroll: true,
            }
        );
    }
}
// END DRAG INSCRIPTIONS

// START DRAG KIT INSCRIPTION
let draggedItemIndexKitInscription = ref(null);
let draggedKitInscriptionIndex = ref(null);
let draggedInscriptionIndex = ref(null);

function dragOverKitInscription(event) {
    event.preventDefault();
    event.target.closest(".target-item-kit-inscription");
}
function dragLeaveKitInscription(event) {
    event.target.closest(".target-item-kit-inscription");
}
function dragEndKitInscription() {
    draggedItemIndexKitInscription.value = null;
}

function dragStartKitInscription(inscriptionIndex, kitInscriptionIndex) {
    draggedInscriptionIndex.value = inscriptionIndex;
    draggedKitInscriptionIndex.value = kitInscriptionIndex;
}

// (NÃO REMOVER). PERMITE ARRASTAR OS KITS PARA OUTRAS INSCRIÇÕES, PODE SER ÚTIL NO FUTURO.
// function dragDropKitInscription(targetInscriptionIndex, targetKitInscriptionIndex) {
//     if (draggedInscriptionIndex.value !== null && draggedKitInscriptionIndex.value !== null) {

//         let draggedKit = props.inscriptions[draggedInscriptionIndex.value].kits[draggedKitInscriptionIndex.value];

//         props.inscriptions[draggedInscriptionIndex.value].kits.splice(draggedKitInscriptionIndex.value, 1);

//         props.inscriptions[targetInscriptionIndex].kits.splice(targetKitInscriptionIndex, 0, draggedKit);

//         draggedInscriptionIndex.value = null;
//         draggedKitInscriptionIndex.value = null;

//         let kitInscriptionOrder = props.inscriptions.map(inscription => {
//             return {
//                 inscription_id: inscription.id,
//                 kit_ids: inscription.kits.map(kitInscription => {
//                     return {
//                         id: kitInscription.id,
//                         index: kitInscription.index
//                     };
//                 })
//             };
//         });

//         router.put(
//             route("event.kit.inscription.order", { id: props.eventId }),
//             {
//                 order: kitInscriptionOrder
//             },
//             {
//                 preserveScroll: true,
//             }
//         );
//     }
// }

//NÃO PERMITE QUE O USUÁRIO ARRASTE OS KITS PARA OUTRAS INSCRIÇÕES.
function dragDropKitInscription(targetInscriptionIndex, targetKitInscriptionIndex) {
    if (draggedInscriptionIndex.value === targetInscriptionIndex) {
        if (draggedInscriptionIndex.value !== null && draggedKitInscriptionIndex.value !== null) {

            let draggedKit = props.inscriptions[draggedInscriptionIndex.value].kits[draggedKitInscriptionIndex.value];

            props.inscriptions[draggedInscriptionIndex.value].kits.splice(draggedKitInscriptionIndex.value, 1);

            props.inscriptions[targetInscriptionIndex].kits.splice(targetKitInscriptionIndex, 0, draggedKit);

            draggedInscriptionIndex.value = null;
            draggedKitInscriptionIndex.value = null;

            let kitInscriptionOrder = props.inscriptions.map(inscription => {
                return {
                    inscription_id: inscription.id,
                    kit_ids: inscription.kits.map(kitInscription => {
                        return {
                            id: kitInscription.id,
                            index: kitInscription.index
                        };
                    })
                };
            });

            router.put(
                route("event.kit.inscription.order", { id: props.eventId }),
                {
                    order: kitInscriptionOrder
                },
                {
                    preserveScroll: true,
                }
            );
        }
    } else {

        alert("Você não pode mover kits entre inscrições diferentes!");
    }
}
// END DRAG KIT INSCRIPTION



// START ACCORDION INSCRIPTION
const expandedInscriptionItems = ref(props.inscriptions.map((i) => i.id));

const toggleInscriptionAccordionItem = (itemId) => {
    const index = expandedInscriptionItems.value.indexOf(itemId);
    if (index === -1) {
        expandedInscriptionItems.value.push(itemId);
    } else {
        expandedInscriptionItems.value.splice(index, 1);
    }
};
// END ACCORDION INSCRIPTION

const changedProducts = ref([]);

function increaseNumberProductQuantity(productRelation) {
    if (productRelation.quantity < 200) {
        productRelation.quantity++;
        addChangedProduct(productRelation);
    }
}

function decreaseNumberProductQuantity(productRelation) {
    if (productRelation.quantity > 0) {
        productRelation.quantity--;
        addChangedProduct(productRelation);
    }
}

function addChangedProduct(productRelation) {
    console.log(productRelation);
    const existingProduct = changedProducts.value.find(p => p.id === productRelation.id);
    if (!existingProduct) {
        changedProducts.value.push({
            id: productRelation.id,
            quantity: productRelation.quantity
        });
    } else {
        existingProduct.quantity = productRelation.quantity;
    }
}

function handleInputChange(productRelation) {
    if (productRelation.quantity < 0) {
        productRelation.quantity = 0;
    } else if (productRelation.quantity > 200) {
        productRelation.quantity = 200;
    }
    addChangedProduct(productRelation);
}


function productUpdate() {
    router.put(
        route("event.product.quantity.update", { id: props.eventId }),
        {
            productsRelation: changedProducts.value,
        },
        {
            preserveScroll: true,
        }
    );
}

//iniciar segundo accordion fechado
// const expandedKitItems = ref([]);

//iniciar segundo accordion aberto
const expandedKitItems = ref(
    props.inscriptions.flatMap(inscription => inscription.kits.map(kit => kit.id))
);


const toggleKitAccordionItem = (itemId) => {
    const index = expandedKitItems.value.indexOf(itemId);
    if (index === -1) {
        expandedKitItems.value.push(itemId);
    } else {
        expandedKitItems.value.splice(index, 1);
    }
};

</script>
<style>
#product-quantity {}
</style>
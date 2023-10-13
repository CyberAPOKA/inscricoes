<template>
    <teleport to="body">
        <transition leave-active-class="duration-200">
            <div v-show="show" class="fixed inset-0 overflow-y-auto px-4 py-6 sm:px-0 z-50 flex justify-center items-center"
                scroll-region>
                <transition enter-active-class="ease-out duration-300" enter-from-class="opacity-0"
                    enter-to-class="opacity-100" leave-active-class="ease-in duration-200" leave-from-class="opacity-100"
                    leave-to-class="opacity-0">
                    <div v-show="show" class="fixed inset-0 transform transition-all" @click="close">
                        <div class="absolute inset-0 modal-backdrop" />
                    </div>
                </transition>

                <transition enter-active-class="ease-out duration-300"
                    enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                    enter-to-class="opacity-100 translate-y-0 sm:scale-100" leave-active-class="ease-in duration-200"
                    leave-from-class="opacity-100 translate-y-0 sm:scale-100"
                    leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <div v-show="show"
                        class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto"
                        :class="maxWidthClass" v-if="product">
                        <form @submit.prevent="updateProduct(product)">
                            <div>
                                <div class="p-4 border-b rounded-t dark:border-gray-600">
                                    <h3 class="text-3xl font-black text-black">
                                        EDITAR PRODUTO:
                                    </h3>
                                </div>
                                <div class="p-6">
                                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                        <div class="md:col-span-3">
                                            <label for="product-name"
                                                class="block mb-2 text-sm font-medium text-gray-900">Nome
                                                do
                                                Produto*</label>
                                            <input type="text" id="product-name" v-model="product.name"
                                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all" />
                                        </div>
                                        <div class="md:col-span-1">
                                            <label for="product-maximum_amount"
                                                class="block mb-2 text-sm font-medium text-gray-900">Quantidade para
                                                venda</label>
                                            <input type="number" id="product-maximum_amount"
                                                v-model="product.maximum_amount"
                                                class="border border-gray-300 font-bold text-sm rounded-lg block w-full p-2.5 shadow-all" />
                                        </div>
                                    </div>
                                    <div class="bg-[#277901] flex items-center gap-4 mt-4 rounded-xl w-full p-4">
                                        <h1 class="text-white font-medium text-sm mx-4">
                                            Este produto terá alguma variação? Ex: Cores, tamanhos,
                                            modelos e etc.
                                        </h1>
                                        <div class="flex items-center justify-center bg-white rounded-xl w-full py-6 gap-2">
                                            <p class="text-[#616161] font-normal text-sm">
                                                Adicionar variação para esse produto
                                            </p>
                                            <label class="relative inline-flex items-center cursor-pointer">
                                                <input type="checkbox" v-model="productVariation" class="sr-only peer"
                                                    true-value="yes" false-value="no" />
                                                <div
                                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <div v-show="productVariation === 'yes'">
                                        <div>
                                            <form @submit.prevent="createVariation(product.id)"
                                                class="grid grid-cols-1 md:grid-cols-4 gap-4 pt-4">
                                                <div class="md:col-span-2">
                                                    <label for="product-variation-variation-create"
                                                        class="block mb-2 text-sm font-medium text-gray-900">Variação</label>
                                                    <input type="text" id="product-variation-variation-create"
                                                        v-model="variationForm.variation"
                                                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all" />
                                                </div>
                                                <div class="md:col-span-1">
                                                    <label for="product-variation-amount-create"
                                                        class="block mb-2 text-sm font-medium text-gray-900">Quantidade por
                                                        variação</label>
                                                    <input type="number" id="product-variation-amount-create"
                                                        v-model="variationForm.amount"
                                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all" />
                                                </div>
                                                <button
                                                    class="md:col-span-1 flex justify-center items-center gap-2 bg-[#0DCD71] px-6 text-white font-bold text-xs rounded-lg uppercase hover:cursor-pointer md:mt-6 py-3"
                                                    type="submit">
                                                    <SvgBug />
                                                    <span>Salvar</span>
                                                </button>
                                            </form>
                                        </div>
                                        <variationUpdateModalFile :show="showModal" @close="closeVariationUpdateModalFunc"
                                            :variation="selectedVariation" />
                                        <deleteVariationModalFile :show="showDeleteModal"
                                            @close="closeVariationDeleteModalFunc" :id="variationId"
                                            @variationDeleted="removeVariation" />

                                        <div class="max-h-96 overflow-y-auto overflow-x-hidden p-2">
                                            <div v-for="variation in product.variations" :key="variation.id">
                                                <div
                                                    class="bg-white shadow-all flex justify-between items-center w-full mt-4 rounded-xl relative">
                                                    <p
                                                        class="ml-4 pr-4 border-r-2 border-r-[#CECECE] font-bold text-base text-[#616161]">
                                                        {{ variation.variation }}
                                                    </p>
                                                    <p class="font-bold text-base text-[#616161]">
                                                        {{ variation.amount }}
                                                    </p>
                                                    <div
                                                        class="bg-[#616161] flex items-center gap-12 md:gap-4 p-4 rounded-r-xl rounded-l-xl md:rounded-l-none">
                                                        <button @click="() => variationUpdateModal(variation)"
                                                            type="button">
                                                            <SvgBug />
                                                        </button>

                                                        <button @click="() => variationDeleteModal(variation.id)"
                                                            type="button">
                                                            <SvgBug />
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal footer -->
                            <div
                                class="flex items-center justify-between p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                <button type="button"
                                    class="md:w-52 flex justify-center gap-2 items-center bg-[#FF7171] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all"
                                    @click="close">
                                    <SvgBug />
                                    <span>Cancelar</span>
                                </button>
                                <button
                                    class="md:w-52 flex justify-center items-center gap-2 bg-[#0DCD71] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all hover:cursor-pointer"
                                    type="submit">
                                    <SvgBug />
                                    <span>SALVAR PRODUTO</span>
                                </button>
                            </div>
                        </form>
                        <slot v-if="show" />
                    </div>
                    <div v-else>Erro desconhecido.</div>
                </transition>
            </div>
        </transition>
    </teleport>
</template>

<script setup>
import { computed, onMounted, onUnmounted, watch, ref } from 'vue';
import { router, useForm } from "@inertiajs/vue3";
import SvgBug from "@/Pages/Svgs/SvgBug.vue";
import variationUpdateModalFile from "@/Pages/Event/Partials/Components/variationUpdateModal.vue";
import deleteVariationModalFile from "@/Pages/Event/Partials/Components/deleteVariationModal.vue";
import axios from 'axios';

const props = defineProps({
    product: {
        type: Object,
    },
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '6xl',
    },
    closeable: {
        type: Boolean,
        default: true,
    },
    type: {
        type: String
    },
});

const emit = defineEmits(['close']);

watch(() => props.show, () => {
    if (props.show) {
        document.body.style.overflow = 'hidden';
    } else {
        document.body.style.overflow = null;
    }
});

const close = () => {
    if (props.closeable) {
        emit('close');
    }
};

const closeOnEscape = (e) => {
    if (e.key === 'Escape' && props.show) {
        close();
    }
};

onMounted(() => document.addEventListener('keydown', closeOnEscape));

onUnmounted(() => {
    document.removeEventListener('keydown', closeOnEscape);
    document.body.style.overflow = null;
});

const maxWidthClass = computed(() => {
    return {
        'sm': 'sm:max-w-sm',
        'md': 'sm:max-w-md',
        'lg': 'sm:max-w-lg',
        'xl': 'sm:max-w-xl',
        '2xl': 'sm:max-w-2xl',
        '3xl': 'sm:max-w-3xl',
        '4xl': 'sm:max-w-4xl',
        '5xl': 'sm:max-w-5xl',
        '6xl': 'sm:max-w-6xl',
    }[props.maxWidth];
});

function updateProduct(product) {
    router.put(
        route("event.product.update", { id: product.id }),
        {
            name: product.name,
            maximum_amount: product.maximum_amount,
            has_variations: productVariation.value
        },
        {
            preserveScroll: true,
        }
    );
}

const productVariation = ref('no');

watch(() => props.product?.variations, (newVariations) => {
    productVariation.value = (newVariations && newVariations.length > 0) ? 'yes' : 'no';
}, { immediate: true });

const variationForm = useForm({
    variation: "",
    amount: "",
});

const createVariation = () => {
    axios.post(route("event.product.variation.create", { id: props.product.id }), variationForm)
        .then(response => {
            if (response.data && response.data.id) {
                props.product.variations.push(response.data);
            }
        })
        .catch(error => {
            console.error("Error creating product variation:", error);
            // Talvez mostre uma mensagem de erro para o usuário
        });
};



const showModal = ref(false);
const selectedVariation = ref(null);
const variationUpdateModal = (variation) => {
    showModal.value = true;
    selectedVariation.value = variation;
}
const closeVariationUpdateModalFunc = () => {
    showModal.value = false;
}

const showDeleteModal = ref(false);
const variationId = ref(null);
const variationDeleteModal = (id) => {
    showDeleteModal.value = true;
    variationId.value = id;
}
const closeVariationDeleteModalFunc = () => {
    showDeleteModal.value = false;
}

function removeVariation(id) {
    const index = props.product.variations.findIndex(variation => variation.id === id);
    if (index !== -1) {
        props.product.variations.splice(index, 1);
    }
}

</script> 
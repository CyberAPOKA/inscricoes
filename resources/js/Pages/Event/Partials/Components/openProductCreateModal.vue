<template>
    <!-- Main modal -->
    <div id="openProductCreateModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="modal-backdrop" data-modal-hide="openProductCreateModal"></div>
        <div class="relative w-full max-w-6xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <form @submit.prevent="productCreate" enctype="multipart/form-data">
                    <!-- Modal header -->
                    <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                        <h1 class="text-3xl font-black text-black">CRIAR PRODUTO <span
                                v-if="productForm.extra === 'yes'">EXTRA</span>:</h1>
                        <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="openProductCreateModal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>

                    <!-- Modal body -->
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div class="md:col-span-1">
                                <label for="select-product"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecionar
                                    produto
                                    cadastrado</label>
                                <select id="select-product" v-model="selectedProduct"
                                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all">
                                    <option value="">Remover</option>
                                    <option v-for="product in products" :key="product.id" :value="product">
                                        {{ product.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="md:col-span-2">
                                <label for="product-name" class="block mb-2 text-sm font-medium text-gray-900">Nome
                                    do
                                    Produto*</label>
                                <input type="text" id="product-name" v-model="productForm.name"
                                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all" />
                            </div>
                            <div class="md:col-span-1">
                                <label for="product-maximum_amount"
                                    class="block mb-2 text-sm font-medium text-gray-900">Quantidade para
                                    venda</label>
                                <input type="number" id="product-maximum_amount" v-model="productForm.maximum_amount"
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
                                    <input type="checkbox" v-model="productVariation" class="sr-only peer" true-value="yes"
                                        false-value="no" />
                                    <div
                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                    </div>
                                </label>
                            </div>
                        </div>
                        <div v-show="productVariation === 'yes'">
                            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 pt-4" :class="{
                                'shadow-all-green mt-4 p-4 rounded-xl': editingIndex !== null,
                            }">
                                <div class="md:col-span-2">
                                    <label for="product-variation-variation"
                                        class="block mb-2 text-sm font-medium text-gray-900">Variação</label>
                                    <input type="text" id="product-variation-variation" v-model="variationForm.variation"
                                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all" />
                                </div>
                                <div class="md:col-span-1">
                                    <label for="product-variation-amount"
                                        class="block mb-2 text-sm font-medium text-gray-900">Quantidade por
                                        variação</label>
                                    <input type="number" id="product-variation-amount" v-model="variationForm.amount"
                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all" />
                                </div>
                                <button
                                    class="md:col-span-1 flex justify-center items-center gap-2 bg-[#0DCD71] px-6 text-white font-bold text-xs rounded-lg uppercase hover:cursor-pointer md:mt-6 py-3"
                                    type="button" @click="saveVariation">
                                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                            d="M0 11C0 4.928 4.928 0 11 0C17.072 0 22 4.928 22 11C22 17.072 17.072 22 11 22C4.928 22 0 17.072 0 11ZM12.1 12.1H16.5V9.9H12.1V5.5H9.9V9.9H5.5V12.1H9.9V16.5H12.1V12.1Z"
                                            fill="white" />
                                    </svg>
                                    <span v-if="editingIndex !== null">ATUALIZAR VARIAÇÃO</span>
                                    <span v-else>SALVAR VARIAÇÃO</span>
                                </button>
                            </div>
                            <div v-for="(variation, index) in productForm.variations" :key="index">
                                <div class="bg-white shadow-all flex justify-between items-center w-full mt-4 rounded-xl relative"
                                    :class="{
                                        'shadow-all-200': editingIndex === index,
                                    }">
                                    <p class="ml-4 pr-4 border-r-2 border-r-[#CECECE] font-bold text-base text-[#616161]">
                                        {{ variation.variation }}
                                    </p>
                                    <p class="font-bold text-base text-[#616161]">
                                        {{ variation.amount }}
                                    </p>
                                    <div
                                        class="bg-[#616161] flex items-center gap-12 md:gap-4 p-4 rounded-r-xl rounded-l-xl md:rounded-l-none">
                                        <button @click="editVariation(index)" type="button">
                                            <svg width="15" height="14" viewBox="0 0 15 14" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M14.7563 2.04722C15.0812 2.35051 15.0812 2.84044 14.7563 3.14373L13.2315 4.56687L10.1069 1.6506L11.6317 0.227468C11.9567 -0.0758228 12.4816 -0.0758228 12.8066 0.227468L14.7563 2.04722ZM0 14V11.0837L9.21539 2.48271L12.34 5.39897L3.12457 14H0Z"
                                                    fill="white" />
                                            </svg>
                                        </button>
                                        <button @click="deleteVariation(index)" type="button">
                                            <svg width="10" height="14" viewBox="0 0 10 14" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                    d="M7.5 0.777778H10V2.33333H0V0.777778H2.5L3.21429 0H6.78571L7.5 0.777778ZM2.14286 14C1.35714 14 0.714286 13.3 0.714286 12.4444V3.11111H9.28571V12.4444C9.28571 13.3 8.64286 14 7.85714 14H2.14286Z"
                                                    fill="white" />
                                            </svg>
                                        </button>
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
                            data-modal-hide="openProductCreateModal">
                            <span>Cancelar</span>
                        </button>
                        <button data-modal-hide="openProductCreateModal"
                            class="md:w-52 flex justify-center items-center gap-2 bg-[#0DCD71] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all hover:cursor-pointer"
                            type="submit">
                            <span>Salvar</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, watch, reactive, onMounted, computed, watchEffect } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import SvgBug from "@/Pages/Svgs/SvgBug.vue";

const props = defineProps({
    eventId: Number,
    products: Array,
    modalType: String
});

watchEffect(() => {
    if (props.modalType === 'regular') {
        productForm.extra = "no";
    } else if (props.modalType === 'extra') {
        productForm.extra = "yes";
    }
});

const productVariation = ref("");

//start select product
const selectedProduct = ref(null);

watch(selectedProduct, (newValue) => {
    if (newValue && newValue.product) {
        productForm.name = newValue.product.name;
        productForm.maximum_amount = newValue.product.maximum_amount;
        productForm.extra = newValue.product.extra;
    }
});

watch(selectedProduct, (newValue) => {
    if (newValue) {
        productForm.name = newValue.name;
        productForm.maximum_amount = newValue.maximum_amount;
        productForm.extra = newValue.extra;

        if (newValue.variations && newValue.variations.length) {
            productVariation.value = "yes";
            productForm.variations = newValue.variations;
            //trazer preenchido o primeiro valor nos inputs
            // variationForm.variation = newValue.variations[0].variation;
            // variationForm.amount = newValue.variations[0].amount;
        } else {
            productVariation.value = "no";
            productForm.variations = [];
            variationForm.variation = "";
            variationForm.amount = "";
        }
    } else {
        productForm.name = "";
        productForm.maximum_amount = 0;
        productForm.extra = "";
        productForm.variations = [];
        productVariation.value = "no";
        variationForm.variation = "";
        variationForm.amount = "";
    }
});
//end select product

// START VARIATION CREATE
const variationForm = reactive({
    variation: "",
    amount: "",
});

const saveVariation = () => {
    if (editingIndex.value !== null) {
        productForm.variations[editingIndex.value] = { ...variationForm };
        editingIndex.value = null;
    } else {
        productForm.variations.push({ ...variationForm });
    }
    variationForm.variation = "";
    variationForm.amount = "";
};

const editingIndex = ref(null);

const editVariation = (index) => {
    variationForm.variation = productForm.variations[index].variation;
    variationForm.amount = productForm.variations[index].amount;
    editingIndex.value = index;
};

const deleteVariation = (index) => {
    productForm.variations.splice(index, 1);
    if (editingIndex.value === index) {
        editingIndex.value = null;
        variationForm.variation = "";
        variationForm.amount = "";
    }
};
// END VARIATION CREATE

const productForm = useForm({
    name: "",
    maximum_amount: "",
    extra: "no",
    variations: [],
});

const productCreate = () => {
    productForm.post(route("event.product.create", { id: props.eventId }), {
        preserveScroll: true,
        onSuccess: (response) => {

        },
    });
};
</script>
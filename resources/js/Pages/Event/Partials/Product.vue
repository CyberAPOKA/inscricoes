<template>
    <div>
        <openProductCreateModal :eventId="eventId" :products="products" :modalType="modalType" />
        <openProductShowModalFile :show="showModal" @close="closeModalFunc" :product="selectedProduct" :type="modalType"
            @edit="handleEdit" />

        <openProductUpdateModalFile :show="updateModal" @close="closeUpdateModalFunc" :product="selectedProduct"
            :type="modalType" />
        <deleteProductModalFile :show="showDeleteModal" @close="closeProductDeleteModalFunc" :id="productId" />
        <div>
            <h1 class="text-[#000000] font-extrabold text-2xl">
                CRIE AQUI O(S) PRODUTO(S) PARA O ESTOQUE DO SEU EVENTO:
            </h1>

            <!-- Modal Open Product -->
            <button class="flex items-center justify-center gap-2 bg-[#0DCD71] w-full p-3 rounded-[10px] mt-4"
                data-modal-target="openProductCreateModal" data-modal-toggle="openProductCreateModal" type="button"
                @click="setModalType('regular')">
                <SvgBug />
                <span class="text-white font-bold text-base">ADICIONAR PRODUTO</span>
            </button>
            <div v-show="hasRegularProducts">

                <div id="accordion-collapse" data-accordion="collapse" class="mt-4">
                    <h2 id="accordion-collapse-heading-regular-product">
                        <button type="button"
                            class="flex items-center justify-between w-full p-5 font-medium text-left rounded-[10px] relative bg-white"
                            :class="accordionRegularProducts ? 'shadow-xt' : 'shadow-all'"
                            data-accordion-target="#aaccordion-collapse-body-regular-product"
                            :aria-expanded="accordionRegularProducts"
                            aria-controls="aaccordion-collapse-body-regular-product"
                            @click="toggleAccordionRegularProducts">
                            <span>Produtos {{ accordionRegularProducts }}</span>
                            <SvgBug />
                        </button>
                    </h2>

                    <div id="aaccordion-collapse-body-regular-product" class="hidden -mt-2"
                        aria-labelledby="accordion-collapse-heading-regular-product">
                        <div class="bg-[#616161] rounded-b-[10px] p-2 pt-4">
                            <div class="bg-[#F9F9F9] rounded-[10px] p-4 flex flex-col gap-y-2">

                                <div class="bg-white shadow-all rounded-[10px] flex flex-col text-center lg:flex-row items-stretch justify-between"
                                    v-for="product in regularProducts">
                                    <p class="text-[#616161] font-bold text-xs pl-4 py-4">{{ product.name }}</p>
                                    <p class="text-xs font-normal py-4">
                                        <span class="text-[#616161] font-bold">({{ product.maximum_amount }})</span>
                                        Quantidade de estoque
                                        <span class="text-[#616161] font-bold">({{ product.variations.length }})</span>
                                        variações
                                    </p>
                                    <div
                                        class="bg-[#616161] flex items-center justify-center px-4 rounded-b-[10px] lg:rounded-l-none lg:rounded-r-[10px] py-4 lg:py-0 gap-x-12 lg:gap-x-4">
                                        <button @click="() => showModalFunc(product, 'regular')" type="button">
                                            <SvgBug />
                                        </button>

                                        <button @click="() => updateModalFunc(product, 'regular')" type="button">
                                            <SvgBug />
                                        </button>

                                        <button @click="() => productDeleteModal(product.id)" type="button">
                                            <SvgBug />
                                        </button>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-[#616161] bg-[#ECECEC] w-full p-16 text-center rounded-[10px] my-4 font-medium" v-if="!hasRegularProducts">
                Nenhum produto cadastrado
            </p>
        </div>
        <hr class="my-6" />
        <div>
            <h1 class="text-[#000000] font-extrabold text-2xl flex items-center gap-2">
                <span>CRIE AQUI PRODUTO(S) EXTRA(S) PARA O SEU EVENTO:</span>
                <SvgBug />
            </h1>
            <button class="flex items-center justify-center gap-2 bg-[#0DCD71] w-full p-3 rounded-[10px] mt-4"
                data-modal-target="openProductCreateModal" data-modal-toggle="openProductCreateModal" type="button"
                @click="setModalType('extra')">
                <SvgBug />
                <span class="text-white font-bold text-base">ADICIONAR PRODUTO EXTRA</span>
            </button>
            <div v-show="hasExtraProducts">
                <div id="accordion-collapse" data-accordion="collapse" class="mt-4">
                    <h2 id="accordion-collapse-heading-extra-product">
                        <button type="button"
                            class="flex items-center justify-between w-full p-5 font-medium text-left rounded-[10px] relative bg-white"
                            :class="accordionExtraProducts ? 'shadow-xt' : 'shadow-all'"
                            data-accordion-target="#aaccordion-collapse-body-extra-product"
                            :aria-expanded="accordionExtraProducts" aria-controls="aaccordion-collapse-body-extra-product"
                            @click="toggleAccordionExtraProducts">
                            <span>Produtos {{ accordionExtraProducts }}</span>
                            <SvgBug />
                        </button>
                    </h2>

                    <div id="aaccordion-collapse-body-extra-product" class="hidden -mt-2"
                        aria-labelledby="accordion-collapse-heading-extra-product">
                        <div class="bg-[#616161] rounded-b-[10px] p-2 pt-4">
                            <div class="bg-[#F9F9F9] rounded-[10px] p-4 flex flex-col gap-y-2">
                                <div class="bg-white shadow-all rounded-[10px] flex flex-col text-center lg:flex-row items-stretch justify-between"
                                    v-for="product in extraProducts">
                                    <p class="text-[#616161] font-bold text-xs pl-4 py-4">{{ product.name }}</p>
                                    <p class="text-xs font-normal py-4">
                                        <span class="text-[#616161] font-bold">({{ product.maximum_amount }})</span>
                                        Quantidade de estoque
                                        <span class="text-[#616161] font-bold">({{ product.variations.length }})</span>
                                        variações
                                    </p>
                                    <div
                                        class="bg-[#616161] flex items-center justify-center px-4 rounded-b-[10px] lg:rounded-l-none lg:rounded-r-[10px] py-4 lg:py-0 gap-x-12 lg:gap-x-4">
                                        <button @click="() => showModalFunc(product, 'extra')" type="button">
                                            <SvgBug />
                                        </button>

                                        <button @click="() => updateModalFunc(product, 'extra')" type="button">
                                            <SvgBug />
                                        </button>

                                        <button @click="() => productDeleteModal(product.id)" type="button">
                                            <SvgBug />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-[#616161] bg-[#ECECEC] w-full p-16 text-center rounded-[10px] my-4 font-medium" v-if="!hasExtraProducts">
                Nenhum produto extra cadastrado
            </p>
        </div>
    </div>
</template>
  
<script setup>
import { ref, watch, reactive, onMounted, computed, watchEffect } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import { step } from "../step";
import Multiselect from "@vueform/multiselect";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";
import SvgBug from "@/Pages/Svgs/SvgBug.vue";
import openProductCreateModal from "@/Pages/Event/Partials/Components/openProductCreateModal.vue";
import openProductShowModalFile from "@/Pages/Event/Partials/Components/openProductShowModal.vue";
import openProductUpdateModalFile from "@/Pages/Event/Partials/Components/openProductUpdateModal.vue";
import deleteProductModalFile from "@/Pages/Event/Partials/Components/deleteProductModal.vue";

const toast = useToast();

const modalType = ref('');

const setModalType = (type) => {
    modalType.value = type;
};

const props = defineProps({
    eventId: Number,
    products: Array,
});

const accordionRegularProducts = ref(true);
const accordionExtraProducts = ref(true);

const toggleAccordionRegularProducts = () => {
    accordionRegularProducts.value = !accordionRegularProducts.value;
};
const toggleAccordionExtraProducts = () => {
    accordionExtraProducts.value = !accordionExtraProducts.value;
};


const regularProducts = computed(() =>
    props.products.filter((product) => product.extra === "no")
);
const extraProducts = computed(() =>
    props.products.filter((product) => product.extra === "yes")
);

const hasRegularProducts = computed(() => regularProducts.value.length > 0);
const hasExtraProducts = computed(() => extraProducts.value.length > 0);

const showModal = ref(false);
const selectedProduct = ref(null);
const showModalFunc = (product, type) => {
    showModal.value = true;
    selectedProduct.value = product;
    modalType.value = type;
}
const closeModalFunc = () => {
    showModal.value = false;
}

const updateModal = ref(false);
const updateModalFunc = (product, type) => {
    updateModal.value = true;
    selectedProduct.value = product;
    modalType.value = type;
}
const closeUpdateModalFunc = () => {
    updateModal.value = false;
}

const showDeleteModal = ref(false);
const productId = ref(null);
const productDeleteModal = (id) => {
    showDeleteModal.value = true;
    productId.value = id;
}
const closeProductDeleteModalFunc = () => {
    showDeleteModal.value = false;
}

const handleEdit = (product) => {
    closeModalFunc();
    updateModalFunc(product, modalType.value);
}
</script>
<style>
.modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.3);
    z-index: -1;
}
</style>
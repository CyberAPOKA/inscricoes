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
                        <div>
                            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-3xl font-black text-black">
                                    VISUALIZAÇÃO DE PRODUTO:
                                </h3>
                                <div class="flex gap-2">
                                    <button
                                        class="flex items-center justify-center gap-2 bg-gradient-to-b from-[#9F9F9F] to-[#797979] text-white px-4 py-1 rounded-md"
                                        @click="editProduct">
                                        <SvgBug />

                                        <span>EDITAR</span>
                                    </button>
                                    <button
                                        class="flex items-center justify-center gap-2 bg-[#616161] text-white px-4 py-1 rounded-md"
                                        @click="close">
                                        <SvgBug />

                                        <span>FECHAR JANELA</span>
                                    </button>
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                    <div class="md:col-span-3">
                                        <label for="product-name" class="block mb-2 text-sm font-medium text-gray-900">Nome
                                            do
                                            Produto*</label>
                                        <input type="text" id="product-name" v-model="product.name" readonly
                                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all" />
                                    </div>
                                    <div class="md:col-span-1">
                                        <label for="product-maximum_amount"
                                            class="block mb-2 text-sm font-medium text-gray-900">Quantidade para
                                            venda</label>
                                        <input type="number" id="product-maximum_amount" v-model="product.maximum_amount"
                                            readonly
                                            class="border border-gray-300 font-bold text-sm rounded-lg block w-full p-2.5 shadow-all" />
                                    </div>
                                </div>
                                <div class="bg-[#F1F1F1] rounded-2xl p-6 mt-4 max-h-[50vh] overflow-y-auto">
                                    <h1 class="font-bold text-[#000000] text-base">
                                        Variações cadastradas para o produto
                                    </h1>
                                    <div v-for="(variation, index) in product.variations" :key="index">
                                        <div
                                            class="bg-white shadow-all grid grid-cols-12 w-full mt-4 rounded-lg relative text-[#474545] py-2">
                                            <p
                                                class="ml-4 pr-4 border-r-2 border-r-[#CECECE] font-bold text-base text-[#616161] col-span-5">
                                                {{ variation.variation }}
                                            </p>
                                            <p class="font-bold text-base text-[#616161] col-span-7 ml-4">
                                                {{ variation.amount }} produtos
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <slot v-if="show" />
                    </div>
                    <div v-else>Erro desconhecido.</div>
                </transition>
            </div>
        </transition>
    </teleport>
</template>

<script setup>
import { computed, onMounted, onUnmounted, watch } from 'vue';
import SvgBug from "@/Pages/Svgs/SvgBug.vue";

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

const editProduct = () => {
    emit('edit', props.product);
};

</script>
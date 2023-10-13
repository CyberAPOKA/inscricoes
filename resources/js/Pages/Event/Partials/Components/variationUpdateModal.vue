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
                        :class="maxWidthClass" v-if="variation">
                        <div class="p-6">
                            <h1 class="text-3xl font-black text-black">
                                EDITAR VARIAÇÃO:
                            </h1>
                            <form @submit.prevent="updateVariation(variation)"
                                class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-4">
                                <div class="md:col-span-1">
                                    <label for="product-variation-variation-update"
                                        class="block mb-2 text-sm font-medium text-gray-900">Variação</label>
                                    <input type="text" id="product-variation-variation-update" v-model="variation.variation"
                                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all" />
                                </div>
                                <div class="md:col-span-1">
                                    <label for="product-variation-amount-update"
                                        class="block mb-2 text-sm font-medium text-gray-900">Quantidade por
                                        variação</label>
                                    <input type="number" id="product-variation-amount-update" v-model="variation.amount"
                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all" />
                                </div>
                                <div class="col-span-2 flex justify-between items-center">
                                    <button type="button"
                                        class="md:w-52 flex justify-center gap-2 items-center bg-[#FF7171] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all"
                                        @click="close">
                                        <SvgBug />
                                        <span>Cancelar</span>
                                    </button>
                                    <button
                                        class="md:col-span-1 flex justify-center items-center gap-2 bg-[#0DCD71] px-6 text-white font-bold text-xs rounded-lg uppercase hover:cursor-pointer md:mt-6 py-3"
                                        type="submit" @click="close">
                                        <SvgBug />
                                        <span>Salvar</span>
                                    </button>
                                </div>
                            </form>
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
import { computed, onMounted, onUnmounted, watch, ref } from 'vue';
import { router, useForm } from "@inertiajs/vue3";
import SvgBug from "@/Pages/Svgs/SvgBug.vue";

const props = defineProps({
    variation: {
        type: Object,
    },
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '5xl',
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

function updateVariation(variation) {
    router.put(
        route("event.product.variation.update", { id: variation.id }),
        {
            variation: variation.variation,
            amount: variation.amount
        },
        {
            preserveScroll: true,
        }
    );
}
</script>
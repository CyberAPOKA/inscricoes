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
                        :class="maxWidthClass" v-if="id">
                        <div class="p-6">
                            <h1 class="text-3xl font-black text-black text-center">
                                TEM CERTEZA QUE DESEJA DELETAR ESTA VARIAÇÃO DESTE PRODUTO?
                            </h1>
                            <form @submit.prevent="deleteVariation(id)"
                                class="col-span-2 flex justify-between items-center mt-4">

                                <button type="button"
                                    class="w-32 md:w-52 flex justify-center gap-2 items-center bg-[#FF7171] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all"
                                    @click="close">
                                    <span>NÃO</span>
                                </button>
                                <button
                                    class="w-32 md:w-52 flex justify-center items-center gap-2 bg-[#0DCD71] px-6 text-white font-bold text-xs rounded-lg uppercase hover:cursor-pointer md:mt-6 py-3"
                                    type="submit" @click="close">
                                    <span>SIM</span>
                                </button>
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
    id: {
        type: Number,
    },
    show: {
        type: Boolean,
        default: false,
    },
    maxWidth: {
        type: String,
        default: '4xl',
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

function deleteVariation(id) {
    router.delete(route("event.variation.delete", { id: id }), {
        preserveScroll: true,
        onSuccess: () => {
            emit('variationDeleted', id);
        }
    });
}
</script>
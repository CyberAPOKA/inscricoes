<template>
    <Sidebar></Sidebar>
    <div :class="sidebarVisible ? 'pt-4 sm:ml-44 xl:ml-52 bg-yellow' : 'pt-4 ml-14 xl:ml-16 bg-yellow'">
        <div class="rounded-tl-[4rem] bg-white mt-4">
            <section class="pt-12">
                <div class="border-b-2 shadow-lg">
                    <div class="container mx-auto">
                        <h1 class="font-black text-[30px]">CADASTRO DE EVENTO</h1>
                        <hr class="h-1 w-56 bg-yellow mb-6 border-t-0" />
                    </div>
                </div>
                <div class="container mx-auto py-12 ">
                    <div class="grid md:grid-cols-12">
                        <div class="md:col-span-9 mx-4">
                            <Data v-show="step === 1" />
                        </div>
                        <!-- <Navigation /> -->
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script setup>
import { ref } from "vue";
import Sidebar from "@/Layouts/Sidebar.vue";
import { sidebarVisible } from "@/Layouts/sidebar.js";
import { step } from "@/Pages/Event/step.js";
import { useForm } from "laravel-precognition-vue";
import Navigation from "@/Pages/Event/Partials/Navigation.vue";
import Data from "@/Pages/Event/Partials/Data.vue";
import Location from "@/Pages/Event/Partials/Location.vue";
import GraphicMaterial from "@/Pages/Event/Partials/GraphicMaterial.vue";
import Cropper from "@/Pages/Event/Partials/Cropper.vue";

const props = defineProps({
    eventGraphicMaterials: Array,
});
</script>

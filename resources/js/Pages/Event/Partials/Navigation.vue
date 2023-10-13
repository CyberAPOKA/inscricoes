<template>
  <div class="md:col-span-3 hidden md:block fixed right-2 xl:right-4 2xl:right-12 md:max-w-[9rem] lg:max-w-none">
    <div class="flex flex-wrap flex-col rounded-xl p-2 xl:p-4 2xl:p-6 bg-gray-card text-white gap-3 lg:gap-2 xl:gap-1">
      <button type="button" class="flex items-center text-left text-sm xl:text-md 2xl:text-base"
        :class="{ 'text-yellow': step === 1, 'text-white': step > 1 }" @click="step = 1">
        <EventArrow class="mr-2" v-if="step === 1" />
        Dados do evento
      </button>

      <button type="button" class="flex items-center text-left text-sm xl:text-md 2xl:text-base"
        :class="{ 'text-yellow': step === 2, 'text-white': step > 2 }" @click="step = 2">
        <EventArrow class="mr-2" v-if="step === 2" />
        Localização
      </button>

      <button type="button" class="flex items-center text-left text-sm xl:text-md 2xl:text-base"
        :class="{ 'text-yellow': step === 3, 'text-white': step > 3 }" @click="step = 3">
        <EventArrow class="mr-2" v-if="step === 3" />
        Material Gráfico
      </button>

      <button type="button" class="flex items-center text-left text-sm xl:text-md 2xl:text-base"
        :class="{ 'text-yellow': step === 4, 'text-white': step > 4 }" @click="step = 4">
        <EventArrow class="mr-2" v-if="step === 4" />
        Inscrições / Lotes
      </button>

      <button type="button" class="flex items-center text-left text-sm xl:text-md 2xl:text-base"
        v-if="hasProductsAndKits === 'yes'" :class="{ 'text-yellow': step === 5, 'text-white': step > 5 }"
        @click="step = 5">
        <EventArrow class="mr-2" v-if="step === 5" />
        Produtos / Estoque
      </button>

      <button type="button" class="flex items-center text-left text-sm xl:text-md 2xl:text-base"
        v-if="hasProductsAndKits === 'yes'" :class="{ 'text-yellow': step === 6, 'text-white': step > 6 }"
        @click="step = 6">
        <EventArrow class="mr-2" v-if="step === 6" />
        Kits
      </button>

      <button type="button" class="flex items-center text-left text-sm xl:text-md 2xl:text-base"
        :class="{ 'text-yellow': step === 7, 'text-white': step > 7 }" @click="step = 7">
        <EventArrow class="mr-2" v-if="step === 7" />
        Valores
      </button>

      <button type="button" class="flex items-center text-left text-sm xl:text-md 2xl:text-base"
        :class="{ 'text-yellow': step === 8, 'text-white': step > 8 }" @click="step = 8">
        <EventArrow class="mr-2" v-if="step === 8" />
        Formas de pagamento
      </button>

      <button type="button" class="flex items-center text-left text-sm xl:text-md 2xl:text-base"
        :class="{ 'text-yellow': step === 9, 'text-white': step > 9 }" @click="step = 9">
        <EventArrow class="mr-2" v-if="step === 9" />
        Percurso
      </button>

      <button type="button" class="flex items-center text-left text-sm xl:text-md 2xl:text-base"
        :class="{ 'text-yellow': step === 10, 'text-white': step > 10 }" @click="step = 10">
        <EventArrow class="mr-2" v-if="step === 10" />
        Revisão
      </button>
    </div>
  </div>
</template>
<script setup>
import EventArrow from "@/Pages/Svgs/EventArrow.vue";
import Check from "@/Pages/Svgs/Check.vue";
import { step } from "@/Pages/Event/step.js";

const props = defineProps({
  hasProductsAndKits: String,
});

</script>

<template>
  <div>
    <button @click="openModal"
      class="md:p-4 sm:p-8  flex justify-center items-center shadow-input  gap-3 font-semibold bg-green text-white rounded-lg w-full h-[40px] sm:font-xl">
      <MoreSvg />
      CRIAR CUPOM
    </button>
    <div class="z-11 fixed inset-0 w-fll flex items-center justify-center" v-if="isModalOpen">
      <div class="bg-white p-6 rounded shadow-md">
        <h2 class="text-lg font-semibold mb-4">CRIAR UM CUPOM:</h2>
        <form @submit.prevent="submitForm">

          <h1 class="mt-2 font-normal">Vincular ao CPF ou Gerar Código?*</h1>

          <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Criar Cupom</button>
        </form>
        <button @click="closeModal" class="mt-4 bg-gray-300 hover:bg-gray-400 px-3 py-1 rounded">
          Fechar
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import MoreSvg from "@/Pages/Svgs/More.vue";
</script>

<script>
export default {
  data() {
    return {
      isModalOpen: false,
    };
  },
  methods: {
    openModal() {
      this.isModalOpen = true;
    },
    closeModal() {
      this.isModalOpen = false;
    },
  },
};
</script>

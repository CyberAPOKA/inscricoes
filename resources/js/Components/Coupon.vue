<template>
  <div class="flex justify-between items-center mb-4">
    <div class="">
      <h1 class="font-extrabold text-[24px]"> CUPONS CADASTRADOS NO EVENTO: </h1>
    </div>
  </div>

  <div class="md:flex sm:block sm:text-center justify-between items-center mb-4">
    <div class="flex gap-2">
      <div class="flex">
        <input type="text" class="shadow-input rounded-md font-normal w-[35rem]" placeholder="Cupom" />
      </div>
      <div class="rounded-3xl">
        <button
          class="h-[46px] w-[140px] flex justify-center items-center shadow-input gap-3 font-semibold bg-dark text-white rounded-lg sm:font-xl">
          <FilterSvg />
          Filtros (0)
        </button>
      </div>
    </div>
    <div class="md:w-1/4 sm:w-auto sm:font-[12px] sm:p-1">
      <div class="rounded-3xl">
        <Modal />
      </div>
    </div>
  </div>

  <div class="mb-5 sm:z-40 bg-[#F9F9F9] rounded-3xl shadow-input">
    <div>
      <div class="p-2 bg-grad-green text-center rounded-t-3xl text-white">
        <h1 class="font-semibold text-1xl ml-4"> CUPONS ATIVOS NO SISTEMA </h1>
      </div>
      <div class="">
        <div class="p-4 mt-4 bg-[#F9F9F9] sm:z-40 rounded-3xl">
          <div class="sm:hidden">
            <div class="p4 mt-4 border-[#F9F9F9]">
              <div class="container mx-auto py-12 px-2 md:px-0">
                <div class="grid gap-3" :class="sidebarVisible ? 'md:grid-cols-3' : 'md:grid-cols-4'">
                  <div v-for=" index  in  5 " :key="index">
                    <div class="flex flex-col shadow-input rounded-3xl text-center">
                      <p class="py-2 flex justify-center gap-2"> Inscrição: 5Km - Simples </p>
                      <p class="py-2 flex justify-center gap-2"> Quantidade vendida: 500 </p>
                      <p class="py-2 flex justify-center gap-2"> Valor: R$ 20.6897,00 </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hidden sm:block">
            <div class="grid grid-cols-7 text-center font-semibold text-[14px]">
              <div class="p-3">Campanha</div>
              <div class="p-3">% de desconto</div>
              <div class="p-3">Inscrições vinculadas</div>
              <div class="p-3">Quantidade</div>
              <div class="p-3">Período de uso</div>
              <div class="p-3">CPF ou Código</div>
            </div>
            <div class="bg-[#9F9F9F] rounded-lg max-h-72 overflow-y-auto">
              <div class="p-3 w-full text-center">
                <div v-for=" index  in  5 " :key="index">
                  <div class="mb-3 grid grid-cols-7 items-center justify-stretch rounded-[0.6rem] bg-white text-[12px] ">
                    <div> Maratona de Porto Alegre </div>
                    <div>20 </div>
                    <div>2 </div>
                    <div>500 </div>
                    <div>10/07/2023 - 11:00 até 10/08/2023 - 11:00 </div>
                    <div>Código</div>
                    <div class="ml-0">
                      <EditOrView />
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

  <div class="mb-5 sm:z-40 bg-[#F9F9F9] rounded-3xl shadow-input">
    <div>
      <div class="p-2 bg-grad-gray text-center rounded-t-3xl text-white">
        <h1 class="font-semibold text-1xl ml-4"> CUPONS DESATIVADOS </h1>
      </div>
      <div class="">
        <div class="p-4 mt-4 bg-[#F9F9F9] sm:z-40 rounded-3xl">
          <div class="sm:hidden">
            <div class="p4 mt-4 border-[#F9F9F9]">
              <div class="container mx-auto py-12 px-2 md:px-0">
                <div class="grid gap-3" :class="sidebarVisible ? 'md:grid-cols-3' : 'md:grid-cols-4'">
                  <div v-for=" index  in  5 " :key="index">
                    <div class="flex flex-col shadow-input rounded-3xl text-center">
                      <p class="py-2 flex justify-center gap-2"> Inscrição: 5Km - Simples </p>
                      <p class="py-2 flex justify-center gap-2"> Quantidade vendida: 500 </p>
                      <p class="py-2 flex justify-center gap-2"> Valor: R$ 20.6897,00 </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="hidden sm:block first-letter:">
            <div class="grid grid-cols-7 text-center font-semibold text-[14px]">
              <div class="p-3">Campanha</div>
              <div class="p-3">% de desconto</div>
              <div class="p-3">Inscrições vinculadas</div>
              <div class="p-3">Quantidade</div>
              <div class="p-3">Período de uso</div>
              <div class="p-3">CPF ou Código</div>
            </div>
            <div class="bg-[#9F9F9F] rounded-lg max-h-72 overflow-y-auto">
              <div class="p-3 w-full text-center text-[12px]">
                <div v-for=" index  in  5 " :key="index">
                  <div class="mb-3 grid grid-cols-7 items-center justify-stretch rounded-[0.6rem] bg-white">
                    <div> Maratona de Porto Alegre </div>
                    <div>20 </div>
                    <div>2 </div>
                    <div>500 </div>
                    <div>10/07/2023 - 11:00 até 10/08/2023 - 11:00 </div>
                    <div>Código</div>
                    <div>
                      <EditOrView />
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
</template>

<script setup>
import { sidebarVisible } from "@/Layouts/sidebar.js";
import FilterSvg from "@/Pages/Svgs/Filter.vue";
import EditOrView from "@/Pages/Svgs/EditOrView.vue";
import Modal from '@/Components/ModalCoupon.vue';
</script>

<script>
export default {
  name: 'App',
  components: {
    Modal, // Registre o componente de modal
  },
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
}
</script>
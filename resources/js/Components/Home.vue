
<template>
  <div :class="sidebarVisible ? 'pt-2 bg-white sm:z-40' : 'bg-white'">
    <a :href="route('event.view')">
      <div class="container mx-auto p-4 px-2 md:px-0">
        <div class="grid gap-5" :class="sidebarVisible ? 'md:grid-cols-3' : 'md:grid-cols-3'">

          <div class="p-4 flex flex-col shadow-input rounded-3xl text-center bg-gray-50">
            <div class="p-2 text-center text-gray-500 font-semibold">
              <h1>QUANTIDADE DE VENDAS DE INCRIÇÕES</h1>
            </div>
            <div class="mb-4 relative">
              <div class="flex justify-around gap-3 font-semibold">
                <div class="w-full">
                  <p class="py-4 pt-2 pb-2 bg-zinc-200 rounded-lg align-middle w-full border-2">4.000</p>
                  <p class="text-center text-gray-500">Conclusion</p>
                </div>
                <div class="w-full">
                  <p class="py-4 pt-2 pb-2 bg-white rounded-lg align-middle w-full border-2">4.000</p>
                  <p class="text-center text-gray-500">Processing</p>
                </div>
              </div>
            </div>
            <div class="mb-4 relative">
              <div class="flex justify-around gap-3 font-semibold">
                <div class="w-full">
                  <p class="py-4 pt-2 pb-2 bg-white rounded-lg align-middle w-full border-2">600</p>
                  <p class="text-center text-gray-500">Opened</p>
                </div>
                <div class="w-full">
                  <p class="py-4 pt-2 pb-2 bg-[#FF7171] rounded-lg align-middle w-full text-white border-2">
                    25</p>
                  <p class="text-center text-gray-500">Canceled</p>
                </div>
              </div>
            </div>
          </div>

          <div class="p-4 flex flex-col shadow-input rounded-3xl text-center bg-gray-50">
            <div class="p-2 text-center text-gray-500 font-semibold">
              <h1>FINANCEIRO</h1>
            </div>
            <div class="mb-4 relative">
              <div class="flex justify-around gap-3 font-semibold">
                <div class="w-full">
                  <p class="py-4 pt-2 pb-2 bg-zinc-200 rounded-lg align-middle w-full border-2">R$ 20.000
                  </p>
                  <p class="text-center text-gray-500">Conclusion</p>
                </div>
                <div class="w-full">
                  <p class="py-4 pt-2 pb-2 bg-white rounded-lg align-middle w-full border-2">R$ 200</p>
                  <p class="text-center text-gray-500">Processing</p>
                </div>
              </div>
            </div>
            <div class="mb-4 relative">
              <div class="flex justify-around gap-3 font-semibold">
                <div class="w-full">
                  <p class="py-4 pt-2 pb-2 bg-white rounded-lg align-middle w-full border-2">R$ 600</p>
                  <p class="text-center text-gray-500">Opened</p>
                </div>
                <div class="w-full">
                  <p class="py-4 pt-2 pb-2 bg-[#FF7171] rounded-lg align-middle w-full text-white border-2">
                    R$ 200</p>
                  <p class="text-center text-gray-500">Canceled</p>
                </div>
              </div>
            </div>
          </div>

          <div class="p-4 grid flex-col shadow-input relative rounded-3xl text-center">
            <div class="p-4 mb-4 text-center text-gray-500 font-semibold h-0 align-middle grid content-center">
              <h1>QUANTIDADE DE VENDAS DE PRODUTOS</h1>
            </div>
            <div class="p-4 flex-col align-middle flex items-stretch justify-evenly relative shadow-input rounded-3xl">
              <div class="mb-4 flex justify-around gap-0 font-semibold">
                <div class="p-4 w-full bg-gray-100 rounded-l-full">
                  <p class="text-center text-gray-500">Camisetas</p>
                </div>
                <div class="p-4 w-full bg-gray-100 rounded-r-full">
                  <p class="text-center text-gray-500">4.000</p>
                </div>
              </div>
              <div class="flex justify-around gap-0 font-semibold">
                <div class="p-4 w-full bg-gray-100 rounded-l-full">
                  <p class="text-center text-gray-500">Medalha</p>
                </div>
                <div class="p-4 w-full bg-gray-100 rounded-r-full">
                  <p class="text-center text-gray-500">4.000</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>

  <div :class="sidebarVisible ? 'p-4 bg-[#CECECE] sm:z-40 rounded-3xl' : ' p-4 rounded-3xl bg-[#CECECE]'">
    <a :href="route('event.view')">
      <div class="container mx-auto px-2 md:px-0">
        <h1 class="font-semibold mb-2">ATLETAS</h1>
        <div class="grid gap-3" :class="sidebarVisible ? 'md:grid-cols-4' : 'md:grid-cols-4'">
          <div class="flex flex-col shadow-input rounded-3xl text-center">
            <div class="bg-gray-200 rounded-3xl py-2">
              <h1 class="p-4 pt-8 pb-8 m-4 rounded-3xl font-black bg-white align-middle text-3xl shadow-input">2
              </h1>
              <p class="font-semibold align-middle mb-2">Incritos hoje</p>
            </div>
          </div>
          <div class="flex flex-col shadow-input rounded-3xl text-center">
            <div class="bg-gray-200 rounded-3xl py-2">
              <h1 class="p-4 pt-8 pb-8 m-4 rounded-3xl font-black bg-white align-middle text-3xl shadow-input">2
              </h1>
              <p class="font-semibold align-middle mb-2">Inscritos últimos 7 dias</p>
            </div>
          </div>
          <div class="flex flex-col shadow-input rounded-3xl text-center">
            <div class="bg-yellow rounded-3xl py-2">
              <h1 class="p-4 pt-8 pb-8 m-4 rounded-3xl font-black bg-white align-middle text-3xl shadow-input">2
              </h1>
              <p class="font-semibold align-middle mb-2">Pendentes</p>
            </div>
          </div>
          <div class="flex flex-col shadow-input rounded-3xl text-center">
            <div class="bg-[#FF7171] rounded-3xl py-2 text-white">
              <h1 class="p-4 pt-8 pb-8 m-4 rounded-3xl font-black bg-white align-middle text-3xl text-dark shadow-input">
                2
              </h1>
              <p class="font-semibold align-middle mb-2">Cancelados</p>
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>

  <div :class="sidebarVisible ? 'pt-4 bg-white sm:z-40' : 'pt-4 bg-white'">
    <a :href="route('event.view')">
      <div class="container mx-auto py-0 px-2 md:px-0">
        <div class="grid gap-3" :class="sidebarVisible ? 'md:grid-cols-2' : 'md:grid-cols-2'">
          <div class="flex flex-col shadow-input rounded-3xl text-center">
            <div class="bg-white rounded-3xl py-2 h-auto">
              <h1 class="mt-4 font-black font-semibold text-gray-500">FUNIL DE VENDAS</h1>
              <funnelChart />
            </div>
          </div>
          <div class="flex flex-col shadow-input rounded-3xl text-center">
            <div class="bg-white rounded-3xl py-2 h-auto">
              <h1 class="mt-4 font-black font-semibold text-gray-500">INSCRIÇÕES DO DIA</h1>
              <lineChart />
            </div>
          </div>
        </div>
      </div>
    </a>
  </div>
</template>

<script setup>
import { sidebarVisible } from "@/Layouts/sidebar.js";
import funnelChart from "@/Components/FunnelChart.vue";
import lineChart from "@/Components/LineChart.vue";
</script>
<template>
  <Sidebar></Sidebar>
  <div
    :class="sidebarVisible ? 'pt-4 sm:ml-52 bg-yellow sm:sticky sm:top-0 sm:z-10' : 'pt-4 sm:ml-14 bg-yellow sm:sticky sm:top-0 sm:z-10'">

    <div class="rounded-tl-[4rem] border-b-2  bg-white mt-4 relative">
      <section>
        <div class="border-b-2">
          <div class="container mx-auto ml-16">
            <div class="sm:grid sm:grid-cols flex flex-col gap-2">
              <div class="top-0 right-0 p-0">
                <div class="flex justify-end w-full space-x-4">
                  <button class="flex justify-between items-center rounded-b-lg bg-yellow px-4 py-3 gap-2">
                    <img src="/assets/img/icon/pencil-edit.svg" class="h-4 w-4" alt="Edit Status">
                    <span>{{ $t('edit_status') }}</span>
                  </button>
                  <button class="flex justify-between items-center rounded-b-lg bg-yellow px-4 py-3 gap-2">
                    <img src="/assets/img/icon/pencil-edit.svg" class="h-4 w-4" alt="Edit Event">
                    <span>{{ $t('edit_event') }}</span>
                  </button>
                </div>
              </div>

              <div class="flex flex-col md:flex-row justify-between gap-4 p-2">
                <h1 class="border-b-2 font-semibold border-yellow custom-title uppercase text-2xl">
                  MARATONA INTERNACIONAL DE SÃO PAULO
                </h1>
              </div>

              <div class="widget-container flex flex-col md:flex-row gap-4 p-2">
                <div class="ml-3 rounded-lg bg-yellow inline-flex items-center">
                  <span class="m-2 font-semibold text-sm mt-0 mb-0">waiting for approval</span>
                </div>
                <div class="ml-3 rounded-lg inline-flex items-center">
                  <img src="/assets/img/icon/calendar-events.svg">
                  <span class="p-1 text-sm">22/05/2023, 10:00</span>
                </div>
                <div class="ml-3 text-sm rounded-lg inline-flex items-center">
                  <img src="/assets/img/icon/location.svg">
                  <span class="p-1 text-sm">São Paulo/SP</span>
                </div>
                <div class="ml-3 rounded-lg inline-flex items-center">
                  <img src="/assets/img/icon/list-events.svg">
                  <span class="p-1 text-sm">Category: Maratona</span>
                </div>
                <div class="ml-3 rounded-lg inline-flex items-center">
                  <img src="/assets/img/icon/organizer.svg">
                  <span class="p-1 text-sm">Organizer: Yescom</span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="border-b-2 shadow-lg">
          <div class="container mx-auto ml-8">
            <div class="sm:grid sm:grid-cols flex flex-col gap-2" id="myTabContent">
              <div class="dark:border-gray-700 flex overflow-x-auto">
                <ul class="flex text-sm font-medium text-center px-8" id="myTab" data-tabs-toggle="#myTabContent"
                  role="tablist">
                  <li v-for="(tab, index) in tabs" :key="tab.id" class="mr-10 py-5 text-black" role="presentation">
                    <button :class="{ 'bg-gray-200 text-black': tabSelected === index }"
                      class="uppercase text-xs px-4 py-2 border-transparent flex flex-col justify-center items-center h-76 space-x-2 hover:bg-gray-200 rounded-md"
                      :id="tab.id + '-tab'" :data-tabs-target="'#' + tab.id" type="button" role="tab"
                      :aria-controls="tabSelected === index ? tab.id : null" :aria-selected="tabSelected === index"
                      @click="tabSelected = index">
                      <img :src="tab.icon" class="mb-2"> {{ tab.label }}
                    </button>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>

      </section>
    </div>
  </div>

  <div :class="sidebarVisible ? 'sm:ml-52 bg-white sm:sticky' : 'pt-4 sm:ml-14 bg-white'">
    <div class="bg-white">
      <section>
        <div class="border-b-2">
          <div class="container mx-auto">
            <div class="sm:grid sm:grid-cols flex flex-col gap-2 text-[#000]" Id="myTabContent">
              <div v-for="(    tab, index    ) in     tabs    " :key="tab.id"
                :class="{ ' p-4 hidden': tabSelected !== index, 'p-4': tabSelected === index, 'active': activeTabId === tab.id }"
                class="rounded-lg dark:bg-gray-800" :id="tab.id" role="tabpanel" :aria-labelledby="tab.id + '-tab'">

                <div v-if="tab.id === 'profile'">
                  <Home />
                </div>

                <div v-if="tab.id === 'financial'">
                  <Financial />
                </div>

                <div v-if="tab.id === 'coupon'">
                  <Coupon />
                </div>

              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';
import Sidebar from "@/Layouts/Sidebar.vue";
import { sidebarVisible } from "@/Layouts/sidebar.js";
import Home from "@/Components/Home.vue";
import Financial from "@/Components/Financial.vue";
import Coupon from "@/Components/Coupon.vue";

let tabSelected = ref('profile');

const activeTabId = computed(() => {
  return tabs[tabSelected.value]?.id;
});

const tabs = [
  { id: 'profile', label: 'home', icon: '/assets/img/icon/home.svg' },
  { id: 'data', label: 'dados gerais', icon: '/assets/img/icon/list.svg' },
  { id: 'inscription', label: 'inscription', icon: '/assets/img/icon/inscription.svg' },
  { id: 'products', label: 'products', icon: '/assets/img/icon/products.svg' },
  { id: 'order', label: 'order', icon: '/assets/img/icon/order.svg' },
  { id: 'financial', label: 'financeiro', icon: '/assets/img/icon/financeiro.svg' },
  { id: 'coupon', label: 'coupon', icon: '/assets/img/icon/coupon.svg' },
  { id: 'courtesy', label: 'courtesy', icon: '/assets/img/icon/courtesy.svg' },
  { id: 'combos', label: 'combos', icon: '/assets/img/icon/combos.svg' },
];
</script>
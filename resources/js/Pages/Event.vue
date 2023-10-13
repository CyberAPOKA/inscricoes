<template>
  <Sidebar></Sidebar>
  <div :class="sidebarVisible ? 'pt-4 sm:ml-44 xl:ml-52 bg-yellow' : 'pt-4 ml-14 xl:ml-16 bg-yellow'">
    <div class="rounded-tl-[4rem] bg-white mt-4 ">

      <section class="pt-12">
        <div class="border-b-2 shadow-lg">
          <div class="container mx-auto">
            <h1 class="font-black text-5xl">CADASTRO DE EVENTO</h1>
            <hr class="h-1 w-56 bg-yellow mb-6 border-t-0" />
          </div>
        </div>
        <div class="container mx-auto py-12">
          <div class="grid md:grid-cols-12">
            <div class="md:col-span-9 mx-4">
              <Data v-show="step === 1" :event="event" :data="event.data" :regulation="event.regulation" />
              <Location v-show="step === 2" :location="event.location" :eventId="event.id" />
              <GraphicMaterial v-show="step === 3" :event="event" />
              <Inscription v-show="step === 4" :inscriptions="event.inscriptions" :eventId="event.id" />

              <Product v-show="step === 5" :eventId="event.id" :extraProducts="extraProducts" :products="event.products" />

              <Kit v-show="step === 6" :kits="event.kits" :eventId="event.id" :inscriptions="event.inscriptions"
                :hasProductsAndKits="event.has_products_and_kits" :extraProducts="extraProducts" :products="products" />
              <Values v-show="step === 7" :inscriptions="event.inscriptions" :kits="event.kits" :eventId="event.id" />
              <!-- <NumberOfProductsPerSubscription v-show="step === 8" :inscriptions="event.inscriptions"
                :eventId="event.id" /> -->
              <PaymentMethods v-show="step === 8" :event="event" :inscriptions="event.inscriptions" />
              <Route v-show="step === 9" :routes="event.routes" :eventId="event.id" :inscriptions="event.inscriptions" />
            </div>

            <Navigation :hasProductsAndKits="event.has_products_and_kits" />
          </div>
        </div>
      </section>
    </div>
  </div>
</template>

<script setup>
import Sidebar from "@/Layouts/Sidebar.vue";
import { sidebarVisible } from "@/Layouts/sidebar.js";
import { step } from "@/Pages/Event/step.js";
import Navigation from "@/Pages/Event/Partials/Navigation.vue";
import Data from "@/Pages/Event/Partials/Data.vue";
import Location from "@/Pages/Event/Partials/Location.vue";
import GraphicMaterial from "@/Pages/Event/Partials/GraphicMaterial.vue";
import Inscription from "@/Pages/Event/Partials/Inscription.vue";
import Route from "@/Pages/Event/Partials/Route.vue";
import Kit from "@/Pages/Event/Partials/Kit.vue";
import NumberOfProductsPerSubscription from "@/Pages/Event/Partials/NumberOfProductsPerSubscription.vue";
import Values from "@/Pages/Event/Partials/Values.vue";
import PaymentMethods from "./Event/Partials/PaymentMethods.vue";
import Product from "./Event/Partials/Product.vue";


const props = defineProps({
  event: Object,
  eventGraphicMaterials: Array,
  extraProducts: Array,
  products: Array,
});
</script>

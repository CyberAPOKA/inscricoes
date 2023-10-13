<template>
  <div class="flex flex-col gap-8">
    <div v-for="(inscription, index) in inscriptions" :key="inscription.id" class="bg-[#616161] rounded-2xl shadow-all">

      <div :id="'accordion-collapse-' + inscription.id" data-accordion="collapse">
        <div
          class="flex flex-col md:flex-row justify-center md:justify-between items-center rounded-xl relative p-4 bg-white gap-2"
          :class="{ 'md:shadow-xt': expandedInscriptionItems.includes(inscription.id) }">
          <div class="flex items-center gap-4 pl-4 border-r-2 pr-20">
            <div class="target-item-inscriptions cursor-grab" draggable="true"
              @dragstart="dragStartInscription(inscription.index)" @drop="dragDropInscription(inscription.index)"
              @dragover="dragOverInscription" @dragleave="dragLeaveInscription" @dragend="dragEndInscription">

            </div>
            <h1 class="text-[#616161] font-bold text-base">{{ inscription.name }}</h1>
          </div>
          <div class="flex gap-2">
            <p class="text-[#616161] font-medium text-base">{{ inscription.participants }} Atleta(s)
            </p>
            <p class="bg-[#616161] px-2 rounded-md text-white">
              {{ inscription.modality }}
            </p>
          </div>
          <div class="border-l-2 pl-20">
            <h2 class="" :id="'accordion-collapse-heading-' + inscription.id">
              <button type="button" @click="toggleInscriptionAccordionItem(inscription.id)"
                :aria-expanded="expandedInscriptionItems.includes(inscription.id)"
                :aria-controls="'accordion-collapse-body-' + inscription.id">
              </button>
            </h2>
          </div>
        </div>
        <div :id="'accordion-collapse-body-' + inscription.id" class="block"
          v-show="expandedInscriptionItems.includes(inscription.id)"
          :aria-labelledby="'accordion-collapse-heading-' + inscription.id">
          <div class="bg-[#616161] -mt-2 px-2 flex flex-col items-center pb-6 rounded-b-xl gap-20 pt-6">
            <div class="p-2 w-full rounded-xl flex flex-col gap-4">
              <div v-for="(kitInscription, kitIndex) in inscription.kits" :key="kitInscription.id">
                <div :id="'accordion-collapse-' + kitInscription.id" :data-accordion="'collapse-' + kitInscription.id">
                  <div
                    class="bg-[#FFF9AE] flex flex-col md:flex-row justify-center md:justify-between items-center rounded-2xl relative gap-2 w-full shadow-lg p-4">
                    <div class="flex gap-2 ml-4 justify-center items-center">
                      <div class="target-item-kit-inscription cursor-grab" draggable="true"
                        @dragstart="dragStartKitInscription(index, kitIndex)"
                        @drop="dragDropKitInscription(index, kitIndex)" @dragover="dragOverKitInscription"
                        @dragleave="dragLeaveKitInscription" @dragend="dragEndKitInscription">

                      </div>
                      <h2 class="text-[#191919] font-bold text-base">
                        {{ kitInscription.kit.name }}
                      </h2>
                    </div>
                    <div class="grid grid-cols-2 gap-2 md:grid-cols-3 lg:grid-cols-4 py-2">
                      <div v-for="productRelation in kitInscription.kit.products" :key="productRelation.id">
                        <p class="bg-[#616161] px-2 rounded-md text-white">
                          {{ productRelation.product.name }}
                        </p>
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
  </div>
</template>
<script setup></script>
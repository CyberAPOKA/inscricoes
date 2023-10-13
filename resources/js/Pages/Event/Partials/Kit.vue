<template>
  <div>
    <div>
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
                class="mb-6 bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:w-full sm:mx-auto max-w-4xl">
                <div class="p-6">
                  <h1 class="text-3xl font-black text-black text-center">
                    TEM CERTEZA QUE DESEJA REMOVER ESTE PRODUTO DESTE KIT?
                  </h1>
                  <form @submit.prevent="removeProduct(productIdToRemove, kitIdToRemove)"
                    class="col-span-2 flex justify-between items-center mt-4">
                    {{ productIdToRemove }} -- {{ kitIdToRemove }}
                    <button type="button"
                      class="w-32 md:w-52 flex justify-center gap-2 items-center bg-[#FF7171] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all"
                      @click="close">
                      <span>NÃO</span>
                    </button>
                    <button
                      class="w-32 md:w-52 flex justify-center items-center gap-2 bg-[#0DCD71] px-6 text-white font-bold text-xs rounded-lg uppercase hover:cursor-pointer md:mt-6 py-3"
                      type="submit">
                      <span>SIM</span>
                    </button>
                  </form>
                </div>
                <slot v-if="show" />
              </div>
            </transition>
          </div>
        </transition>
      </teleport>
    </div>

    <div v-show="hasProductsAndKits === 'no'">
      <form @submit.prevent="(e) => e.preventDefault()">
        <div class="flex gap-20">
          <button type="button" @click="haveKit(eventId, 'yes')" class="bg-green">
            SIM
          </button>
          <button type="button" @click="step++" class="bg-red-500">NÃO</button>
        </div>
      </form>
    </div>

    <div v-show="hasProductsAndKits === 'yes'">
      <h1 class="font-black text-3xl">CRIE AQUI O(S) SEU(OS) KIT(S) DO SEU EVENTO:</h1>
      <button data-modal-target="kitCreateModal" data-modal-toggle="kitCreateModal"
        class="bg-[#0DCD71] flex items-center justify-center w-full gap-4 px-4 py-2 rounded-xl my-4" type="button">
        <span class="text-white font-bold text-xl">ADICIONAR KIT</span>
      </button>

      <!-- Main modal -->
      <div id="kitCreateModal" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="modal-backdrop" data-modal-hide="kitCreateModal"></div>
        <div class="relative w-full max-w-6xl max-h-full">
          <!-- Modal content -->
          <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <form @submit.prevent="kitCreate" enctype="multipart/form-data">
              <!-- Modal header -->
              <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h1 class="text-3xl font-black text-black">CRIAR KIT:</h1>
                <button type="button"
                  class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                  data-modal-hide="kitCreateModal">
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                  </svg>
                  <span class="sr-only">Close modal</span>
                </button>
              </div>
              <!-- Modal body -->
              <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-y-4 md:gap-8">
                  <div class="col-span-2 grid grid-cols-2 gap-4">
                    <div>
                      <label for="kit-name" class="block mb-2 text-sm font-medium text-gray-900">Nome do kit:*</label>
                      <input type="text" id="kit-name" v-model="kitForm.name"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all" />
                    </div>
                    <div class="md:col-span-1">
                      <label for="kit-athletes-amount"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantidade de atletas do
                        kit*</label>
                      <select id="kit-athletes-amount" v-model="kitForm.athletes_amount"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all">
                        <option value="1">1 atleta</option>
                        <option value="2">2 atletas</option>
                        <option value="3">3 atletas</option>
                        <option value="4">4 atletas</option>
                        <option value="5">5 atletas</option>
                        <option value="6">6 atletas</option>
                        <option value="7">7 atletas</option>
                        <option value="8">8 atletas</option>
                        <option value="9">9 atletas</option>
                        <option value="10">10 atletas</option>
                      </select>
                    </div>
                    <div class="col-span-2 h-full">
                      <label for="kit-observation"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observação</label>
                      <textarea id="kit-observation" v-model="kitForm.observation" rows="10"
                        class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border-none shadow-all h-fit"></textarea>
                    </div>
                  </div>

                  <div>
                    <h1 class="mb-2">Foto do kit</h1>
                    <div class="flex items-center justify-center w-full" v-if="!kitForm.image">
                      <label for="dropzone-kit-image"
                        class="flex flex-col md:flex-row items-center justify-center w-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer shadow-all py-32">
                        <div class="flex flex-col items-center justify-center">
                          CLIQUE AQUI
                        </div>
                        <input id="dropzone-kit-image" type="file" class="hidden" @change="onFileSelect('image', $event)"
                          accept="image/*" />
                      </label>
                    </div>
                    <div v-else class="relative">
                      <img :src="imageKitPreviewUrl" v-if="imageKitPreviewUrl" />

                      <button class="absolute top-2 right-2 cursor-pointer" type="button" @click="clearKitImage">
                        <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                          viewBox="0 0 14 14">
                          <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Modal footer -->
              <div
                class="flex items-center justify-between p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                <button type="button"
                  class="md:w-52 flex justify-center gap-2 items-center bg-[#FF7171] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all"
                  data-modal-hide="kitCreateModal">
                  <span>Cancelar</span>
                </button>
                <button data-modal-hide="kitCreateModal"
                  class="md:w-52 flex justify-center items-center gap-2 bg-[#0DCD71] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all hover:cursor-pointer"
                  type="submit">
                  <span>Salvar</span>
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="shadow-all p-6 mt-4 mb-8 rounded-xl" v-show="kits.length != 0">
        <h1 class="font-black text-3xl text-center">Kits cadastrados:</h1>
        <div v-for="kit in kits" :key="kit.id" class="py-4">
          <h1 class="font-black text-xl mb-2">Kit {{ kit.id }}</h1>
          <div id="accordion-collapse" data-accordion="collapse">
            <div
              class="flex flex-col md:flex-row justify-center md:justify-between items-center shadow-all rounded-xl relative p-4 bg-white gap-2"
              :class="{ 'md:shadow-xt': expandedKitItems.includes(kit.id) }">
              <div>
                <h2 class="absolute top-2 right-4 md:hidden" :id="'accordion-collapse-heading-' + kit.id">
                  <button type="button" @click="toggleKitAccordionItem(kit.id)"
                    :aria-expanded="expandedKitItems.includes(kit.id)"
                    :aria-controls="'accordion-collapse-body-' + kit.id">
                    <svg data-accordion-icon class="w-4 h-4" :class="{ 'rotate-180': expandedKitItems.includes(kit.id) }"
                      viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                        d="M1.645 8.8667L7 3.92203L12.355 8.8667L14 7.34443L7 0.8667L-1.30708e-07 7.34443L1.645 8.8667Z"
                        fill="#191919" />
                    </svg>
                  </button>
                </h2>
                <div class="flex gap-4">
                  <h1 class="text-[#616161] font-bold text-xl">
                    {{ kit.name }}
                  </h1>
                  <h1 class="text-[#616161] font-bold text-xl border-l-2 border-[#CECECE] pl-4">
                    {{ kit.athletes_amount }} Atleta(s)
                  </h1>
                </div>
              </div>
              <div class="grid grid-cols-2 md:grid-cols-3 2xl:grid-cols-4 gap-4 md:border-x md:border-black md:px-4">
                <div v-for="inscriptionRelation in kit.inscriptions" :key="inscriptionRelation.id">
                  <p class="bg-[#616161] px-2 rounded-md text-white text-center">
                    {{ inscriptionRelation.event_inscription.name }}
                  </p>
                </div>
              </div>
              <div class="flex gap-8 items-center my-4 md:my-0">
                <div>
                  <form @submit.prevent="duplicateKit(kit)" class="flex">
                    <button>
                      <svg class="w-5 h-5" viewBox="0 0 13 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M9.57895 0H1.36842C0.615789 0 0 0.572727 0 1.27273V10.1818H1.36842V1.27273H9.57895V0ZM8.89474 2.54545L13 6.36364V12.7273C13 13.4273 12.3842 14 11.6316 14H4.09842C3.34579 14 2.73684 13.4273 2.73684 12.7273L2.74368 3.81818C2.74368 3.11818 3.35263 2.54545 4.10526 2.54545H8.89474ZM11.9737 7H8.21053V3.5L11.9737 7Z"
                          fill="#191919" />
                      </svg>
                    </button>
                  </form>
                </div>

                <!-- START KIT EDIT -->
                <div class="flex">
                  <button @click="openKitEditModal(kit.id)">
                    <svg class="w-5 h-5" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M14.7563 2.91391C15.0812 3.21721 15.0812 3.70714 14.7563 4.01043L13.2315 5.43356L10.1069 2.5173L11.6317 1.09417C11.9567 0.790876 12.4816 0.790876 12.8066 1.09417L14.7563 2.91391ZM0 14.8667V11.9504L9.21539 3.34941L12.34 6.26567L3.12457 14.8667H0Z"
                        fill="#191919" />
                    </svg>
                  </button>
                </div>

                <div v-if="isKitEditModalOpen(kit.id)" :id="'kitEditModal-' + kit.id" tabindex="-1" aria-hidden="true"
                  class="fixed flex items-center justify-center top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                  <div class="modal-lot-create-backdrop" @click="closeKitEditModal(kit.id)"></div>
                  <div class="relative w-full max-w-6xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                      <form @submit.prevent="kitEdit(kit)">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                          <h3 class="text-3xl font-black text-black">EDITAR KIT:</h3>
                          <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            @click="closeKitEditModal(kit.id)">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                              viewBox="0 0 14 14">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                          </button>
                        </div>
                        <!-- Modal body -->

                        <div class="p-6">
                          <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <div class="col-span-2">
                              <div>
                                <label for="kit-edit-name" class="block mb-2 text-sm font-medium text-gray-900">Nome do
                                  kit:*</label>
                                <input type="text" id="kit-edit-name" v-model="kit.name"
                                  class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all" />
                              </div>
                              <div class="mt-4">
                                <label for="kit-edit-observation"
                                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observação</label>
                                <textarea id="kit-edit-observation" v-model="kit.observation" rows="4"
                                  class="block p-2.5 w-full text-sm text-gray-900 rounded-lg border-none shadow-all"></textarea>
                              </div>
                              <div class="mt-4">
                                <label for="kit-athletes-amount"
                                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantidade de
                                  atletas do
                                  kit*</label>
                                <select id="kit-athletes-amount" v-model="kit.athletes_amount"
                                  class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all">
                                  <option value="1">1 atleta</option>
                                  <option value="2">2 atletas</option>
                                  <option value="3">3 atletas</option>
                                  <option value="4">4 atletas</option>
                                  <option value="5">5 atletas</option>
                                  <option value="6">6 atletas</option>
                                  <option value="7">7 atletas</option>
                                  <option value="8">8 atletas</option>
                                  <option value="9">9 atletas</option>
                                  <option value="10">10 atletas</option>
                                </select>
                              </div>
                            </div>
                            <div class="flex flex-col">
                              <h1 class="mb-2">Foto do kit</h1>
                              <div class="flex items-center justify-center w-full h-full" v-if="!kit.image_path">
                                <label :for="'dropzone-kit-image-edit-' + kit.id"
                                  class="flex flex-col h-full items-center justify-center w-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer shadow-all py-4">
                                  <div class="flex flex-col items-center justify-center">
                                    CLIQUE AQUI
                                  </div>
                                  <input :id="'dropzone-kit-image-edit-' + kit.id" type="file" class="hidden"
                                    @change="onFileSelectEditKit('image', $event, kit.id)" accept="image/*" />
                                </label>
                              </div>
                              <div v-else class="relative">
                                <img v-if="kit.image_path" :src="'../storage/' + kit.image_path"
                                  class="w-full h-72 md:w-fit md:h-72 rounded-xl" alt="" />
                                <button class="absolute top-2 right-2 cursor-pointer" type="button"
                                  @click="deleteImage(kit.id)">
                                  <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                  </svg>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Modal footer -->
                        <div
                          class="flex items-center justify-between p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                          <button type="button"
                            class="md:w-52 flex justify-center items-center bg-[#FF7171] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all gap-2"
                            @click="closeKitEditModal(kit.id)">
                            <svg width="23" height="22" viewBox="0 0 23 22" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M3.72183 3.22178C8.01538 -1.07177 14.9846 -1.07177 19.2782 3.22178C23.5717 7.51533 23.5717 14.4846 19.2782 18.7781C14.9846 23.0717 8.01538 23.0717 3.72183 18.7781C-0.571727 14.4846 -0.571727 7.51533 3.72183 3.22178ZM11.5 12.5556L14.6113 15.6669L16.1669 14.1112L13.0556 11L16.1669 7.88868L14.6113 6.33305L11.5 9.44432L8.38873 6.33305L6.83309 7.88868L9.94436 11L6.83309 14.1112L8.38873 15.6669L11.5 12.5556Z"
                                fill="white" />
                            </svg>
                            <span>Cancelar</span>
                          </button>
                          <button
                            class="md:w-52 flex justify-center items-center gap-2 bg-[#0DCD71] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all hover:cursor-pointer"
                            type="submit">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M0 11C0 4.928 4.928 0 11 0C17.072 0 22 4.928 22 11C22 17.072 17.072 22 11 22C4.928 22 0 17.072 0 11ZM12.1 12.1H16.5V9.9H12.1V5.5H9.9V9.9H5.5V12.1H9.9V16.5H12.1V12.1Z"
                                fill="white" />
                            </svg>
                            <span>SALVAR KIT</span>
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- END KIT EDIT -->
                <form @submit.prevent="kitDelete(kit.id)" class="flex">
                  <button type="submit">
                    <svg class="w-5 h-5" viewBox="0 0 10 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.5 1.64448H10V3.20003H0V1.64448H2.5L3.21429 0.866699H6.78571L7.5 1.64448ZM2.14286 14.8667C1.35714 14.8667 0.714286 14.1667 0.714286 13.3111V3.97781H9.28571V13.3111C9.28571 14.1667 8.64286 14.8667 7.85714 14.8667H2.14286Z"
                        fill="#191919" />
                    </svg>
                  </button>
                </form>

                <button class="hidden md:block" :id="'accordion-collapse-heading-' + kit.id" type="button"
                  @click="toggleKitAccordionItem(kit.id)" :aria-expanded="expandedKitItems.includes(kit.id)"
                  :aria-controls="'accordion-collapse-body-' + kit.id">
                  <svg data-accordion-icon class="w-4 h-4" :class="{ 'rotate-180': expandedKitItems.includes(kit.id) }"
                    viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.645 8.8667L7 3.92203L12.355 8.8667L14 7.34443L7 0.8667L-1.30708e-07 7.34443L1.645 8.8667Z"
                      fill="#191919" />
                  </svg>
                </button>
              </div>
            </div>

            <div :id="'accordion-collapse-body-' + kit.id" class="block" v-show="expandedKitItems.includes(kit.id)"
              :aria-labelledby="'accordion-collapse-heading-' + kit.id">
              <div class="bg-[#616161] -mt-2 px-2 flex flex-col items-center pb-6 rounded-b-xl gap-4 pt-6">
                <div class="bg-gray-100 p-6 w-full rounded-xl">
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-y-8 gap-4">
                    <div class="col-span-2 md:col-span-1">
                      <img v-if="kit.image_path" :src="'../storage/' + kit.image_path"
                        class="w-full h-72 md:w-fit md:h-96 rounded-xl" alt="" />
                    </div>
                    <div class="col-span-1 md:col-span-2 flex flex-col gap-2">
                      <h1 class="text-[#616161] font-bold text-xl">{{ kit.name }}:</h1>
                      <label for="kit.observation" class="mt-2">Observação: </label>
                      <textarea name="" id="kit.observation" readonly cols="30" rows="6" v-model="kit.observation"
                        class="rounded-xl border-none shadow-all"></textarea>

                      <div v-if="kit.products && kit.products.length > 0" class="flex flex-col gap-2">
                        <div v-for="product in kit.products" :key="product.id">
                          <div
                            class="bg-white flex justify-between items-center shadow-all rounded-xl py-1 md:py-0 gap-y-4">
                            <p class="col-span-3 md:ml-4 font-bold text-[#616161] text-xl pr-4">
                              <span>{{ product.name }}</span>
                            </p>

                            <div
                              class="col-span-2 bg-[#616161] flex justify-around items-center gap-12 md:gap-4 p-4 rounded-r-xl rounded-l-xl md:rounded-l-none h-full">

                              <button @click="openModal(product.id, kit.id)" type="button">
                                <SvgBug />
                              </button>

                            </div>
                          </div>
                        </div>
                      </div>
                      <div v-else>
                        não tem produto
                      </div>
                    </div>
                  </div>
                </div>
                <!-- START PRODUCT CREATE  -->
                <button
                  class="flex justify-center items-center gap-2 bg-[#0DCD71] px-6 py-3 text-white font-bold text-lg rounded-lg uppercase hover:cursor-pointer"
                  @click="openProductCreateModal(kit.id)" type="button">
                  <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M0 11C0 4.928 4.928 0 11 0C17.072 0 22 4.928 22 11C22 17.072 17.072 22 11 22C4.928 22 0 17.072 0 11ZM12.1 12.1H16.5V9.9H12.1V5.5H9.9V9.9H5.5V12.1H9.9V16.5H12.1V12.1Z"
                      fill="white" />
                  </svg>
                  <span>ADICIONAR
                    <!-- <span v-if="inscription.lots != ''">NOVO</span> -->
                    PRODUTO</span>
                </button>

                <!-- Main modal -->
                <div v-if="isProductCreateModalOpen(kit.id)" :id="'productCreateModal-' + kit.id" tabindex="-1"
                  aria-hidden="true"
                  class="fixed flex items-center justify-center top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                  <div class="modal-lot-create-backdrop" @click="closeProductCreateModal(kit.id)"></div>
                  <div class="relative w-full max-w-6xl max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                      <form @submit.prevent="productsKit(kit.id)">
                        <!-- Modal header -->
                        <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                          <h3 class="text-3xl font-black text-black">ADICIONAR PRODUTO AO KIT:</h3>
                          <button type="button"
                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            @click="closeProductCreateModal(kit.id)">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                              viewBox="0 0 14 14">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                          </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-6">
                          <!-- {{ kit }} -->
                          <div class="pt-4 md:col-span-2 w-full">
                            <label for="kit-inscriptions"
                              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecionar os produtos
                              para o
                              <span class="text-[#616161] font-bold">{{ kit.name }}</span>
                            </label>
                            <Multiselect v-model="productsKitsForms[kit.id].selectedProductIds" class="shadow-all p-0.5"
                              mode="tags" :close-on-select="false" :searchable="true" :create-option="false"
                              :options="formattedProducts" :reduce="(label) => label.value" />
                            <!-- {{ productsKitsForms[kit.id].selectedProductIds }} -->

                            <div class="bg-white flex items-center gap-8 shadow-xt rounded-[10px] mt-8 relative">
                              <h1 class="text-[#616161] font-bold text-sm m-4">{{ kit.name }}</h1>
                              <h2 class="text-[#616161] font-bold text-xs pl-4">{{ kit.athletes_amount }} Atleta(s)</h2>
                            </div>
                            <div class="-mt-4 bg-[#616161] pt-6 px-2 pb-2 rounded-b-[10px]">
                              <div class="bg-[#F9F9F9] rounded-[10px] p-4 flex flex-col gap-2">
                                <div class="grid grid-cols-3 text-[#616161] text-xs font-normal">
                                  <h1 class="pl-4">Produto</h1>
                                  <h1 class="text-center">Insira a quantidade para esse kit</h1>
                                  <h1 class="text-center">Disponíveis no estoque</h1>
                                </div>
                                <div v-for="product in selectedProductsForKit(kit.id)" :key="product.value">
                                  <div
                                    class="grid grid-cols-3 items-center justify-stretch shadow-all rounded-[10px] bg-white min-h-[3rem]">
                                    <h1 class="pl-4 text-[#616161] font-bold text-xs">{{ product.label }}</h1>
                                    <div class="w-full flex justify-center items-center">
                                      <input type="number" v-model="productsKitsForms[kit.id].quantities[product.value]"
                                        class="rounded-[5px] w-16 text-center h-8 shadow-all border-none text-[#191919] font-black text-xs">
                                    </div>
                                    <p
                                      class="bg-[#616161] h-full flex justify-center items-center rounded-r-[10px] text-white font-medium text-xs">
                                      {{ product.maximum_amount }}
                                    </p>
                                  </div>
                                  <div v-if="productsKitsForms[kit.id].quantities[product.value] !== kit.athletes_amount"
                                    class="bg-[#FFEC00] rounded-b-[10px] flex justify-center items-center gap-2 p-2">
                                    <SvgBug />
                                    <p class="text-[#191919] text-xs font-normal">A quantidade de vezes deste produto é
                                      diferente da quantidade de atletas deste kit.</p>
                                  </div>
                                </div>

                              </div>
                            </div>
                            <div class="bg-[#FFEC00] rounded-[20px] flex justify-center items-center gap-2 p-2 mt-4">
                              <SvgBug />
                              <p class="text-[#191919] text-xs font-normal">Importante saber que os kits não serão mais
                                vendidos assim que o estoque de produtos esgotar.</p>
                            </div>
                          </div>
                        </div>
                        <!-- Modal footer -->
                        <div
                          class="flex items-center justify-between p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                          <button type="button"
                            class="md:w-52 flex justify-center gap-2 items-center bg-[#FF7171] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all"
                            @click="closeProductCreateModal(kit.id)">
                            <svg width="23" height="22" viewBox="0 0 23 22" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M3.72183 3.22178C8.01538 -1.07177 14.9846 -1.07177 19.2782 3.22178C23.5717 7.51533 23.5717 14.4846 19.2782 18.7781C14.9846 23.0717 8.01538 23.0717 3.72183 18.7781C-0.571727 14.4846 -0.571727 7.51533 3.72183 3.22178ZM11.5 12.5556L14.6113 15.6669L16.1669 14.1112L13.0556 11L16.1669 7.88868L14.6113 6.33305L11.5 9.44432L8.38873 6.33305L6.83309 7.88868L9.94436 11L6.83309 14.1112L8.38873 15.6669L11.5 12.5556Z"
                                fill="white" />
                            </svg>
                            <span>Cancelar</span>
                          </button>
                          <button
                            class="md:w-52 flex justify-center items-center gap-2 bg-[#0DCD71] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all hover:cursor-pointer"
                            type="submit">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M0 11C0 4.928 4.928 0 11 0C17.072 0 22 4.928 22 11C22 17.072 17.072 22 11 22C4.928 22 0 17.072 0 11ZM12.1 12.1H16.5V9.9H12.1V5.5H9.9V9.9H5.5V12.1H9.9V16.5H12.1V12.1Z"
                                fill="white" />
                            </svg>
                            <span>SALVAR</span>
                          </button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                <!-- END PRODUCT CREATE  -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <div v-show="kits.length === 0" class="bg-[#ECECEC] rounded-xl py-12 flex justify-center items-center">
        <h1 class="text-[#616161] font-medium text-sm">Nenhum Kit cadastrado</h1>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch, reactive, onMounted, computed, watchEffect } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import { step } from "../step";
import Multiselect from "@vueform/multiselect";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";
import SvgBug from "@/Pages/Svgs/SvgBug.vue";

const toast = useToast();

const props = defineProps({
  kits: Array,
  inscriptions: Array,
  eventId: Number,
  hasProductsAndKits: String,
  extraProducts: Array,
  products: Array,
});

const formattedProducts = ref(
  props.products.map((item) => ({
    value: item.id,
    label: item.name,
    maximum_amount: item.maximum_amount
  }))
);

watch(
  () => props.products,
  (newProducts) => {
    formattedProducts.value = newProducts.map((product) => ({
      value: product.id,
      label: product.name,
      maximum_amount: product.maximum_amount
    }));
  },
  { deep: true }
);

const formattedInscriptions = ref(
  props.inscriptions.map((item) => ({
    value: item.id,
    label: item.name,
  }))
);

const selectedKits = reactive({});

onMounted(() => {
  props.kits.forEach((kit) => {
    selectedKits[kit.id] = [kit.id];
  });
});

function haveKit(id, value) {
  router.put(
    route("event.has.products.and.kits", { id: id }),
    {
      has_products_and_kits: value,
    },
    {
      preserveScroll: true,
    }
  );
}

const imageKitPreviewUrl = ref("");

function onFileSelect(field, event) {
  const files = event.target.files;

  if (files.length === 1) {
    const file = files[0];
    const imageTypes = [
      "image/jpeg",
      "image/png",
      "image/gif",
      "image/webp",
      "image/bmp",
      "image/svg+xml",
    ];

    if (imageTypes.includes(file.type)) {
      if (file.size <= 3 * 1024 * 1024) {
        // 3MB
        kitForm[field] = file;
        imageKitPreviewUrl.value = URL.createObjectURL(file);
      } else {
        event.target.value = null;
        alert("A imagem deve ter no máximo 3MB.");
      }
    } else {
      event.target.value = null;
      alert("Por favor, selecione uma imagem.");
    }
  } else {
    event.target.value = null;
    alert("1 Arquivo no máximo.");
  }
}

function onFileSelectEditKit(field, event, id) {
  const files = event.target.files;
  console.log("start onFileSelectEditKit");
  if (files.length === 1) {
    const file = files[0];
    const imageTypes = [
      "image/jpeg",
      "image/png",
      "image/gif",
      "image/webp",
      "image/bmp",
      "image/svg+xml",
    ];
    if (imageTypes.includes(file.type)) {
      if (file.size <= 3 * 1024 * 1024) {
        // 3MB
        kitForm[field] = file;
        console.log("222");
        router.post(
          route("event.kit.update.image", { id: id }),
          {
            event_id: props.eventId,
            field: field,
            file: file,
          },
          {
            preserveScroll: true,
          }
        );
      } else {
        event.target.value = null;
        alert("A imagem deve ter no máximo 3MB.");
      }
    } else {
      event.target.value = null;
      alert("Por favor, selecione uma imagem.");
    }
  } else {
    event.target.value = null;
    alert("1 Arquivo no máximo.");
  }
}

function clearKitImage() {
  imageKitPreviewUrl.value = "";
  const fileInputKit = document.getElementById("dropzone-kit-image");
  if (fileInputKit) {
    fileInputKit.value = "";
  }
  kitForm.image = null;
}

const expandedKitItems = ref(props.kits.map((i) => i.id));

const toggleKitAccordionItem = (itemId) => {
  const index = expandedKitItems.value.indexOf(itemId);
  if (index === -1) {
    expandedKitItems.value.push(itemId);
  } else {
    expandedKitItems.value.splice(index, 1);
  }
};

watch(
  () => props.kits,
  (newKits, oldKits) => {
    if (newKits.length > oldKits.length) {
      const newKit = newKits.find((kit) => !oldKits.includes(kit));

      if (newKit && !expandedKitItems.value.includes(newKit.id)) {
        expandedKitItems.value.push(newKit.id);
      }
    }
  },
  { deep: true }
);

// START KIT EDIT
const openKitEditModals = ref([]);
const openKitEditModal = (id) => {
  if (!openKitEditModals.value.includes(id)) {
    openKitEditModals.value.push(id);
  }
};
const closeKitEditModal = (id) => {
  const index = openKitEditModals.value.indexOf(id);
  if (index > -1) {
    openKitEditModals.value.splice(index, 1);
  }
};
const isKitEditModalOpen = (id) => openKitEditModals.value.includes(id);
// END KIT EDIT

// START PRODUCT CREATE
const openProductCreateModals = ref([]);
const openProductCreateModal = (id) => {
  if (!openProductCreateModals.value.includes(id)) {
    openProductCreateModals.value.push(id);
    selectedKits[id] = [id];
  }
};

const closeProductCreateModal = (id) => {
  const index = openProductCreateModals.value.indexOf(id);
  if (index > -1) {
    openProductCreateModals.value.splice(index, 1);
    delete selectedKits[id];
  }
};

const isProductCreateModalOpen = (id) => openProductCreateModals.value.includes(id);
// END PRODUCT CREATE

// START INSCRIPTION KIT
const selectedInscriptionsForKits = ref({});

onMounted(() => {
  props.kits.forEach((kit) => {
    selectedInscriptionsForKits.value[kit.id] = kit.inscriptions.map(
      (i) => i.event_inscription_id
    );
  });
});

watch(
  () => props.kits,
  (newRoutes) => {
    newRoutes.forEach((kit) => {
      if (!selectedInscriptionsForKits.value[kit.id]) {
        selectedInscriptionsForKits.value[kit.id] = kit.inscriptions.map(
          (i) => i.event_inscription_id
        );
      }
    });
  },
  { deep: true }
);
// END INSCRIPTION KIT

const kitForm = useForm({
  name: "",
  observation: "",
  athletes_amount: "",
  image: null
});

const kitCreate = () => {
  kitForm.post(route("event.kit.create", { id: props.eventId }), {
    preserveScroll: true,
    onSuccess: (response) => {

    },
  });
};


watch(
  () => props.inscriptions,
  (newInscriptions) => {
    formattedInscriptions.value = newInscriptions.map((inscription) => ({
      value: inscription.id,
      label: inscription.name,
    }));
  },
  { deep: true }
);

//start productkit
const productsKitsForms = reactive(
  props.kits.reduce((acc, kit) => {
    acc[kit.id] = {
      selectedProductIds: kit.products.map(product => product.id),
      quantities: kit.products.reduce((quantitiesObj, product) => {
        quantitiesObj[product.id] = product.pivot.quantity;
        return quantitiesObj;
      }, {})
    };
    return acc;
  }, {})
);

const productsKit = (currentKitId) => {
  console.log('ids:', productsKitsForms[currentKitId].selectedProductIds);
  router.post(route("event.kit.relation.products.create", { id: currentKitId }),
    {
      productIds: productsKitsForms[currentKitId].selectedProductIds,
      quantities: productsKitsForms[currentKitId].quantities
    },
    {
      preserveScroll: true,
    }
  );
};

const selectedProductsForKit = (kitId) => {
  return productsKitsForms[kitId].selectedProductIds
    .map(id => formattedProducts.value.find(product => product.value === id))
    .filter(product => product);
};

watchEffect(() => {
  props.kits.forEach(kit => {
    if (!productsKitsForms[kit.id]) {
      productsKitsForms[kit.id] = {
        selectedProductIds: kit.products.map(product => product.id),
        quantities: kit.products.reduce((quantitiesObj, product) => {
          quantitiesObj[product.id] = product.pivot.quantity;
          return quantitiesObj;
        }, {})
      };
    }
  });
});

//end productkit

function deleteImage(id) {
  router.delete(route("event.kit.delete.image", { id: id }), {
    preserveScroll: true,
  });
}

function kitDelete(id) {
  router.delete(route("event.kit.delete", { id: id }), {
    preserveScroll: true,
  });
}


function kitEdit(item) {
  console.log(item);
  router.put(
    route("event.kit.edit", { id: item.id }),
    {
      name: item.name,
      observation: item.observation,
      observation: item.observation,
      athletes_amount: item.athletes_amount,
      //era usado para relação entre kits e inscrições.
      //inscriptions: selectedInscriptionsForKits.value[item.id],
    },
    {
      preserveScroll: true,
    }
  );
  closeKitEditModal(item.id);
  toast.success("Dados editados com Sucesso!", {
    position: "top-right",
    duration: 5000,
  });
}

function duplicateKit(kit) {
  console.log(kit);
  router.post(
    route("event.kit.duplicate", { id: props.eventId }),
    {
      kit: kit,
    },
    {
      preserveScroll: true,
    }
  );
  toast.success("Kit duplicado com Sucesso!", {
    position: "top-right",
    duration: 5000,
  });
}



const show = ref(false);
const productIdToRemove = ref(null);
const kitIdToRemove = ref(null);

function openModal(id, kitId) {
  productIdToRemove.value = id;
  kitIdToRemove.value = kitId;
  show.value = true;
}

function close(id) {
  show.value = false;
}

function removeProduct(id, kitIdToRemove) {
  router.post(route("event.remove.product.from.kit", { id: props.eventId }),
    {
      // teste: "teste"
      product_id: id,
      kit_id: kitIdToRemove
    },
    {
      preserveScroll: true,
      onSuccess: () => {
        show.value = false;
        formattedProducts.value = formattedProducts.value.filter(product => product.value !== id);

        for (const kitId in productsKitsForms) {
          productsKitsForms[kitId].selectedProductIds = productsKitsForms[kitId].selectedProductIds.filter(productId => productId !== id);
          if (productsKitsForms[kitId].quantities[id]) {
            delete productsKitsForms[kitId].quantities[id];
          }
        }
      }
    });
}

// function removeProduct(id, kitIdToRemove) {
//   router.put(
//     route("event.remove.product.from.kit", { id: id }),
//     {
//       teste: "testezzz",
//     },
//     {
//       preserveScroll: true,
//     }
//   );
// }

</script>
<style>
.backdrop-blur {
  backdrop-filter: blur(5px);
}

.disabled-kits .multiselect-tag {
  background-color: #616161 !important;
}

.is-disabled .multiselect-wrapper {
  background: white !important;
  border-radius: 0.5rem !important;
}

.modal-product-create-backdrop {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.3);
  z-index: -1;
}

.modal-lot-create-backdrop {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.3);
  z-index: -1;
}
</style>


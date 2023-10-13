<template>
  <div>
    <!-- {{ inscriptions }} -->
    <h1 class="font-black text-3xl">
      CRIE AQUI A(S) INCRIÇÃO(ÕES) E O(S) LOTE(S) DO SEU EVENTO:
    </h1>
    <button
      data-modal-target="inscriptionModal"
      data-modal-toggle="inscriptionModal"
      class="bg-[#0DCD71] flex items-center justify-center w-full gap-4 px-4 py-2 rounded-xl my-4"
      type="button"
    >
      <svg
        width="22"
        height="23"
        viewBox="0 0 22 23"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
      >
        <path
          fill-rule="evenodd"
          clip-rule="evenodd"
          d="M0 11.5C0 5.428 4.928 0.5 11 0.5C17.072 0.5 22 5.428 22 11.5C22 17.572 17.072 22.5 11 22.5C4.928 22.5 0 17.572 0 11.5ZM12.1 12.6H16.5V10.4H12.1V6H9.9V10.4H5.5V12.6H9.9V17H12.1V12.6Z"
          fill="white"
        />
      </svg>
      <span class="text-white font-bold text-xl"
        >ADICIONAR <span v-if="inscriptions.length != 0">NOVA</span> INSCRIÇÃO</span
      >
    </button>

    <!-- Main modal -->
    <div
      id="inscriptionModal"
      tabindex="-1"
      aria-hidden="true"
      class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
    >
      <div class="relative w-full max-w-6xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <form @submit.prevent="inscriptionSubmit">
            <!-- Modal header -->
            <div
              class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600"
            >
              <h1 class="text-3xl font-black text-black">
                CRIAR INSCRIÇÃO PARA SEU EVENTO:
              </h1>
              <button
                type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="inscriptionModal"
              >
                <svg
                  class="w-3 h-3"
                  aria-hidden="true"
                  xmlns="http://www.w3.org/2000/svg"
                  fill="none"
                  viewBox="0 0 14 14"
                >
                  <path
                    stroke="currentColor"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                  />
                </svg>
                <span class="sr-only">Close modal</span>
              </button>
            </div>
            <!-- Modal body -->
            <div class="p-6">
              <div class="flex flex-col md:flex-row gap-2 w-full">
                <div class="w-full">
                  <label
                    for="inscription-name"
                    class="block mb-2 text-sm font-medium text-gray-900"
                    >Nome da inscrição*</label
                  >
                  <input
                    type="text"
                    id="inscription-name"
                    v-model="inscriptionForm.name"
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
                  />
                </div>
                <div class="flex items-end w-full gap-2">
                  <div class="w-full relative">
                    <label
                      for="participants"
                      class="block text-sm font-medium text-gray-900"
                      >Participantes por inscrição*</label
                    >
                    <div
                      class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full shadow-all text-center"
                    >
                      <div class="flex justify-center items-center py-2 max-h-10 gap-1">
                        <button
                          type="button"
                          @click="decreaseNumberInscriptionCreate"
                          class="bg-[#277901] text-white py-[0.1rem] px-2 rounded-l-md text-xl"
                        >
                          <p class="mb-[0.05rem]">-</p>
                        </button>
                        <input
                          type="number"
                          id="participants"
                          v-model="inscriptionForm.participants"
                          class="bg-white border border-gray-300 text-gray-900 text-sm block shadow-all text-center w-20 max-h-8"
                        />
                        <button
                          type="button"
                          @click="increaseNumberInscriptionCreate"
                          class="bg-[#277901] text-white py-[0.1rem] px-2 rounded-r-md text-xl"
                        >
                          <p class="mb-[0.05rem]">+</p>
                        </button>
                      </div>
                    </div>
                  </div>
                  <div class="w-full">
                    <div>
                      <label
                        for="modality"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                        >Modalidade*</label
                      >
                      <select
                        id="modality"
                        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
                        v-model="inscriptionForm.modality"
                      >
                        <option selected></option>
                        <option value="Natação">Natação</option>
                        <option value="Ciclismo">Ciclismo</option>
                        <option value="Corrida de Obstáculos">
                          Corrida de Obstáculos
                        </option>
                        <option value="Triathlon">Triathlon</option>
                        <option value="Duathlon">Duathlon</option>
                        <option value="Outros">Outros</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <div class="w-full pt-6">
                <label
                  for="restrictions"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                  >Restrições*</label
                >
                <select
                  id="restrictions"
                  class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
                  v-model="inscriptionForm.restrictions"
                >
                  <option selected></option>
                  <option value="Menor que 10 anos">Menor que 10 anos</option>
                  <option value="Menor que 14 anos">Menor que 14 anos</option>
                  <option value="Menor que 16 anos">Menor que 16 anos</option>
                  <option value="Sexo Feminino">Sexo Feminino</option>
                  <option value="Sexo Masculino">Sexo Masculino</option>
                </select>
              </div>
            </div>
            <!-- Modal footer -->
            <div
              class="flex items-center justify-between p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600"
            >
              <button
                type="button"
                class="md:w-52 flex justify-center gap-2 items-center bg-[#FF7171] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all"
                data-modal-hide="inscriptionModal"
              >
                <svg
                  width="23"
                  height="22"
                  viewBox="0 0 23 22"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M3.72183 3.22178C8.01538 -1.07177 14.9846 -1.07177 19.2782 3.22178C23.5717 7.51533 23.5717 14.4846 19.2782 18.7781C14.9846 23.0717 8.01538 23.0717 3.72183 18.7781C-0.571727 14.4846 -0.571727 7.51533 3.72183 3.22178ZM11.5 12.5556L14.6113 15.6669L16.1669 14.1112L13.0556 11L16.1669 7.88868L14.6113 6.33305L11.5 9.44432L8.38873 6.33305L6.83309 7.88868L9.94436 11L6.83309 14.1112L8.38873 15.6669L11.5 12.5556Z"
                    fill="white"
                  />
                </svg>
                <span>Cancelar</span>
              </button>
              <button
                data-modal-hide="inscriptionModal"
                class="md:w-52 flex justify-center items-center gap-2 bg-[#0DCD71] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all hover:cursor-pointer"
                type="submit"
              >
                <svg
                  width="22"
                  height="22"
                  viewBox="0 0 22 22"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M0 11C0 4.928 4.928 0 11 0C17.072 0 22 4.928 22 11C22 17.072 17.072 22 11 22C4.928 22 0 17.072 0 11ZM12.1 12.1H16.5V9.9H12.1V5.5H9.9V9.9H5.5V12.1H9.9V16.5H12.1V12.1Z"
                    fill="white"
                  />
                </svg>
                <span>Salvar</span>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="shadow-all p-6 mt-4 mb-8 rounded-xl">
      <h1 class="font-black text-3xl text-center">Inscrições cadastradas:</h1>
      <div v-for="inscription in inscriptions" :key="inscription.id" class="py-4">
        <h1 class="font-black text-xl mb-2">Inscrição {{ inscription.id }}</h1>
        <div id="accordion-collapse" data-accordion="collapse">
          <div
            class="flex flex-col lg:flex-row justify-center md:justify-between items-center shadow-all rounded-xl relative p-4 bg-white gap-2"
            :class="{ 'md:shadow-xt': expandedItems.includes(inscription.id) }"
          >
            <div>
              <div
                class="hidden lg:flex h-full items-center target-item absolute top-1 left-0"
                draggable="true"
                @dragstart="dragStart(inscription.index)"
                @drop="dragDrop(inscription.index)"
                @dragover="dragOver"
                @dragleave="dragLeave"
                @dragend="dragEnd"
              >
                <div class="cursor-grab text-3xl p-4">
                  <svg
                    class="h-4 w-4"
                    viewBox="0 0 7 10"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <circle cx="5.375" cy="1.49164" r="1.125" fill="#616161" />
                    <circle cx="5.375" cy="4.86664" r="1.125" fill="#616161" />
                    <circle cx="5.375" cy="8.24164" r="1.125" fill="#616161" />
                    <circle cx="1.125" cy="1.49164" r="1.125" fill="#616161" />
                    <circle cx="1.125" cy="4.86664" r="1.125" fill="#616161" />
                    <circle cx="1.125" cy="8.24164" r="1.125" fill="#616161" />
                  </svg>
                </div>
              </div>
              <div>
                <form
                  @submit.prevent="orderIndexInscriptionMobile(inscription.id, action)"
                  class="flex flex-col justify-between h-full lg:hidden absolute top-0 left-0"
                >
                  <button
                    class="bg-white p-3 rounded-xl"
                    type="submit"
                    value="up"
                    @click="action = 'up'"
                  >
                    <svg
                      class="h-4 w-4"
                      viewBox="0 0 22 22"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M0 11L1.93875 12.9387L9.625 5.26625V22H12.375V5.26625L20.0475 12.9525L22 11L11 0L0 11Z"
                        fill="#191919"
                      />
                    </svg>
                  </button>
                  <button
                    class="bg-white p-3 rounded-xl"
                    type="submit"
                    value="down"
                    @click="action = 'down'"
                  >
                    <svg
                      class="h-4 w-4"
                      viewBox="0 0 22 22"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        d="M22 11L20.0613 9.06125L12.375 16.7337V0H9.625V16.7337L1.9525 9.0475L0 11L11 22L22 11Z"
                        fill="#191919"
                      />
                    </svg>
                  </button>
                </form>
              </div>
              <h2
                class="absolute top-2 right-4 lg:hidden"
                :id="'accordion-collapse-heading-' + inscription.id"
              >
                <button
                  type="button"
                  @click="toggleAccordionItem(inscription.id)"
                  :aria-expanded="expandedItems.includes(inscription.id)"
                  :aria-controls="'accordion-collapse-body-' + inscription.id"
                >
                  <svg
                    data-accordion-icon
                    class="w-4 h-4"
                    :class="{ 'rotate-180': expandedItems.includes(inscription.id) }"
                    viewBox="0 0 14 9"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      d="M1.645 8.8667L7 3.92203L12.355 8.8667L14 7.34443L7 0.8667L-1.30708e-07 7.34443L1.645 8.8667Z"
                      fill="#191919"
                    />
                  </svg>
                </button>
              </h2>
              <h1 class="pl-5 text-[#616161] font-bold  xl:text-xl">
                {{ inscription.name }}
              </h1>
            </div>
            <div
              class="flex items-center justify-center gap-4 md:border-x md:border-black px-1 lg:px-2 xl:px4"
            >
              <p class="text-[#616161] font-medium text-lg">
                {{ inscription.participants }} Atleta(s)
              </p>
              <p class="bg-[#616161] px-2 rounded-md text-white">
                {{ inscription.modality }}
              </p>
            </div>
            <div class="flex gap-2 md:gap-4 lg:gap-6 xl:gap-8 items-center my-4 md:my-0">
              <form @submit.prevent="inscriptionDuplicate(inscription.id)" class="flex">
                <button type="submit">
                  <svg
                    class="w-5 h-5"
                    viewBox="0 0 13 15"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M9.57895 0.866699H1.36842C0.615789 0.866699 0 1.43943 0 2.13943V11.0485H1.36842V2.13943H9.57895V0.866699ZM8.89474 3.41215L13 7.23034V13.594C13 14.294 12.3842 14.8667 11.6316 14.8667H4.09842C3.34579 14.8667 2.73684 14.294 2.73684 13.594L2.74368 4.68488C2.74368 3.98488 3.35263 3.41215 4.10526 3.41215H8.89474ZM11.9737 7.8667H8.21053V4.3667L11.9737 7.8667Z"
                      fill="#0F172A"
                    />
                  </svg>
                </button>
              </form>

              <!-- START INSCRIPTION EDIT -->
              <div class="flex">
                <button @click="openInscriptionEditModal(inscription.id)">
                  <svg
                    class="w-5 h-5"
                    viewBox="0 0 15 15"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M14.7563 2.91391C15.0812 3.21721 15.0812 3.70714 14.7563 4.01043L13.2315 5.43356L10.1069 2.5173L11.6317 1.09417C11.9567 0.790876 12.4816 0.790876 12.8066 1.09417L14.7563 2.91391ZM0 14.8667V11.9504L9.21539 3.34941L12.34 6.26567L3.12457 14.8667H0Z"
                      fill="#191919"
                    />
                  </svg>
                </button>
              </div>

              <div
                v-if="isInscriptionEditModalOpen(inscription.id)"
                :id="'inscriptionEditModal-' + inscription.id"
                tabindex="-1"
                aria-hidden="true"
                class="fixed flex items-center justify-center top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
              >
                <div
                  class="modal-lot-create-backdrop"
                  @click="closeInscriptionEditModal(inscription.id)"
                ></div>
                <div class="relative w-full max-w-6xl max-h-full">
                  <!-- Modal content -->
                  <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <form @submit.prevent="inscriptionEdit(inscription)">
                      <!-- Modal header -->
                      <div
                        class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600"
                      >
                        <h3 class="text-3xl font-black text-black">EDITAR INSCRIÇÃO:</h3>
                        <button
                          type="button"
                          class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                          @click="closeInscriptionEditModal(inscription.id)"
                        >
                          <svg
                            class="w-3 h-3"
                            aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 14 14"
                          >
                            <path
                              stroke="currentColor"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                            />
                          </svg>
                          <span class="sr-only">Close modal</span>
                        </button>
                      </div>
                      <!-- Modal body -->
                      <div class="p-6">
                        <div class="flex flex-col md:flex-row gap-2 w-full">
                          <div class="w-full">
                            <label
                              for="inscription-name"
                              class="block mb-2 text-sm font-medium text-gray-900"
                              >Nome da inscrição*</label
                            >
                            <input
                              type="text"
                              id="inscription-name"
                              v-model="inscription.name"
                              class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
                            />
                          </div>
                          <div class="flex items-end w-full gap-2">
                            <div class="w-full">
                              <label
                                for="participants"
                                class="block mb-2 text-sm font-medium text-gray-900"
                                >Participantes por inscrição*</label
                              >
                              <div
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full shadow-all text-center"
                              >
                                <div
                                  class="flex justify-center items-center py-2 max-h-10 gap-1"
                                >
                                  <button
                                    type="button"
                                    @click="decreaseNumberInscriptionEdit(inscription)"
                                    class="bg-[#277901] text-white py-[0.1rem] px-2 rounded-l-md text-xl"
                                  >
                                    <p class="mb-[0.05rem]">-</p>
                                  </button>
                                  <input
                                    type="number"
                                    id="participants"
                                    v-model="inscription.participants"
                                    class="bg-white border border-gray-300 text-gray-900 text-sm block shadow-all text-center w-20 max-h-8"
                                  />
                                  <button
                                    type="button"
                                    @click="increaseNumberInscriptionEdit(inscription)"
                                    class="bg-[#277901] text-white py-[0.1rem] px-2 rounded-r-md text-xl"
                                  >
                                    <p class="mb-[0.05rem]">+</p>
                                  </button>
                                </div>
                              </div>
                            </div>
                            <div class="w-full">
                              <div>
                                <label
                                  for="modality"
                                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                  >Modalidade*</label
                                >
                                <select
                                  id="modality"
                                  class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
                                  v-model="inscription.modality"
                                >
                                  <option selected></option>
                                  <option value="Natação">Natação</option>
                                  <option value="Ciclismo">Ciclismo</option>
                                  <option value="Corrida de Obstáculos">
                                    Corrida de Obstáculos
                                  </option>
                                  <option value="Triathlon">Triathlon</option>
                                  <option value="Duathlon">Duathlon</option>
                                  <option value="Outros">Outros</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="w-full pt-6">
                          <label
                            for="restrictions"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Restrições*</label
                          >
                          <select
                            id="restrictions"
                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
                            v-model="inscription.restrictions"
                          >
                            <option selected></option>
                            <option value="Menor que 10 anos">Menor que 10 anos</option>
                            <option value="Menor que 14 anos">Menor que 14 anos</option>
                            <option value="Menor que 16 anos">Menor que 16 anos</option>
                            <option value="Sexo Feminino">Sexo Feminino</option>
                            <option value="Sexo Masculino">Sexo Masculino</option>
                          </select>
                        </div>
                      </div>
                      <!-- Modal footer -->
                      <div
                        class="flex items-center justify-between p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600"
                      >
                        <button
                          type="button"
                          class="md:w-52 flex justify-center items-center bg-[#FF7171] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all gap-2"
                          @click="closeInscriptionEditModal(inscription.id)"
                        >
                          <svg
                            width="23"
                            height="22"
                            viewBox="0 0 23 22"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              fill-rule="evenodd"
                              clip-rule="evenodd"
                              d="M3.72183 3.22178C8.01538 -1.07177 14.9846 -1.07177 19.2782 3.22178C23.5717 7.51533 23.5717 14.4846 19.2782 18.7781C14.9846 23.0717 8.01538 23.0717 3.72183 18.7781C-0.571727 14.4846 -0.571727 7.51533 3.72183 3.22178ZM11.5 12.5556L14.6113 15.6669L16.1669 14.1112L13.0556 11L16.1669 7.88868L14.6113 6.33305L11.5 9.44432L8.38873 6.33305L6.83309 7.88868L9.94436 11L6.83309 14.1112L8.38873 15.6669L11.5 12.5556Z"
                              fill="white"
                            />
                          </svg>
                          <span>Cancelar</span>
                        </button>
                        <button
                          class="md:w-52 flex justify-center items-center gap-2 bg-[#0DCD71] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all hover:cursor-pointer"
                          type="submit"
                        >
                          <svg
                            width="22"
                            height="22"
                            viewBox="0 0 22 22"
                            fill="none"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              fill-rule="evenodd"
                              clip-rule="evenodd"
                              d="M0 11C0 4.928 4.928 0 11 0C17.072 0 22 4.928 22 11C22 17.072 17.072 22 11 22C4.928 22 0 17.072 0 11ZM12.1 12.1H16.5V9.9H12.1V5.5H9.9V9.9H5.5V12.1H9.9V16.5H12.1V12.1Z"
                              fill="white"
                            />
                          </svg>
                          <span>SALVAR LOTE</span>
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- END INSCRIPTION EDIT -->

              <form @submit.prevent="inscriptionDelete(inscription.id)" class="flex">
                <button type="submit">
                  <svg
                    class="w-5 h-5"
                    viewBox="0 0 10 15"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                  >
                    <path
                      fill-rule="evenodd"
                      clip-rule="evenodd"
                      d="M7.5 1.64448H10V3.20003H0V1.64448H2.5L3.21429 0.866699H6.78571L7.5 1.64448ZM2.14286 14.8667C1.35714 14.8667 0.714286 14.1667 0.714286 13.3111V3.97781H9.28571V13.3111C9.28571 14.1667 8.64286 14.8667 7.85714 14.8667H2.14286Z"
                      fill="#191919"
                    />
                  </svg>
                </button>
              </form>

              <button
                class="hidden lg:block"
                :id="'accordion-collapse-heading-' + inscription.id"
                type="button"
                @click="toggleAccordionItem(inscription.id)"
                :aria-expanded="expandedItems.includes(inscription.id)"
                :aria-controls="'accordion-collapse-body-' + inscription.id"
              >
                <svg
                  data-accordion-icon
                  class="w-4 h-4"
                  :class="{ 'rotate-180': expandedItems.includes(inscription.id) }"
                  viewBox="0 0 14 9"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M1.645 8.8667L7 3.92203L12.355 8.8667L14 7.34443L7 0.8667L-1.30708e-07 7.34443L1.645 8.8667Z"
                    fill="#191919"
                  />
                </svg>
              </button>
            </div>
          </div>

          <div
            :id="'accordion-collapse-body-' + inscription.id"
            class="block"
            v-show="expandedItems.includes(inscription.id)"
            :aria-labelledby="'accordion-collapse-heading-' + inscription.id"
          >
            <div
              class="bg-[#616161] -mt-2 px-2 flex flex-col items-center pb-6 rounded-b-xl gap-4 pt-6"
            >
              <div
                class="bg-[#CECECE] p-4 w-full rounded-xl"
                v-for="lot in inscription.lots"
              >
                <div
                  class="bg-white flex flex-col md:flex-row justify-between items-center shadow-all rounded-xl py-1 md:py-0"
                >
                  <p class="md:ml-4 font-bold text-[#616161] text-xl">{{ lot.name }}</p>
                  <div
                    class="flex flex-col md:flex-row items-center md:border-x md:border-black md:px-20 text-[#616161]"
                  >
                    <p>
                      <span class="font-bold">
                        {{ moment(lot.start_date).format("DD/MM/YYYY") }}
                      </span>
                      às
                      {{ formatHour(lot.start_hour) }}
                    </p>
                    <p>&#160;até&#160;</p>
                    <p>
                      <span class="font-bold">
                        {{ moment(lot.end_date).format("DD/MM/YYYY") }}
                      </span>
                      às
                      {{ formatHour(lot.end_hour) }}
                    </p>
                  </div>
                  <div
                    class="bg-[#616161] flex items-center gap-12 md:gap-4 p-4 rounded-r-xl rounded-l-xl md:rounded-l-none"
                  >
                    <!-- START EDIT LOT -->
                    <button @click="openLotEditModal(lot.id)">
                      <svg
                        class="w-4 h-4"
                        viewBox="0 0 15 15"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          fill-rule="evenodd"
                          clip-rule="evenodd"
                          d="M14.7563 2.91343C15.0812 3.21672 15.0812 3.70665 14.7563 4.00994L13.2315 5.43308L10.1069 2.51681L11.6317 1.09368C11.9567 0.790388 12.4816 0.790388 12.8066 1.09368L14.7563 2.91343ZM0 14.8662V11.9499L9.21539 3.34892L12.34 6.26518L3.12457 14.8662H0Z"
                          fill="white"
                        />
                      </svg>
                    </button>

                    <div
                      v-if="isLotEditModalOpen(lot.id)"
                      :id="'lotEditModal-' + lot.id"
                      tabindex="-1"
                      aria-hidden="true"
                      class="fixed flex items-center justify-center top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
                    >
                      <div
                        class="modal-lot-create-backdrop"
                        @click="closeLotEditModal(lot.id)"
                      ></div>
                      <div class="relative w-full max-w-6xl max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                          <form @submit.prevent="lotEdit(lot)">
                            <!-- Modal header -->
                            <div
                              class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600"
                            >
                              <h3 class="text-3xl font-black text-black">EDITAR LOTE:</h3>
                              <button
                                type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                @click="closeLotEditModal(lot.id)"
                              >
                                <svg
                                  class="w-3 h-3"
                                  aria-hidden="true"
                                  xmlns="http://www.w3.org/2000/svg"
                                  fill="none"
                                  viewBox="0 0 14 14"
                                >
                                  <path
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                                  />
                                </svg>
                                <span class="sr-only">Close modal</span>
                              </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-6">
                              <div class="w-full">
                                <label
                                  for="lot-name"
                                  class="block mb-2 text-sm font-medium text-gray-900"
                                  >Qual o nome do lote?</label
                                >
                                <input
                                  type="text"
                                  id="lot-name"
                                  v-model="lot.name"
                                  class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
                                />
                              </div>

                              <div
                                class="grid grid-cols-2 md:flex justify-center md:justify-start items-center gap-4 w-full pt-4"
                              >
                                <p class="font-bold">Data/Hora:</p>
                                <div>
                                  <input
                                    type="date"
                                    id="lot-start_date"
                                    v-model="lot.start_date"
                                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
                                  />
                                </div>
                                <p>às</p>
                                <div>
                                  <input
                                    type="time"
                                    step="60"
                                    id="lot-start_hour"
                                    v-model="lot.start_hour"
                                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
                                  />
                                </div>
                                <p class="font-bold">Até</p>
                                <div>
                                  <input
                                    type="date"
                                    id="lot-end_date"
                                    v-model="lot.end_date"
                                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
                                  />
                                </div>
                                <p>às</p>
                                <div>
                                  <input
                                    type="time"
                                    step="60"
                                    id="lot-end_hour"
                                    v-model="lot.end_hour"
                                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
                                  />
                                </div>
                              </div>
                            </div>
                            <!-- Modal footer -->
                            <div
                              class="flex items-center justify-between p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600"
                            >
                              <button
                                type="button"
                                class="md:w-52 flex justify-center gap-2 items-center bg-[#FF7171] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all"
                                @click="closeLotEditModal(lot.id)"
                              >
                                <svg
                                  width="23"
                                  height="22"
                                  viewBox="0 0 23 22"
                                  fill="none"
                                  xmlns="http://www.w3.org/2000/svg"
                                >
                                  <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M3.72183 3.22178C8.01538 -1.07177 14.9846 -1.07177 19.2782 3.22178C23.5717 7.51533 23.5717 14.4846 19.2782 18.7781C14.9846 23.0717 8.01538 23.0717 3.72183 18.7781C-0.571727 14.4846 -0.571727 7.51533 3.72183 3.22178ZM11.5 12.5556L14.6113 15.6669L16.1669 14.1112L13.0556 11L16.1669 7.88868L14.6113 6.33305L11.5 9.44432L8.38873 6.33305L6.83309 7.88868L9.94436 11L6.83309 14.1112L8.38873 15.6669L11.5 12.5556Z"
                                    fill="white"
                                  />
                                </svg>
                                <span>Cancelar</span>
                              </button>
                              <button
                                class="md:w-52 flex justify-center items-center gap-2 bg-[#0DCD71] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all hover:cursor-pointer"
                                type="submit"
                              >
                                <svg
                                  width="22"
                                  height="22"
                                  viewBox="0 0 22 22"
                                  fill="none"
                                  xmlns="http://www.w3.org/2000/svg"
                                >
                                  <path
                                    fill-rule="evenodd"
                                    clip-rule="evenodd"
                                    d="M0 11C0 4.928 4.928 0 11 0C17.072 0 22 4.928 22 11C22 17.072 17.072 22 11 22C4.928 22 0 17.072 0 11ZM12.1 12.1H16.5V9.9H12.1V5.5H9.9V9.9H5.5V12.1H9.9V16.5H12.1V12.1Z"
                                    fill="white"
                                  />
                                </svg>
                                <span>SALVAR LOTE</span>
                              </button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- END EDIT LOT -->
                    <form @submit.prevent="lotDelete(lot.id)" class="flex">
                      <button type="submit">
                        <svg
                          class="w-4 h-4"
                          viewBox="0 0 10 15"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M7.5 1.64399H10V3.19954H0V1.64399H2.5L3.21429 0.866211H6.78571L7.5 1.64399ZM2.14286 14.8662C1.35714 14.8662 0.714286 14.1662 0.714286 13.3107V3.97732H9.28571V13.3107C9.28571 14.1662 8.64286 14.8662 7.85714 14.8662H2.14286Z"
                            fill="white"
                          />
                        </svg>
                      </button>
                    </form>
                  </div>
                </div>
              </div>
              <!-- START LOTE CREATE  -->
              <button
                class="flex justify-center items-center gap-2 bg-[#0DCD71] px-6 py-3 text-white font-bold text-lg rounded-lg uppercase hover:cursor-pointer"
                @click="openLotCreateModal(inscription.id)"
                type="button"
              >
                <svg
                  width="22"
                  height="22"
                  viewBox="0 0 22 22"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    fill-rule="evenodd"
                    clip-rule="evenodd"
                    d="M0 11C0 4.928 4.928 0 11 0C17.072 0 22 4.928 22 11C22 17.072 17.072 22 11 22C4.928 22 0 17.072 0 11ZM12.1 12.1H16.5V9.9H12.1V5.5H9.9V9.9H5.5V12.1H9.9V16.5H12.1V12.1Z"
                    fill="white"
                  />
                </svg>
                <span
                  >ADICIONAR
                  <span v-if="inscription.lots != ''">NOVO</span>
                  LOTE</span
                >
              </button>
            </div>
            <!-- Main modal -->
            <div
              v-if="isLotCreateModalOpen(inscription.id)"
              :id="'lotCreateModal-' + inscription.id"
              tabindex="-1"
              aria-hidden="true"
              class="fixed flex items-center justify-center top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
            >
              <div
                class="modal-lot-create-backdrop"
                @click="closeLotCreateModal(inscription.id)"
              ></div>
              <div class="relative w-full max-w-6xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                  <form @submit.prevent="lotSubmit(inscription.id)">
                    <!-- Modal header -->
                    <div
                      class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600"
                    >
                      <h3 class="text-3xl font-black text-black">CRIAR LOTE:</h3>
                      <button
                        type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        @click="closeLotCreateModal(inscription.id)"
                      >
                        <svg
                          class="w-3 h-3"
                          aria-hidden="true"
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 14 14"
                        >
                          <path
                            stroke="currentColor"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                          />
                        </svg>
                        <span class="sr-only">Close modal</span>
                      </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-6">
                      <div class="w-full">
                        <label
                          for="lot-name"
                          class="block mb-2 text-sm font-medium text-gray-900"
                          >Qual o nome do lote?</label
                        >
                        <input
                          type="text"
                          id="lot-name"
                          v-model="lotForm.name"
                          class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
                        />
                      </div>
                      <!-- <div class="pt-4">
                        <label
                          for="route-inscriptions"
                          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                          >Vincular percurso em quais inscrições?12</label
                        >
                        <Multiselect
                          class="shadow-all"
                          v-model="lotForm.inscriptions"
                          mode="tags"
                          :close-on-select="false"
                          :searchable="true"
                          :create-option="false"
                          :options="formattedInscriptions"
                        />
                      </div> -->
                      <div class="md:grid md:grid-cols-3 py-4 gap-4 items-center">
                        <div
                          class="col-span-1 flex items-center shadow-all justify-between px-4 rounded-xl p-4 w-full"
                        >
                          <p class="text-base">Adicionar lote à todas inscrições</p>
                          <label class="relative inline-flex items-center cursor-pointer">
                            <input
                              type="checkbox"
                              value=""
                              class="sr-only peer"
                              v-model="lotForm.add_lot_to_all_subscriptions"
                              true-value="yes"
                              false-value="no"
                            />
                            <div
                              class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"
                            ></div>
                          </label>
                        </div>

                        <div
                          class="grid grid-cols-2 md:flex md:flex-row justify-between items-center gap-2 w-full pt-4"
                        >
                          <p class="font-bold">Data/Hora:</p>
                          <div>
                            <input
                              type="date"
                              id="lot-start_date"
                              v-model="lotForm.start_date"
                              class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
                            />
                          </div>
                          <p>às</p>
                          <div>
                            <input
                              type="time"
                              step="60"
                              id="lot-start_hour"
                              v-model="lotForm.start_hour"
                              class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
                            />
                          </div>
                          <p class="font-bold">Até</p>
                          <div>
                            <input
                              type="date"
                              id="lot-end_date"
                              v-model="lotForm.end_date"
                              class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
                            />
                          </div>
                          <p>às</p>
                          <div>
                            <input
                              type="time"
                              step="60"
                              id="lot-end_hour"
                              v-model="lotForm.end_hour"
                              class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
                            />
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Modal footer -->
                    <div
                      class="flex items-center justify-between p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600"
                    >
                      <button
                        type="button"
                        class="md:w-52 flex justify-center gap-2 items-center bg-[#FF7171] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all"
                        @click="closeLotCreateModal(inscription.id)"
                      >
                        <svg
                          width="23"
                          height="22"
                          viewBox="0 0 23 22"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M3.72183 3.22178C8.01538 -1.07177 14.9846 -1.07177 19.2782 3.22178C23.5717 7.51533 23.5717 14.4846 19.2782 18.7781C14.9846 23.0717 8.01538 23.0717 3.72183 18.7781C-0.571727 14.4846 -0.571727 7.51533 3.72183 3.22178ZM11.5 12.5556L14.6113 15.6669L16.1669 14.1112L13.0556 11L16.1669 7.88868L14.6113 6.33305L11.5 9.44432L8.38873 6.33305L6.83309 7.88868L9.94436 11L6.83309 14.1112L8.38873 15.6669L11.5 12.5556Z"
                            fill="white"
                          />
                        </svg>
                        <span>Cancelar</span>
                      </button>
                      <button
                        class="md:w-52 flex justify-center items-center gap-2 bg-[#0DCD71] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all hover:cursor-pointer"
                        type="submit"
                      >
                        <svg
                          width="22"
                          height="22"
                          viewBox="0 0 22 22"
                          fill="none"
                          xmlns="http://www.w3.org/2000/svg"
                        >
                          <path
                            fill-rule="evenodd"
                            clip-rule="evenodd"
                            d="M0 11C0 4.928 4.928 0 11 0C17.072 0 22 4.928 22 11C22 17.072 17.072 22 11 22C4.928 22 0 17.072 0 11ZM12.1 12.1H16.5V9.9H12.1V5.5H9.9V9.9H5.5V12.1H9.9V16.5H12.1V12.1Z"
                            fill="white"
                          />
                        </svg>
                        <span>SALVAR LOTE</span>
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <!-- END LOTE CREATE  -->
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, watch, reactive, onMounted } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import moment from "moment";
import Multiselect from "@vueform/multiselect";
const props = defineProps({
  inscriptions: Array,
  eventId: Number,
});

const formattedInscriptions = ref(
  props.inscriptions.map((item) => ({
    value: item.id,
    label: item.name,
  }))
);

const expandedItems = ref(props.inscriptions.map((i) => i.id));

const toggleAccordionItem = (itemId) => {
  const index = expandedItems.value.indexOf(itemId);
  if (index === -1) {
    expandedItems.value.push(itemId);
  } else {
    expandedItems.value.splice(index, 1);
  }
};

// watch(
//   () => props.inscriptions,
//   (newInscriptions, oldInscriptions) => {
//     if (newInscriptions.length > oldInscriptions.length) {
//       const newInscription = newInscriptions.find(
//         (inscription) => !oldInscriptions.includes(inscription)
//       );

//       if (newInscription && !expandedItems.value.includes(newInscription.id)) {
//         expandedItems.value.push(newInscription.id);
//       }
//     }
//   },
//   { deep: true }
// );

function increaseNumberInscriptionCreate() {
  if (inscriptionForm.participants < 99999) {
    inscriptionForm.participants++;
  }
}

function decreaseNumberInscriptionCreate() {
  if (inscriptionForm.participants > 0) {
    inscriptionForm.participants--;
  }
}

function increaseNumberInscriptionEdit(inscription) {
  if (inscription.participants < 99999) {
    inscription.participants++;
  }
}

function decreaseNumberInscriptionEdit(inscription) {
  if (inscription.participants > 0) {
    inscription.participants--;
  }
}

// START INSCRIPTION EDIT
const openInscriptionEditModals = ref([]);
const openInscriptionEditModal = (id) => {
  if (!openInscriptionEditModals.value.includes(id)) {
    openInscriptionEditModals.value.push(id);
  }
};
const closeInscriptionEditModal = (id) => {
  const index = openInscriptionEditModals.value.indexOf(id);
  if (index > -1) {
    openInscriptionEditModals.value.splice(index, 1);
  }
};
const isInscriptionEditModalOpen = (id) => openInscriptionEditModals.value.includes(id);
// END INSCRIPTION EDIT

// START LOT CREATE
const openLotCreateModals = ref([]);
const openLotCreateModal = (id) => {
  if (!openLotCreateModals.value.includes(id)) {
    openLotCreateModals.value.push(id);
  }
};
const closeLotCreateModal = (id) => {
  const index = openLotCreateModals.value.indexOf(id);
  if (index > -1) {
    openLotCreateModals.value.splice(index, 1);
  }
};
const isLotCreateModalOpen = (id) => openLotCreateModals.value.includes(id);
// END LOT CREATE

// START LOT EDIT
const openLotEditModals = ref([]);
const openLotEditModal = (id) => {
  if (!openLotEditModals.value.includes(id)) {
    openLotEditModals.value.push(id);
  }
};
const closeLotEditModal = (id) => {
  const index = openLotEditModals.value.indexOf(id);
  if (index > -1) {
    openLotEditModals.value.splice(index, 1);
  }
};
const isLotEditModalOpen = (id) => openLotEditModals.value.includes(id);
// END LOT EDIT

let draggedItemIndex = ref(null);

function dragStart(index) {
  draggedItemIndex.value = index;
}

function dragOver(event) {
  event.preventDefault();
  event.target.closest(".target-item").style.border = "2px solid lightgray";
}

function dragLeave(event) {
  event.target.closest(".target-item").style.border = "";
}

function dragEnd() {
  draggedItemIndex.value = null;
}

function dragDrop(targetIndex) {
  event.target.closest(".target-item").style.border = "";
  if (draggedItemIndex.value !== null && draggedItemIndex.value !== targetIndex) {
    let sourceIndex = draggedItemIndex.value;
    let temp = props.inscriptions[sourceIndex];
    props.inscriptions.splice(sourceIndex, 1);
    props.inscriptions.splice(targetIndex, 0, temp);

    for (let i = 0; i < props.inscriptions.length; i++) {
      props.inscriptions[i].index = i;
    }

    router.put(
      route("event.inscription.order", { id: props.eventId }),
      { inscriptions: props.inscriptions },
      {
        preserveScroll: true,
      }
    );
  }
}

const formatHour = (time) => {
  return moment(time, "HH:mm:ss").format("HH:mm");
};

const inscriptionForm = useForm({
  name: "",
  participants: "",
  modality: "",
  restrictions: "",
  inscriptions: null,
});

const inscriptionSubmit = () => {
  inscriptionForm.post(route("event.inscription.create", { id: props.eventId }), {
    preserveScroll: true,
    onSuccess: (response) => {
      console.log("success");

      const newInscription = response.data;
      formattedInscriptions.value.push({
        value: newInscription.id,
        label: newInscription.name,
      });
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

const lotForm = useForm({
  name: "",
  add_lot_to_all_subscriptions: "",
  start_date: "",
  start_hour: "",
  end_date: "",
  end_hour: "",
  event_id: props.eventId,
  inscriptions: null,
});

const lotSubmit = (id) => {
  console.log(id);
  lotForm.post(route("event.lot.create", { id: id }), {
    preserveScroll: true,
    onSuccess: () => {
      console.log("success");
      closeLotCreateModal(id);
    },
  });
};

function lotEdit(lot) {
  console.log(lot);
  router.post(
    route("event.lot.edit", { id: lot.id }),
    {
      name: lot.name,
      start_date: lot.start_date,
      start_hour: lot.start_hour,
      end_date: lot.end_date,
      end_hour: lot.end_hour,
    },
    {
      preserveScroll: true,
    }
  );
  closeLotEditModal(lot.id);
}
function inscriptionEdit(inscription) {
  console.log(inscription);
  router.post(
    route("event.inscription.edit", { id: inscription.id }),
    {
      name: inscription.name,
      participants: inscription.participants,
      modality: inscription.modality,
      restrictions: inscription.restrictions,
    },
    {
      preserveScroll: true,
    }
  );
  closeInscriptionEditModal(inscription.id);
}

function lotDelete(id) {
  router.delete(route("event.lot.delete", { id: id }), {
    preserveScroll: true,
  });
}
function inscriptionDelete(id) {
  router.delete(route("event.inscription.delete", { id: id }), {
    preserveScroll: true,
  });
}
function inscriptionDuplicate(id) {
  router.post(route("event.inscription.duplicate", { id: id }), {
    preserveScroll: true,
  });
}

function orderIndexInscriptionMobile(id, action) {
  router.put(
    route("event.inscription.order.mobile", { id: id }),
    {
      action: action,
    },
    {
      preserveScroll: true,
    }
  );
}
</script>
<style>
.modal-lot-create-backdrop {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.7);
  z-index: -1;
}
input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}
input[type="number"] {
  -moz-appearance: textfield;
}
</style>

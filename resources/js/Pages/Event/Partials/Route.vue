<template>
  <div>
    <h1 class="font-black text-3xl">
      ADICIONE UM PERCURSO PARA AS INCRIÇÕES CRIADAS (OPCIONAL):
    </h1>
    <button
      data-modal-target="routeCreateModal"
      data-modal-toggle="routeCreateModal"
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
      <span class="text-white font-bold text-xl">ADICIONAR PERCURSO</span>
    </button>
    <!-- Main modal -->
    <div
      id="routeCreateModal"
      tabindex="-1"
      aria-hidden="true"
      class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
    >
      <div class="relative w-full max-w-6xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <form @submit.prevent="routeCreate" enctype="multipart/form-data">
            <!-- Modal header -->
            <div
              class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600"
            >
              <h1 class="text-3xl font-black text-black">
                ADICIONAR UM PERCURSO PARA SUAS INCRIÇÕES:
              </h1>
              <button
                type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="routeCreateModal"
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
              <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                  <label
                    for="route-name"
                    class="block mb-2 text-sm font-medium text-gray-900"
                    >Nome do percurso:*</label
                  >
                  <input
                    type="text"
                    id="route-name"
                    v-model="routeForm.name"
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
                  />
                </div>
                <div>
                  <label
                    for="route-observation"
                    class="block mb-2 text-sm font-medium text-gray-900"
                    >Observação:*</label
                  >
                  <input
                    type="text"
                    id="route-observation"
                    v-model="routeForm.observation"
                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
                  />
                </div>
              </div>
              <div class="pt-4">
                <label
                  for="route-inscriptions"
                  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                  >Vincular percurso em quais inscrições?1</label
                >
                <Multiselect
                  class="shadow-all"
                  v-model="routeForm.inscriptions"
                  mode="tags"
                  :close-on-select="false"
                  :searchable="true"
                  :create-option="false"
                  :options="formattedInscriptions"
                />
              </div>
              <div class="w-full">
                <div class="flex items-start gap-2 pt-4">
                  <h1
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                  >
                    Visualização do percurso por:*
                  </h1>
                  <button data-popover-target="popover-route-create" type="button">
                    <svg
                      width="18"
                      height="18"
                      viewBox="0 0 18 18"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M0 9C0 4.032 4.032 0 9 0C13.968 0 18 4.032 18 9C18 13.968 13.968 18 9 18C4.032 18 0 13.968 0 9ZM9.9 12.6V14.4H8.1V12.6H9.9ZM9 16.2C5.031 16.2 1.8 12.969 1.8 9C1.8 5.031 5.031 1.8 9 1.8C12.969 1.8 16.2 5.031 16.2 9C16.2 12.969 12.969 16.2 9 16.2ZM5.4 7.2C5.4 5.211 7.011 3.6 9 3.6C10.989 3.6 12.6 5.211 12.6 7.2C12.6 8.35462 11.889 8.97599 11.1967 9.58099C10.5399 10.1549 9.9 10.7142 9.9 11.7H8.1C8.1 10.0609 8.94791 9.41093 9.6934 8.83951C10.2782 8.39125 10.8 7.99129 10.8 7.2C10.8 6.21 9.99 5.4 9 5.4C8.01 5.4 7.2 6.21 7.2 7.2H5.4Z"
                        fill="#9F9F9F"
                      />
                    </svg>
                  </button>
                  <div
                    data-popover
                    id="popover-route-create"
                    role="tooltip"
                    class="absolute z-10 invisible inline-block max-w-3xl text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800"
                  >
                    <div
                      class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700"
                    >
                      <h3 class="font-semibold text-gray-900 dark:text-white">
                        Tem 2 opções para adicionar o percurso em sua inscrição(ões):
                      </h3>
                    </div>
                    <div class="px-3 py-2">
                      <p class="text-[#191919] font-normal text-sm">
                        <span class="font-black">Por imagem</span> que é inserir uma
                        imagem em jpg ou png com o percurso da sua inscrição(ões) e por
                        link que é acessar o site https://www.google.com.br/maps/ depois
                        vá no ícone directions e adicione o local inicial do percurso,
                        selecione a opção de caminhando (ícone de pessoa andando),
                        adicione os seu destinos até completar o percurso total desejado
                        por inscrição. Depois vá no ícone de menu (3 linhas) e selecione
                        Share or embed map, irá abrir uma nova janela com a opção Embed a
                        map e clique em COPY HTML. Assim que copiado cole essa informação
                        no campo de Link embedded abaixo:
                      </p>
                    </div>
                    <div data-popper-arrow></div>
                  </div>
                </div>
                <div class="flex flex-col md:flex-row gap-4 pt-2">
                  <button
                    type="button"
                    class="flex justify-center items-center gap-2 shadow-all px-20 py-10 rounded-xl"
                    :class="selectedContent === 'image' ? 'bg-black' : 'bg-white'"
                    @click="selectedContent = 'image'"
                  >
                    <svg
                      class="w-8 h-8"
                      viewBox="0 0 27 22"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M2.49913 0H24.4991C25.7214 0 26.9436 1.22222 26.9436 2.44444V19.5556C26.9436 20.7778 25.7214 22 24.4991 22H2.49913C1.15469 22 0.0546875 20.9 0.0546875 19.5556V2.44444C0.0546875 1.22222 1.27691 0 2.49913 0ZM9.22135 11.6111L4.94358 17.1111H22.0547L16.5547 9.77778L12.2769 15.29L9.22135 11.6111Z"
                        :fill="selectedContent === 'image' ? 'white' : 'black'"
                      />
                    </svg>
                    <p
                      class="font-black text-lg"
                      :class="selectedContent === 'image' ? 'text-white' : 'text-black'"
                    >
                      Imagem
                    </p>
                  </button>
                  <button
                    type="button"
                    class="flex justify-center items-center gap-2 shadow-all px-20 py-10 rounded-xl"
                    :class="selectedContent === 'link' ? 'bg-black' : 'bg-white'"
                    @click="selectedContent = 'link'"
                  >
                    <svg
                      class="w-8 h-8"
                      viewBox="0 0 17 22"
                      fill="none"
                      xmlns="http://www.w3.org/2000/svg"
                    >
                      <path
                        fill-rule="evenodd"
                        clip-rule="evenodd"
                        d="M15.1008 6.6C15.1008 2.959 12.1418 0 8.50078 0C4.85978 0 1.90078 2.959 1.90078 6.6C1.90078 11.55 8.50078 18.7 8.50078 18.7C8.50078 18.7 15.1008 11.55 15.1008 6.6ZM6.30078 6.6C6.30078 5.39 7.29078 4.4 8.50078 4.4C9.71078 4.4 10.7008 5.39 10.7008 6.6C10.7008 7.81 9.72178 8.8 8.50078 8.8C7.29078 8.8 6.30078 7.81 6.30078 6.6ZM0.800781 22V19.8H16.2008V22H0.800781Z"
                        :fill="selectedContent === 'link' ? 'white' : 'black'"
                      />
                    </svg>

                    <p
                      class="text-black font-black text-lg"
                      :class="selectedContent === 'link' ? 'text-white' : 'text-black'"
                    >
                      Link Embed
                    </p>
                  </button>
                </div>
                <div v-if="selectedContent === 'image'" class="grid md:grid-cols-4 pt-4">
                  <div>
                    <p class="mb-2">Clique e escolha a imagem:*</p>
                    <div
                      class="flex items-center justify-center w-full"
                      v-if="!routeForm.image"
                    >
                      <label
                        for="dropzone-route-image"
                        class="flex flex-col md:flex-row items-center justify-center w-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer shadow-all py-4"
                      >
                        <div class="flex flex-col items-center justify-center">
                          <svg
                            aria-hidden="true"
                            class="w-10 h-10 mb-3 text-gray-400"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg"
                          >
                            <path
                              stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                            ></path>
                          </svg>
                          <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                            <span class="font-bold text-dark">Arraste</span> a imagem ou
                            <span class="font-bold text-dark">clique aqui.</span>
                          </p>
                          <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                            Formatos suportados:
                            <span class="font-bold text-dark">JPG, JPEG ou PNG</span>
                          </p>
                        </div>
                        <input
                          id="dropzone-route-image"
                          type="file"
                          class="hidden"
                          @change="onFileSelect('image', $event)"
                          accept="image/*"
                        />
                      </label>
                    </div>
                    <div v-else class="relative">
                      <img :src="imagePreviewUrl" v-if="imagePreviewUrl" />

                      <button
                        class="absolute top-2 right-2 cursor-pointer"
                        type="button"
                        @click="clearImage"
                      >
                        <svg
                          class="w-6 h-6"
                          aria-hidden="true"
                          xmlns="http://www.w3.org/2000/svg"
                          fill="none"
                          viewBox="0 0 14 14"
                        >
                          <path
                            stroke="white"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                          />
                        </svg>
                      </button>
                    </div>
                  </div>
                </div>
                <div v-else-if="selectedContent === 'link'">
                  <div>
                    <label
                      for="route-link-embed"
                      class="block my-2 text-sm font-medium text-gray-900"
                      >Inserir o link embed:*</label
                    >
                    {{ routeForm.link_embed }}
                    <input
                      type="text"
                      id="route-link-embed"
                      v-model="routeForm.link_embed"
                      class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
                    />
                  </div>
                  <div class="pt-6">
                    <div v-if="iframeError">O SEU LINK É INVÁLIDO</div>
                    <iframe
                      v-else
                      v-if="routeForm.link_embed"
                      :src="routeForm.link_embed"
                      @error="onIframeError"
                      width="600"
                      height="450"
                      style="border: 0"
                      allowfullscreen=""
                      loading="lazy"
                    ></iframe>
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
                data-modal-hide="routeCreateModal"
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
                data-modal-hide="routeCreateModal"
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

    <!-- START -->
    <div class="shadow-all p-6 mt-4 mb-8 rounded-xl">
      <h1 class="font-black text-3xl text-center">Percursos cadastradas:</h1>
      <div v-for="route in routes" :key="route.id" class="py-4">
        <h1 class="font-black text-xl mb-2">Percurso {{ route.id }}</h1>
        <div id="accordion-collapse" data-accordion="collapse">
          <div
            class="flex flex-col md:flex-row justify-center md:justify-between items-center shadow-all rounded-xl relative p-4 bg-white gap-2"
            :class="{ 'md:shadow-xt': expandedRouteItems.includes(route.id) }"
          >
            <div>
              <h2
                class="absolute top-2 right-4 md:hidden"
                :id="'accordion-collapse-heading-' + route.id"
              >
                <button
                  type="button"
                  @click="toggleRouteAccordionItem(route.id)"
                  :aria-expanded="expandedRouteItems.includes(route.id)"
                  :aria-controls="'accordion-collapse-body-' + route.id"
                >
                  <svg
                    data-accordion-icon
                    class="w-4 h-4"
                    :class="{ 'rotate-180': expandedRouteItems.includes(route.id) }"
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
              <h1 class="text-[#616161] font-bold text-xl">
                {{ route.name }}
              </h1>
            </div>
            <div
              class="grid grid-cols-2 md:grid-cols-3 2xl:grid-cols-4 gap-4 md:border-x md:border-black md:px-4"
            >
              <div
                v-for="inscriptionRelation in route.inscriptions"
                :key="inscriptionRelation.id"
              >
                <p class="bg-[#616161] px-2 rounded-md text-white text-center">
                  {{ inscriptionRelation.event_inscription.name }}
                </p>
              </div>
            </div>
            <div class="flex gap-8 items-center my-4 md:my-0">
              <!-- START ROUTE EDIT -->
              <div class="flex">
                <button @click="openRouteEditModal(route.id)">
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
                v-if="isRouteEditModalOpen(route.id)"
                :id="'routeEditModal-' + route.id"
                tabindex="-1"
                aria-hidden="true"
                class="fixed flex items-center justify-center top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full"
              >
                <div
                  class="modal-lot-create-backdrop"
                  @click="closeRouteEditModal(route.id)"
                ></div>
                <div class="relative w-full max-w-6xl max-h-full">
                  <!-- Modal content -->
                  <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <form @submit.prevent="routeEdit(route)">
                      <!-- Modal header -->
                      <div
                        class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600"
                      >
                        <h3 class="text-3xl font-black text-black">EDITAR PERCURSO:</h3>
                        <button
                          type="button"
                          class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                          @click="closeRouteEditModal(route.id)"
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
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                          <div>
                            <label
                              for="route-edit-name"
                              class="block mb-2 text-sm font-medium text-gray-900"
                              >Nome do percurso:*</label
                            >
                            <input
                              type="text"
                              id="route-edit-name"
                              v-model="route.name"
                              class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
                            />
                          </div>
                          <div>
                            <label
                              for="route-edit-observation"
                              class="block mb-2 text-sm font-medium text-gray-900"
                              >Observação:*</label
                            >
                            <input
                              type="text"
                              id="route-edit-observation"
                              v-model="route.observation"
                              class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
                            />
                          </div>
                        </div>
                        <div class="pt-4">
                          <label
                            for="route-inscriptions"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >Vincular percurso em quais inscrições?</label
                          >
                          {{ selectedInscriptions[route.id] }}
                          <Multiselect
                            class="shadow-all"
                            v-model="selectedInscriptions[route.id]"
                            mode="tags"
                            :close-on-select="false"
                            :searchable="true"
                            :create-option="false"
                            :options="formattedInscriptions"
                          />
                        </div>
                        <div class="w-full">
                          <div class="flex pt-4">
                            <h1
                              class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                            >
                              Visualização do percurso por:*
                            </h1>
                          </div>
                          <div class="flex flex-col md:flex-row gap-4 pt-2">
                            <button
                              type="button"
                              class="flex justify-center items-center gap-2 shadow-all px-20 py-10 rounded-xl"
                              :class="
                                contentSelection(route) === 'image'
                                  ? 'bg-black'
                                  : 'bg-white'
                              "
                              @click="setSelection(route, 'image')"
                            >
                              <svg
                                class="w-8 h-8"
                                viewBox="0 0 27 22"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  fill-rule="evenodd"
                                  clip-rule="evenodd"
                                  d="M2.49913 0H24.4991C25.7214 0 26.9436 1.22222 26.9436 2.44444V19.5556C26.9436 20.7778 25.7214 22 24.4991 22H2.49913C1.15469 22 0.0546875 20.9 0.0546875 19.5556V2.44444C0.0546875 1.22222 1.27691 0 2.49913 0ZM9.22135 11.6111L4.94358 17.1111H22.0547L16.5547 9.77778L12.2769 15.29L9.22135 11.6111Z"
                                  :fill="
                                    contentSelection(route) === 'image'
                                      ? 'white'
                                      : 'black'
                                  "
                                />
                              </svg>
                              <p
                                class="font-black text-lg"
                                :class="
                                  contentSelection(route) === 'image'
                                    ? 'text-white'
                                    : 'text-black'
                                "
                              >
                                Imagem
                              </p>
                            </button>
                            <button
                              type="button"
                              class="flex justify-center items-center gap-2 shadow-all px-20 py-10 rounded-xl"
                              :class="
                                contentSelection(route) === 'link'
                                  ? 'bg-black'
                                  : 'bg-white'
                              "
                              @click="setSelection(route, 'link')"
                            >
                              <svg
                                class="w-8 h-8"
                                viewBox="0 0 17 22"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  fill-rule="evenodd"
                                  clip-rule="evenodd"
                                  d="M15.1008 6.6C15.1008 2.959 12.1418 0 8.50078 0C4.85978 0 1.90078 2.959 1.90078 6.6C1.90078 11.55 8.50078 18.7 8.50078 18.7C8.50078 18.7 15.1008 11.55 15.1008 6.6ZM6.30078 6.6C6.30078 5.39 7.29078 4.4 8.50078 4.4C9.71078 4.4 10.7008 5.39 10.7008 6.6C10.7008 7.81 9.72178 8.8 8.50078 8.8C7.29078 8.8 6.30078 7.81 6.30078 6.6ZM0.800781 22V19.8H16.2008V22H0.800781Z"
                                  :fill="
                                    contentSelection(route) === 'link' ? 'white' : 'black'
                                  "
                                />
                              </svg>

                              <p
                                class="font-black text-lg"
                                :class="
                                  contentSelection(route) === 'link'
                                    ? 'text-white'
                                    : 'text-black'
                                "
                              >
                                Link Embed
                              </p>
                            </button>
                          </div>
                          <div
                            v-if="contentSelection(route) === 'image'"
                            class="grid grid-cols-4 pt-4"
                          >
                            <div>
                              <p class="mb-2">Clique e escolha a imagem:*</p>
                              <div
                                class="flex items-center justify-center w-full"
                                v-if="!route.image_path"
                              >
                                <label
                                  :for="'dropzone-route-image-edit-' + route.id"
                                  class="flex flex-col md:flex-row items-center justify-center w-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer shadow-all py-4"
                                >
                                  <div class="flex flex-col items-center justify-center">
                                    <svg
                                      aria-hidden="true"
                                      class="w-10 h-10 mb-3 text-gray-400"
                                      fill="none"
                                      stroke="currentColor"
                                      viewBox="0 0 24 24"
                                      xmlns="http://www.w3.org/2000/svg"
                                    >
                                      <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"
                                      ></path>
                                    </svg>
                                    <p
                                      class="mb-2 text-sm text-gray-500 dark:text-gray-400"
                                    >
                                      <span class="font-bold text-dark">Arraste</span> a
                                      imagem ou
                                      <span class="font-bold text-dark"
                                        >clique aqui.</span
                                      >
                                    </p>
                                    <p
                                      class="mb-2 text-sm text-gray-500 dark:text-gray-400"
                                    >
                                      Formatos suportados:
                                      <span class="font-bold text-dark"
                                        >JPG, JPEG ou PNG</span
                                      >
                                    </p>
                                  </div>
                                  <input
                                    :id="'dropzone-route-image-edit-' + route.id"
                                    type="file"
                                    class="hidden"
                                    @change="onFileSelectEdit('image', $event, route.id)"
                                    accept="image/*"
                                  />
                                </label>
                              </div>
                              <div v-else class="relative">
                                <img :src="imagePreviewUrl" v-if="imagePreviewUrl" />
                                <img
                                  v-else
                                  v-if="route.image_path"
                                  :src="'../storage/' + route.image_path"
                                  class="w-full h-72 md:w-fit md:h-full rounded-xl"
                                  alt=""
                                />

                                <button
                                  class="absolute top-2 right-2 cursor-pointer"
                                  type="button"
                                  @click="deleteImage(route.id)"
                                >
                                  <svg
                                    class="w-6 h-6"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 14 14"
                                  >
                                    <path
                                      stroke="white"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"
                                    />
                                  </svg>
                                </button>
                              </div>
                            </div>
                          </div>
                          <div v-else-if="contentSelection(route) === 'link'">
                            <div>
                              <label
                                for="route-link-embed"
                                class="block my-2 text-sm font-medium text-gray-900"
                                >Inserir o link embed:*</label
                              >
                              <input
                                type="text"
                                id="route-link-embed"
                                v-model="route.link_embed"
                                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
                              />
                            </div>
                            <div class="pt-6">
                              <div v-if="iframeError">error svg</div>
                              <iframe
                                v-else
                                v-if="route.link_embed"
                                :src="route.link_embed"
                                @error="onIframeError"
                                width="600"
                                height="450"
                                style="border: 0"
                                allowfullscreen=""
                                loading="lazy"
                              ></iframe>
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
                          class="md:w-52 flex justify-center items-center bg-[#FF7171] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all gap-2"
                          @click="closeRouteEditModal(route.id)"
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
              <!-- END ROUTE EDIT -->

              <form @submit.prevent="routeDelete(route.id)" class="flex">
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
                class="hidden md:block"
                :id="'accordion-collapse-heading-' + route.id"
                type="button"
                @click="toggleRouteAccordionItem(route.id)"
                :aria-expanded="expandedRouteItems.includes(route.id)"
                :aria-controls="'accordion-collapse-body-' + route.id"
              >
                <svg
                  data-accordion-icon
                  class="w-4 h-4"
                  :class="{ 'rotate-180': expandedRouteItems.includes(route.id) }"
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
            :id="'accordion-collapse-body-' + route.id"
            class="block"
            v-show="expandedRouteItems.includes(route.id)"
            :aria-labelledby="'accordion-collapse-heading-' + route.id"
          >
            <div
              class="bg-[#616161] -mt-2 px-2 flex flex-col items-center pb-6 rounded-b-xl gap-4 pt-6"
            >
              <div class="bg-gray-100 p-6 w-full rounded-xl">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-y-8 gap-4">
                  <div class="col-span-2 md:col-span-1">
                    <iframe
                      v-if="route.link_embed"
                      :src="route.link_embed"
                      class="w-full h-72 md:w-fit md:h-full rounded-xl"
                      style="border: 0"
                      allowfullscreen=""
                      loading="lazy"
                    ></iframe>
                    <img
                      v-else
                      v-if="route.image_path"
                      :src="'../storage/' + route.image_path"
                      class="w-full h-72 md:w-fit md:h-full rounded-xl"
                      alt=""
                    />
                  </div>
                  <div class="col-span-1 md:col-span-2 flex flex-col gap-2">
                    <h1 class="text-[#616161] font-bold text-xl">{{ route.name }}:</h1>
                    <label for="route.observation" class="mt-2">Observações: </label>
                    <textarea
                      name=""
                      id="route.observation"
                      cols="30"
                      rows="6"
                      v-model="route.observation"
                      class="rounded-xl border-none shadow-all"
                    ></textarea>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- END  -->
  </div>
</template>

<script setup>
import { ref, watch, reactive, onMounted } from "vue";
import { router, useForm } from "@inertiajs/vue3";
import Multiselect from "@vueform/multiselect";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const toast = useToast();

const props = defineProps({
  routes: Array,
  inscriptions: Array,
  eventId: Number,
});

const formattedInscriptions = ref(
  props.inscriptions.map((item) => ({
    value: item.id,
    label: item.name,
  }))
);

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


const selectedInscriptions = ref({});

onMounted(() => {
  props.routes.forEach((route) => {
    selectedInscriptions.value[route.id] = route.inscriptions.map(
      (i) => i.event_inscription_id
    );
  });
});

watch(
  () => props.routes,
  (newRoutes) => {
    newRoutes.forEach((route) => {
      if (!selectedInscriptions.value[route.id]) {
        selectedInscriptions.value[route.id] = route.inscriptions.map(
          (i) => i.event_inscription_id
        );
      }
    });
  },
  { deep: true }
);

const selectedContent = ref("");
const imagePreviewUrl = ref("");

watch(selectedContent, (newValue) => {
  if (newValue === "image") {
    routeForm.link_embed = "";
  } else if (newValue === "link") {
    imagePreviewUrl.value = "";
    const fileInput = document.getElementById("dropzone-route-image");
    if (fileInput) {
      fileInput.value = "";
    }
    routeForm.image = null;
  }
});

const routeSelections = reactive(new Map());

const contentSelection = (route) => {
  if (!routeSelections.has(route.id)) {
    if (route.image_path) {
      routeSelections.set(route.id, "image");
    } else if (route.link_embed) {
      routeSelections.set(route.id, "link");
    } else {
      routeSelections.set(route.id, "none");
    }
  }
  return routeSelections.get(route.id);
};

const updatedRoutes = reactive(new Map());

const getUpdatedRoute = (routeId) => {
  if (!updatedRoutes.has(routeId)) {
    updatedRoutes.set(routeId, { ...route });
  }
  return updatedRoutes.get(routeId);
};

const setSelection = (currentRoute, selection) => {
  const updatedRoute = getUpdatedRoute(route.id);
  if (selection === "image") {
    updatedRoute.link_embed = "";
    updatedRoute.image_path = null;
    router.delete(route("event.route.reset.fields", { id: currentRoute.id }), {
      preserveScroll: true,
    });
  } else if (selection === "link") {
    router.delete(route("event.route.reset.fields", { id: currentRoute.id }), {
      preserveScroll: true,
    });
    updatedRoute.image_path = null;
    const fileInput = document.getElementById(
      `dropzone-route-image-edit-${currentRoute.id}`
    );
    if (fileInput) {
      fileInput.value = "";
    }
  }
  routeSelections.set(currentRoute.id, selection);
  console.log("final setSelection");
};

// function resetFields(apoka) {
//   console.log(apoka);
//   router.delete(route("event.route.reset.fields", { id: apoka.id }), {
//     preserveScroll: true,
//   });
// }

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
        routeForm[field] = file;
        imagePreviewUrl.value = URL.createObjectURL(file);
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

function onFileSelectEdit(field, event, id) {
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
        routeForm[field] = file;
        console.log("222");
        router.post(
          route("event.route.update.image", { id: id }),
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

function clearImage() {
  imagePreviewUrl.value = "";
  const fileInput = document.getElementById("dropzone-route-image");
  if (fileInput) {
    fileInput.value = "";
  }
  routeForm.image = null;
}

const routeForm = useForm({
  name: "",
  observation: "",
  inscriptions: null,
  image: null,
  link_embed: "",
});

const routeCreate = () => {
  routeForm.post(route("event.route.create", { id: props.eventId }), {
    preserveScroll: true,
    onSuccess: () => {
      console.log("success");
    },
  });
};

const iframeError = ref(false);

function onIframeError() {
  iframeError.value = true;
}

function extractURLFromIframe(input) {
  const match = input.match(/<iframe.*?src="(.*?)"/);
  if (match && match[1]) {
    return match[1];
  }
  return input;
}

async function checkURL() {
  if (!routeForm.link_embed) return;

  const actualURL = extractURLFromIframe(routeForm.link_embed);

  try {
    const response = await fetch(actualURL, {
      method: "GET",
    });

    console.log("Response status:", response.status);

    if (response.ok) {
      iframeError.value = false;
      routeForm.link_embed = actualURL;
    } else {
      iframeError.value = true;
    }
  } catch (error) {
    console.error("Fetch error:", error);
    iframeError.value = true;
  }
}

watch(
  () => routeForm.link_embed,
  (newValue) => {
    if (!newValue || newValue.trim() === "") {
      iframeError.value = false;
    } else {
      checkURL();
    }
  }
);

const expandedRouteItems = ref(props.routes.map((i) => i.id));

const toggleRouteAccordionItem = (itemId) => {
  const index = expandedRouteItems.value.indexOf(itemId);
  if (index === -1) {
    expandedRouteItems.value.push(itemId);
  } else {
    expandedRouteItems.value.splice(index, 1);
  }
};

watch(
  () => props.routes,
  (newRoutes, oldRoutes) => {
    if (newRoutes.length > oldRoutes.length) {
      const newRoute = newRoutes.find((route) => !oldRoutes.includes(route));

      if (newRoute && !expandedRouteItems.value.includes(newRoute.id)) {
        expandedRouteItems.value.push(newRoute.id);
      }
    }
  },
  { deep: true }
);

// START ROUTE EDIT
const openRouteEditModals = ref([]);
const openRouteEditModal = (id) => {
  if (!openRouteEditModals.value.includes(id)) {
    openRouteEditModals.value.push(id);
  }
};
const closeRouteEditModal = (id) => {
  const index = openRouteEditModals.value.indexOf(id);
  if (index > -1) {
    openRouteEditModals.value.splice(index, 1);
  }
};
const isRouteEditModalOpen = (id) => openRouteEditModals.value.includes(id);
// END ROUTE EDIT

function deleteImage(id) {
  router.delete(route("event.route.delete.image", { id: id }), {
    preserveScroll: true,
  });
}

function routeEdit(item) {
  console.log(item);
  router.put(
    route("event.route.edit", { id: item.id }),
    {
      name: item.name,
      observation: item.observation,
      link_embed: item.link_embed,
      // inscriptions: selectedInscriptions[item.id],
      inscriptions: selectedInscriptions.value[item.id],
    },
    {
      preserveScroll: true,
    }
  );
  closeRouteEditModal(item.id);
  toast.success("Dados editados com Sucesso!", {
    position: "top-right",
    duration: 5000,
  });
}

function routeDelete(id) {
  router.delete(route("event.route.delete", { id: id }), {
    preserveScroll: true,
  });
}
</script>
<style src="@vueform/multiselect/themes/default.css"></style>
<style>
.multiselect {
  border-radius: 0.5rem !important;
}
.multiselect-tags-search:focus {
  outline: none !important;
  border: none !important;
  box-shadow: none !important;
}
.multiselect-tag {
  background-color: #0dcd71;
}
.is-active {
  outline: 2px solid transparent !important;
  outline-offset: 2px !important;
  --tw-ring-inset: var(--tw-empty, /*!*/ /*!*/) !important;
  --tw-ring-offset-width: 0px !important;
  --tw-ring-offset-color: #fff !important;
  --tw-ring-color: #2563eb !important;
  --tw-ring-offset-shadow: var(--tw-ring-inset) 0 0 0 var(--tw-ring-offset-width)
    var(--tw-ring-offset-color) !important;
  --tw-ring-shadow: var(--tw-ring-inset) 0 0 0 calc(1px + var(--tw-ring-offset-width))
    var(--tw-ring-color) !important;
  box-shadow: var(--tw-ring-offset-shadow), var(--tw-ring-shadow), var(--tw-shadow) !important;
  border-color: #2563eb !important;
}
</style>

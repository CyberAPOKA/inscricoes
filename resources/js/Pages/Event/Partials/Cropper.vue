<template>
  <div>
    <!-- {{ event.logos }} -->
    <!-- <div>
      <div v-for="logo in event.logos" :key="logo.id">
        <div v-for="item in logo.info" :key="item.id">
          {{ item.index }}
        </div>
      </div>
    </div> -->
    <h1 class="ml-8 text-[#616161] font-normal text-lg">Parcerias do evento:</h1>
    <div class="bg-[#F9F9F9] rounded-3xl p-6 shadow-all">
      <form @submit.prevent="submit" enctype="multipart/form-data">
        <div>
          <div>
            <h1 class="md:ml-8 text-[#616161] font-normal text-lg pb-2">
              Tipo de parceria (Ex: Patrocinadores master, patrocinadores, apoio, etc..):
            </h1>
            <div class="flex flex-col md:flex-row space-y-3 md:space-y-0 md:gap-6">
              <input type="text" v-model="form.file_type" placeholder="Escreva um nome..."
                class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all" />
              <button data-modal-target="openModal" data-modal-toggle="openModal"
                class="block text-white bg-[#0DCD71] hover:bg-blue-800 px-12 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm py-2.5 text-center"
                type="button" :disabled="form.file_type.length === 0">
                Criar
              </button>
            </div>
          </div>

          <div id="openModal" tabindex="-1" aria-hidden="true"
            class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative w-full max-w-2xl max-h-full" :class="{ 'max-w-7xl': image }">
              <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex justify-center p-4 rounded-t md:rounded-t-none dark:border-gray-600">
                  <h3 class="text-4xl font-black text-black dark:text-white">
                    ENVIAR LOGOTIPO
                  </h3>
                  <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                    data-modal-hide="openModal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                      viewBox="0 0 14 14">
                      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                  </button>
                </div>
                <div class="p-6 flex flex-col items-center gap-2 justify-evenly md:flex-row h-full w-full">
                  <div class="flex flex-col items-center h-full" v-if="form.sponsor.length != 0">
                    <h1 class="font-bold text-2xl uppercase">Imagem Original
                    </h1>
                    <vue-cropper ref="cropper" v-if="imageUrl" :src="imageUrl" alt="Imagem" preview=".preview"
                      :aspect-ratio="1 / 1" class="max-h-96 max-w-7xl" />
                  </div>

                  <button type="button" @click="cropImage"
                    class="max-h-24 flex flex-col justify-center items-center gap-2 bg-blue-500 px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all"
                    v-if="form.sponsor.length != 0">
                    <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M8.904 6.204C9.157 5.654 9.3 5.049 9.3 4.4C9.3 1.969 7.331 0 4.9 0C2.469 0 0.5 1.969 0.5 4.4C0.5 6.831 2.469 8.8 4.9 8.8C5.549 8.8 6.154 8.657 6.704 8.404L9.3 11L6.704 13.596C6.154 13.343 5.549 13.2 4.9 13.2C2.469 13.2 0.5 15.169 0.5 17.6C0.5 20.031 2.469 22 4.9 22C7.331 22 9.3 20.031 9.3 17.6C9.3 16.951 9.157 16.346 8.904 15.796L11.5 13.2L19.2 20.9H22.5V19.8L8.904 6.204ZM4.9 6.6C3.69 6.6 2.7 5.621 2.7 4.4C2.7 3.179 3.69 2.2 4.9 2.2C6.11 2.2 7.1 3.179 7.1 4.4C7.1 5.621 6.11 6.6 4.9 6.6ZM2.7 17.6C2.7 18.821 3.69 19.8 4.9 19.8C6.11 19.8 7.1 18.821 7.1 17.6C7.1 16.379 6.11 15.4 4.9 15.4C3.69 15.4 2.7 16.379 2.7 17.6ZM11.5 11.55C11.192 11.55 10.95 11.308 10.95 11C10.95 10.692 11.192 10.45 11.5 10.45C11.808 10.45 12.05 10.692 12.05 11C12.05 11.308 11.808 11.55 11.5 11.55ZM12.6 7.7L19.2 1.1H22.5V2.2L14.8 9.9L12.6 7.7Z"
                        fill="white" />
                    </svg>
                    <span>Recortar</span>
                  </button>

                  <div class="cropped-image">
                    <div v-if="image" class="flex flex-col items-center w-full">
                      <h1 class="font-bold text-2xl uppercase">Imagem Recortada</h1>
                      <div class="p-6 rounded-2xl shadow-all">
                        <img :src="image" alt="Cropped Image" class="max-w-96 max-h-96" />
                      </div>
                    </div>
                    <div v-else class="crop-placeholder" />
                  </div>
                </div>
                <div class="mx-6 py-2 rounded-xl gap-4 bg-yellow flex justify-center items-center"
                  v-if="form.sponsor.length != 0">
                  <svg class="h-6 w-6" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M9 0C4.032 0 0 4.032 0 9C0 13.968 4.032 18 9 18C13.968 18 18 13.968 18 9C18 4.032 13.968 0 9 0ZM8.1 13.5V11.7H9.9V13.5H8.1ZM8.1 4.5V9.9H9.9V4.5H8.1Z"
                      fill="#191919" />
                  </svg>
                  <p>
                    Redimensione e recorte novamente para obter uma nova imagem recortada.
                  </p>
                </div>
                <div
                  class="flex flex-col md:flex-row gap-2 justify-between p-6 border-gray-200 rounded-b dark:border-gray-600">
                  <button type="button"
                    class="md:w-52 flex justify-evenly items-center bg-[#FF7171] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all"
                    data-modal-hide="openModal" v-if="form.sponsor.length === 0">
                    <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M3.72183 3.22178C8.01538 -1.07177 14.9846 -1.07177 19.2782 3.22178C23.5717 7.51533 23.5717 14.4846 19.2782 18.7781C14.9846 23.0717 8.01538 23.0717 3.72183 18.7781C-0.571727 14.4846 -0.571727 7.51533 3.72183 3.22178ZM11.5 12.5556L14.6113 15.6669L16.1669 14.1112L13.0556 11L16.1669 7.88868L14.6113 6.33305L11.5 9.44432L8.38873 6.33305L6.83309 7.88868L9.94436 11L6.83309 14.1112L8.38873 15.6669L11.5 12.5556Z"
                        fill="white" />
                    </svg>
                    <span>Cancelar</span>
                  </button>
                  <button @click="removeFile" type="button"
                    class="md:w-52 flex justify-evenly items-center bg-red-600 px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all"
                    v-if="form.sponsor.length != 0">
                    <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M3.72183 3.22178C8.01538 -1.07177 14.9846 -1.07177 19.2782 3.22178C23.5717 7.51533 23.5717 14.4846 19.2782 18.7781C14.9846 23.0717 8.01538 23.0717 3.72183 18.7781C-0.571727 14.4846 -0.571727 7.51533 3.72183 3.22178ZM11.5 12.5556L14.6113 15.6669L16.1669 14.1112L13.0556 11L16.1669 7.88868L14.6113 6.33305L11.5 9.44432L8.38873 6.33305L6.83309 7.88868L9.94436 11L6.83309 14.1112L8.38873 15.6669L11.5 12.5556Z"
                        fill="white" />
                    </svg>
                    <span>Remover Imagem</span>
                  </button>
                  <button v-show="form.sponsor.length != 0 && image" data-modal-hide="openModal"
                    class="md:w-52 flex justify-center items-center gap-2 bg-[#0DCD71] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all hover:cursor-pointer">
                    <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M0 11C0 4.928 4.928 0 11 0C17.072 0 22 4.928 22 11C22 17.072 17.072 22 11 22C4.928 22 0 17.072 0 11ZM12.1 12.1H16.5V9.9H12.1V5.5H9.9V9.9H5.5V12.1H9.9V16.5H12.1V12.1Z"
                        fill="white" />
                    </svg>
                    <span>Salvar</span>
                  </button>

                  <label for="dropzone-file-sponsor" v-if="form.sponsor.length === 0" class="md:w-52">
                    <div
                      class="md:w-52 flex justify-evenly items-center gap-2 bg-[#0DCD71] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all hover:cursor-pointer">
                      <svg width="19" height="22" viewBox="0 0 19 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                          d="M13.3826 9.05882V16.8235H5.61788V9.05882H0.441406L9.50023 0L18.5591 9.05882H13.3826ZM18.5591 22V19.4118H0.441406V22H18.5591Z"
                          fill="white" />
                      </svg>
                      <span>Enviar</span>
                    </div>
                    <input id="dropzone-file-sponsor" class="hidden" type="file"
                      @change="onFileSelected('sponsor', $event)" accept=".png, .jpeg, .jpg" />
                  </label>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
      <div id="openModalRow" tabindex="-1" aria-hidden="true"
        class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <form @submit.prevent="submitRow" enctype="multipart/form-data">
          <div class="relative w-full max-w-2xl max-h-full" :class="{
            'max-w-7xl': imageUrlRow,
            'md:w-[42rem]': form.sponsor.length === 0,
          }">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
              <div class="flex justify-center p-4 rounded-t md:rounded-t-none dark:border-gray-600">
                <h3 class="text-4xl font-black text-black dark:text-white">
                  ENVIAR LOGOTIPO
                </h3>
                <button type="button"
                  class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                  data-modal-hide="openModalRow">
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                  </svg>
                  <span class="sr-only">Close modal</span>
                </button>
              </div>
              <div class="p-6 flex flex-col items-center gap-2 justify-evenly md:flex-row h-full w-full">
                <div class="flex flex-col items-center h-full" v-if="form.sponsor.length != 0">
                  <h1 class="font-bold text-2xl uppercase">Imagem Original</h1>
                  <vue-cropper ref="cropperRow" v-if="imageUrlRow" :src="imageUrlRow" alt="Imagem" preview=".preview"
                    :aspect-ratio="1 / 1" class="max-w-[40rem] max-h-[40rem]" />
                </div>

                <button type="button" @click="cropImageRow"
                  class="max-h-24 flex flex-col justify-center items-center gap-2 bg-blue-500 px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all"
                  v-if="form.sponsor.length != 0">
                  <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M8.904 6.204C9.157 5.654 9.3 5.049 9.3 4.4C9.3 1.969 7.331 0 4.9 0C2.469 0 0.5 1.969 0.5 4.4C0.5 6.831 2.469 8.8 4.9 8.8C5.549 8.8 6.154 8.657 6.704 8.404L9.3 11L6.704 13.596C6.154 13.343 5.549 13.2 4.9 13.2C2.469 13.2 0.5 15.169 0.5 17.6C0.5 20.031 2.469 22 4.9 22C7.331 22 9.3 20.031 9.3 17.6C9.3 16.951 9.157 16.346 8.904 15.796L11.5 13.2L19.2 20.9H22.5V19.8L8.904 6.204ZM4.9 6.6C3.69 6.6 2.7 5.621 2.7 4.4C2.7 3.179 3.69 2.2 4.9 2.2C6.11 2.2 7.1 3.179 7.1 4.4C7.1 5.621 6.11 6.6 4.9 6.6ZM2.7 17.6C2.7 18.821 3.69 19.8 4.9 19.8C6.11 19.8 7.1 18.821 7.1 17.6C7.1 16.379 6.11 15.4 4.9 15.4C3.69 15.4 2.7 16.379 2.7 17.6ZM11.5 11.55C11.192 11.55 10.95 11.308 10.95 11C10.95 10.692 11.192 10.45 11.5 10.45C11.808 10.45 12.05 10.692 12.05 11C12.05 11.308 11.808 11.55 11.5 11.55ZM12.6 7.7L19.2 1.1H22.5V2.2L14.8 9.9L12.6 7.7Z"
                      fill="white" />
                  </svg>
                  <span>Recortar</span>
                </button>

                <div class="cropped-image">
                  <div v-if="imageRow" class="flex flex-col items-center w-full">
                    <h1 class="font-bold text-2xl uppercase">Imagem Recortada</h1>
                    <div class="p-6 rounded-2xl shadow-all">
                      <img :src="imageRow" alt="Cropped Image" class="max-w-96 max-h-96" />
                    </div>
                  </div>
                  <div v-else class="crop-placeholder" />
                </div>
              </div>
              <div class="mx-6 py-2 rounded-xl gap-4 bg-yellow flex justify-center items-center"
                v-if="form.sponsor.length != 0">
                <svg class="h-6 w-6" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path fill-rule="evenodd" clip-rule="evenodd"
                    d="M9 0C4.032 0 0 4.032 0 9C0 13.968 4.032 18 9 18C13.968 18 18 13.968 18 9C18 4.032 13.968 0 9 0ZM8.1 13.5V11.7H9.9V13.5H8.1ZM8.1 4.5V9.9H9.9V4.5H8.1Z"
                    fill="#191919" />
                </svg>
                <p>
                  Redimensione e recorte novamente para obter uma nova imagem recortada.
                </p>
              </div>
              <div
                class="flex flex-col md:flex-row gap-2 justify-between p-6 border-gray-200 rounded-b dark:border-gray-600">
                <button type="button"
                  class="md:w-52 flex justify-evenly items-center bg-[#FF7171] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all"
                  data-modal-hide="openModalRow" v-if="form.sponsor.length === 0">
                  <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M3.72183 3.22178C8.01538 -1.07177 14.9846 -1.07177 19.2782 3.22178C23.5717 7.51533 23.5717 14.4846 19.2782 18.7781C14.9846 23.0717 8.01538 23.0717 3.72183 18.7781C-0.571727 14.4846 -0.571727 7.51533 3.72183 3.22178ZM11.5 12.5556L14.6113 15.6669L16.1669 14.1112L13.0556 11L16.1669 7.88868L14.6113 6.33305L11.5 9.44432L8.38873 6.33305L6.83309 7.88868L9.94436 11L6.83309 14.1112L8.38873 15.6669L11.5 12.5556Z"
                      fill="white" />
                  </svg>
                  <span>Cancelar</span>
                </button>
                <button @click="removeFileRow" type="button"
                  class="md:w-52 flex justify-evenly items-center bg-red-600 px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all"
                  v-if="form.sponsor.length != 0">
                  <svg width="23" height="22" viewBox="0 0 23 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M3.72183 3.22178C8.01538 -1.07177 14.9846 -1.07177 19.2782 3.22178C23.5717 7.51533 23.5717 14.4846 19.2782 18.7781C14.9846 23.0717 8.01538 23.0717 3.72183 18.7781C-0.571727 14.4846 -0.571727 7.51533 3.72183 3.22178ZM11.5 12.5556L14.6113 15.6669L16.1669 14.1112L13.0556 11L16.1669 7.88868L14.6113 6.33305L11.5 9.44432L8.38873 6.33305L6.83309 7.88868L9.94436 11L6.83309 14.1112L8.38873 15.6669L11.5 12.5556Z"
                      fill="white" />
                  </svg>
                  <span>Remover Imagem</span>
                </button>

                <button v-show="form.sponsor.length != 0" data-modal-hide="openModalRow"
                  class="md:w-52 flex justify-center items-center gap-2 bg-[#0DCD71] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all hover:cursor-pointer">
                  <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M0 11C0 4.928 4.928 0 11 0C17.072 0 22 4.928 22 11C22 17.072 17.072 22 11 22C4.928 22 0 17.072 0 11ZM12.1 12.1H16.5V9.9H12.1V5.5H9.9V9.9H5.5V12.1H9.9V16.5H12.1V12.1Z"
                      fill="white" />
                  </svg>
                  <span>Salvar</span>
                </button>

                <label for="dropzone-file-sponsor-row" v-if="form.sponsor.length === 0" class="md:w-52">
                  <div
                    class="md:w-52 flex justify-evenly items-center gap-2 bg-[#0DCD71] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all hover:cursor-pointer">
                    <svg width="19" height="22" viewBox="0 0 19 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M13.3826 9.05882V16.8235H5.61788V9.05882H0.441406L9.50023 0L18.5591 9.05882H13.3826ZM18.5591 22V19.4118H0.441406V22H18.5591Z"
                        fill="white" />
                    </svg>
                    <span>Enviar</span>
                  </div>
                  <input id="dropzone-file-sponsor-row" class="hidden" type="file"
                    @change="onFileSelectedRow('sponsor', $event)" accept=".png, .jpeg, .jpg" />
                </label>
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="pt-4">
        <h1 class="text-[#616161] font-normal text-lg pb-2">
          Parcerias criadas no evento (Organize na ordem que vai aparecer na página do
          evento, <span class="hidden md:contents font-bold">arraste</span>
          <span class="contents md:hidden font-bold">clique</span> para cima e para
          baixo):
        </h1>
        <div class="flex flex-col gap-4">
          <div v-for="(group, index) in mutableGroupedLogos" class="relative bg-[#5C5B5B] p-4 rounded-2xl">
            <div class="hidden lg:block draggable-area absolute m-auto left-4 top-0 bottom-0 z-10 hover:cursor-grab"
              draggable="true" v-on:dragstart="dragStart(index)" v-on:dragover.prevent v-on:drop="dragDrop(index)">
              <svg class="h-8 w-8 absolute top-10 md:m-auto md:left-4 md:top-0 md:bottom-0" viewBox="0 0 11 15"
                fill="none" xmlns="http://www.w3.org/2000/svg">
                <ellipse cx="8.36133" cy="2.68997" rx="1.75" ry="1.75" fill="#616161" />
                <ellipse cx="8.36133" cy="7.93997" rx="1.75" ry="1.75" fill="#616161" />
                <ellipse cx="8.36133" cy="13.19" rx="1.75" ry="1.75" fill="#616161" />
                <ellipse cx="1.75" cy="2.68997" rx="1.75" ry="1.75" fill="#616161" />
                <ellipse cx="1.75" cy="7.93997" rx="1.75" ry="1.75" fill="#616161" />
                <ellipse cx="1.75" cy="13.19" rx="1.75" ry="1.75" fill="#616161" />
              </svg>
            </div>

            <!-- {{ group.index }} -->
            <!-- {{ group.logos }} -->

            <div class="flex flex-col lg:flex-row items-center bg-white p-4 rounded-2xl relative pt-20 lg:pt-4"
              :class="[group.logos && group.logos.length === 0 ? 'h-40' : '']">
              <div
                class="flex flex-row lg:flex-col justify-between items-center lg:items-stretch rounded-t-xl lg:rounded-tl-none lg:rounded-r-2xl absolute m-auto w-full lg:w-auto right-0 top-0 lg:bottom-0 bg-dark p-2">
                <button data-modal-target="openModalRow" data-modal-toggle="openModalRow" type="button"
                  @click="currentGroup = group">
                  <svg class="w-8 h-8 hover:cursor-pointer" viewBox="0 0 18 18" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                      d="M0 9C0 4.032 4.032 0 9 0C13.968 0 18 4.032 18 9C18 13.968 13.968 18 9 18C4.032 18 0 13.968 0 9ZM9.9 9.9H13.5V8.1H9.9V4.5H8.1V8.1H4.5V9.9H8.1V13.5H9.9V9.9Z"
                      fill="white" />
                  </svg>
                </button>
                <hr class="hidden lg:block" />
                <div class="block lg:hidden">
                  <form @submit.prevent="orderMobile(group.id, group.index, action)" class="flex gap-12">
                    <button class="bg-white p-3 rounded-xl" type="submit" value="up" @click="action = 'up'">
                      <svg class="h-6 w-6" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 11L1.93875 12.9387L9.625 5.26625V22H12.375V5.26625L20.0475 12.9525L22 11L11 0L0 11Z"
                          fill="#191919" />
                      </svg>
                    </button>
                    <button class="bg-white p-3 rounded-xl" type="submit" value="down" @click="action = 'down'">
                      <svg class="h-6 w-6" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22 11L20.0613 9.06125L12.375 16.7337V0H9.625V16.7337L1.9525 9.0475L0 11L11 22L22 11Z"
                          fill="#191919" />
                      </svg>
                    </button>
                  </form>
                </div>
                <form @submit.prevent="deleteRow(group.id)">
                  <button>
                    <svg class="w-8 h-8 hover:cursor-pointer" viewBox="0 0 14 18" fill="none"
                      xmlns="http://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M10.2141 1H13.4284V3H0.571289V1H3.78557L4.70394 0H9.29578L10.2141 1ZM3.32639 18C2.31619 18 1.48966 17.1 1.48966 16V4H12.5101V16C12.5101 17.1 11.6835 18 10.6733 18H3.32639Z"
                        fill="white" />
                    </svg>
                  </button>
                </form>
              </div>
              <h2 class="text-[#616161] font-bold text-xl md:ml-10 pb-4 md:pb-0">
                {{ group.fileType }}
              </h2>
              <!-- class="grid grid-cols-2 md:grid-cols-6 gap-2 md:ml-4" -->
              <Draggable v-model="group.logos" group="logos" item-key="id" class="flex items-center justify-center xl:justify-start flex-wrap gap-2 mt-4 lg:mt-0 mx-auto md:px-2 md:mr-6"
                :class="[group.logos && group.logos.length === 0 ? 'h-full w-full' : 'h-full w-full']"
                @change="onChange(group.fileType, group.id, $event)" @start="dragStartLogo" @end="dragEndLogo">

                <template #item="{ element, index }">
                  <div class="flex items-center rounded-2xl shadow-all hover:cursor-grab p-2"
                    :class="{ zoomOut: isZoomingOut[element.id] }" @click="zoomOut(element.id)">
                    <img
                      class="w-full h-20 sm:w-full md:h-24 rounded-2xl object-contain hover:rounded-2xl transition duration-75 hover:scale-150 hover:translate-x-2"
                      :src="'../storage/' + element.file_path" :alt="index" />
                    <!-- mostra a index do banco de dados e do componente draggable -->
                    <!-- {{ element.index }} {{ index }} -->
                    <form @submit.prevent="deletePhoto(group.fileType, group.id, element.id)"
                      class="ml-1 right-0 top-0 hover:cursor-pointer">
                      <button type="submit">
                        <svg class="h-4 w-4" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M0 5C0 2.235 2.235 0 5 0C7.765 0 10 2.235 10 5C10 7.765 7.765 10 5 10C2.235 10 0 7.765 0 5ZM6.795 7.5L7.5 6.795L5.705 5L7.5 3.205L6.795 2.5L5 4.295L3.205 2.5L2.5 3.205L4.295 5L2.5 6.795L3.205 7.5L5 5.705L6.795 7.5Z"
                            fill="#616161" />
                        </svg>
                      </button>
                    </form>
                    <!-- <p class="text-red-600 text-5xl">{{ index }} - {{ element.index }}</p> -->
                  </div>
                </template>
              </Draggable>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script setup>
import { ref, watch, reactive, watchEffect } from "vue";
import { computed } from "@vue/reactivity";
import VueCropper from "vue-cropperjs";
import "cropperjs/dist/cropper.css";
import { useForm } from "@inertiajs/vue3";
import Draggable from "vuedraggable";
import { router } from "@inertiajs/vue3";

const props = defineProps({
  event: Object,
});

const logos = ref(props.event.logos.info);

const groupedLogos = computed(() => {
  const groups = {};

  logos.value.forEach((logo, index) => {
    const fileType = logo.file_type;
    if (!groups[fileType]) {
      groups[fileType] = {
        id: logo.id,
        index: logo.index,
        logos: [],
      };
    }

    logo.info.forEach((infoItem) => {
      groups[fileType].logos.push({
        ...infoItem,
        position: logo.id,
        parent: logo,
      });
    });
  });

  return reactive(
    Object.entries(groups).map(([fileType, group]) => ({
      fileType,
      id: group.id,
      index: group.index,
      logos: group.logos,
    }))
  );
});

function onChange(fileType, groupId, e) {
  let item;
  console.log(e);
  if (e.moved) {
    item = e.moved;
  } else if (e.added) {
    item = e.added;
  } else {
    return;
  }

  router.put(
    route("photo.move", { id: props.event.id }),
    {
      item: item,
      itemStatus: e.moved ? "moved" : "added",
      newIndex: item.newIndex,
      oldIndex: item.oldIndex,
      file_type: fileType,
      event_logo_id: groupId,
    },
    {
      preserveScroll: true,
    }
  );
}

function deletePhoto(fileType, groupId, logoId) {
  // console.log(fileType);
  router.post(
    route("event.logo.delete", { id: props.event.id }),
    {
      file_type: fileType,
      group_id: groupId,
      logo_id: logoId,
    },
    {
      preserveScroll: true,
    }
  );
}

function deleteRow(groupId) {
  console.log(groupId);
  if (confirm("Deseja realmente deletar? isso apagará todas as fotos.")) {
    router.post(
      route("event.row.delete", { id: props.event.id }),
      {
        group_id: groupId,
      },
      {
        preserveScroll: true,
      }
    );
  }
}

let action = ref(null);

function orderMobile(groupId, groupIndex, action) {
  console.log(groupIndex);
  console.log(action);
  router.post(
    route("drag.move.mobile", { id: props.event.id }),
    {
      group_id: groupId,
      group_index: groupIndex,
      action: action,
    },
    {
      preserveScroll: true,
    }
  );
}

let isZoomingOut = ref([]);
async function zoomOut(index) {
  isZoomingOut.value[index] = true;
  await new Promise((resolve) => setTimeout(resolve, 500));
  isZoomingOut.value[index] = false;
}

function dragStartLogo(event) {
  event.stopPropagation();
}

function dragEndLogo(event) {
  event.stopPropagation();
}

let draggedIndex = ref(null);

watchEffect(() => {
  logos.value = props.event.logos;
});

const removeFile = () => {
  form.sponsor = "";
  form.image = null;
  imageUrl.value = null;
  image.value = null;
  if (cropper.value) {
    cropper.value.destroy();
    cropper.value = null;
  }
  const fileInput = document.querySelector('input[type="file"]');
  if (fileInput) {
    fileInput.value = "";
  }
};

const removeFileRow = () => {
  form.sponsor = "";
  form.imageRow = null;
  imageUrlRow.value = null;
  imageRow.value = null;
  if (cropper.value) {
    cropper.value.destroy();
    cropper.value = null;
  }
  const fileInput = document.querySelector('.input-file-row[type="file"]');
  if (fileInput) {
    fileInput.value = "";
  }
  const fileInputById = document.querySelector("#dropzone-file-sponsor-row");
  if (fileInputById) {
    fileInputById.value = "";
  }
};

const mutableGroupedLogos = ref([]);

watchEffect(() => {
  mutableGroupedLogos.value = groupedLogos.value;
});

function dragStart(index) {
  draggedIndex.value = index;
}

function dragDrop(index) {
  const draggedItem = mutableGroupedLogos.value[draggedIndex.value];
  mutableGroupedLogos.value.splice(draggedIndex.value, 1);
  mutableGroupedLogos.value.splice(index, 0, draggedItem);

  router.put(
    route("drag.move", { id: props.event.id }),
    {
      mutableGroupedLogos: mutableGroupedLogos.value,
    },
    {
      preserveScroll: true,
    }
  );
}

const imageUrl = ref(null);
const image = ref(null);
const cropper = ref(null);
const currentGroup = ref(null);

const onFileSelected = (key, event) => {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = (e) => {
      imageUrl.value = e.target.result;
    };
    reader.readAsDataURL(file);
    form[key] = [file];
    form[key + "_name"] = file.name;
  }
};

const onFileSelectedRow = (key, event) => {
  const file = event.target.files[0];
  if (file) {
    const reader = new FileReader();
    reader.onload = (e) => {
      imageUrlRow.value = e.target.result;
    };
    reader.readAsDataURL(file);
    form[key] = [file];
    form[key + "_name"] = file.name;
  }
};

const imageUrlRow = ref(null);
const imageRow = ref(null);
const cropperRow = ref(null);

const dataURLtoFile = (dataURL, filename) => {
  const arr = dataURL.split(",");
  const mime = arr[0].match(/:(.*?);/)[1];
  const bstr = atob(arr[1]);
  let n = bstr.length;
  const u8arr = new Uint8Array(n);
  while (n--) {
    u8arr[n] = bstr.charCodeAt(n);
  }
  return new File([u8arr], filename, { type: mime });
};

const cropImage = () => {
  image.value = cropper.value.getCroppedCanvas().toDataURL();
  const dataURL = cropper.value.getCroppedCanvas().toDataURL();
  const filename = form.sponsor_name;
  const file = dataURLtoFile(dataURL, filename);
  form.image = file;
};

const cropImageRow = () => {
  imageRow.value = cropperRow.value.getCroppedCanvas().toDataURL();
  const dataURL = cropperRow.value.getCroppedCanvas().toDataURL();
  const filename = form.sponsor_name;
  const file = dataURLtoFile(dataURL, filename);
  form.image = file;
};

const form = useForm({
  sponsor: "",
  image: "",
  file_type: "",
});

const submit = () => {
  form.post(route("event.logo.save", { id: props.event.id }), {
    headers: {
      "Content-Type": "multipart/form-data",
    },
    preserveScroll: true,
    onSuccess: () => {
      form.sponsor = "";
      form.image = null;
      form.file_type = "";
      imageUrl.value = null;
      image.value = null;
      if (cropper.value) {
        cropper.value.destroy();
        cropper.value = null;
      }
      const fileInput = document.querySelector('input[type="file"]');
      if (fileInput) {
        fileInput.value = "";
      }
    },
  });
};
const submitRow = () => {
  // console.log(currentGroup.value.fileType);
  form.post(
    route("event.row.logo.save", {
      id: props.event.id,
      data: currentGroup.value.fileType,
    }),
    {
      headers: {
        "Content-Type": "multipart/form-data",
      },
      preserveScroll: true,
      onSuccess: () => {
        form.sponsor = "";
        form.imageRow = null;
        form.file_type = "";
        imageUrlRow.value = null;
        imageRow.value = null;
        if (cropper.value) {
          cropper.value.destroy();
          cropper.value = null;
        }
        const fileInput = document.querySelector('.input-file-row[type="file"]');
        if (fileInput) {
          fileInput.value = "";
        }
        const fileInputById = document.querySelector("#dropzone-file-sponsor-row");
        if (fileInputById) {
          fileInputById.value = "";
        }
      },
    }
  );
};
</script>
<style>
@keyframes zoomOut {
  0% {
    transform: scale(1);
    opacity: 1;
  }

  100% {
    transform: scale(0);
    opacity: 0;
  }
}

.zoomOut {
  animation: zoomOut 0.5s ease-out forwards;
}
</style>

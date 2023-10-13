<template>
  <form @submit.prevent="submit" enctype="multipart/form-data">
    <div class="grid lg:grid-cols-2 xl:grid-cols-3 lg:gap-6">
      <div class="relative z-0 w-full mb-6 group col-span-3 xl:col-span-1">
        <label
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          for="file_input"
          >Banner Principal*</label
        >
        <div class="flex items-center justify-center w-full" v-if="!hasMainBanner">
          <label
            for="dropzone-file-main_banner"
            class="flex flex-col items-center justify-center w-full h-44 border-2 border-gray-500 border-dashed rounded-lg cursor-pointer bg-white"
          >
            <div class="flex flex-col items-center justify-center p-2">
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
                <span class="font-bold text-dark">Arraste</span> o logotipo ou
                <span class="font-bold text-dark">clique aqui.</span>
              </p>
              <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                Formatos suportados:
                <span class="font-bold text-dark">JPG, JPEG ou PNG</span>
              </p>
              <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                Dimensões: <span class="font-bold text-dark">250px X 250px</span>
              </p>
            </div>
            <input
              id="dropzone-file-main_banner"
              type="file"
              class="hidden"
              @change="onFileSelect('main_banner', $event)"
              accept=".png, .jpeg, .jpg"
            />
          </label>
        </div>
        <div
          v-else
          v-for="material in event.materials.filter((m) => m.file_type === 'main_banner')"
          :key="material.id"
          class="relative bg-[#9F9F9F] rounded-lg h-44"
        >
          <div class="flex flex-col justify-center items-center py-5 h-full">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="white"
              class="w-8 h-8 rotate-45"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13"
              />
            </svg>
            <p class="text-center font-bold text-lg text-white">
              {{ material?.file_name }}
            </p>
          </div>
          <button
            class="absolute top-2 right-2 cursor-pointer"
            type="button"
            @click="deleteFile(material.id)"
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
      <div class="relative z-0 w-full mb-6 group col-span-3 xl:col-span-1">
        <label
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          for="file_input"
          >Logo do evento</label
        >
        <div class="flex items-center justify-center w-full" v-if="!hasLogoEvent">
          <label
            for="dropzone-file-logo_event"
            class="flex flex-col items-center justify-center w-full h-44 border-2 border-gray-500 border-dashed rounded-lg cursor-pointer bg-white"
          >
            <div class="flex flex-col items-center justify-center p-2">
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
                <span class="font-bold text-dark">Arraste</span> o logotipo ou
                <span class="font-bold text-dark">clique aqui.</span>
              </p>
              <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                Formatos suportados:
                <span class="font-bold text-dark">JPG, JPEG ou PNG</span>
              </p>
              <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                Dimensões: <span class="font-bold text-dark">250px X 250px</span>
              </p>
            </div>
            <input
              id="dropzone-file-logo_event"
              type="file"
              class="hidden"
              @change="onFileSelect('logo_event', $event)"
              accept=".png, .jpeg, .jpg"
            />
          </label>
        </div>
        <div
          v-else
          v-for="material in event.materials.filter((m) => m.file_type === 'logo_event')"
          :key="material.id"
          class="relative bg-[#9F9F9F] rounded-lg h-44"
        >
          <div class="flex flex-col justify-center items-center py-5 h-full">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="white"
              class="w-8 h-8 rotate-45"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13"
              />
            </svg>
            <p class="text-center font-bold text-lg text-white">
              {{ material?.file_name }}
            </p>
          </div>
          <button
            class="absolute top-2 right-2 cursor-pointer"
            type="button"
            @click="deleteFile(material.id)"
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
      <div class="relative z-0 w-full mb-6 group col-span-3 xl:col-span-1">
        <label
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          for="file_input"
          >Banner calendário*</label
        >
        <div class="flex items-center justify-center w-full" v-if="!hasCalendarBanner">
          <label
            for="dropzone-file-calendar_banner"
            class="flex flex-col items-center justify-center w-full h-44 border-2 border-gray-500 border-dashed rounded-lg cursor-pointer bg-white"
          >
            <div class="flex flex-col items-center justify-center p-2">
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
                <span class="font-bold text-dark">Arraste</span> o logotipo ou
                <span class="font-bold text-dark">clique aqui.</span>
              </p>
              <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                Formatos suportados:
                <span class="font-bold text-dark">JPG, JPEG ou PNG</span>
              </p>
              <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                Dimensões: <span class="font-bold text-dark">250px X 250px</span>
              </p>
            </div>
            <input
              id="dropzone-file-calendar_banner"
              type="file"
              class="hidden"
              @change="onFileSelect('calendar_banner', $event)"
              accept=".png, .jpeg, .jpg"
            />
          </label>
        </div>
        <div
          v-else
          v-for="material in event.materials.filter(
            (m) => m.file_type === 'calendar_banner'
          )"
          :key="material.id"
          class="relative bg-[#9F9F9F] rounded-lg h-44"
        >
          <div class="flex flex-col justify-center items-center py-5 h-full">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="white"
              class="w-8 h-8 rotate-45"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13"
              />
            </svg>
            <p class="text-center font-bold text-lg text-white">
              {{ material?.file_name }}
            </p>
          </div>
          <button
            class="absolute top-2 right-2 cursor-pointer"
            type="button"
            @click="deleteFile(material.id)"
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
    <div class="grid lg:grid-cols-2 lg:gap-6">
      <div class="relative z-0 w-full mb-6 group">
        <label
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          for="file_input"
          >Arte story</label
        >
        <div class="flex items-center justify-center w-full" v-if="!hasArteStory">
          <label
            for="dropzone-file-art_story"
            class="flex flex-col items-center justify-center w-full h-44 border-2 border-gray-500 border-dashed rounded-lg cursor-pointer bg-white"
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
                <span class="font-bold text-dark">Arraste</span> o logotipo ou
                <span class="font-bold text-dark">clique aqui.</span>
              </p>
              <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                Formatos suportados:
                <span class="font-bold text-dark">JPG, JPEG ou PNG</span>
              </p>
              <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                Dimensões: <span class="font-bold text-dark">250px X 250px</span>
              </p>
            </div>
            <input
              id="dropzone-file-art_story"
              type="file"
              class="hidden"
              @change="onFileSelect('art_story', $event)"
              accept=".png, .jpeg, .jpg"
            />
          </label>
        </div>
        <div
          v-else
          v-for="material in event.materials.filter((m) => m.file_type === 'art_story')"
          :key="material.id"
          class="relative bg-[#9F9F9F] rounded-lg h-44"
        >
          <div class="flex flex-col justify-center items-center py-5 h-full">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="white"
              class="w-8 h-8 rotate-45"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13"
              />
            </svg>
            <p class="text-center font-bold text-lg text-white">
              {{ material?.file_name }}
            </p>
          </div>
          <button
            class="absolute top-2 right-2 cursor-pointer"
            type="button"
            @click="deleteFile(material.id)"
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
      <div class="relative z-0 w-full mb-6 group">
        <label
          class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
          for="file_input"
          >Arte feed</label
        >
        <div class="flex items-center justify-center w-full" v-if="!hasArtFeed">
          <label
            for="dropzone-file-art_feed"
            class="flex flex-col items-center justify-center w-full h-44 border-2 border-gray-500 border-dashed rounded-lg cursor-pointer bg-white"
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
                <span class="font-bold text-dark">Arraste</span> o logotipo ou
                <span class="font-bold text-dark">clique aqui.</span>
              </p>
              <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                Formatos suportados:
                <span class="font-bold text-dark">JPG, JPEG ou PNG</span>
              </p>
              <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                Dimensões: <span class="font-bold text-dark">250px X 250px</span>
              </p>
            </div>
            <input
              id="dropzone-file-art_feed"
              type="file"
              class="hidden"
              @change="onFileSelect('art_feed', $event)"
              accept=".png, .jpeg, .jpg"
            />
          </label>
        </div>
        <div
          v-else
          v-for="material in event.materials.filter((m) => m.file_type === 'art_feed')"
          :key="material.id"
          class="relative bg-[#9F9F9F] rounded-lg h-44"
        >
          <div class="flex flex-col justify-center items-center py-5 h-full">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
              stroke-width="1.5"
              stroke="white"
              class="w-8 h-8 rotate-45"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13"
              />
            </svg>
            <p class="text-center font-bold text-lg text-white">
              {{ material?.file_name }}
            </p>
          </div>
          <button
            class="absolute top-2 right-2 cursor-pointer"
            type="button"
            @click="deleteFile(material.id)"
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

    <Cropper v-show="step === 3" :event="event" />
    <!-- <div class="flex justify-between pt-12">
      <a
        :href="route('events')"
        v-if="step === 1"
        class="bg-red-300 px-8 py-2 rounded-xl text-white font-bold"
      >
        Cancelar
      </a>
      <button
        type="button"
        v-if="step > 1"
        @click="step--"
        class="bg-red-300 px-8 py-2 rounded-xl text-white font-bold"
      >
        Voltar
      </button>
      <button type="submit" class="bg-green px-8 py-2 rounded-xl text-white font-bold">
        Avançar {{ step }}
      </button>
    </div> -->
    <div class="flex justify-between pt-12">
      <a
        :href="route('events')"
        v-if="step === 1"
        class="bg-red-300 px-8 py-2 rounded-xl text-white font-bold"
      >
        Cancelar
      </a>
      <button
        type="button"
        v-if="step > 1"
        @click="step--"
        class="bg-red-300 px-8 py-2 rounded-xl text-white font-bold"
      >
        Voltar
      </button>
      <button
        type="button"
        @click="step++"
        class="bg-green px-8 py-2 rounded-xl text-white font-bold"
      >
        Avançar {{ step }}
      </button>
    </div>
  </form>
</template>
<script setup>
import { ref, watch } from "vue";
import { computed } from "@vue/reactivity";
import { step } from "@/Pages/Event/step.js";
import { useForm } from "@inertiajs/vue3";
import Cropper from "@/Pages/Event/Partials/Cropper.vue";
import { router } from "@inertiajs/vue3";

const props = defineProps({
  event: Object,
});

const hasMainBanner = computed(() => {
  return props.event.materials.some((material) => material.file_type === "main_banner");
});
const hasLogoEvent = computed(() => {
  return props.event.materials.some((material) => material.file_type === "logo_event");
});
const hasCalendarBanner = computed(() => {
  return props.event.materials.some(
    (material) => material.file_type === "calendar_banner"
  );
});
const hasArteStory = computed(() => {
  return props.event.materials.some((material) => material.file_type === "art_story");
});
const hasArtFeed = computed(() => {
  return props.event.materials.some((material) => material.file_type === "art_feed");
});

// Arquivos Únicos
const onFileSelect = (field, event) => {
  const files = event.target.files;
  if (files.length === 1) {
    const file = files[0];
    if (["image/jpeg", "image/png"].includes(file.type)) {
      if (file.size <= 3 * 1024 * 1024) {
        // 3MB
        form[field] = file;
        if (props.event?.id == undefined) {
          console.log("111");
        } else {
          console.log("222");
          router.post(
            route("event.materials.upload", { id: props.event?.id }),
            {
              event_id: props.event?.id,
              field: field,
              file: file,
            },
            {
              preserveScroll: true,
            }
          );
        }
      } else {
        event.target.value = null;
        alert("O arquivo deve ter no máximo 3MB.");
      }
    } else {
      event.target.value = null;
      alert("Por favor, selecione um arquivo JPG, JPEG ou PNG válido.");
    }
  } else {
    event.target.value = null;
    alert("Apenas 1 arquivo é permitido.");
  }
};

const form = useForm({
  sponsor: [],
  main_banner: "",
  logo_event: "",
  calendar_banner: "",
  art_story: "",
  art_feed: "",
});

const submit = () => {
  form.post(route("event.graphic.materials.save", { id: props.event.id }), {
    headers: {
      "Content-Type": "multipart/form-data",
    },
    preserveScroll: true,
  });
};

const del = useForm({
  main_banner: "",
  logo_event: "",
  calendar_banner: "",
  art_story: "",
  art_feed: "",
});

const deleteFile = (fileId) => {
  del.post(route("event.materials.delete", { id: fileId }), {
    preserveScroll: true,
  });
  file.value = null;
  form["main_banner"] = null;
  form["logo_event"] = null;
  form["calendar_banner"] = null;
  form["art_story"] = null;
  form["art_feed"] = null;
};
</script>

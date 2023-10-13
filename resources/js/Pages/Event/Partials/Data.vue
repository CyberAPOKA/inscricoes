<template>
  <form @submit.prevent="submit" enctype="multipart/form-data">
    <div class="mb-6">
      <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nome do Evento*</label>
      <input type="text" id="name" v-model="form.name"
        class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
        @change="form.validate('name')" />
      <div v-if="form.invalid('name')">
        <p class="text-red-600 font-bold">{{ form.errors.name }}</p>
      </div>
    </div>
    <div class="grid gap-6 mb-6 md:grid-cols-2">
      <div>
        <label for="organizer" class="block mb-2 text-sm font-medium text-gray-900">Organizador*</label>
        <input type="text" id="organizer" v-model="form.organizer"
          class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
          @change="form.validate('organizer')" />
        <div v-if="form.invalid('organizer')">
          <p class="text-red-600 font-bold">{{ form.errors.organizer }}</p>
        </div>
      </div>
      <div>
        <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoria*</label>
        <select id="category"
          class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
          v-model="form.category">
          <option selected disabled value=""></option>
          <option value="US">United States</option>
          <option value="CA">Canada</option>
          <option value="FR">France</option>
          <option value="DE">Germany</option>
        </select>

        <div v-if="form.invalid('category')">
          <p class="text-red-600 font-bold">{{ form.errors.category }}</p>
        </div>
      </div>
    </div>

    <div class="grid mb-6" :class="{ 'w-full': form.one_more_day === 'yes', 'md:w-3/5': form.one_more_day === 'no' }">
      <p class="mb-2">Data do dia do evento*</p>
      <div
        class="flex flex-col xl:flex-row items-center gap-4 xl:gap-3 2xl:gap-4 p-4 justify-between md:justify-around rounded-xl shadow-all">

        <div class="flex items-center justify-around w-full gap-4">
          <h1 class="font-bold text-[#616161] mt-6" v-show="form.one_more_day === 'yes'">Início</h1>
          <div>
            <label for="date" class="block mb-2 text-sm font-medium text-gray-900">Data*</label>
            <input type="date" id="date" v-model="form.date"
              class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
              @change="form.validate('date')" />
            <div v-if="form.invalid('date')">
              <p class="text-red-600 font-bold">{{ form.errors.date }}</p>
            </div>
          </div>

          <div>
            <label for="hour" class="block mb-2 text-sm font-medium text-gray-900">Hora*</label>
            <input type="time" step="60" id="hour" v-model="form.hour"
              class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
              @change="form.validate('hour')" />
            <div v-if="form.invalid('hour')">
              <p class="text-red-600 font-bold">{{ form.errors.hour }}</p>
            </div>
          </div>
        </div>

        <div
          class="flex items-center justify-around w-full gap-4 border-t-2 xl:border-t-0 pt-2 xl:pt-0 lg:pl-4 xl:pl-2 2xl:pl-4 xl:border-l-2 border-[#616161]"
          v-show="form.one_more_day === 'yes'">
          <h1 class="font-bold text-[#616161] mt-6" v-show="form.one_more_day === 'yes'">Fim</h1>
          <div>
            <label for="final_date" class="block mb-2 text-sm font-medium text-gray-900">Data*</label>
            <input type="date" id="final_date" v-model="form.final_date"
              class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
              @change="form.validate('final_date')" />
            <div v-if="form.invalid('final_date')">
              <p class="text-red-600 font-bold">{{ form.errors.final_date }}</p>
            </div>
          </div>

          <div>
            <label for="final_hour" class="block mb-2 text-sm font-medium text-gray-900">Hora*</label>
            <input type="time" step="60" id="final_hour" v-model="form.final_hour"
              class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
              @change="form.validate('final_hour')" />
            <div v-if="form.invalid('final_hour')">
              <p class="text-red-600 font-bold">{{ form.errors.final_hour }}</p>
            </div>
          </div>
        </div>

        <div class="flex items-center justify-end  w-full">
          <label class="relative inline-flex items-center cursor-pointer mt-6">
            <input type="checkbox" id="one_more_day" class="sr-only peer" v-model="form.one_more_day" true-value="yes"
              false-value="no" />
            <div
              class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
            </div>
            <span class="ml-3 text-sm font-medium text-gray-900 dark:text-gray-300">+ de 1 dia</span>
          </label>
        </div>

      </div>
    </div>

    <div class="grid grid-flow-row mb-6 md:grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-2">
      <div>
        <p class="mb-2">Início da Divulgação no site*</p>
        <div class="flex items-center gap-2 2xl:gap-6 px-2 2xl:px-4 py-4 justify-around rounded-xl shadow-all">
          <div>
            <label for="start_disclosure_date" class="block mb-2 text-sm font-medium text-gray-900">Data*</label>
            <input type="date" id="start_disclosure_date" v-model="form.start_disclosure_date"
              class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
              @change="form.validate('start_disclosure_date')" />

          </div>
          <div>
            <label for="start_disclosure_hour" class="block mb-2 text-sm font-medium text-gray-900">Hora*</label>
            <input type="time" step="60" id="start_disclosure_hour" v-model="form.start_disclosure_hour"
              class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
              @change="form.validate('start_disclosure_hour')" />
            <div v-if="form.invalid('start_disclosure_hour')">
              <p class="text-red-600 font-bold">
                {{ form.errors.start_disclosure_hour }}
              </p>
            </div>
          </div>
        </div>
        <div v-if="form.invalid('start_disclosure_date')">
          <p class="text-red-600 font-bold">
            {{ form.errors.start_disclosure_date }}
          </p>
        </div>
      </div>
      <div>
        <p class="mb-2">Fim da Divulgação no site*</p>
        <div class="flex items-center gap-2 2xl:gap-6 px-2 2xl:px-4 py-4 justify-around rounded-xl shadow-all">
          <div>
            <label for="end_disclosure_date" class="block mb-2 text-sm font-medium text-gray-900">Data*</label>
            <input type="date" id="end_disclosure_date" v-model="form.end_disclosure_date"
              class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
              @change="form.validate('end_disclosure_date')" />
          </div>
          <div>
            <label for="end_disclosure_hour" class="block mb-2 text-sm font-medium text-gray-900">Hora*</label>
            <input type="time" step="60" id="end_disclosure_hour" v-model="form.end_disclosure_hour"
              class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all"
              @change="form.validate('end_disclosure_hour')" />
            <div v-if="form.invalid('end_disclosure_hour')">
              <p class="text-red-600 font-bold">{{ form.errors.end_disclosure_hour }}</p>
            </div>
          </div>
        </div>
        <div v-if="form.invalid('end_disclosure_date')">
          <p class="text-red-600 font-bold">{{ form.errors.end_disclosure_date }}</p>
        </div>
      </div>

      <div>
        <p class="mb-2">Regulamento</p>
        <div class="flex items-center justify-center w-full" v-if="!props.regulation">
          <label for="dropzone-file"
            class="flex flex-col md:flex-row items-center justify-center w-full border-2 border-gray-300 border-dashed rounded-lg cursor-pointer shadow-all text-center">
            <div class="flex flex-col md:flex-row items-center justify-center py-4 px-4 gap-6">
              <RegulationIcon />
              <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                <span class="font-semibold">Arraste</span> o arquivo do regulamento ou
                <span class="font-semibold">clique aqui.</span><br />
                Formatos suportados: <span class="font-semibold">PDF.</span>
              </p>
            </div>
            <input id="dropzone-file" type="file" class="hidden" @change="onFileSelect('regulation', $event)"
              accept=".pdf" />
          </label>
        </div>
        <div v-else class="relative bg-[#9F9F9F] rounded-xl">
          <div class="flex flex-col justify-center items-center py-[1.35rem]">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white"
              class="w-8 h-8 rotate-45">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13" />
            </svg>
            <p class="text-center font-bold text-lg text-white">
              {{ props.regulation?.file_name }}
            </p>
          </div>
          <button class="absolute top-2 right-2 cursor-pointer" type="button"
            @click="deleteRegulation(props.regulation?.id)">
            <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
              <path stroke="white" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
          </button>
        </div>
        <!-- <p v-if="fileName != ''" class="font-bold text-green">
          Arquivo selecionado: {{ fileName }}
        </p> -->
      </div>
    </div>
    <div class="mb-6 relative">
      <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição*</label>
      <textarea id="description" rows="7"
        class="block p-2.5 w-full text-sm text-gray-900 bg-white shadow-all rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
        v-model="form.description" @change="form.validate('description')"></textarea>
      <div v-if="form.invalid('description')">
        <p class="text-red-600 font-bold">{{ form.errors.description }}</p>
      </div>
      <div class="absolute bottom-0 right-5">{{ descriptionCharacterCount }}/4000</div>
    </div>
    <div class="mb-6 relative">
      <label for="terms_and_conditions" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Termos e
        Condições*</label>
      <textarea id="terms_and_conditions" rows="7"
        class="block p-2.5 w-full text-sm text-gray-900 bg-white shadow-all rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
        v-model="form.terms_and_conditions" @change="form.validate('terms_and_conditions')"></textarea>
      <div v-if="form.invalid('terms_and_conditions')">
        <p class="text-red-600 font-bold">{{ form.errors.terms_and_conditions }}</p>
      </div>
      <div class="absolute bottom-0 right-5">{{ termsCharacterCount }}/4000</div>
    </div>
    <div class="mb-6 relative">
      <label for="observation" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observações</label>
      <textarea id="observation" rows="7"
        class="block p-2.5 w-full text-sm text-gray-900 bg-white shadow-all rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
        v-model="form.observation"></textarea>
      <div class="absolute bottom-0 right-5">{{ obsercationCharacterCount }}/4000</div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-2 items-end">
      <div>
        <label for="maximum_amount_tickets" class="block mb-2 text-sm font-medium text-gray-900">Quantidade máxima de
          ingressos*</label>
        <input type="number" id="maximum_amount_tickets" v-model="form.maximum_amount_tickets"
          class="bg-white border border-gray-300 text-gray-900 text-sm rounded-[10px] block w-full p-2.5 shadow-all"
          @change="form.validate('maximum_amount_tickets')" />
        <div v-if="form.invalid('maximum_amount_tickets')">
          <p class="text-red-600 font-bold">{{ form.errors.maximum_amount_tickets }}</p>
        </div>
      </div>

      <div
        class="lg:col-span-2 flex items-center justify-center w-full shadow-all h-10 rounded-[10px] border border-gray-300">
        <span class="mr-3 text-sm font-medium text-gray-900 dark:text-gray-300">Seu evento terá produtos e kits?*</span>
        <label class="relative inline-flex items-center cursor-pointer">
          <input type="checkbox" id="has_products_and_kits" class="sr-only peer" v-model="form.has_products_and_kits"
            true-value="yes" false-value="no" />
          <div
            class="flex items-center justify-center w-[5.3rem] h-6 bg-[#FF7171] peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-[60px] peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-[#0DCD71]">
            <span class="absolute left-6 text-white font-bold text-xs"
              v-show="form.has_products_and_kits === 'yes'">SIM</span>
            <span class="absolute right-5 text-white font-bold text-xs"
              v-show="form.has_products_and_kits === 'no'">NÃO</span>
          </div>
        </label>
      </div>

    </div>
    <div class="flex justify-between pt-12">
      <a :href="route('events')" v-if="step === 1" class="bg-red-300 px-8 py-2 rounded-xl text-white font-bold">
        Cancelar
      </a>
      <button type="button" v-if="step > 1" @click="step--" class="bg-red-300 px-8 py-2 rounded-xl text-white font-bold">
        Voltar
      </button>
      <button type="submit" class="bg-green px-8 py-2 rounded-xl text-white font-bold" :disabled="dataDisabled">
        Avançar {{ step }}
      </button>

    </div>
  </form>
</template>
<script setup>
import { ref, watch, computed } from "vue";
import RegulationIcon from "@/Pages/Svgs/Regulation.vue";
import { useForm as usePrecognitionForm } from "laravel-precognition-vue";
import { step } from "@/Pages/Event/step.js";
import { router, useForm } from "@inertiajs/vue3";

const props = defineProps({
  event: Object,
  data: Object,
  regulation: Object,
});

const file = ref(null);
const fileName = ref("");
const descriptionCharacterCount = ref(0);
const termsCharacterCount = ref(0);
const obsercationCharacterCount = ref(0);

watch(file, (newFile) => {
  fileName.value = newFile ? newFile.name : "";
});

const form = usePrecognitionForm(
  "post",
  route("event.data.save", {
    id: props.event?.id,
  }),
  {
    headers: {
      "Content-Type": "multipart/form-data",
    },
    name: props.event?.name,
    organizer: props.data?.organizer,
    category: props.data?.category,
    date: props.data?.date,
    hour: props.data?.hour,
    one_more_day: props.data?.one_more_day ?? 'no',
    final_date: props.data?.final_date,
    final_hour: props.data?.final_hour,
    start_disclosure_date: props.data?.start_disclosure_date,
    start_disclosure_hour: props.data?.start_disclosure_hour,
    end_disclosure_date: props.data?.end_disclosure_date,
    end_disclosure_hour: props.data?.end_disclosure_hour,
    regulation: props?.regulation,
    description: props.data?.description,
    terms_and_conditions: props.data?.terms_and_conditions,
    observation: props.data?.observation,
    maximum_amount_tickets: props.data?.maximum_amount_tickets,
  }
);

const dataDisabled = computed(() => {
  return Object.keys(form.errors).length > 0 ||
    !form.name ||
    !form.organizer ||
    !form.category ||
    !form.date ||
    !form.hour ||
    !form.one_more_day ||
    !form.start_disclosure_date ||
    !form.start_disclosure_hour ||
    !form.end_disclosure_date ||
    !form.end_disclosure_hour ||
    !form.regulation ||
    !form.description ||
    !form.terms_and_conditions ||
    !form.maximum_amount_tickets;
});

watch(
  () => form.description,
  (newValue) => {
    if (newValue.length > 4000) {
      form.description = newValue.slice(0, 4000);
    }
    descriptionCharacterCount.value = form.description.length;
  }
);

watch(
  () => form.terms_and_conditions,
  (newValue) => {
    if (newValue.length > 4000) {
      form.terms_and_conditions = newValue.slice(0, 4000);
    }
    termsCharacterCount.value = form.terms_and_conditions.length;
  }
);

watch(
  () => form.observation,
  (newValue) => {
    if (newValue.length > 4000) {
      form.observation = newValue.slice(0, 4000);
    }
    obsercationCharacterCount.value = form.observation.length;
  }
);

function onFileSelect(field, event) {
  const files = event.target.files;
  if (files.length === 1) {
    const file = files[0];
    if (file.type === "application/pdf") {
      if (file.size <= 3 * 1024 * 1024) {
        // 3MB
        file.value = event.target.files[0];
        form[field] = file.value;
        fileName.value = file.name;
        if (props.event?.id == undefined) {
          console.log("111");
        } else {
          console.log("222");
          router.post(
            route("event.regulation.upload", { id: props.event?.id }),
            {
              event_id: props.event?.id,
              regulation: file.value,
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
      alert("Por favor, selecione um arquivo PDF.");
    }
  } else {
    event.target.value = null;
    alert("Apenas 1 arquivo é permitido.");
  }
}

const submit = () => {
  form.submit().then(response => {
    console.log(response);
    console.log(response.data.redirectUrl);

    if (!props.event?.id && response.data && response.data.redirectUrl) {
      window.location.href = response.data.redirectUrl;
    }

  }).finally(() => {

    if (props.event?.id) {
      step.value++;
    }

  });
};

const regulation = useForm({
  regulation: "",
});

const deleteRegulation = (regulationId) => {
  regulation.post(route("event.regulation.delete", { id: regulationId }), {
    preserveScroll: true,
  });
  file.value = null;
  form["regulation"] = null;
};
</script>

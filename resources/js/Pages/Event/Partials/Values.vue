<template>
    <div>
        <form @submit.prevent="valuesSave">
            <div class="flex flex-col gap-8">
                <div v-for="(inscription, index) in inscriptions" :key="inscription.id"
                    class="bg-[#616161] rounded-2xl shadow-all">

                    <div :id="'accordion-collapse-' + inscription.id" data-accordion="collapse">
                        <div class="flex flex-col md:flex-row justify-center md:justify-between items-center rounded-xl relative p-4 bg-white gap-2"
                            :class="{ 'md:shadow-xt': expandedInscriptionItems.includes(inscription.id) }">
                            <div class="flex items-center gap-4 pl-4 border-r-2 pr-20">
                                <div class="target-item-inscriptions cursor-grab" draggable="true"
                                    @dragstart="dragStartInscription(inscription.index)"
                                    @drop="dragDropInscription(inscription.index)" @dragover="dragOverInscription"
                                    @dragleave="dragLeaveInscription" @dragend="dragEndInscription">

                                    <svg class="h-4 w-4" viewBox="0 0 7 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <circle cx="5.375" cy="1.49164" r="1.125" fill="#616161" />
                                        <circle cx="5.375" cy="4.86664" r="1.125" fill="#616161" />
                                        <circle cx="5.375" cy="8.24164" r="1.125" fill="#616161" />
                                        <circle cx="1.125" cy="1.49164" r="1.125" fill="#616161" />
                                        <circle cx="1.125" cy="4.86664" r="1.125" fill="#616161" />
                                        <circle cx="1.125" cy="8.24164" r="1.125" fill="#616161" />
                                    </svg>
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
                                        <svg data-accordion-icon class="w-4 h-4"
                                            :class="{ 'rotate-180': expandedInscriptionItems.includes(inscription.id) }"
                                            viewBox="0 0 14 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M1.645 8.8667L7 3.92203L12.355 8.8667L14 7.34443L7 0.8667L-1.30708e-07 7.34443L1.645 8.8667Z"
                                                fill="#191919" />
                                        </svg>
                                    </button>
                                </h2>
                            </div>
                        </div>
                        <div :id="'accordion-collapse-body-' + inscription.id" class="block"
                            v-show="expandedInscriptionItems.includes(inscription.id)"
                            :aria-labelledby="'accordion-collapse-heading-' + inscription.id">
                            <div class="bg-[#616161] -mt-2 px-2 flex flex-col items-center pb-6 rounded-b-xl gap-20 pt-6">
                                <div class="p-2 w-full rounded-xl flex flex-col gap-4">
                                    <div v-for="(lotInscription, lotIndex) in inscription.lots" :key="lotInscription.id">
                                        <div :id="'accordion-collapse-' + lotInscription.id"
                                            :data-accordion="'collapse-' + lotInscription.id">
                                            <div
                                                class="bg-[#FFF9AE] flex flex-col md:flex-row justify-center md:justify-between items-center rounded-2xl relative gap-2 w-full shadow-lg p-4">
                                                <div class="flex gap-2 ml-4 justify-center items-center">
                                                    <div class="target-item-lot-inscription cursor-grab" draggable="true"
                                                        @dragstart="dragStartLotInscription(index, lotIndex)"
                                                        @drop="dragDropLotInscription(index, lotIndex)"
                                                        @dragover="dragOverLotInscription"
                                                        @dragleave="dragLeaveLotInscription"
                                                        @dragend="dragEndLotInscription">
                                                        <svg class="h-4 w-4" viewBox="0 0 7 10" fill="none"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <circle cx="5.375" cy="1.49164" r="1.125" fill="#616161" />
                                                            <circle cx="5.375" cy="4.86664" r="1.125" fill="#616161" />
                                                            <circle cx="5.375" cy="8.24164" r="1.125" fill="#616161" />
                                                            <circle cx="1.125" cy="1.49164" r="1.125" fill="#616161" />
                                                            <circle cx="1.125" cy="4.86664" r="1.125" fill="#616161" />
                                                            <circle cx="1.125" cy="8.24164" r="1.125" fill="#616161" />
                                                        </svg>
                                                    </div>
                                                    <h2 class="text-[#191919] font-bold text-base">
                                                        {{ lotInscription.name }}
                                                    </h2>
                                                </div>
                                                <div class="flex flex-wrap">
                                                    <p>
                                                        <span class="text-[#191919] font-bold text-base">Início e final de
                                                            lote:</span>


                                                        {{ moment(lotInscription.start_date).format("DD/MM/YYYY") }}

                                                        às
                                                        {{ formatHour(lotInscription.start_hour) }}

                                                        até

                                                        {{ moment(lotInscription.end_date).format("DD/MM/YYYY") }}

                                                        às
                                                        {{ formatHour(lotInscription.end_hour) }}
                                                    </p>
                                                </div>
                                                <div class="block"></div>
                                                <h2 :id="'accordion-collapse-heading-lot-' + lotInscription.id"
                                                    class="bg-[#191919] top-0 right-0 absolute rounded-r-2xl h-full flex items-center justify-center">

                                                    <button type="button"
                                                        class="flex items-center justify-between w-full p-5 font-medium text-left text-white bg-[#191919] rounded-r-2xl"
                                                        @click="toggleKitAccordionItem(lotInscription.id)">
                                                        <svg data-accordion-icon class="w-3 h-3 shrink-0"
                                                            :class="expandedKitItems.includes(lotInscription.id) ? 'rotate-180' : 'rotate-0'"
                                                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                            fill="none" viewBox="0 0 10 6">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5" />
                                                        </svg>

                                                    </button>
                                                </h2>
                                            </div>
                                            <div :id="'accordion-collapse-body-lot-' + lotInscription.id" class="block"
                                                v-show="expandedKitItems.includes(lotInscription.id)">

                                                <div
                                                    class="p-4 bg-[#F9F9F9] pt-8 rounded-b-xl flex flex-col items-center justify-center gap-4 -mt-4">
                                                    <div class="hidden lg:grid lg:grid-cols-10 w-full text-center mr-16"
                                                        v-show="lotInscription.event_kits != ''">
                                                        <p class="text-[#191919] font-semibold lg:col-span-3">Kit</p>
                                                        <p class="text-[#191919] font-semibold lg:col-span-2">Quantidade de
                                                            vagas para esse lote</p>
                                                        <p class="text-[#191919] font-semibold lg:col-span-2">Valor</p>
                                                        <p class="text-[#191919] font-semibold lg:col-span-2">Desconto por
                                                            Idoso</p>
                                                    </div>
                                                    <div v-for="kit in lotInscription.event_kits"
                                                        class="bg-white relative rounded-2xl shadow-all w-full p-4 flex items-start flex-col gap-4 lg:grid lg:grid-cols-10">
                                                        <p class="text-[#616161] font-bold flex items-center justify-start gap-2 border-b-2 lg:border-none w-5/6 lg:col-span-3"
                                                            v-if="kit.event_kit_id">
                                                            <span
                                                                class="text-[#191919] font-semibold block lg:hidden">Kit:</span>
                                                            Com Kit {{ kit.kit.name }}
                                                        </p>
                                                        <p class="text-[#616161] font-bold lg:col-span-3" v-else>
                                                            Sem/Kit
                                                        </p>
                                                        <div
                                                            class="flex items-center justify-between gap-2 border-b-2 lg:border-none w-5/6 lg:w-full pb-2 lg:pb-0 lg:col-span-2">
                                                            <span
                                                                class="text-[#191919] font-semibold block lg:hidden">Quantidade:</span>
                                                            <p
                                                                class="text-[#191919]  font-black rounded-2xl px-4 lg:px-4 xl:px-8 2xl:px-12 border-2 py-1 shadow-all-100">

                                                                <span v-if="kit.vacancies_number === 99999">Sem
                                                                    Limite</span>
                                                                <span v-else>{{ kit.vacancies_number }}</span>
                                                            </p>
                                                        </div>
                                                        <div
                                                            class="flex items-center justify-between gap-2 border-b-2 lg:border-none w-5/6 lg:w-full pb-2 lg:pb-0 lg:col-span-2">
                                                            <span
                                                                class="text-[#191919] font-semibold block lg:hidden">Valor:</span>
                                                            <p
                                                                class="text-[#191919] font-black rounded-2xl px-4 lg:px-4 xl:px-8 2xl:px-12 border-2 py-1 shadow-all-100">

                                                                R$ {{ kit.value }}
                                                            </p>
                                                        </div>
                                                        <div
                                                            class="flex items-center justify-between gap-2 border-b-2 lg:border-none w-5/6 lg:w-full pb-2 lg:pb-0 lg:mr-20 xl:mr-0 lg:col-span-2">
                                                            <span
                                                                class="text-[#191919] font-semibold flex items-center justify-center lg:hidden max-w-[6rem] gap-2">
                                                                Desconto por idoso<span>
                                                                    <svg class="w-5 h-5" viewBox="0 0 18 18" fill="none"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M0 9C0 4.032 4.032 0 9 0C13.968 0 18 4.032 18 9C18 13.968 13.968 18 9 18C4.032 18 0 13.968 0 9ZM9.9 12.6V14.4H8.1V12.6H9.9ZM9 16.2C5.031 16.2 1.8 12.969 1.8 9C1.8 5.031 5.031 1.8 9 1.8C12.969 1.8 16.2 5.031 16.2 9C16.2 12.969 12.969 16.2 9 16.2ZM5.4 7.2C5.4 5.211 7.011 3.6 9 3.6C10.989 3.6 12.6 5.211 12.6 7.2C12.6 8.35462 11.889 8.97599 11.1967 9.58099C10.5399 10.1549 9.9 10.7142 9.9 11.7H8.1C8.1 10.0609 8.94791 9.41093 9.6934 8.83951C10.2782 8.39125 10.8 7.99129 10.8 7.2C10.8 6.21 9.99 5.4 9 5.4C8.01 5.4 7.2 6.21 7.2 7.2H5.4Z"
                                                                            fill="#9F9F9F" />
                                                                    </svg>
                                                                </span>
                                                            </span>
                                                            <p
                                                                class="text-[#191919] font-black rounded-2xl px-4 lg:px-4 xl:px-8 2xl:px-12 border-2 py-1 bg-[#FFEC00] shadow-all-100">
                                                                R$ {{ kit.senior_discount }}
                                                            </p>
                                                        </div>
                                                        <div
                                                            class="absolute right-0 top-0 h-full bg-[#616161] flex flex-col lg:flex-row justify-around items-center w-12 lg:w-16 xl:w-20 rounded-r-2xl">

                                                            <button type="button" @click="openkitLotEditModal(kit.id)">
                                                                <svg width="15" height="14" viewBox="0 0 15 14" fill="none"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                                        d="M14.7563 2.04722C15.0812 2.35051 15.0812 2.84044 14.7563 3.14373L13.2315 4.56687L10.1069 1.6506L11.6317 0.227468C11.9567 -0.0758228 12.4816 -0.0758228 12.8066 0.227468L14.7563 2.04722ZM0 14V11.0837L9.21539 2.48271L12.34 5.39897L3.12457 14H0Z"
                                                                        fill="white" />
                                                                </svg>
                                                            </button>
                                                            <!-- START KIT LOT EDIT -->
                                                            <!-- Main modal -->
                                                            <div v-if="iskitLotEditModal(kit.id)"
                                                                :id="'lotCreateModal-' + kit.id" tabindex="-1"
                                                                aria-hidden="true"
                                                                class="fixed flex items-center justify-center top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                                <div class="modal-lot-create-backdrop"
                                                                    @click="closekitLotEditModal(kit.id)">
                                                                </div>
                                                                <div class="relative w-full max-w-6xl max-h-full">
                                                                    <!-- Modal content -->
                                                                    <div
                                                                        class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                                        <form @submit.prevent="updateKitLot(kit)">
                                                                            <!-- Modal header -->
                                                                            <div
                                                                                class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                                                <h3 class="text-3xl font-black text-black">
                                                                                    EDITAR <span
                                                                                        v-if="kit.event_kit_id">COM</span><span
                                                                                        v-else>SEM</span> KIT: {{
                                                                                            kit.event_kit_id }}
                                                                                </h3>
                                                                                <button type="button"
                                                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                                                    @click="closekitLotEditModal(kit.id)">
                                                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                        fill="none" viewBox="0 0 14 14">
                                                                                        <path stroke="currentColor"
                                                                                            stroke-linecap="round"
                                                                                            stroke-linejoin="round"
                                                                                            stroke-width="2"
                                                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                                                    </svg>
                                                                                    <span class="sr-only">Close modal</span>
                                                                                </button>
                                                                            </div>
                                                                            <!-- Modal body -->
                                                                            <div class="p-6">
                                                                                <div class="grid grid-cols-1 gap-4 items-end"
                                                                                    :class="kit.event_kit_id ? 'md:grid-cols-2' : 'md:grid-cols-4'">
                                                                                    <!-- <div class="">
                                                                                        <label for="kit-lot-amount-update"
                                                                                            class="block mb-2 text-sm font-medium text-gray-900">Quantidade:
                                                                                            máx {{ kit.kit.athletes_amount
                                                                                            }}</label>
                                                                                        <input type="number"
                                                                                            id="kit-lot-amount-update"
                                                                                            v-model="kit.athletes_amount"
                                                                                            @input="adjustKitAmount(kit, lotInscription)"
                                                                                            class="border border-gray-300 font-bold text-sm rounded-lg block w-full p-2.5 shadow-all text-[#313131] text-center" />
                                                                                    </div> -->
                                                                                    <div v-if="!kit.event_kit_id"
                                                                                        class="relative bg-[#9F9F9F] h-10 shadow-all rounded-xl p-2">
                                                                                        <p class="text-white font-bold">Sem
                                                                                            kit</p>
                                                                                    </div>
                                                                                    <div v-if="kit.event_kit_id">
                                                                                        <label for="select-product-create"
                                                                                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                                                            Selecionar o kit </label>
                                                                                        <!--  @change="updateAvailableAmount(lotInscription.kit); resetFields(lotInscription);" -->
                                                                                        <select id="select-product-create"
                                                                                            required v-model="kit.id"
                                                                                            @change="resetFields(lotInscription);"
                                                                                            class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all">
                                                                                            <option value="" selected
                                                                                                disabled>
                                                                                            </option>
                                                                                            <option :value="kit.id"
                                                                                                v-for="kit in getFilteredKitsForInscription(inscription.participants)"
                                                                                                :key="kit.id">
                                                                                                {{ kit.name }}
                                                                                            </option>

                                                                                        </select>
                                                                                    </div>
                                                                                    <div v-if="kit.event_kit_id">
                                                                                        <label
                                                                                            for="lot-inscription-vacancies-number"
                                                                                            class="block mb-2 text-sm font-medium text-gray-900">Quantidade
                                                                                            de vagas para esse lote*</label>
                                                                                        <input type="number"
                                                                                            placeholder="Sem limite"
                                                                                            id="lot-inscription-vacancies-number"
                                                                                            v-model="kit.vacancies_number"
                                                                                            class="border border-gray-300 font-bold text-sm rounded-lg block w-full p-2.5 shadow-all text-[#313131] text-center" />
                                                                                    </div>
                                                                                    <div v-if="!kit.event_kit_id">
                                                                                        <label for="kit-lot-amount-update"
                                                                                            class="block mb-2 text-sm font-medium text-gray-900">Quantidade</label>
                                                                                        <input type="number"
                                                                                            id="kit-lot-amount-update"
                                                                                            v-model="kit.amount"
                                                                                            class="border border-gray-300 font-bold text-sm rounded-lg block w-full p-2.5 shadow-all text-[#313131] text-center" />
                                                                                    </div>
                                                                                    <div>
                                                                                        <label for="kit-lot-value-update"
                                                                                            class="block mb-2 text-sm font-medium text-gray-900">Valor</label>
                                                                                        <input type="number"
                                                                                            id="kit-lot-value-update"
                                                                                            v-model="kit.value"
                                                                                            class="border border-gray-300 font-bold text-sm rounded-lg block w-full p-2.5 shadow-all text-[#313131] text-center" />
                                                                                    </div>
                                                                                    <div>
                                                                                        <label
                                                                                            for="kit-lot-senior_discount-update"
                                                                                            class="block mb-2 text-sm font-medium text-gray-900">Desconto
                                                                                            por idoso</label>
                                                                                        <input type="number"
                                                                                            id="kit-lot-senior_discount-update"
                                                                                            v-model="kit.senior_discount"
                                                                                            class="border border-gray-300 font-bold text-sm rounded-lg block w-full p-2.5 shadow-all text-[#313131] text-center" />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!-- Modal footer -->
                                                                            <div
                                                                                class="flex items-center justify-between p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                                <button type="button"
                                                                                    class="md:w-52 flex justify-center gap-2 items-center bg-[#FF7171] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all"
                                                                                    @click="closekitLotEditModal(kit.id)">
                                                                                    <svg width="23" height="22"
                                                                                        viewBox="0 0 23 22" fill="none"
                                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                                        <path fill-rule="evenodd"
                                                                                            clip-rule="evenodd"
                                                                                            d="M3.72183 3.22178C8.01538 -1.07177 14.9846 -1.07177 19.2782 3.22178C23.5717 7.51533 23.5717 14.4846 19.2782 18.7781C14.9846 23.0717 8.01538 23.0717 3.72183 18.7781C-0.571727 14.4846 -0.571727 7.51533 3.72183 3.22178ZM11.5 12.5556L14.6113 15.6669L16.1669 14.1112L13.0556 11L16.1669 7.88868L14.6113 6.33305L11.5 9.44432L8.38873 6.33305L6.83309 7.88868L9.94436 11L6.83309 14.1112L8.38873 15.6669L11.5 12.5556Z"
                                                                                            fill="white" />
                                                                                    </svg>
                                                                                    <span>Cancelar</span>
                                                                                </button>
                                                                                <button
                                                                                    class="md:w-52 flex justify-center items-center gap-2 bg-[#0DCD71] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all hover:cursor-pointer"
                                                                                    type="submit">
                                                                                    <svg width="22" height="22"
                                                                                        viewBox="0 0 22 22" fill="none"
                                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                                        <path fill-rule="evenodd"
                                                                                            clip-rule="evenodd"
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
                                                            <!-- END KIT LOT EDIT -->
                                                            <form @submit.prevent="kitLotDelete(kit.id)" class="flex">
                                                                <button type="submit">
                                                                    <svg width="10" height="14" viewBox="0 0 10 14"
                                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                                            d="M7.5 0.777778H10V2.33333H0V0.777778H2.5L3.21429 0H6.78571L7.5 0.777778ZM2.14286 14C1.35714 14 0.714286 13.3 0.714286 12.4444V3.11111H9.28571V12.4444C9.28571 13.3 8.64286 14 7.85714 14H2.14286Z"
                                                                            fill="white" />
                                                                    </svg>
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div
                                                        class="flex flex-col items-center justify-center gap-4 lg:flex-row">
                                                        <button
                                                            class="flex justify-center items-center gap-2 bg-[#0DCD71] px-6 py-3 text-white font-bold text-lg rounded-lg uppercase hover:cursor-pointer"
                                                            @click="openAddWithKitInLotModal(lotInscription.id)"
                                                            type="button">
                                                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M0 11C0 4.928 4.928 0 11 0C17.072 0 22 4.928 22 11C22 17.072 17.072 22 11 22C4.928 22 0 17.072 0 11ZM12.1 12.1H16.5V9.9H12.1V5.5H9.9V9.9H5.5V12.1H9.9V16.5H12.1V12.1Z"
                                                                    fill="white" />
                                                            </svg>
                                                            <span>ADICIONAR COM KIT</span>
                                                        </button>
                                                        <button v-if="!hasKitWithoutID(lotInscription)"
                                                            class="flex justify-center items-center gap-2 bg-[#0DCD71] px-6 py-3 text-white font-bold text-lg rounded-lg uppercase hover:cursor-pointer"
                                                            @click="openAddWithoutKitInLotModal(lotInscription.id)"
                                                            type="button">
                                                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                    d="M0 11C0 4.928 4.928 0 11 0C17.072 0 22 4.928 22 11C22 17.072 17.072 22 11 22C4.928 22 0 17.072 0 11ZM12.1 12.1H16.5V9.9H12.1V5.5H9.9V9.9H5.5V12.1H9.9V16.5H12.1V12.1Z"
                                                                    fill="white" />
                                                            </svg>
                                                            <span>ADICIONAR SEM KIT1</span>
                                                        </button>
                                                    </div>
                                                    <!-- START ADICIONAR COM KIT -->
                                                    <!-- Main modal -->
                                                    <div v-if="isAddWithKitInLotModalOpen(lotInscription.id)"
                                                        :id="'lotCreateModal-' + lotInscription.id" tabindex="-1"
                                                        aria-hidden="true"
                                                        class="fixed flex items-center justify-center top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                        <div class="modal-lot-create-backdrop"
                                                            @click="closeAddWithKitInLotModal(lotInscription.id)"></div>
                                                        <div class="relative w-full max-w-6xl max-h-full">
                                                            <!-- Modal content -->
                                                            <div
                                                                class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                                <form
                                                                    @submit.prevent="addWithKitInLotSubmit(lotInscription, inscription.id)">
                                                                    <!-- Modal header -->
                                                                    <div
                                                                        class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                                        <h3 class="text-3xl font-black text-black">
                                                                            ADICIONAR COM KIT:</h3>
                                                                        <button type="button"
                                                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                                            @click="closeAddWithKitInLotModal(lotInscription.id)">
                                                                            <svg class="w-3 h-3" aria-hidden="true"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                fill="none" viewBox="0 0 14 14">
                                                                                <path stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round" stroke-width="2"
                                                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                                            </svg>
                                                                            <span class="sr-only">Close modal</span>
                                                                        </button>
                                                                    </div>
                                                                    <!-- Modal body -->
                                                                    <div class="p-6">
                                                                        <div
                                                                            class="grid grid-cols-1 md:grid-cols-2 gap-4 items-end">
                                                                            <div class="md:col-span-1">
                                                                                <label for="select-product-edit"
                                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                                                    Selecionar o kit</label>
                                                                                <!-- @change="updateAvailableAmount(lotInscription.kit); resetFields(lotInscription);" -->
                                                                                <select id="select-product-edit" required
                                                                                    v-model="lotInscription.event_kit_id"
                                                                                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all">
                                                                                    <option value="" selected disabled>
                                                                                    </option>
                                                                                    <option :value="kit.id"
                                                                                        v-for="kit in getFilteredKitsForInscription(inscription.participants)"
                                                                                        :key="kit.id">
                                                                                        {{ kit.name }}
                                                                                    </option>

                                                                                </select>
                                                                            </div>
                                                                            <div
                                                                                class="md:col-span-1 flex items-center shadow-all justify-between px-4 rounded-xl w-full h-[2.6rem] pb-0">
                                                                                <p class="text-base">Adicionar o kit em
                                                                                    todos os lotes dessa inscrição</p>
                                                                                <label
                                                                                    class="relative inline-flex items-center cursor-pointer">
                                                                                    <input type="checkbox" value=""
                                                                                        class="sr-only peer"
                                                                                        v-model="lotInscription.allLots"
                                                                                        true-value="yes" false-value="no" />
                                                                                    <div
                                                                                        class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600">
                                                                                    </div>
                                                                                </label>
                                                                            </div>
                                                                        </div>
                                                                        <div
                                                                            class="grid grid-cols-1 lg:grid-cols-2 gap-4 mt-12 items-end">
                                                                            <!-- <div
                                                                                class="relative bg-[#9F9F9F] h-10 shadow-all rounded-xl p-2">
                                                                                <p class="text-white font-bold">Disponíveis:
                                                                                    {{ availableAmount }}</p>
                                                                                <div
                                                                                    class="flex justify-center items-center">
                                                                                    <label for="lot-inscription-amount"
                                                                                        class="block mb-2 text-sm font-medium text-gray-900 w-1/3 absolute top-0 right-0 -mt-6 text-center">Quantidade</label>
                                                                                    <input type="number"
                                                                                        id="lot-inscription-amount"
                                                                                        v-model="lotInscription.amount"
                                                                                        @input="adjustAmount(lotInscription)"
                                                                                        :disabled="!lotInscription.kit"
                                                                                        class="w-1/3 absolute top-0 right-0 bg-white border-gray-300 text-[#313131] text-sm font-bold rounded-xl p-2.5 text-center shadow-all" />
                                                                                </div>
                                                                            </div> -->
                                                                            <div class="">
                                                                                <label
                                                                                    for="lot-inscription-vacancies-number"
                                                                                    class="block mb-2 text-sm font-medium text-gray-900">Quantidade
                                                                                    de vagas para esse lote*</label>
                                                                                <input type="number"
                                                                                    placeholder="Sem limite"
                                                                                    id="lot-inscription-vacancies-number"
                                                                                    v-model="lotInscription.vacancies_number"
                                                                                    :disabled="!lotInscription.event_kit_id"
                                                                                    class="border border-gray-300 font-bold text-sm rounded-lg block w-full p-2.5 shadow-all text-[#313131] text-center" />
                                                                            </div>
                                                                            <div class="grid grid-cols-2 gap-4">
                                                                                <div class="">
                                                                                    <label for="lot-inscription-value"
                                                                                        class="block mb-2 text-sm font-medium text-gray-900">Valor
                                                                                        do kit*</label>
                                                                                    <input type="number"
                                                                                        id="lot-inscription-value"
                                                                                        v-model="lotInscription.value"
                                                                                        :disabled="!lotInscription.event_kit_id"
                                                                                        class="border border-gray-300 font-bold text-sm rounded-lg block w-full p-2.5 shadow-all text-[#313131] text-center" />
                                                                                </div>
                                                                                <div class="">
                                                                                    <label
                                                                                        for="lot-inscription-senior_discount"
                                                                                        class="block mb-2 text-sm font-medium text-gray-900">Desconto
                                                                                        por idoso*</label>
                                                                                    <input type="number"
                                                                                        id="lot-inscription-senior_discount"
                                                                                        v-model="lotInscription.senior_discount"
                                                                                        :disabled="!lotInscription.event_kit_id"
                                                                                        class="border border-gray-300 font-bold text-sm rounded-lg block w-full p-2.5 shadow-all text-[#313131] text-center" />
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div v-if="isExceedingAvailableAmountForLot(lotInscription, inscription)"
                                                                            class="text-red-500 mt-2 ml-4">
                                                                            Você inseriu um valor que ultrapassa a
                                                                            quantidade total de Kits.
                                                                        </div>
                                                                    </div>
                                                                    <!-- Modal footer -->
                                                                    <div
                                                                        class="flex items-center justify-between p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                        <button type="button"
                                                                            class="md:w-52 flex justify-center gap-2 items-center bg-[#FF7171] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all"
                                                                            @click="closeAddWithKitInLotModal(lotInscription.id)">
                                                                            <svg width="23" height="22" viewBox="0 0 23 22"
                                                                                fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path fill-rule="evenodd"
                                                                                    clip-rule="evenodd"
                                                                                    d="M3.72183 3.22178C8.01538 -1.07177 14.9846 -1.07177 19.2782 3.22178C23.5717 7.51533 23.5717 14.4846 19.2782 18.7781C14.9846 23.0717 8.01538 23.0717 3.72183 18.7781C-0.571727 14.4846 -0.571727 7.51533 3.72183 3.22178ZM11.5 12.5556L14.6113 15.6669L16.1669 14.1112L13.0556 11L16.1669 7.88868L14.6113 6.33305L11.5 9.44432L8.38873 6.33305L6.83309 7.88868L9.94436 11L6.83309 14.1112L8.38873 15.6669L11.5 12.5556Z"
                                                                                    fill="white" />
                                                                            </svg>
                                                                            <span>Cancelar</span>
                                                                        </button>
                                                                        <button
                                                                            class="md:w-52 flex justify-center items-center gap-2 px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all hover:cursor-pointer"
                                                                            type="submit"
                                                                            :class="isExceedingForAnyLot ? 'bg-gray-400' : 'bg-[#0DCD71]'"
                                                                            :disabled="isExceedingForAnyLot">
                                                                            <svg width="22" height="22" viewBox="0 0 22 22"
                                                                                fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path fill-rule="evenodd"
                                                                                    clip-rule="evenodd"
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
                                                    <!-- END ADICIONAR COM KIT -->

                                                    <!-- START ADICIONAR SEM KIT -->
                                                    <!-- Main modal -->
                                                    <div v-if="isAddWithoutKitInLotModalOpen(lotInscription.id)"
                                                        :id="'lotCreateModal-' + lotInscription.id" tabindex="-1"
                                                        aria-hidden="true"
                                                        class="fixed flex items-center justify-center top-0 left-0 right-0 z-50 w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                                        <div class="modal-lot-create-backdrop"
                                                            @click="closeAddWithoutKitInLotModal(lotInscription.id)"></div>
                                                        <div class="relative w-full max-w-6xl max-h-full">
                                                            <!-- Modal content -->
                                                            <div
                                                                class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                                                <form
                                                                    @submit.prevent="addWithoutKitInLotSubmit(lotInscription)">
                                                                    <!-- Modal header -->
                                                                    <div
                                                                        class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-600">
                                                                        <h3 class="text-3xl font-black text-black">
                                                                            ADICIONAR SEM KIT:</h3>
                                                                        <button type="button"
                                                                            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                                            @click="closeAddWithoutKitInLotModal(lotInscription.id)">
                                                                            <svg class="w-3 h-3" aria-hidden="true"
                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                fill="none" viewBox="0 0 14 14">
                                                                                <path stroke="currentColor"
                                                                                    stroke-linecap="round"
                                                                                    stroke-linejoin="round" stroke-width="2"
                                                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                                            </svg>
                                                                            <span class="sr-only">Close modal</span>
                                                                        </button>
                                                                    </div>
                                                                    <!-- Modal body -->
                                                                    <div class="p-6">
                                                                        <div
                                                                            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mt-12 items-end">
                                                                            <div
                                                                                class="relative bg-[#9F9F9F] h-10 shadow-all rounded-xl p-2">
                                                                                <p class="text-white font-bold">Sem kit</p>
                                                                            </div>
                                                                            <div class="md:col-span-1">
                                                                                <label for="select-product"
                                                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                                                    Quantidade de atletas* </label>
                                                                                <select id="select-product" required
                                                                                    v-model="lotInscription.athletes_amount"
                                                                                    class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 shadow-all">
                                                                                    <option value="1" selected>1 atleta
                                                                                    </option>
                                                                                    <option value="2" selected>2 atletas
                                                                                    </option>
                                                                                    <option value="3" selected>3 atletas
                                                                                    </option>
                                                                                    <option value="4" selected>4 atletas
                                                                                    </option>
                                                                                    <option value="5" selected>5 atletas
                                                                                    </option>
                                                                                    <option value="6" selected>6 atletas
                                                                                    </option>
                                                                                    <option value="7" selected>7 atletas
                                                                                    </option>
                                                                                    <option value="8" selected>8 atletas
                                                                                    </option>
                                                                                    <option value="9" selected>9 atletas
                                                                                    </option>
                                                                                    <option value="10" selected>10 atletas
                                                                                    </option>
                                                                                </select>
                                                                            </div>
                                                                            <div class="">
                                                                                <label for="lot-inscription-amount"
                                                                                    class="block mb-2 text-sm font-medium text-gray-900">Quantidade*</label>
                                                                                <input type="number"
                                                                                    id="lot-inscription-amount"
                                                                                    v-model="lotInscription.amount"
                                                                                    class="border border-gray-300 font-bold text-sm rounded-lg block w-full p-2.5 shadow-all text-[#313131] text-center" />
                                                                            </div>

                                                                            <div class="">
                                                                                <label for="lot-inscription-value"
                                                                                    class="block mb-2 text-sm font-medium text-gray-900">Valor*</label>
                                                                                <input type="number"
                                                                                    id="lot-inscription-value"
                                                                                    v-model="lotInscription.value"
                                                                                    class="border border-gray-300 font-bold text-sm rounded-lg block w-full p-2.5 shadow-all text-[#313131] text-center" />
                                                                            </div>
                                                                            <div class="">
                                                                                <label for="lot-inscription-senior_discount"
                                                                                    class="block mb-2 text-sm font-medium text-gray-900">Desconto
                                                                                    por idoso*</label>
                                                                                <input type="number"
                                                                                    id="lot-inscription-senior_discount"
                                                                                    v-model="lotInscription.senior_discount"
                                                                                    class="border border-gray-300 font-bold text-sm rounded-lg block w-full p-2.5 shadow-all text-[#313131] text-center" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Modal footer -->
                                                                    <div
                                                                        class="flex items-center justify-between p-6 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-600">
                                                                        <button type="button"
                                                                            class="md:w-52 flex justify-center gap-2 items-center bg-[#FF7171] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all"
                                                                            @click="closeAddWithoutKitInLotModal(lotInscription.id)">
                                                                            <svg width="23" height="22" viewBox="0 0 23 22"
                                                                                fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path fill-rule="evenodd"
                                                                                    clip-rule="evenodd"
                                                                                    d="M3.72183 3.22178C8.01538 -1.07177 14.9846 -1.07177 19.2782 3.22178C23.5717 7.51533 23.5717 14.4846 19.2782 18.7781C14.9846 23.0717 8.01538 23.0717 3.72183 18.7781C-0.571727 14.4846 -0.571727 7.51533 3.72183 3.22178ZM11.5 12.5556L14.6113 15.6669L16.1669 14.1112L13.0556 11L16.1669 7.88868L14.6113 6.33305L11.5 9.44432L8.38873 6.33305L6.83309 7.88868L9.94436 11L6.83309 14.1112L8.38873 15.6669L11.5 12.5556Z"
                                                                                    fill="white" />
                                                                            </svg>
                                                                            <span>Cancelar</span>
                                                                        </button>
                                                                        <button
                                                                            class="md:w-52 flex justify-center items-center gap-2 bg-[#0DCD71] px-6 py-3 text-white font-bold text-xs rounded-lg uppercase shadow-all hover:cursor-pointer"
                                                                            type="submit">
                                                                            <svg width="22" height="22" viewBox="0 0 22 22"
                                                                                fill="none"
                                                                                xmlns="http://www.w3.org/2000/svg">
                                                                                <path fill-rule="evenodd"
                                                                                    clip-rule="evenodd"
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
                                                    <!-- END ADICIONAR SEM KIT -->
                                                </div>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div v-for="lot in inscription.lots">
                            {{ lot.name }}
                        </div> -->
                    </div>
                </div>
            </div>

            <div class="flex justify-between pt-12">
                <button type="button" v-if="step > 1" @click="step--"
                    class="bg-red-300 px-8 py-2 rounded-xl text-white font-bold">
                    Voltar
                </button>
                <button type="submit" class="bg-green px-8 py-2 rounded-xl text-white font-bold">
                    Avançar {{ step }}
                </button>
            </div>

        </form>
    </div>
</template>
<script setup>
import { reactive, ref, watch, computed } from "vue";
import { step } from "@/Pages/Event/step.js";
import moment from "moment";
import { router, useForm } from "@inertiajs/vue3";
import { useToast } from "vue-toast-notification";
import "vue-toast-notification/dist/theme-sugar.css";

const toast = useToast();

const props = defineProps({
    inscriptions: Array,
    kits: Array,
    eventId: Number,
});

function getFilteredKitsForInscription(participants) {
    return props.kits.filter(kit => kit.athletes_amount == participants);
}

const formatHour = (time) => {
    return moment(time, "HH:mm:ss").format("HH:mm");
};

// START DRAG INSCRIPTIONS
let draggedItemIndex = ref(null);
function dragStartInscription(index) {
    draggedItemIndex.value = index;
}
function dragOverInscription(event) {
    event.preventDefault();
    event.target.closest(".target-item-inscriptions");
}
function dragLeaveInscription(event) {
    event.target.closest(".target-item-inscriptions");
}
function dragEndInscription() {
    draggedItemIndex.value = null;
}
function dragDropInscription(targetIndex) {
    event.target.closest(".target-item-inscriptions");
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
// END DRAG INSCRIPTIONS

// START DRAG KIT INSCRIPTION
let draggedItemIndexKitInscription = ref(null);
let draggedKitInscriptionIndex = ref(null);
let draggedInscriptionIndex = ref(null);

function dragOverLotInscription(event) {
    event.preventDefault();
    event.target.closest(".target-item-lot-inscription");
}
function dragLeaveLotInscription(event) {
    event.target.closest(".target-item-lot-inscription");
}
function dragEndLotInscription() {
    draggedItemIndexKitInscription.value = null;
}

function dragStartLotInscription(inscriptionIndex, kitInscriptionIndex) {
    draggedInscriptionIndex.value = inscriptionIndex;
    draggedKitInscriptionIndex.value = kitInscriptionIndex;
}

// (NÃO REMOVER). PERMITE ARRASTAR OS KITS PARA OUTRAS INSCRIÇÕES, PODE SER ÚTIL NO FUTURO.
// function dragDropLotInscription(targetInscriptionIndex, targetKitInscriptionIndex) {
//     if (draggedInscriptionIndex.value !== null && draggedKitInscriptionIndex.value !== null) {

//         let draggedKit = props.inscriptions[draggedInscriptionIndex.value].lots[draggedKitInscriptionIndex.value];

//         props.inscriptions[draggedInscriptionIndex.value].lots.splice(draggedKitInscriptionIndex.value, 1);

//         props.inscriptions[targetInscriptionIndex].lots.splice(targetKitInscriptionIndex, 0, draggedKit);

//         draggedInscriptionIndex.value = null;
//         draggedKitInscriptionIndex.value = null;

//         let kitInscriptionOrder = props.inscriptions.map(inscription => {
//             return {
//                 inscription_id: inscription.id,
//                 kit_ids: inscription.lots.map(lotInscription => {
//                     return {
//                         id: lotInscription.id,
//                         index: lotInscription.index
//                     };
//                 })
//             };
//         });

//         router.put(
//             route("event.lot.inscription.order", { id: props.eventId }),
//             {
//                 order: kitInscriptionOrder
//             },
//             {
//                 preserveScroll: true,
//             }
//         );
//     }
// }

//NÃO PERMITE QUE O USUÁRIO ARRASTE OS KITS PARA OUTRAS INSCRIÇÕES.
function dragDropLotInscription(targetInscriptionIndex, targetKitInscriptionIndex) {
    if (draggedInscriptionIndex.value === targetInscriptionIndex) {
        if (draggedInscriptionIndex.value !== null && draggedKitInscriptionIndex.value !== null) {

            let draggedKit = props.inscriptions[draggedInscriptionIndex.value].lots[draggedKitInscriptionIndex.value];

            props.inscriptions[draggedInscriptionIndex.value].lots.splice(draggedKitInscriptionIndex.value, 1);

            props.inscriptions[targetInscriptionIndex].lots.splice(targetKitInscriptionIndex, 0, draggedKit);

            draggedInscriptionIndex.value = null;
            draggedKitInscriptionIndex.value = null;

            let kitInscriptionOrder = props.inscriptions.map(inscription => {
                return {
                    inscription_id: inscription.id,
                    kit_ids: inscription.lots.map(lotInscription => {
                        return {
                            id: lotInscription.id,
                            index: lotInscription.index
                        };
                    })
                };
            });

            router.put(
                route("event.lot.inscription.order", { id: props.eventId }),
                {
                    order: kitInscriptionOrder
                },
                {
                    preserveScroll: true,
                }
            );
        }
    } else {

        alert("Você não pode mover lots entre inscrições diferentes!");
    }
}
// END DRAG KIT INSCRIPTION



// START ACCORDION INSCRIPTION
const expandedInscriptionItems = ref(props.inscriptions.map((i) => i.id));

const toggleInscriptionAccordionItem = (itemId) => {
    const index = expandedInscriptionItems.value.indexOf(itemId);
    if (index === -1) {
        expandedInscriptionItems.value.push(itemId);
    } else {
        expandedInscriptionItems.value.splice(index, 1);
    }
};
// END ACCORDION INSCRIPTION


//iniciar segundo accordion fechado
// const expandedKitItems = ref([]);

//iniciar segundo accordion aberto
const expandedKitItems = ref(
    props.inscriptions.flatMap(inscription => inscription.lots.map(lot => lot.id))
);


const toggleKitAccordionItem = (itemId) => {
    const index = expandedKitItems.value.indexOf(itemId);
    if (index === -1) {
        expandedKitItems.value.push(itemId);
    } else {
        expandedKitItems.value.splice(index, 1);
    }
};


function valuesSave() {
    router.put(
        route("event.values.update", { id: props.eventId }),
        {

        },
        {
            preserveScroll: true,
        }
    );
}

// START COM KIT
const openAddWithKitInLotModals = ref([]);
const openAddWithKitInLotModal = (id) => {
    if (!openAddWithKitInLotModals.value.includes(id)) {
        openAddWithKitInLotModals.value.push(id);
    }
};
const closeAddWithKitInLotModal = (id) => {
    const index = openAddWithKitInLotModals.value.indexOf(id);
    if (index > -1) {
        openAddWithKitInLotModals.value.splice(index, 1);
    }
};
const isAddWithKitInLotModalOpen = (id) => openAddWithKitInLotModals.value.includes(id);
// END COM KIT

// START SEM KIT
const openAddWithoutKitInLotModals = ref([]);
const openAddWithoutKitInLotModal = (id) => {
    if (!openAddWithoutKitInLotModals.value.includes(id)) {
        openAddWithoutKitInLotModals.value.push(id);
    }
};
const closeAddWithoutKitInLotModal = (id) => {
    const index = openAddWithoutKitInLotModals.value.indexOf(id);
    if (index > -1) {
        openAddWithoutKitInLotModals.value.splice(index, 1);
    }
};
const isAddWithoutKitInLotModalOpen = (id) => openAddWithoutKitInLotModals.value.includes(id);
// END SEM KIT

const availableAmount = ref(0);

function resetFields(lotInscription) {
    lotInscription.vacancies_number = "";
    lotInscription.amount = "";
    lotInscription.value = "";
    lotInscription.senior_discount = "";
}

function updateAvailableAmount(kitId) {
    const selectedKit = props.kits.find(kit => kit.id === kitId);
    checkExceedingForAnyLot();
    if (selectedKit) {
        let totalAmountUsed = 0;

        for (let inscription of props.inscriptions) {
            for (let lotInscription of inscription.lots) {
                for (let eventKit of lotInscription.event_kits) {
                    if (eventKit.event_kit_id === kitId) {
                        totalAmountUsed += eventKit.amount;
                    }
                }
            }
        }

        availableAmount.value = selectedKit.amount - totalAmountUsed;
    }

}

function addWithKitInLotSubmit(lot, inscriptionId) {
    console.log(lot);

    router.post(
        route("event.add.with.kit", { id: lot.id }),
        {
            kitId: lot.event_kit_id,
            allLots: lot.allLots,
            inscriptionId: inscriptionId,
            athletes_amount: lot.athletes_amount,
            vacancies_number: lot.vacancies_number,
            value: lot.value,
            senior_discount: lot.senior_discount
        },
        {
            preserveScroll: true,
        }
    );
    closeAddWithKitInLotModal(lot.id);
}

function adjustAmount(lot) {
    if (lot.amount < 0) {
        lot.amount = 0;
    } else if (lot.amount > availableAmount.value) {
        lot.amount = availableAmount.value;
    }
    checkExceedingForAnyLot();
}

function addWithoutKitInLotSubmit(lot) {
    console.log(lot);

    router.post(
        route("event.add.without.kit", { id: lot.id }),
        {
            athletes_amount: lot.athletes_amount,
            amount: lot.amount,
            value: lot.value,
            senior_discount: lot.senior_discount
        },
        {
            preserveScroll: true,
        }
    );
    closeAddWithoutKitInLotModal(lot.id);
}

function kitLotDelete(id) {
    router.delete(route("event.kit.lot.delete", { id: id }), {
        preserveScroll: true,
    });
}

// START KIT LOT EDIT

const openkitLotEditModals = ref([]);
const openkitLotEditModal = (id) => {
    if (!openkitLotEditModals.value.includes(id)) {
        openkitLotEditModals.value.push(id);
    }
};
const closekitLotEditModal = (id) => {
    const index = openkitLotEditModals.value.indexOf(id);
    if (index > -1) {
        openkitLotEditModals.value.splice(index, 1);
    }
};
const iskitLotEditModal = (id) => openkitLotEditModals.value.includes(id);
// END KIT LOT EDIT


function updateKitLot(kit) {
    console.log(kit);
    router.put(
        route("event.kit.lot.update", { id: kit.id }),
        {
            event_kit_id: kit.event_kit_id,
            athletes_amount: kit.athletes_amount,
            vacancies_number: kit.vacancies_number,
            amount: kit.amount,
            value: kit.value,
            senior_discount: kit.senior_discount,
        },
        {
            preserveScroll: true,
        }
    );
    iskitLotEditModal(kit.id);
    toast.success("Dados atualizados com Sucesso!", {
        position: "top-right",
        duration: 5000,
    });
}

function adjustKitAmount(kit, lotInscription) {
    if (kit.athletes_amount < 0) {
        kit.athletes_amount = 0;
    }
    else if (kit.athletes_amount > kit.kit.athletes_amount) {
        kit.athletes_amount = kit.kit.athletes_amount;
    }

    const totalAmountForSpecificKit = lotInscription.event_kits
        .filter(currentKit => currentKit.event_kit_id === kit.event_kit_id)
        .reduce((sum, currentKit) => sum + currentKit.amount, 0);

    if (totalAmountForSpecificKit > kit.kit.athletes_amount) {

        kit.athletes_amount -= (totalAmountForSpecificKit - kit.kit.athletes_amount);
    }
}

function isExceedingAvailableAmountForLot(lotInscription, inscription) {
    if (lotInscription.allLots === "yes") {
        const totalAmountForAllLots = lotInscription.amount * inscription.lots.length;
        return totalAmountForAllLots > availableAmount.value;
    } else {
        return lotInscription.amount > availableAmount.value;
    }
}

const isExceedingForAnyLot = ref(false);

function checkExceedingForAnyLot() {
    for (let inscription of props.inscriptions) {
        for (let lotInscription of inscription.lots) {
            if (isExceedingAvailableAmountForLot(lotInscription, inscription)) {
                isExceedingForAnyLot.value = true;
                return;
            }
        }
    }
    isExceedingForAnyLot.value = false;
}

watch(() => props.inscriptions.flatMap(i => i.lots).map(l => l.allLots), () => {
    checkExceedingForAnyLot();
}, { deep: true });

function hasKitWithoutID(lotInscription) {
    return lotInscription.event_kits.some(kit => kit.event_kit_id === null);
}
</script>
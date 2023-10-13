<template>
    <div class="flex justify-between items-center mb-4">
        <div class="">
            <h1 class="font-extrabold text-[24px]"> ÁREA FINANCEIRA: </h1>
        </div>
        <div class="px-5 py-2 text-white bg-[#616161] rounded-3xl font-semibold">
            <h1 class="text-1xl"> Taixa de comodidade: 10% </h1>
        </div>
    </div>

    <div class="p-4 mb-4 bg-[#CECECE] sm:z-40 rounded-3xl">
        <a :href="route('event.view')">
            <div class="container mx-auto px-2 md:px-0">
                <div class="grid gap-3" :class="sidebarVisible ? 'md:grid-cols-5' : 'md:grid-cols-5'">
                    <div class="md:flex sm:block flex-col rounded-2xl text-center">
                        <div class="bg-[#0DCD71] rounded-2xl py-2 shadow-input">
                            <h1
                                class="p-6 pt-6 pb-6 m-4 rounded-2xl font-black bg-white align-middle text-2xl shadow-input">
                                R$ 18.562
                            </h1>
                            <p class="font-semibold align-middle mb-2 text-white">Faturamento Total</p>
                        </div>
                    </div>
                    <div class="flex flex-col rounded-2xl text-center">
                        <div class="bg-gray-200 rounded-2xl py-2 shadow-input">
                            <h1
                                class="p-6 pt-6 pb-6 m-4 rounded-2xl font-black bg-white align-middle text-2xl shadow-input">
                                R$ 1.256
                            </h1>
                            <p class="font-semibold align-middle mb-2 text-dark text-[15px]">Saldo Bloqueado</p>
                        </div>
                    </div>
                    <div class="flex flex-col rounded-2xl text-center">
                        <div class="bg-gray-200 rounded-2xl py-2 text-white shadow-input">
                            <h1
                                class="p-6 pt-6 pb-6 m-4 rounded-2xl font-black bg-white align-middle text-2xl text-dark shadow-input">
                                R$ 2.000
                            </h1>
                            <p class="font-semibold align-middle mb-2 text-dark text-[15px]">Saldo Disponível</p>
                        </div>
                    </div>
                    <div class="flex flex-col rounded-2xl text-center">
                        <div class="bg-gray-200 rounded-2xl py-2 shadow-input">
                            <h1
                                class="p-6 pt-6 pb-6 m-4 rounded-2xl font-black bg-white align-middle text-2xl shadow-input">
                                R$ 5.000
                            </h1>
                            <p class="font-semibold align-middle mb-2 text-dark text-[15px]">Saldo Sacado</p>
                        </div>
                    </div>
                    <div class="flex flex-col rounded-2xl text-center">
                        <div class="bg-[#FF7171] rounded-2xl py-2 text-dark  shadow-input">
                            <h1
                                class="p-6 pt-6 pb-6 m-4 rounded-2xl font-black bg-white align-middle text-2xl text-dark shadow-input">
                                R$ 1.689
                            </h1>
                            <p class="font-semibold align-middle mb-2 text-white text-[15px]">Valor do somatório de
                                cancelados</p>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="mb-5 sm:z-40 rounded-3xl shadow-input">
        <div>
            <div class="p-2 bg-grad-green rounded-t-3xl text-white">
                <h1 class="font-semibold text-1xl ml-4"> Solicitação de saque: </h1>
            </div>
            <div class="md:flex gap-3 p-4 place-items-center rounded-b-3xl"
                :class="sidebarVisible ? 'md:grid-cols-3 bg-white align-middle' : ' bg-white md:grid-cols-3'">
                <div class="flex flex-col border-r-2 border-[#C8C8C]">
                    <div class="rounded-3xl py-2">
                        <p class="text-[14px] mr-4">
                            As solicitações feitas até às 15:00 hrs de um dia útil serão realizadas no mesmo dia. Após às
                            15:00 hrs
                            somente no próximo dia útil.
                        </p>
                    </div>
                </div>
                <div class="flex flex-col ml-4 mr-4 text-left text-[#616161]">
                    <label class="mb-[2px] ml-2 text-xs">Valor:*</label>
                    <div class="rounded-3xl mb-[1rem]">
                        <input
                            class="border border-gray-300 shadow-input rounded-md px-4 py-2 focus:outline-none focus:border-green-500 w-64 h-[40px] text-xs"
                            placeholder="R$ 00,00" type="text">
                    </div>
                </div>
                <div class="flex flex-col w-full">
                    <div class="rounded-3xl md:w-2/4 sm:w-full">
                        <button
                            class="flex justify-center items-center shadow-input  gap-3 font-semibold bg-green text-white rounded-lg w-full h-[40px]">
                            <FinancialSvg />
                            SOLICITAR SAQUE
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-5 sm:z-40 rounded-3xl shadow-input">
        <div>
            <div class="p-4 rounded-t-3x">
                <h1 class="font-semibold text-1xl"> Dados bancários do organizador: </h1>
            </div>
            <div class="grid gap-3 p-4 pt-0 place-items-left text-[#616161] text-xs rounded-b-3xl"
                :class="sidebarVisible ? 'md:grid-cols-6 bg-white align-middle' : ' bg-white md:grid-cols-1'">
                <div class="flex flex-col">
                    <div class="rounded-3xl py-2">
                        <label class="block mb-2" for="saque-input">CNPJ:*</label>
                        <input id="saque-input" class="w-full border border-gray-300 rounded-md text-xs shadow-input"
                            type="text" placeholder="XXX.XXXX.XXXXX-XXXX">
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="rounded-3xl py-2">
                        <label class="block mb-2" for="saque-input">Titular:*</label>
                        <input id="saque-input" class="w-full border border-gray-300 rounded-md text-xs shadow-input"
                            type="text" placeholder="NOME 1">
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="rounded-3xl py-2">
                        <label class="block mb-2" for="saque-input">Banco:*</label>
                        <input id="saque-input" class="w-full border border-gray-300 rounded-md text-xs shadow-input"
                            type="text" placeholder="Banco do Brasil">
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="rounded-3xl py-2">
                        <label class="block mb-2" for="saque-input">Agência:*</label>
                        <input id="saque-input" class="w-full border border-gray-300 rounded-md text-xs shadow-input"
                            type="text" placeholder="45215">
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="rounded-3xl py-2">
                        <label class="block mb-2" for="saque-input">Conta:*</label>
                        <input id="saque-input" class="w-full border border-gray-300 rounded-md text-xs shadow-input"
                            type="text" placeholder="5487">
                    </div>
                </div>
                <div class="flex flex-col">
                    <div class="rounded-3xl py-2">
                        <label class="block mb-2" for="saque-input">Dígito:*</label>
                        <input id="saque-input" class="w-full border border-gray-300 rounded-md text-xs shadow-input"
                            type="text" placeholder="8">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-5 p-4 bg-[#F9F9F9] sm:z-40 rounded-3xl shadow-input">
        <a :href="route('event.view')">
            <div class="container p-4">
                <h1 class="font-semibold mb-2">Métodos de Pagamento:</h1>
                <div class="grid gap-3" :class="sidebarVisible ? 'md:grid-cols-3' : 'md:grid-cols-3'">
                    <div class="flex flex-col text-center">
                        <div class="bg-white rounded-3xl py-2 shadow-input">
                            <h1 class="mt-2 font-semibold">BOLETO</h1>
                            <div class="flex justify-center gap-4 w-full p-4">
                                <div class="flex flex-col w-full">
                                    <div class="w-full border border-solid border-gray-300 rounded-xl shadow-input flex-1">
                                        <h1 class="p-5 rounded-3xl font-black bg-white align-middle text-3xl">R$ 6.562</h1>
                                    </div>
                                    <div>
                                        <p class="font-semibold align-middle m-2">Faturamento Total</p>
                                    </div>
                                </div>
                                <div class="flex flex-col w-full">
                                    <div class="px-5 border border-solid border-gray-300 rounded-xl shadow-input flex-1">
                                        <h1 class="p-5 rounded-3xl font-black bg-white align-middle text-3xl">R$ 356</h1>
                                    </div>
                                    <div>
                                        <p class="font-semibold align-middle m-2">Em processamento</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col text-center">
                        <div class="bg-white rounded-3xl py-2 shadow-input">
                            <h1 class="mt-2 font-semibold"> CARTÃO DE CRÉDITO </h1>
                            <div class="flex justify-center gap-4 w-full p-4">
                                <div class="flex flex-col w-full">
                                    <div class="border border-solid border-gray-300 rounded-xl shadow-input flex-1">
                                        <h1 class="p-5 rounded-3xl font-black bg-white align-middle text-3xl">R$ 8.265</h1>
                                    </div>
                                    <div>
                                        <p class="font-semibold align-middle m-2">Faturamento Total</p>
                                    </div>
                                </div>
                                <div class="flex flex-col w-full">
                                    <div class="border border-solid border-gray-300 rounded-xl shadow-input flex-1">
                                        <h1 class="p-5 rounded-3xl font-black bg-white align-middle text-3xl">R$ 2.000</h1>
                                    </div>
                                    <div>
                                        <p class="font-semibold align-middle m-2">Saldo bloqueado</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col text-center">
                        <div class="bg-white rounded-3xl py-2 shadow-input">
                            <h1 class="mt-2 font-semibold"> PIX </h1>
                            <div class="flex justify-center gap-4 w-full p-4">
                                <div class="flex flex-col w-full">
                                    <div class="border border-solid border-gray-300 rounded-xl shadow-input flex-1">
                                        <h1 class="p-5 rounded-3xl font-black bg-white align-middle text-3xl">
                                            R$ 3.887
                                        </h1>
                                    </div>
                                    <div>
                                        <p class="font-semibold align-middle m-2">Faturamento Total</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="p-4 mt-4 bg-[#F9F9F9] sm:z-40 rounded-3xl shadow-input">
        <div class="md:flex sm:block sm:text-center justify-between items-center mb-4">
            <div class="">
                <h1 class="font-extrabold text-1xl"> Painel de Cŕeditos: </h1>
            </div>
            <div class="md:w-1/4 sm:w-auto sm:font-[12px] sm:p-1">
                <div class="rounded-3xl">
                    <button
                        class="md:p-4 sm:p-8  flex justify-center items-center shadow-input  gap-3 font-semibold bg-green text-white rounded-lg w-full h-[40px] sm:font-xl">
                        <FinancialSvg />
                        REGISTRAR CRÉDITO
                    </button>
                </div>
            </div>
        </div>
        <div class="sm:hidden">
            <div class="p4 mt-4 border-[#F9F9F9]">
                <div class="container mx-auto py-12 px-2 md:px-0">
                    <div class="grid gap-3" :class="sidebarVisible ? 'md:grid-cols-3' : 'md:grid-cols-4'">
                        <div v-for=" index  in  5 " :key="index">
                            <div class="flex flex-col shadow-input rounded-3xl text-center">
                                <p class="py-2 flex justify-center gap-2"> Inscrição: 5Km - Simples </p>
                                <p class="py-2 flex justify-center gap-2"> Quantidade vendida: 500 </p>
                                <p class="py-2 flex justify-center gap-2"> Valor: R$ 20.6897,00 </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden sm:block">
            <div class="grid grid-cols-3 text-center font-semibold">
                <div class="p-3">Data</div>
                <div class="p-3">Descrição</div>
                <div class="p-3">Valor</div>
            </div>
            <div class="bg-[#9F9F9F] rounded-t-lg max-h-72 overflow-y-auto">
                <div class="p-3 w-full text-center">
                    <div v-for=" index  in  5 " :key="index">
                        <div class="mb-3 grid grid-cols-3 rounded-lg bg-white">
                            <div class="p-3"> 25/11/2023 - 10:58 </div>
                            <div class="p-3"> Saque solicitado via painel </div>
                            <div class="p-3"> R$ 22.000,00 </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="md:flex sm:block justify-between items-center p-4 rounded-b-lg bg-[#9F9F9F] ">
            <div class=""></div>
            <div class="md:w-1/4 sm:w-auto">
                <div class="rounded-lg">
                    <div
                        class="flex min-w-max justify-evenly items-center shadow-input gap-3 font-semibold bg-[#F1F1F1] text-dark rounded-lg h-[40px]">
                        <div>Total:</div>
                        <div>R$ 1000.00 </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="p-4 mt-4 bg-[#F9F9F9] sm:z-40 rounded-3xl shadow-input">
        <div class="md:flex sm:block sm:text-center justify-between items-center mb-4">
            <div class="">
                <h1 class="font-extrabold text-1xl"> Painel de Débitos </h1>
            </div>
            <div class="md:w-1/4 sm:w-auto sm:font-[12px] sm:p-1">
                <div class="rounded-3xl">
                    <button
                        class="md:p-4 sm:p-8 flex justify-center items-center shadow-input gap-3 font-semibold bg-green text-white rounded-lg w-full h-[40px] sm:font-xl">
                        <FinancialSvg />
                        REGISTRAR DÉBITO
                    </button>
                </div>
            </div>
        </div>
        <div class="sm:hidden">
            <div class="p4 mt-4 border-[#F9F9F9]">
                <div class="container mx-auto py-12 px-2 md:px-0">
                    <div class="grid gap-3" :class="sidebarVisible ? 'md:grid-cols-3' : 'md:grid-cols-4'">
                        <div v-for=" index  in  5 " :key="index">
                            <div class="flex flex-col shadow-input rounded-3xl text-center">
                                <p class="py-2 flex justify-center gap-2"> Inscrição: 5Km - Simples </p>
                                <p class="py-2 flex justify-center gap-2"> Quantidade vendida: 500 </p>
                                <p class="py-2 flex justify-center gap-2"> Valor: R$ 20.6897,00 </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden sm:block">
            <div class="grid grid-cols-3 text-center font-semibold">
                <div class="p-3">Data</div>
                <div class="p-3">Descrição</div>
                <div class="p-3">Valor</div>
            </div>
            <div class="bg-[#9F9F9F] rounded-t-lg max-h-72 overflow-y-auto">
                <div class="p-3 w-full text-center">
                    <div v-for=" index  in  5 " :key="index">
                        <div class="mb-3 grid grid-cols-3 rounded-lg bg-white">
                            <div class="p-3"> 25/11/2023 - 10:58 </div>
                            <div class="p-3"> TED </div>
                            <div class="p-3"> R$ 3,67 </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="md:flex sm:block justify-between items-center p-4 rounded-b-lg bg-[#9F9F9F] ">
            <div class=""></div>
            <div class="md:w-1/4 sm:w-auto">
                <div class="rounded-lg">
                    <div
                        class="flex min-w-max justify-evenly items-center shadow-input gap-3 font-semibold bg-[#F1F1F1] text-dark rounded-lg h-[40px]">
                        <div>Total:</div>
                        <div>R$ 1000.00 </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="p-4 mt-4 bg-[#F9F9F9] sm:z-40 rounded-3xl shadow-input">
        <div class="flex justify-between items-center mb-4">
            <div class="">
                <h1 class="font-extrabold text-1xl"> Faturamento por inscrição: </h1>
            </div>
        </div>
        <div class="sm:hidden">
            <div class="p4 mt-4 border-[#F9F9F9]">
                <div class="container mx-auto py-12 px-2 md:px-0">
                    <div class="grid gap-3" :class="sidebarVisible ? 'md:grid-cols-3' : 'md:grid-cols-4'">
                        <div v-for=" index  in  2 " :key="index">
                            <div class="flex flex-col shadow-input rounded-3xl text-center">
                                <p class="py-2 flex justify-center gap-2"> Inscrição: 5Km - Simples </p>
                                <p class="py-2 flex justify-center gap-2"> Quantidade vendida: 500 </p>
                                <p class="py-2 flex justify-center gap-2"> Valor: R$ 20.6897,00 </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden sm:block">
            <div class="grid grid-cols-3 text-center font-semibold">
                <div class="p-3">Incrições</div>
                <div class="p-3">Quantidade Vendida</div>
                <div class="p-3">Valor</div>
            </div>
            <div class="bg-[#9F9F9F] rounded-t-lg max-h-32 overflow-y-auto">
                <div class="p-3 w-full text-center">
                    <div v-for=" index  in  2 " :key="index">
                        <div class="mb-3 grid grid-cols-3 rounded-lg bg-white">
                            <div class="p-3"> 5Km - Simples </div>
                            <div class="p-3"> Vendida: 500 </div>
                            <div class="p-3"> R$ 20.6897,00 </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="md:flex sm:block justify-between items-center p-4 rounded-b-lg bg-[#9F9F9F] ">
            <div class=""></div>
            <div class="md:w-1/4 sm:w-auto">
                <div class="rounded-lg">
                    <div
                        class="flex min-w-max justify-evenly items-center shadow-input gap-3 font-semibold bg-[#F1F1F1] text-dark rounded-lg h-[40px]">
                        <div>Total:</div>
                        <div>R$ 1000.00 </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { sidebarVisible } from "@/Layouts/sidebar.js";
import FinancialSvg from "@/Pages/Svgs/Financial.vue";
</script>
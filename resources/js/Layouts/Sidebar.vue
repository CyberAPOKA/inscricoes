<template>
    <button data-drawer-target="sidebar-multi-level-sidebar" data-drawer-toggle="sidebar-multi-level-sidebar"
        aria-controls="sidebar-multi-level-sidebar" type="button"
        class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>

    <aside id="sidebar-multi-level-sidebar" aria-label="Sidebar" :class="sidebarVisible
        ? 'fixed top-0 left-0 z-40 sm:w-44 xl:w-52 h-screen transition-transform -translate-x-full sm:translate-x-0'
        : 'fixed top-0 left-0 z-40 sm:w-14 xl:w-16 h-screen transition-transform'
        ">
        <div class="h-full px-3 py-4 bg-yellow dark:bg-gray-800 relative">
            <button
                class="h-8 w-8 absolute right-0 -mr-4 z-50 hidden md:flex items-center justify-center bg-[#616161] rounded-full mt-20 p-1"
                style="z-index: 99999;" type="button" @click="toggleSidebar">
                <ArrowSideBar :style="{ transform: `rotate(${arrowRotation}deg)` }" class="w-full h-full" />
            </button>
            <ul class="space-y-2 font-medium">
                <li class="pt-4">
                    <a href="#" class="flex items-center md:p-0 sm:p-2 text-gray-900 rounded-lg">
                        <MaximizedLogo v-show="sidebarVisible" />
                        <MinimizedLogo v-show="!sidebarVisible" />
                    </a>
                </li>
                <li class="pt-12">
                    <a href="#"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white group hover:bg-black hover:text-white dark:hover:bg-gray-700">
                        <DashboardSvg />
                        <span class="ml-3" v-show="sidebarVisible">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a :href="route('events')" :active="route().current('events')"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white group hover:bg-black hover:text-white dark:hover:bg-gray-700">
                        <EventSvg />
                        <span class="ml-3" v-show="sidebarVisible">Eventos</span>
                    </a>
                </li>
                <li>
                    <a :href="route('events')" :active="route().current('events')"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white group hover:bg-black hover:text-white dark:hover:bg-gray-700">
                        <EventsCombo />
                        <span class="ml-3" v-show="sidebarVisible">Combos de Eventos</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white group hover:bg-black hover:text-white dark:hover:bg-gray-700">
                        <AdministrativeSvg />
                        <span class="ml-3" v-show="sidebarVisible">Administrativo</span>
                    </a>
                </li>
                <li>
                    <a href="#"
                        class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white group hover:bg-black hover:text-white dark:hover:bg-gray-700">
                        <PanelSvg />
                        <span class="ml-3" v-show="sidebarVisible">Painel da Foco</span>
                    </a>
                </li>
            </ul>

            <div class="flex items-center justify-center">
                <NotificationSvg />
                <button @click="toggleDropdown" type="button"
                    class="absolute shadow-input bottom-[15rem] inline-flex items-center px-4 py-4 rounded-full border border-transparent text-sm leading-4 font-semibold text-[#191919] bg-white hover:text-gray-700 focus:outline-none text-[14px] focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                    {{ sidebarVisible ? $page.props.auth.user.name : '' }}
                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>

                <div v-if="isDropdownOpen" @click="closeDropdown" :class="sidebarVisible
                    ? 'absolute right-0 mt-2 bg-white border border-gray-300 shadow-md rounded text-[12px] font-normal z-40 bottom-[8.2rem]'
                    : 'absolute right-auto bottom-28 right-0 mt-2 bg-white border border-gray-300 shadow-md rounded text-[12px] font-normal z-40 bottom-[8.2rem]'
                    ">

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        Gerenciar Conta
                    </div>
                    <DropdownLink :href="route('profile.show')"> Meus Dados </DropdownLink>
                    <DropdownLink @click="logout"> Sair </DropdownLink>
                </div>
            </div>
        </div>
    </aside>
</template>

<script setup>
import { ref } from "vue";
import { sidebarVisible } from "@/Layouts/sidebar.js";
import MaximizedLogo from "@/Pages/Svgs/MaximizedLogo.vue";
import MinimizedLogo from "@/Pages/Svgs/MinimizedLogo.vue";
import DashboardSvg from "@/Pages/Svgs/Dashboard.vue";
import EventSvg from "@/Pages/Svgs/Events.vue";
import EventsCombo from "@/Pages/Svgs/EventsCombo.vue";
import Atletas from "@/Pages/Svgs/Atletas.vue";
import AdministrativeSvg from "@/Pages/Svgs/Administrative.vue";
import NotificationSvg from "@/Pages/Svgs/Notifications.vue";
import PanelSvg from "@/Pages/Svgs/Panel.vue";
import ArrowSideBar from "@/Pages/Svgs/ArrowSideBar.vue";
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import { Head, Link, router } from '@inertiajs/vue3';
import DropdownLink from '@/Components/DropdownLink.vue';

onMounted(() => {
    initFlowbite();
});

defineProps({
    title: String,
});

const arrowRotation = ref(0);
const toggleSidebar = () => {
    sidebarVisible.value = !sidebarVisible.value;
    arrowRotation.value += 180;
};

</script>

<script>
export default {
    data() {
        return {
            isDropdownOpen: false,
        };
    },
    methods: {
        toggleDropdown() {
            this.isDropdownOpen = !this.isDropdownOpen;
        },
        closeDropdown() {
            this.isDropdownOpen = false;
        },
        logout: () => {
            router.post(route('logout'));
        },
    },

};
</script>
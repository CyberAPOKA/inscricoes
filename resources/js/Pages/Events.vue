<template>
    <Sidebar></Sidebar>
    <div
        :class="sidebarVisible ? 'pt-4 sm:ml-52 bg-yellow sm:sticky sm:top-0 sm:z-10' : 'pt-4 sm:ml-14 bg-yellow sm:sticky sm:top-0 sm:z-10'">
        <div class="rounded-tl-[4rem] shadow-input bg-white mt-4 z-40">
            <section class="pt-12">
                <div class="border-b-2 shadow-lg">
                    <div class="container mx-auto ml-16">
                        <div class="sm:grid sm:grid-cols-2 flex flex-col gap-2">
                            <div class="flex flex-col md:flex-row justify-between gap-20 p-2">
                                <h1
                                    class="border-b-2 border-yellow uppercase w-44 text-black font-poppins font-extrabold text-5xl">
                                    {{ $t('events') }}</h1>
                                <div class="grid grid-cols-12 relative rounded-full border-none w-full md:ml-12"
                                    style="box-shadow: 0 0 5px 2px #919090">
                                    <SearchSvg class="col-span-2 md:col-span-1 mt-3 md:mt-4 ml-4" />
                                    <input type="text" class="col-span-10 md:col-span-11 rounded-full border-none w-full"
                                        placeholder="Busque pelo evento" />
                                </div>
                            </div>
                            <div class="flex md:justify-end h-16 p-2 mr-4">
                                <a :href="route('event.create')"
                                    class="flex justify-between items-center rounded-lg px-4 bg-green shadow-lg gap-2">
                                    <MoreSvg />
                                    <p class="text-white font-bold uppercase">Crie um evento</p>
                                </a>
                            </div>
                        </div>

                        <div class="mt-8 py-4">
                            <div class="flex space-x-2 mb-4 align-middle">
                                <button v-for="category in uniqueCategories" :key="category"
                                    @click="setActiveCategory(category)" :class="{
                                        'bg-dark uppercase font-extrabold text-white': activeCategory === category,
                                        'bg-white text-gray-400': activeCategory !== category
                                    }"
                                    class="flex gap-2 px-4 py-2 rounded-lg items-center focus:outline-none align-middle justify-center">
                                    {{ category }}
                                    <div v-if="activeCategory === category"
                                        class="bg-white text-[14px] text-dark px-2 py-0 rounded-md">
                                        {{ categoryItemCounts[category] || 0 }}
                                    </div>
                                </button>
                                <button
                                    class="h-[46px] w-[140px] flex justify-center items-center shadow-input gap-3 font-semibold bg-dark text-white rounded-lg sm:font-xl">
                                    <FilterSvg />
                                    Filtros (0)
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <div :class="sidebarVisible ? 'p-4 sm:ml-52 bg-white sm:z-40 shadow-input' : 'p-4 sm:ml-14 bg-white'">
        <a :href="route('event.view')">
            <div class="container mx-auto py-12 px-2 md:px-0">

                <ul class="grid grid-cols-3 gap-4">
                    <li v-for="item in filteredItems" :key="item.id">
                        <div class="flex flex-col shadow-xl rounded-3xl text-center">
                            <div class="relative">
                                <p v-if="item.status === 'Reprovado'"
                                    class="absolute right-0 mt-2 mr-2 bg-red-600 rounded-2xl px-3 py-1 text-sm text-white">
                                    Reprovado
                                </p>
                                <img :src="item.imageSrc" class="w-full object-cover" :alt="item.name" />
                            </div>

                            <p class="bg-dark py-3 text-white">{{ item.name }}</p>
                            <p class="py-2 flex justify-center gap-2">
                                <Calendar></Calendar>
                                {{ item.date }}
                                <Location></Location>
                                {{ item.time }} {{ item.location }}
                            </p>

                            <div class="bg-yellow rounded-b-3xl py-2">
                                <h1 class="font-black">{{ item.organizer }}</h1>
                                <p>{{ item.organizerType }}</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </a>
    </div>
</template>

<script setup>
import Sidebar from "@/Layouts/Sidebar.vue";
import { sidebarVisible } from "@/Layouts/sidebar.js";
import Calendar from "@/Pages/Svgs/Calendar.vue";
import Location from "@/Pages/Svgs/Location.vue";
import SearchSvg from "@/Pages/Svgs/Search.vue";
import FilterSvg from "@/Pages/Svgs/Filter.vue";
import MoreSvg from "@/Pages/Svgs/More.vue";
</script>

<script>
export default {
    data() {
        return {
            items: [
                { id: 1, name: 'Item 1', date: ' DOM, 17 JUN -', time: '6:00 Salvador', imageSrc: 'assets/img/events/example.png', location: 'BA', organizerType: 'Teste', organizer: 'Fernando', category: 'Todos' },
                { id: 1, name: 'Item 1', date: ' DOM, 17 JUN -', time: '6:00 Salvador', imageSrc: 'assets/img/events/example.png', location: 'BA', organizerType: 'Teste', organizer: 'Fernando', category: 'Todos' },
                { id: 1, name: 'Item 1', date: ' DOM, 17 JUN -', time: '6:00 Salvador', imageSrc: 'assets/img/events/example.png', location: 'BA', organizerType: 'Teste', organizer: 'Fernando', category: 'Todos' },
                { id: 1, name: 'Item 1', date: ' DOM, 17 JUN -', time: '6:00 Salvador', imageSrc: 'assets/img/events/example.png', location: 'BA', organizerType: 'Teste', organizer: 'Fernando', category: 'Cancelados' },
                { id: 1, name: 'Item 1', date: ' DOM, 17 JUN -', time: '6:00 Salvador', imageSrc: 'assets/img/events/example.png', location: 'BA', organizerType: 'Teste', organizer: 'Fernando', category: 'Cancelados' },
                { id: 1, name: 'Item 1', date: ' DOM, 17 JUN -', time: '6:00 Salvador', imageSrc: 'assets/img/events/example.png', location: 'BA', organizerType: 'Teste', organizer: 'Fernando', category: 'Cancelados' },
                { id: 1, name: 'Item 1', date: ' DOM, 17 JUN -', time: '6:00 Salvador', imageSrc: 'assets/img/events/example.png', location: 'BA', organizerType: 'Teste', organizer: 'Fernando', category: 'Ao vivo' },
                { id: 1, name: 'Item 1', date: ' DOM, 17 JUN -', time: '6:00 Salvador', imageSrc: 'assets/img/events/example.png', location: 'BA', organizerType: 'Teste', organizer: 'Fernando', category: 'Ao vivo' },
                { id: 1, name: 'Item 1', date: ' DOM, 17 JUN -', time: '6:00 Salvador', imageSrc: 'assets/img/events/example.png', location: 'BA', organizerType: 'Teste', organizer: 'Fernando', category: 'Ao vivo' },
                { id: 1, name: 'Item 1', date: ' DOM, 17 JUN -', time: '6:00 Salvador', imageSrc: 'assets/img/events/example.png', location: 'BA', organizerType: 'Teste', organizer: 'José', category: 'Ao vivo' },
                { id: 1, name: 'Item 1', date: ' DOM, 17 JUN -', time: '6:00 Salvador', imageSrc: 'assets/img/events/example.png', location: 'BA', organizerType: 'Teste', organizer: 'Fernando', category: 'Não listados' },
                { id: 1, name: 'Item 1', date: ' DOM, 17 JUN -', time: '6:00 Salvador', imageSrc: 'assets/img/events/example.png', location: 'BA', organizerType: 'Teste', organizer: 'Fernando', category: 'Não listados' },
                { id: 1, name: 'Item 1', date: ' DOM, 17 JUN -', time: '6:00 Salvador', imageSrc: 'assets/img/events/example.png', location: 'BA', organizerType: 'Teste', organizer: 'Fernando', category: 'Cancelados' },
                { id: 1, name: 'Item 1', date: ' DOM, 17 JUN -', time: '6:00 Salvador', imageSrc: 'assets/img/events/example.png', location: 'BA', organizerType: 'Teste', organizer: 'Fernando', category: 'Cancelados' },
                { id: 1, name: 'Item 1', date: ' DOM, 17 JUN -', time: '6:00 Salvador', imageSrc: 'assets/img/events/example.png', location: 'BA', organizerType: 'Teste', organizer: 'Fernando', category: 'Cancelados' },
                { id: 1, name: 'Item 1', date: ' DOM, 17 JUN -', time: '6:00 Salvador', imageSrc: 'assets/img/events/example.png', location: 'BA', organizerType: 'Teste', organizer: 'Fernando', category: 'Encerrados' },
                { id: 1, name: 'Item 1', date: ' DOM, 17 JUN -', time: '6:00 Salvador', imageSrc: 'assets/img/events/example.png', location: 'BA', organizerType: 'Teste', organizer: 'Fernando', category: 'Encerrados' },
            ],
            activeCategory: 'Todos',
        };
    },

    computed: {
        uniqueCategories() {
            const categories = this.items.map(item => item.category);
            return [...new Set(categories)];
        },
        filteredItems() {
            if (!this.activeCategory || this.activeCategory === 'Todos') {
                return this.items;
            }
            return this.items.filter(item => item.category === this.activeCategory);
        },
        categoryItemCounts() {
            const counts = {};

            if (this.activeCategory === 'Todos') {
                counts['Todos'] = this.filteredItems.length;
            } else {
                for (const item of this.filteredItems) {
                    if (!counts[item.category]) {
                        counts[item.category] = 1;
                    } else {
                        counts[item.category]++;
                    }
                }
                counts['Todos'] = this.filteredItems.length;
            }

            return counts;
        },
    },
    methods: {
        setActiveCategory(category) {
            this.activeCategory = category;
        },
    },
};
</script>

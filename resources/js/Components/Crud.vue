<script setup>

import { Inertia } from '@inertiajs/inertia';
import { Link } from '@inertiajs/inertia-vue3';
import { ref } from "vue"

const props = defineProps(['columns', 'columns_data', 'data', 'action', 'url', 'primary', 'relation', 'search'])

const deleteData = (data) => {
    Inertia.delete(`/${props.url}/${data}`)
}

const dataSearch = ref(props.search ?? '')

const search = () => {
    Inertia.get(`/${props.url}/?search=${dataSearch.value}`)
}



</script>

<template>
    <div>

        <div class="mb-3 gap-x-5 md:flex md:mt-0 justify-between items-center">
            <div class="mb-3 md:mb-0">
                <Link :href="`/${props.url}/create`" class="block w-fit bg-green-500 rounded text-white px-5 py-2 text-xs md:text-sm shadow hover:bg-green-600 ">Tambah Data</Link>
            </div>
            <div>
                <form class="flex items-center" @submit.prevent="search">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
                        </div>
                        <input type="text" v-model="dataSearch" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 " placeholder="Search" required>
                    </div>
                    <button type="submit" class="p-2.5 ml-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        <span class="sr-only">Search</span>
                    </button>
                </form>
            </div>
        </div>

<div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full">
    <table class="text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    #
                </th>
                <th scope="col" class="px-6 py-3" v-for="column in props.columns" :key="column">
                    {{ column }}
                </th>
                <th scope="col" class="px-6 py-3" v-if="props.action">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700" v-for="(data, index) in props.data" :key="index">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                    {{ index + 1 }}
                </th>
                <td class="px-6 py-4" v-for="column in props.columns_data" :key="column">
                    <span v-if="column == 'image'">
                        <img :src="`../../storage/${data['image']}`" class="w-24" :alt="data['created_at']">
                    </span>
                    <span v-else-if="props.relation" v-for="relation in props.relation" :key="relation">
                        {{ relation[0] == column ? data[relation[0]][relation[1]] : data[column] }}
                    </span>
                    <span v-else>
                        {{ data[column] }}
                    </span>
                </td>
                <td class="px-6 py-4 space-x-2">
                    <Link href="" class="font-medium text-blue-600 hover:underline" v-if="props.action && props.action.show">{{ props.action.show }}</Link>
                    <Link :href="`/${props.url}/${data[props.primary]}/edit`" class="font-medium text-blue-600 hover:underline" v-if="props.action && props.action.edit">{{ props.action.edit }}</Link>
                    <form @submit.prevent="deleteData(data[props.primary])" v-if="props.action && props.action.delete" class="inline">
                        <button class="font-medium text-red-600 hover:underline">{{ props.action.delete }}</button>
                    </form>
                </td>
            </tr>
        </tbody>
    </table>
</div>

    </div>
</template>

<script setup>

const props = defineProps(['columns', 'columns_data', 'data', 'action', 'url', 'primary', 'relation'])

import { Link } from "@inertiajs/inertia-vue3"

</script>

<template>
    <div class="w-full">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-fit">
    <table class="text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    #
                </th>
                <th scope="col" class="px-6 py-3" v-for="column in props.columns" :key="column">
                    {{ column }}
                </th>
                <th scope="col" class="px-6 py-3">
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
                    <span v-else>
                        {{ props.relation && props.relation[0] == column ? data[props.relation[0]][props.relation[1]] : data[column] }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <Link :href="`/transaction/success/${data.code_trx}`" class="text-blue-400 text-underline">Detail</Link>
                </td>
            </tr>
        </tbody>
    </table>
</div>
    </div>
</template>

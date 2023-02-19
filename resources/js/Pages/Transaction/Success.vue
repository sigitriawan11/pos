<script setup>
import IndexLayout from '@/Layouts/IndexLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head :title="$page.props.title" />

    <IndexLayout>
        <div class="p-6 bg-white rounded-md shadow-md">
            <h3 class="text-xl md:text-2xl font-bold">{{ $page.props.transaction.code_trx }}</h3>
        <p class="md:text-sm text-xs">Kasir : {{ $page.props.transaction.user.name }}</p>
        <p class="md:text-sm text-xs">Tanggal Transaksi : {{ $page.props.transaction.date_trx }}</p>

        <div class="grid grid-cols-1 space-x-10 lg:grid-cols-2 mt-5">
            <div class="grid grid-cols-1 gap-3">
            <div class="p-2 rounded shadow bg-gray-100 flex items-center justify-between gap-y-3" v-for="product in $page.props.transaction.transaction_details" :key="product">
                <div>
                    <img :src="`../../storage/${product.product.image}`" alt="" class="w-28 h-28">
                </div>
                <div class="text-right">
                    <h3 class="md:text-base text-sm font-bold">{{ product.product.name }}</h3>
                    <p class="md:text-sm text-xs">Rp. {{ product.total_price }}</p>
                    <p class="md:text-sm text-xs">Qty : {{ product.qty }}</p>
                </div>
            </div>
        </div>
        <div>
            <div class="w-full bg-green-500 text-white px-3 py-2 shadow">
                <h3 class="text-xl md:text-2xl font-bold">Total Harga : Rp. {{ $page.props.transaction.total_price }}</h3>
            </div>
            <div class="w-full bg-red-500 text-white px-3 py-2 shadow mt-2">
                <h3 class="text-xl md:text-2xl font-bold">Kembalian : Rp. {{ $page.props.transaction.change }}</h3>
            </div>
        </div>
        </div>
        </div>
    </IndexLayout>
</template>

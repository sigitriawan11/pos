<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import { Bar } from 'vue-chartjs'


import { Chart as ChartJS, Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale } from 'chart.js'

ChartJS.register(Title, Tooltip, Legend, BarElement, CategoryScale, LinearScale)

const props = defineProps(['transaction', 'purchase'])

const chartTrx = {
    labels: ['Hari Ini', '1 Bulan', '1 Tahun', 'Semua'],
    datasets: [ { data: [
        props.transaction.day,
        props.transaction.month,
        props.transaction.year,
        props.transaction.all
    ]
        , label: "Data Total Transaksi" } ]
}

const chartPcs = {
    labels: ['Hari Ini', '1 Bulan', '1 Tahun', 'Semua'],
    datasets: [ { data: [
        props.purchase.day,
        props.purchase.month,
        props.purchase.year,
        props.purchase.all
    ]
        , label: "Data Total Pembelian Barang" } ]
}

const chartOptions = {
        responsive: true
      }

</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout title_page="Dashboard">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-5">
            <div class="p-4 rounded-md shadow-md flex gap-x-5 items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold">Total Kasir {{ $page.props.cashier }}</h3>
                </div>
                <div class="rounded-md px-3 py-2 bg-purple-300 h-fit">
                    <font-awesome-icon icon="fa-solid fa-users-rectangle" class="text-gray-50" />
                </div>
            </div>
            <div class="p-4 rounded-md shadow-md flex gap-x-5 items-center justify-between ">
                <div>
                    <h3 class="text-lg font-bold">Total Barang {{ $page.props.products }}</h3>
                </div>
                <div class="rounded-md px-3 py-2 bg-purple-300 h-fit">
                    <font-awesome-icon icon="fa-solid fa-desktop" class="text-gray-50" />
                </div>
            </div>
            <div class="p-4 rounded-md shadow-md flex gap-x-5 items-center justify-between">
                <div>
                    <h3 class="text-lg font-bold">Total Pendapatan Rp. {{ $page.props.total_transaction }}</h3>
                </div>
                <div class="rounded-md px-3 py-2 bg-purple-300 h-fit">
                    <font-awesome-icon icon="fa-solid fa-money-bill-wave" class="text-gray-50" />
                </div>
            </div>
            <div class="p-4 rounded-md shadow-md flex gap-x-5 items-center justify-between ">
                <div>
                    <h3 class="text-lg font-bold">Total Pengluaran Rp. {{ $page.props.total_purchase }}</h3>
                </div>
                <div class="rounded-md px-3 py-2 bg-purple-300 h-fit">
                    <font-awesome-icon icon="fa-solid fa-money-bill-wave" class="text-gray-50" />
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mt-3">
            <div class="px-3 py-2 rounded shadow-md">
                <Bar
                    id="TRX"
                    :options="chartOptions"
                    :data="chartTrx"
                />
            </div>

            <div class="px-3 py-2 rounded shadow-md">
                <Bar
                    id="PCS"
                    :options="chartOptions"
                    :data="chartPcs"
                />
            </div>
        </div>

    </AuthenticatedLayout>
</template>

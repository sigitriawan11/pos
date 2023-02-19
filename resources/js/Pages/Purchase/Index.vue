<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Crud from '@/Components/Crud.vue'
import Swal from 'sweetalert2/dist/sweetalert2.js'
const props = defineProps(['flash'])

if(props.flash){
    Swal.fire({
        icon: `${props.flash.type}`,
        title: 'Pesan',
        text: `${props.flash.message}`,
    })
}

const columns = ['Code Trx', 'Produk Kode', 'Jumlah', 'Total Harga', 'Description', 'Supplier', 'Tanggal']
const columns_data = ['code_trx', 'product_code', 'qty', 'total', 'description', 'supplier', 'date_trx']

const relations = [
    ['supplier', 'name'],
]

</script>

<template>
    <Head title="Purchases" />

    <AuthenticatedLayout title_page="Data Pembelian">
        <Crud :columns="columns" :search="$page.props.search" :columns_data="columns_data" :data="$page.props.purchases" :relation="relations" url="purchases" primary="code_trx" />
    </AuthenticatedLayout>
</template>

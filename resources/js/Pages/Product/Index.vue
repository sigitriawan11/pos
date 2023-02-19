<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Crud from '@/Components/Crud.vue'
import Swal from 'sweetalert2/dist/sweetalert2.js'
import { computed } from '@vue/runtime-core';
const props = defineProps(['flash'])

const flash = computed(() => {
    console.log(props.flash)
    return props.flash
})

if(flash.value){
    Swal.fire({
        icon: `${props.flash.type}`,
        title: 'Pesan',
        text: `${props.flash.message}`,
    })
}
const columns = ['image', 'name', 'category', 'buy price', 'sell price', 'stock']
const columns_data = ['image', 'name', 'category', 'purchase_price', 'selling_price', 'stock']
const action = {
    edit: "Edit",
    delete: "Delete"
}
const relations = [
    ['category', 'name']
]


</script>

<template>
    <Head title="Products" />
    <AuthenticatedLayout title_page="Data Produk">
        <Crud :columns="columns" :columns_data="columns_data" :relation="relations" :data="$page.props.products" :action="action" url="products" primary="product_code" :search="$page.props.search" />
    </AuthenticatedLayout>
</template>

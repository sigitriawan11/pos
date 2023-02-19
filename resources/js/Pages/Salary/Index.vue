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

const columns = ['Nama', 'salary']
const columns_data = ['name', 'salary']
const action = {
    edit: "Edit",
}

const relation = [
    ['salary', 'saldo']
]

</script>

<template>
    <Head title="Data Gaji Kasir" />
    <AuthenticatedLayout title_page="Data Gaji">
        <Crud :columns="columns" :search="$page.props.search" :columns_data="columns_data" :relation="relation" :data="$page.props.salaries" :action="action" url="salaries" primary="id" />
    </AuthenticatedLayout>
</template>

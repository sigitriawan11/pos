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

const columns = ['name', 'email', 'phone', 'address', 'birth']
const columns_data = ['name', 'email', 'phone', 'address', 'birth']
const action = {
    edit: "Edit",
    delete: "Delete"
}

</script>

<template>
    <Head title="Kasir" />

    <AuthenticatedLayout title_page="Data Kasir">
        <Crud :columns="columns" :search="$page.props.search" :columns_data="columns_data" :data="$page.props.cashiers" :action="action" url="cashiers" primary="email" />
    </AuthenticatedLayout>
</template>

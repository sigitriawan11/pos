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

const columns = ['name', 'created at']
const columns_data = ['name', 'created_at']
const action = {
    edit: "Edit",
    delete: "Delete"
}

</script>

<template>
    <Head title="Cashiers" />
    <AuthenticatedLayout title_page="Data Kategori">
        <Crud :columns="columns" :columns_data="columns_data" :relation="[[]]" :search="$page.props.search" :data="$page.props.categories" :action="action" url="categories" primary="slug" />
    </AuthenticatedLayout>
</template>

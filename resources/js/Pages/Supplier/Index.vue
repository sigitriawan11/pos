
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

const columns = ['Name', 'Phone', 'Address']
    const columns_data = ['name', 'phone', 'address']
const action = {
    edit: "Edit",
    delete: "Delete"
}

</script>

<template>
    <Head title="Suppliers" />
    <AuthenticatedLayout title_page="Data Suppliers">
        <Crud :columns="columns" :search="$page.props.search" :columns_data="columns_data" :relation="[[]]" :data="$page.props.suppliers" url="suppliers" primary="phone" :action="action" />
    </AuthenticatedLayout>
</template>


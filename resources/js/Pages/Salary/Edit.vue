<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps(['salary'])

const form = useForm({
    name: props.salary.name,
    saldo: props.salary.salary.saldo,
})

const edit = () => {
    Inertia.put(`/salaries/${props.salary.id}`, form)
}
</script>

<template>
    <Head title="Edit Kategori" />

    <AuthenticatedLayout title_page="Tambah Kategori">

        <form @submit.prevent="edit">
            <div class="">

                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                    <input type="text" readonly v-model="form.name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="type here">
                    <p class="text-xs md:text-sm text-red-500" v-if="$page.props.errors.name">{{ $page.props.errors.name }}</p>
                </div>
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Gaji</label>
                    <input type="text" v-model="form.saldo" id="saldo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="type here">
                    <p class="text-xs md:text-sm text-red-500" v-if="$page.props.errors.saldo">{{ $page.props.errors.saldo }}</p>
                </div>
            </div>

            <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 ">Submit</button>
        </form>

    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps(['supplier'])

const form = useForm({
    name: props.supplier.name,
    phone: props.supplier.phone,
    address: props.supplier.address
})

const edit = () => {
    Inertia.put(`/suppliers/${props.supplier.phone}`, form)
}
</script>

<template>
    <Head title="Edit Supplier" />

    <AuthenticatedLayout title_page="Edit Supplier">

        <form @submit.prevent="edit">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-3">
                <div class="">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                    <input type="text" v-model="form.name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="type here">
                    <p class="text-xs md:text-sm text-red-500" v-if="$page.props.errors.name">{{ $page.props.errors.name }}</p>
                </div>
                <div class="">
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">No. HP</label>
                    <input type="number" v-model="form.phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="type here">
                    <p class="text-xs md:text-sm text-red-500" v-if="$page.props.errors.phone">{{ $page.props.errors.phone }}</p>
                </div>
                <div class="">
                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
                    <textarea v-model="form.address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" id="" placeholder="..." cols="15" rows="5"></textarea>
                    <p class="text-xs md:text-sm text-red-500" v-if="$page.props.errors.address">{{ $page.props.errors.address }}</p>
                </div>

            </div>

            <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 ">Submit</button>
        </form>

    </AuthenticatedLayout>
</template>

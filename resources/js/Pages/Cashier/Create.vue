<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

const form = useForm({
    name: "",
    email: "",
    password: "",
    phone: "",
    address: "",
    birth: ""
})

const add = () => {
    Inertia.post('/cashiers', form)
}
</script>

<template>
    <Head title="Kasir" />

    <AuthenticatedLayout title_page="Tambah Kasir">

        <form @submit.prevent="add">
            <div class="md:grid md:grid-cols-2 grid-cols-1 md:gap-x-5">

                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                    <input type="text" v-model="form.name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="type here">
                    <p class="text-xs md:text-sm text-red-500" v-if="$page.props.errors.name">{{ $page.props.errors.name }}</p>
                </div>
                <div class="mb-6">
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900">Email</label>
                    <input type="email" v-model="form.email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="type here">
                    <p class="text-xs md:text-sm text-red-500" v-if="$page.props.errors.email">{{ $page.props.errors.email }}</p>
                </div>
                <div class="mb-6">
                    <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Password</label>
                    <input type="password" v-model="form.password" id="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="type here">
                    <p class="text-xs md:text-sm text-red-500" v-if="$page.props.errors.password">{{ $page.props.errors.password }}</p>
                </div>
                <div class="mb-6">
                    <label for="phone" class="block mb-2 text-sm font-medium text-gray-900">No. HP</label>
                    <input type="number" v-model="form.phone" id="phone" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="type here">
                    <p class="text-xs md:text-sm text-red-500" v-if="$page.props.errors.phone">{{ $page.props.errors.phone }}</p>
                </div>
                <div class="mb-6">
                    <label for="birth" class="block mb-2 text-sm font-medium text-gray-900">Tanggal Lahir</label>
                    <input type="date" id="birth" v-model="form.birth" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="type here">
                    <p class="text-xs md:text-sm text-red-500" v-if="$page.props.errors.birth">{{ $page.props.errors.birth }}</p>
                </div>
                <div class="mb-6">
                    <label for="address" class="block mb-2 text-sm font-medium text-gray-900">Alamat</label>
                    <textarea id="address" v-model="form.address" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="type here"></textarea>
                    <p class="text-xs md:text-sm text-red-500" v-if="$page.props.errors.address">{{ $page.props.errors.address }}</p>
                </div>
            </div>

            <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 ">Submit</button>
        </form>

    </AuthenticatedLayout>
</template>

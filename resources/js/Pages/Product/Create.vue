<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

const form = useForm({
    image: "",
    name: "",
    category_id: "",
    selling_price: "",
    purchase_price: "",
    stock: ""
})

const category = (e) => {
    form.category_id = e.target.value
}

const image = (e) => {
    form.image = e.target.files[0]
}

const add = () => {
    Inertia.post('/products', form)
}
</script>

<template>
    <Head title="Buat Produk" />

    <AuthenticatedLayout title_page="Tambah Produk">

        <form @submit.prevent="add">
            <div class="md:grid md:grid-cols-2 grid-cols-1 md:gap-x-5">
                <div class="mb-6">
                    <label for="image" class="block mb-2 text-sm font-medium text-gray-900">Gambar Produk</label>
                    <input @change="image" class="block w-full file:bg-gray-900 file:text-white file:px-5 file:py-2 text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" id="file_input" type="file">
                    <p class="text-xs md:text-sm text-red-500" v-if="$page.props.errors.image">{{ $page.props.errors.image }}</p>
                </div>
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                    <input type="text" v-model="form.name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="type here">
                    <p class="text-xs md:text-sm text-red-500" v-if="$page.props.errors.name">{{ $page.props.errors.name }}</p>
                </div>
                <div class="mb-6">
                    <label for="category" class="block mb-2 text-sm font-medium text-gray-900">Pilih Kategori</label>
                    <select id="category" @change="category" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        <option selected>Pilih</option>
                        <option :value="category.id" v-for="category in $page.props.categories" :key="category">{{ category.name }}</option>
                    </select>
                    <p class="text-xs md:text-sm text-red-500" v-if="$page.props.errors.category_id">{{ $page.props.errors.category_id }}</p>
                </div>
                <div class="mb-6">
                    <label for="purchase_price" class="block mb-2 text-sm font-medium text-gray-900">Harga Beli</label>
                    <input type="number" v-model="form.purchase_price" id="purchase_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="type here">
                    <p class="text-xs md:text-sm text-red-500" v-if="$page.props.errors.purchase_price">{{ $page.props.errors.purchase_price }}</p>
                </div>
                <div class="mb-6">
                    <label for="selling_price" class="block mb-2 text-sm font-medium text-gray-900">Harga Jual</label>
                    <input type="number" v-model="form.selling_price" id="selling_price" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="type here">
                    <p class="text-xs md:text-sm text-red-500" v-if="$page.props.errors.selling_price">{{ $page.props.errors.selling_price }}</p>
                </div>
                <div class="mb-6">
                    <label for="stock" class="block mb-2 text-sm font-medium text-gray-900">Stock</label>
                    <input type="number" v-model="form.stock" id="stock" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="type here">
                    <p class="text-xs md:text-sm text-red-500" v-if="$page.props.errors.stock">{{ $page.props.errors.stock }}</p>
                </div>
            </div>

            <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 ">Submit</button>
        </form>

    </AuthenticatedLayout>
</template>


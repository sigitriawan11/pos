<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

const form = useForm({
    qty: "",
    total: "",
    description: "",
    product_code: "",
    supplier_id: "",
})

const add = () => {
    Inertia.post('/purchases', form)
}

const product = (e) => {
    form.product_code = e.target.value
}

const supplier = (e) => {
    form.supplier_id = e.target.value
}

</script>

<template>
    <Head title="Tambah Pembelian" />

    <AuthenticatedLayout title_page="Tambah Pembelian">

        <form @submit.prevent="add">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-3">
                <div class="">
                    <label for="product_code" class="block mb-2 text-sm font-medium text-gray-900">Barang</label>
                    <select @change="product" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" id="">
                        <option>Nama Barang</option>
                        <option :value="product.product_code" v-for="product in $page.props.products" :key="product">
                            {{ product.name }}
                        </option>
                    </select>
                    <p class="text-xs md:text-sm text-red-500" v-if="$page.props.errors.product_code">{{ $page.props.errors.product_code }}</p>
                </div>
                <div class="">
                    <label for="qty" class="block mb-2 text-sm font-medium text-gray-900">Jumlah</label>
                    <input type="number" v-model="form.qty" id="qty" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="type here">
                    <p class="text-xs md:text-sm text-red-500" v-if="$page.props.errors.qty">{{ $page.props.errors.qty }}</p>
                </div>
                <div class="">
                    <label for="qty" class="block mb-2 text-sm font-medium text-gray-900">Total</label>
                    <input type="number" v-model="form.total" id="total" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="type here">
                    <p class="text-xs md:text-sm text-red-500" v-if="$page.props.errors.total">{{ $page.props.errors.total }}</p>
                </div>
                <div class="">
                    <label for="supplier_id" class="block mb-2 text-sm font-medium text-gray-900">Supplier</label>
                    <select @change="supplier" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" id="">
                        <option>Nama Supplier</option>
                        <option :value="supplier.id" v-for="supplier in $page.props.suppliers" :key="supplier">
                            {{ supplier.name }}
                        </option>
                    </select>
                    <p class="text-xs md:text-sm text-red-500" v-if="$page.props.errors.supplier_id">{{ $page.props.errors.supplier_id }}</p>
                </div>
                <div class="">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Deskripsi</label>
                    <textarea v-model="form.description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" id="" placeholder="(Optional)" cols="15" rows="5"></textarea>
                    <p class="text-xs md:text-sm text-red-500" v-if="$page.props.errors.description">{{ $page.props.errors.description }}</p>
                </div>

            </div>

            <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 ">Submit</button>
        </form>

    </AuthenticatedLayout>
</template>

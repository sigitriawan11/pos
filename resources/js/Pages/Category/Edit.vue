<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';

const props = defineProps(['category'])

const form = useForm({
    name: props.category.name,
})

const edit = () => {
    Inertia.put(`/categories/${props.category.slug}`, form)
}
</script>

<template>
    <Head title="Edit Kategori" />

    <AuthenticatedLayout title_page="Tambah Kategori">

        <form @submit.prevent="edit">
            <div class="">

                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Nama</label>
                    <input type="text" v-model="form.name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="type here">
                    <p class="text-xs md:text-sm text-red-500" v-if="$page.props.errors.name">{{ $page.props.errors.name }}</p>
                </div>
            </div>

            <button type="submit" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 ">Submit</button>
        </form>

    </AuthenticatedLayout>
</template>

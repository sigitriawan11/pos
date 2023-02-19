<script setup>

import { Inertia } from "@inertiajs/inertia";
import { useForm } from "@inertiajs/inertia-vue3";
import Swal from 'sweetalert2/dist/sweetalert2.js'
import { ref, computed } from "vue"

const change = ref(0)
const data_transaction = ref([])
const total_price = computed(() => {
    let p = 0;
    data_transaction.value.forEach((v, i) => {
        p += v.total_price
    })

    return p
})

const form = useForm({
    total_pay: "",
    transaction_details: data_transaction.value
})

const createTransaction = () => {
    Inertia.post('/transaction/store', form)
}

const data = ref([])


const add = (value, stock) => {

    if(stock != 0){

        data_transaction.value.push({
            image: value.image,
            name: value.name,
            product_code: value.product_code,
            qty: 1,
            total_price: value.selling_price,
            stock: value.stock
        })
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Stock produk ini habis',
            })
    }
}

const removeCart = (value) => {
    data_transaction.value = data_transaction.value.filter((v, i) => {
        if(v.product_code != value){
            return v
        }
    })
}

const addQty = (index, stock) => {
    if(stock == index.qty){
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Stock produk ini hanya ' + stock,
            })
    } else {
        index.total_price = index.total_price / index.qty

        index.qty++
        index.total_price *= index.qty
    }

}
const minQty = (index) => {
    index.total_price = index.total_price / index.qty

    index.qty--
    index.total_price *= index.qty
}


    const total_pay = (e) => {
        change.value = e.target.value - total_price.value
    }

</script>

<template>
     <div>
        <div class="md:flex gap-x-5">
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-5">
                    <div v-for="product in $page.props.products" :key="product" class="shadow-md h-fit">
                        <img :src="`../storage/${product.image}`" class="sm:h-36 h-32 mx-auto md:h-40 lg:h-44" alt="">
                        <div class="py-1">
                            <h3 class="font-semibold text-center text-sm md:text-base">{{ product.name }}</h3>
                        </div>
                        <div>
                            <button type="button"  @click.stop="add(product, product.stock)" class="bg-blue-400 text-white py-1 hover:bg-blue-500 w-full md:text-sm text-xs">Tambahkan</button>
                        </div>
                    </div>
                    <div v-if="!$page.props.products.length">
                        <h3 class="font-bold md:text-3xl text-2xl lg:text-4xl">Data tidak ada</h3>
                    </div>
                </div>
                <form @submit.prevent="createTransaction" class="sticky top-0 bg-gray-100 p-5 shadow-md h-fit max-w-sm w-full md:mt-0 mt-5">
                    <div class="flex flex-col gap-y-2">
                        <div v-for="(d, index) in data_transaction" :key="index" class="flex justify-between bg-white px-2 py-3 rounded relative">
                            <button type="button" @click="removeCart(d.product_code)" class="absolute -top-2 right-1">
                                <font-awesome-icon icon="fa-solid fa-rectangle-xmark"  />
                            </button>
                            <div>
                                <img :src="`../storage/${d.image}`" class="w-24" alt="">
                            </div>
                            <div class="text-right">
                                <h3 class="md:text-base text-sm font-bold">{{ d.name }}</h3>
                                <p class="md:text-sm text-xs">Rp. {{ d.total_price }}</p>
                                <p class="md:text-sm text-xs">Qty : {{ d.qty }}</p>
                                <div class="flex justify-end border border-blue-500 w-fit mt-3">
                                    <button type="button" @click="addQty(d, d.stock)" class="px-3 py-1">+</button>
                                    <div class="px-3 py-1 border-l border-blue-500 border-r">{{ d.qty }}</div>
                                    <button type="button" :disabled="d.qty == 1" @click="minQty(d)"  class="px-3 py-1">-</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-2 mt-3">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Total Harga</label>
                        <input type="number" id="name" :value="total_price" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Total Harga">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900">Total Bayar</label>
                        <input type="number" @keyup="total_pay" v-model="form.total_pay" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Total Bayar">
                        <label for="name"  class="block mb-2 text-sm font-medium text-gray-900">Kembalian</label>
                        <input type="number" id="name" :value="change" readonly class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Kembalian">
                    </div>
                    <button class="px-3 py-3 mt-5 md:text-base text-sm rounded bg-blue-500 text-white text-center hover:bg-blue-600 w-full">Submit</button>
                </form>
            </div>
     </div>
</template>

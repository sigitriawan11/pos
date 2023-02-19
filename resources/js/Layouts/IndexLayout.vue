<script setup>
import { ref } from "vue"
import { Link } from "@inertiajs/inertia-vue3"
import { Inertia } from "@inertiajs/inertia"
import { Head } from "@inertiajs/inertia-vue3"


const open_navbar = ref(false)

const props = defineProps(['title'])

const inputSearch = ref()
const search = () => {
    Inertia.get('/?search=' + inputSearch.value)
}

const logout = () => {
    Inertia.post('/logout')
}

</script>

<template>
    <div>

        <Head :title="props.title">

        </Head>

<nav class="bg-blue-500 border-gray-200 px-2 sm:px-4 py-2.5 text-white sticky top-0 z-50">
  <div class="container px-5 sm:px-10 md:px-12 lg:px-16 flex flex-wrap items-center justify-between mx-auto">
  <Link :href="route('index')" class="flex items-center text-2xl font-semibold">
      POS Online
  </Link>
  <div class="flex md:order-2">
    <button @click="open_navbar = !open_navbar" type="button" data-collapse-toggle="navbar-search" aria-controls="navbar-search" aria-expanded="false" class="md:hidden text-gray-50 hover:text-white  focus:outline-none focus:ring-4 focus:ring-gray-200  rounded-lg text-sm p-2.5 mr-1" >
      <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
      <span class="sr-only">Search</span>
    </button>
    <form @submit.prevent="search" class="relative hidden md:block">
      <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
        <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
        <span class="sr-only">Search icon</span>
      </div>
      <input type="text" v-model="inputSearch" id="search-navbar" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 " placeholder="Cari produk">
    </form>
    <button data-collapse-toggle="navbar-search" @click="open_navbar = !open_navbar" type="button" class="inline-flex items-center p-2 text-sm text-gray-50 hover:text-white rounded-lg md:hidden focus:outline-none focus:ring-2 focus:ring-gray-200 " aria-controls="navbar-search" aria-expanded="false">
      <span class="sr-only">Open menu</span>
      <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
    </button>
  </div>
  <div class="md:block hidden">
    <ul class="flex gap-x-5">
        <li v-if="$page.props.auth.user.Role == 'Admin'"><Link href="/dashboard">Dashboard</Link></li>
        <li><Link href="/transactions">Transaksi</Link></li>
        <li><Link href="/profile">Profil</Link></li>
        <li>
            <form @submit.prevent="logout">
                <button type="submit">Keluar</button>
            </form>
        </li>
    </ul>
  </div>
    <div v-if="open_navbar" class="items-center justify-between w-full md:flex md:w-auto md:order-1" id="navbar-search">
      <form @submit.prevent="search" class="relative mt-3 md:hidden">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
          <svg class="w-5 h-5 text-gray-500" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"></path></svg>
        </div>
        <input type="text" id="search-navbar" v-model="inputSearch" class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 " placeholder="Cari produk">
    </form>
      <ul class="flex flex-col p-4 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:text-sm md:font-medium md:border-0 md:bg-white ">
        <li>
          <Link href="/dashboard" v-if="$page.props.auth.user.Role == 'Admin'" class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 " aria-current="page">Dashboard</Link>
        </li>
        <li>
          <Link href="/transactions" class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 " aria-current="page">Transaksi</Link>
        </li>
        <li>
          <Link href="/profile" class="block py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 " aria-current="page">Profile</Link>
        </li>
        <li>
            <form @submit.prevent="logout" class="block  py-2 pl-3 pr-4 text-gray-700 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 ">
                <button type="submit" class="w-full text-left">Keluar</button>
            </form>
        </li>
      </ul>
    </div>
  </div>
</nav>

    <div class="container px-5 sm:px-10 md:px-12 lg:px-16 mx-auto mt-10">
        <slot />

    </div>
    </div>
</template>

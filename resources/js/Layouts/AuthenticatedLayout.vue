<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/inertia-vue3';

const props = defineProps(['title_page'])

const showingNavigationDropdown = ref(false);
</script>

<template>
    <div>
        <div class="min-h-screen bg-gray-100">
            <nav class="bg-white border-b border-gray-100 w-full fixed top-0 shadow z-20">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="shrink-0 flex items-center">
                                <Link :href="route('dashboard')">
                                    <h3 class="font-bold text-xl md:text-2xl ">POS Online</h3>
                                </Link>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
                                    Dashboard
                                </NavLink>
                                <NavLink :href="route('index')" :active="route().current('index')">
                                    Buat Transaksi
                                </NavLink>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <Dropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                type="button"
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                            >
                                                {{ $page.props.auth.user.name }}

                                                <svg
                                                    class="ml-2 -mr-0.5 h-4 w-4"
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20"
                                                    fill="currentColor"
                                                >
                                                    <path
                                                        fill-rule="evenodd"
                                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                        clip-rule="evenodd"
                                                    />
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <DropdownLink :href="route('profile.edit')"> Profile </DropdownLink>
                                        <DropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </DropdownLink>
                                    </template>
                                </Dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button
                                @click="showingNavigationDropdown = !showingNavigationDropdown"
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                            >
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{
                                            hidden: showingNavigationDropdown,
                                            'inline-flex': !showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"
                                    />
                                    <path
                                        :class="{
                                            hidden: !showingNavigationDropdown,
                                            'inline-flex': showingNavigationDropdown,
                                        }"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"
                                    />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div
                    :class="{ block: showingNavigationDropdown, hidden: !showingNavigationDropdown }"
                    class="sm:hidden"
                >
                    <div class="pt-2 pb-3 space-y-1">
                        <ResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">
                            Dashboard
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('index')" :active="route().current('index')">
                            Transaksi
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('cashiers')" :active="route().current('cashiers')">
                            Kelola Kasir
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('products')" :active="route().current('products')">
                            Kelola Produk
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('categories')" :active="route().current('categories')">
                            Kelola Kategori
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('suppliers')" :active="route().current('suppliers')">
                            Kelola Supplier
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('purchases')" :active="route().current('purchases')">
                            Kelola Pembelian
                        </ResponsiveNavLink>
                        <ResponsiveNavLink :href="route('salaries')" :active="route().current('salaries')">
                            Kelola Pergajian
                        </ResponsiveNavLink>
                    </div>


                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">
                                {{ $page.props.auth.user.name }}
                            </div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <ResponsiveNavLink :href="route('profile.edit')"> Profile </ResponsiveNavLink>
                            <ResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </ResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <!-- <header class="bg-white shadow" v-if="$slots.header">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header" />
                </div>
            </header> -->

            <!-- Page Content -->
            <main class="pt-12">
                <div class="sm:flex block">
                    <div class="sticky bg-white min-w-max min-h-screen sm:block hidden py-10 z-10">
                        <div class="px-3">
                            <div class="flex items-center gap-x-5">
                                <div>
                                    <font-awesome-icon icon="fa-solid fa-user" class="text-2xl text-blue-400" />
                                </div>
                                <div>
                                    <h3>{{ $page.props.auth.user.name }}</h3>
                                    <h3><font-awesome-icon icon="fa-solid fa-circle" class="text-xs text-green-500" /> {{ $page.props.auth.user.Role }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-1 mt-10 gap-y-2">
                            <div class="flex justify-between gap-x-10">
                                <div class="px-3">
                                    <Link href="/cashiers"><font-awesome-icon class="text-blue-400" icon="fa-solid fa-users-rectangle" /> Kelola Kasir</Link>
                                </div>
                            </div>
                            <div class="flex justify-between gap-x-10">
                                <div class="px-3">
                                    <Link href="/products"><font-awesome-icon class="text-blue-400" icon="fa-solid fa-desktop" /> Kelola Produk</Link>
                                </div>
                            </div>
                            <div class="flex justify-between gap-x-10">
                                <div class="px-3">
                                    <Link href="/categories"><font-awesome-icon class="text-blue-400" icon="fa-solid fa-list" /> Kelola Kategori</Link>
                                </div>
                            </div>
                            <div class="flex justify-between gap-x-10">
                                <div class="px-3">
                                    <Link href="/suppliers"><font-awesome-icon class="text-blue-400" icon="fa-solid fa-truck" /> Kelola Supplier</Link>
                                </div>
                            </div>
                            <div class="flex justify-between gap-x-10">
                                <div class="px-3">
                                    <Link href="/purchases"><font-awesome-icon class="text-blue-400" icon="fa-solid fa-money-bill-wave" /> Kelola Pembelian</Link>
                                </div>
                            </div>
                            <div class="flex justify-between gap-x-10">
                                <div class="px-3">
                                    <Link href="/salaries"><font-awesome-icon class="text-blue-400" icon="fa-solid fa-money-bill-wave" /> Kelola Pergajian</Link>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="py-12 overflow-hidden">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <h3 class="font-bold text-2xl mb-5">{{ props.title_page }}</h3>
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 text-gray-900">
                                    <slot />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</template>

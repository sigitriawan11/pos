<script setup>

import { Head } from "@inertiajs/inertia-vue3";
import Layout from "@/Layouts/IndexLayout.vue"
import Products from "@/Pages/ProductIndex.vue"

</script>

<template>
    <div>

        <Layout title="Home">
            <Products :products="$page.props.products" />
        </Layout>
    </div>
</template>

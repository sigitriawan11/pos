<script setup>
    import IndexLayout from "@/Layouts/IndexLayout.vue"
    import ListTransaction from "./ListTransaction.vue"

    const columns = ['Code TRX', 'Total Pay', 'Total Price', 'Change', 'Date']
    const columns_data = ['code_trx', 'total_pay', 'total_price', 'change', 'date_trx']
</script>

<template>
    <IndexLayout title="Transaksi">
        <h3 class="md:text-2xl text-xl font-bold">Semua Transaksi Hari Ini</h3>
        <div class="p-6 rounded-md shadow-md bg-white">
            <ListTransaction :columns="columns" :search="$page.props.search" :columns_data="columns_data" :data="$page.props.transactions" />
        </div>
    </IndexLayout>
</template>

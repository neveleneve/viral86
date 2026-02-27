<template>
    <DashboardLayout>
        Halo
    </DashboardLayout>

    <Head :title="`Pengguna | ${appName1}${appName2}`" />
</template>

<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import { usePage } from '@inertiajs/vue3'

const page = usePage()

const appName1 = page.props.appName1;
const appName2 = page.props.appName2;
</script>

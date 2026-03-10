<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import AdminPageHeader from '@/Components/AdminPageHeader.vue'
import { Head, usePage } from '@inertiajs/vue3'
import { ChevronLeft } from 'lucide-vue-next'

const page = usePage()

defineOptions({ layout: DashboardLayout })

const appName1 = page.props.appName1;
const appName2 = page.props.appName2;
</script>

<template>
    <AdminPageHeader :show-action="$can('view-tag')" title="Tag" subtitle="Postingan" action-label="Kembali"
        action-url="/admin/tag" :breadcrumbs="[
            { label: 'Dashboard', url: '/admin' },
            { label: 'tag', url: '/admin/tag' },
            { label: 'Tambah', url: '#' }
        ]">
        <template #action-icon>
            <ChevronLeft class="w-4 h-4" />
        </template>
    </AdminPageHeader>

    <Head :title="`Tambah Tag | ${appName1}${appName2}`" />
</template>

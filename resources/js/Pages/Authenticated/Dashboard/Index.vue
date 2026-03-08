<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import { Head, usePage } from '@inertiajs/vue3'
import { Newspaper, Users, Eye, TrendingUp } from 'lucide-vue-next'
import { computed } from 'vue'

const page = usePage()
const user = computed(() => page.props.auth.user)

defineOptions({ layout: DashboardLayout })

const appName1 = page.props.appName1;
const appName2 = page.props.appName2;

const stats = [
    { title: 'Total Berita', value: '1,284', icon: Newspaper, color: 'text-red-700' },
    { title: 'Total Pembaca', value: '45.2K', icon: Users, color: 'text-blue-600' },
    { title: 'Tayangan Hari Ini', value: '8,902', icon: Eye, color: 'text-emerald-600' },
    { title: 'Tren Pertumbuhan', value: '+12.5%', icon: TrendingUp, color: 'text-purple-600' },
]
</script>

<template>
    <div class="mb-8">
        <h1 class="text-2xl font-black tracking-tighter text-gray-900 uppercase dark:text-white">
            Dashboard<span class="text-red-700">Utama</span>
        </h1>
        <p class="mt-1 text-[10px] font-bold tracking-widest text-gray-400 uppercase">
            Selamat datang kembali, {{ user ? user.name.split(' ')[0] : 'Tamu' }}!
        </p>
    </div>
    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2 lg:grid-cols-4">
        <div v-for="stat in stats" :key="stat.title"
            class="p-6 bg-white border-l-4 border-red-700 shadow-xl dark:bg-gray-900 shadow-gray-200/50 dark:shadow-none">
            <div class="flex items-center justify-between mb-4">
                <span class="text-[10px] font-black uppercase tracking-widest text-gray-400">{{ stat.title }}</span>
                <component :is="stat.icon" class="w-5 h-5" :class="stat.color" />
            </div>
            <div class="text-3xl font-black tracking-tighter text-gray-900 dark:text-white">
                {{ stat.value }}
            </div>
        </div>
    </div>
    <div class="p-6 bg-white border-l-4 border-red-700 shadow-xl dark:bg-gray-900 shadow-gray-200/50 dark:shadow-none">
        <h2 class="mb-6 text-sm font-black tracking-[0.2em] text-gray-900 uppercase dark:text-white">
            Aktivitas Berita Terakhir
        </h2>
        <div class="overflow-x-auto">
            <div class="text-xs italic text-gray-400">Data aktivitas redaksi akan muncul di sini...</div>
        </div>
    </div>

    <Head :title="`Dashboard | ${appName1}${appName2}`" />
</template>

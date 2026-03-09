<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { ShieldAlert, ArrowLeft, Home, ServerCrash, SearchX } from 'lucide-vue-next'

const props = defineProps({
    status: Number,
    message: String,
    title: String
})

// Ikon dinamis berdasarkan status
const getIcon = () => {
    switch (props.status) {
        case 404: return SearchX;
        case 500: return ServerCrash;
        default: return ShieldAlert;
    }
}
</script>

<template>

    <Head :title="`${status} - ${title}`" />

    <div class="flex items-center justify-center min-h-screen bg-gray-50 dark:bg-gray-950">
        <div class="w-full max-w-sm p-8 bg-white border-l-8 border-red-700 shadow-2xl dark:bg-gray-900">
            <div class="flex flex-col items-center text-center">
                <component :is="getIcon()" class="w-16 h-16 text-red-700 mb-6" />

                <h1 class="text-6xl font-black tracking-tighter text-gray-900 dark:text-white mb-2">
                    {{ status }}
                </h1>

                <p class="text-sm font-black text-gray-500 uppercase tracking-widest mb-2">
                    {{ title }}
                </p>

                <p class="text-xs text-gray-400 mb-8 leading-relaxed">
                    {{ message }}
                </p>

                <Link href="/admin/dashboard"
                    class="flex items-center gap-2 px-8 py-4 text-[10px] font-black text-white uppercase transition-colors bg-gray-900 hover:bg-red-700">
                    <Home class="w-4 h-4" /> Kembali ke Dashboard
                </Link>
            </div>
        </div>
    </div>
</template>

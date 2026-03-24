<script setup>
import { Head, Link } from '@inertiajs/vue3'
import { ShieldAlert, ArrowLeft, Home, ServerCrash, SearchX } from 'lucide-vue-next'

const props = defineProps({
    status: Number,
    message: String,
    title: String
})

const getIcon = () => {
    switch (props.status) {
        case 404: return SearchX;
        case 500: return ServerCrash;
        default: return ShieldAlert;
    }
}
</script>

<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-50 dark:bg-gray-950">
        <div class="w-full max-w-sm p-8 bg-white border-l-8 border-red-700 shadow-2xl dark:bg-gray-900">
            <div class="flex flex-col items-center text-center">
                <component :is="getIcon()" class="w-16 h-16 mb-6 text-red-700" />

                <h1 class="mb-2 text-6xl font-black tracking-tighter text-gray-900 dark:text-white">
                    {{ status }}
                </h1>

                <p class="mb-2 text-sm font-black tracking-widest text-gray-500 uppercase">
                    {{ title }}
                </p>

                <p class="mb-8 text-xs leading-relaxed text-gray-400">
                    {{ message }}
                </p>

                <Link href="/"
                    class="flex items-center gap-2 px-8 py-4 text-[10px] font-black text-white uppercase transition-colors bg-gray-900 hover:bg-red-700">
                    <Home class="w-4 h-4" /> Kembali ke Laman Utana
                </Link>
            </div>
        </div>
    </div>

    <Head :title="`${status} - ${title}`" />
</template>

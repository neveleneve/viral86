<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import { Head } from '@inertiajs/vue3'
import { TrendingUp, Clock, Mail, User } from 'lucide-vue-next'

const mainNews = {
    id: 1,
    category: 'Nasional',
    slug: 'gebrakan-baru-pemerintah-dalam-transformasi-digital-2026-semua-layanan-publik-terintegrasi',
    title: 'Gebrakan Baru Pemerintah dalam Transformasi Digital 2026: Semua Layanan Publik Terintegrasi',
    excerpt: 'Langkah besar diambil pemerintah untuk memastikan efisiensi birokrasi melalui sistem satu pintu berbasis AI yang diharapkan mampu memangkas waktu layanan hingga 80%...',
    author: 'Johan S. Putra',
    date: '2 Jam yang lalu',
    image: 'https://plus.unsplash.com/premium_photo-1754752265556-77115945cde2?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0'
}

const latestNews = [
    { id: 2, category: 'Tekno', slug: 'smartphone-lipat-generasi-terbaru-2026', title: 'Smartphone Lipat Generasi Terbaru Segera Meluncur dengan Baterai Nuklir', date: '3 Jam yang lalu' },
    { id: 3, category: 'Ekonomi', slug: 'harga-emas-rekor-tertinggi-2026', title: 'Harga Emas Mencapai Rekor Tertinggi di Awal Tahun 2026 Akibat Inflasi Global', date: '5 Jam yang lalu' },
    { id: 4, category: 'Olahraga', slug: 'tim-nasional-laga-penentuan', title: 'Tim Nasional Siap Hadapi Laga Penentuan Malam Ini di Stadion Utama', date: '6 Jam yang lalu' },
    { id: 5, category: 'Hiburan', slug: 'konser-dunia-jakarta-2026', title: 'Daftar Artis Internasional yang Akan Menggelar Konser di Jakarta Tahun Ini', date: '7 Jam yang lalu' },
]

const trendingNews = [
    { id: 1, slug: 'cara-cepat-cuan-ai', title: 'Cara Cepat Dapat Cuan dari AI di Tahun 2026', views: 12432 },
    { id: 2, slug: 'resep-viral-mie-instan', title: 'Resep Viral Mie Instan Ala Berandanesia yang Disukai Chef Dunia', views: 8923 },
    { id: 3, slug: 'update-cuaca-ekstrem', title: 'Update Cuaca Ekstrem Pekan Ini: Waspada Badai Tropis', views: 7243 },
]

const formatViewCount = (views) => {
    if (views >= 1000000000) {
        return (views / 1000000000).toFixed(1) + 'b'
    } else if (views >= 1000000) {
        return (views / 1000000).toFixed(1) + 'm'
    } else if (views >= 1000) {
        return (views / 1000).toFixed(1) + 'k'
    }
    return views.toString()
}
</script>

<template>
    <DefaultLayout>
        <div class="grid grid-cols-1 gap-12 lg:grid-cols-12">
            <div class="space-y-16 lg:col-span-8">
                <section>
                    <div
                        class="flex items-center justify-between pb-4 mb-8 border-b border-gray-100 dark:border-gray-800">
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-1.5 bg-red-700"></div>
                            <h2 class="text-2xl font-black tracking-tighter uppercase dark:text-white">
                                Beranda<span class="text-red-700">Terkini</span>
                            </h2>
                        </div>
                        <Link href="/terkini"
                            class="text-[10px] font-bold uppercase tracking-widest text-gray-400 hover:text-red-700 transition-colors">
                            Lihat Semua
                        </Link>
                    </div>

                    <Link :href="`/news/${mainNews.slug}`" class="block group">
                        <article class="relative">
                            <div class="relative overflow-hidden shadow-2xl">
                                <img :src="mainNews.image"
                                    class="w-full h-112.5 object-cover group-hover:scale-105 transition-transform duration-700 ease-out" />
                                <div
                                    class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-60">
                                </div>
                                <div class="absolute left-0 top-6">
                                    <span
                                        class="bg-red-700 text-white text-[10px] font-black px-4 py-2 uppercase tracking-[0.2em] shadow-lg">
                                        {{ mainNews.category }}
                                    </span>
                                </div>
                            </div>
                            <div class="mt-8">
                                <h1
                                    class="text-3xl md:text-5xl font-black text-gray-950 dark:text-white leading-[1.1] tracking-tight group-hover:text-red-700 transition-colors duration-300">
                                    {{ mainNews.title }}
                                </h1>
                                <p
                                    class="mt-5 text-lg font-medium leading-relaxed text-gray-600 dark:text-gray-400 line-clamp-3">
                                    {{ mainNews.excerpt }}
                                </p>
                                <div
                                    class="mt-6 flex items-center gap-4 text-[11px] font-bold uppercase tracking-widest text-gray-400">
                                    <span class="flex items-center gap-1">
                                        <Clock class="h-3.5 w-3.5" /> {{ mainNews.date }}
                                    </span>
                                    <span class="text-gray-200 dark:text-gray-700">|</span>
                                    <a href="#" class="italic">Oleh {{ mainNews.author }}</a>
                                </div>
                            </div>
                        </article>
                    </Link>
                </section>
                <section>
                    <div class="flex items-center gap-3 mb-8">
                        <div class="h-8 w-1.5 bg-gray-900 dark:bg-gray-100"></div>
                        <h2 class="text-2xl font-black tracking-tighter uppercase dark:text-white">
                            Beranda<span class="text-red-700">Nasional</span>
                        </h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-12">
                        <Link v-for="news in latestNews" :key="news.id" :href="`/news/${news.slug}`"
                            class="pl-6 transition-all duration-300 border-l border-gray-100 group dark:border-gray-800 hover:border-red-700">
                            <span class="text-[10px] font-black text-red-700 uppercase tracking-widest block mb-2">
                                {{ news.category }}
                            </span>
                            <h3
                                class="text-xl font-extrabold leading-tight text-gray-900 transition-colors dark:text-gray-100 group-hover:text-red-700">
                                {{ news.title }}
                            </h3>
                            <p
                                class="text-[11px] text-gray-400 mt-3 font-bold uppercase tracking-tighter flex items-center gap-2">
                                <Clock class="w-3 h-3" />
                                {{ news.date }}
                            </p>
                        </Link>
                    </div>
                </section>
            </div>
            <aside class="lg:col-span-4">
                <div class="sticky space-y-12 top-24">
                    <div class="p-6 bg-white border-l-4 border-red-700 shadow-sm dark:border-red-500 dark:bg-gray-800">
                        <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-4">
                            Akses Pembaca
                        </h3>
                        <Link href="/login" class="flex items-center gap-3 group">
                            <div
                                class="p-2 transition-colors bg-gray-100 group-hover:bg-red-700 dark:group-hover:bg-red-500">
                                <User class="w-5 h-5 text-gray-600 group-hover:text-white" />
                            </div>
                            <span
                                class="text-sm font-bold tracking-tighter uppercase transition-colors group-hover:text-red-500 dark:group-hover:bg-red-500">
                                Masuk ke Akun Saya
                            </span>
                        </Link>
                    </div>
                    <div class="p-8 bg-white border-l-4 border-red-700 shadow-xl dark:border-red-500 dark:bg-gray-800">
                        <div class="flex items-center gap-2 pb-4 mb-8 border-b border-gray-50 dark:border-gray-700">
                            <TrendingUp class="w-5 h-5 text-red-700" />
                            <h2 class="text-xl font-black tracking-tighter uppercase dark:text-white">
                                Beranda<span class="text-red-700 dark:text-red-500">Viral</span>
                            </h2>
                        </div>
                        <ul class="space-y-8">
                            <li v-for="(trend, index) in trendingNews" :key="trend.id">
                                <Link :href="`/news/${trend.slug}`" class="flex items-start gap-5 group">
                                    <span
                                        class="text-4xl italic font-black leading-none text-gray-400 transition-colors dark:text-gray-700 group-hover:text-red-500">
                                        0{{ index + 1 }}
                                    </span>
                                    <div>
                                        <h4
                                            class="font-bold leading-snug text-gray-900 transition-colors dark:text-gray-100 group-hover:text-red-500">
                                            {{ trend.title }}
                                        </h4>
                                        <div class="flex items-center gap-2 mt-2">
                                            <div class="w-4 h-px bg-red-700"></div>
                                            <span
                                                class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em]">
                                                {{ formatViewCount(trend.views) }} Pembaca
                                            </span>
                                        </div>
                                    </div>
                                </Link>
                            </li>
                        </ul>
                    </div>
                    <div class="relative p-8 overflow-hidden text-white bg-gray-900 shadow-2xl dark:bg-red-700 group">
                        <div class="relative z-10">
                            <Mail class="w-8 h-8 mb-4 text-red-500 dark:text-white" />
                            <h3 class="text-2xl font-black leading-none tracking-tighter uppercase">Tetap<br />Update.
                            </h3>
                            <div class="mt-6 space-y-3">
                                <input type="email" placeholder="Alamat Email"
                                    class="w-full bg-white/10 border-l-2 border-red-700 dark:border-red-500 p-3 text-sm focus:bg-white/20 outline-none placeholder:text-[10px]" />
                                <button
                                    class="w-full bg-red-700 dark:bg-white dark:text-red-700 py-4 font-black text-xs uppercase tracking-[0.2em] cursor-pointer">
                                    Gabung Sekarang
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </DefaultLayout>

    <Head title="Laman Utama | Berandanesia" />
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3'
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import { TrendingUp, Clock, ChevronRight, Mail } from 'lucide-vue-next'

const mainNews = {
    id: 1,
    category: 'Nasional',
    slug: 'gebrakan-baru-pemerintah-dalam-transformasi-digital-2026-semua-layanan-publik-terintegrasi',
    title: 'Gebrakan Baru Pemerintah dalam Transformasi Digital 2026: Semua Layanan Publik Terintegrasi',
    excerpt: 'Langkah besar diambil pemerintah untuk memastikan efisiensi birokrasi melalui sistem satu pintu berbasis AI yang diharapkan mampu memangkas waktu layanan hingga 80%...',
    author: 'Johan S. Putra',
    date: '2 Jam yang lalu',
    image: 'https://plus.unsplash.com/premium_photo-1754752265556-77115945cde2?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
}

const latestNews = [
    { id: 2, category: 'Tekno', slug: 'smartphone-lipat-generasi-terbaru-2026', title: 'Smartphone Lipat Generasi Terbaru Segera Meluncur dengan Baterai Nuklir', date: '3 Jam yang lalu' },
    { id: 3, category: 'Ekonomi', slug: 'harga-emas-rekor-tertinggi-2026', title: 'Harga Emas Mencapai Rekor Tertinggi di Awal Tahun 2026 Akibat Inflasi Global', date: '5 Jam yang lalu' },
    { id: 4, category: 'Olahraga', slug: 'tim-nasional-laga-penentuan', title: 'Tim Nasional Siap Hadapi Laga Penentuan Malam Ini di Stadion Utama', date: '6 Jam yang lalu' },
    { id: 5, category: 'Hiburan', slug: 'konser-dunia-jakarta-2026', title: 'Daftar Artis Internasional yang Akan Menggelar Konser di Jakarta Tahun Ini', date: '7 Jam yang lalu' },
]

const trendingNews = [
    { id: 1, slug: 'cara-cepat-cuan-ai', title: 'Cara Cepat Dapat Cuan dari AI di Tahun 2026', views: '12.4k' },
    { id: 2, slug: 'resep-viral-mie-instan', title: 'Resep Viral Mie Instan Ala Berandanesia yang Disukai Chef Dunia', views: '8.9k' },
    { id: 3, slug: 'update-cuaca-ekstrem', title: 'Update Cuaca Ekstrem Pekan Ini: Waspada Badai Tropis', views: '7.2k' },
]
</script>

<template>
    <DefaultLayout>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <div class="lg:col-span-8 space-y-16">
                <section>
                    <div
                        class="flex items-center justify-between mb-8 border-b border-gray-100 dark:border-gray-800 pb-4">
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-1.5 bg-red-700"></div>
                            <h2 class="font-black text-2xl tracking-tighter uppercase dark:text-white">
                                Beranda<span class="text-red-700">Terkini</span>
                            </h2>
                        </div>
                        <Link href="/terkini"
                            class="text-[10px] font-bold uppercase tracking-widest text-gray-400 hover:text-red-700 transition-colors">
                            Lihat Semua</Link>
                    </div>
                    <Link :href="`/news/${mainNews.slug}`" class="group block">
                        <article class="relative">
                            <div class="relative overflow-hidden shadow-2xl">
                                <img :src="mainNews.image"
                                    class="w-full h-112.5 object-cover group-hover:scale-105 transition-transform duration-700 ease-out" />
                                <div
                                    class="absolute inset-0 bg-linear-to-t from-black/60 via-transparent to-transparent opacity-60">
                                </div>
                                <div class="absolute top-6 left-0">
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
                                    class="mt-5 text-gray-600 dark:text-gray-400 leading-relaxed text-lg line-clamp-3 font-medium">
                                    {{ mainNews.excerpt }}
                                </p>
                                <div
                                    class="mt-6 flex items-center gap-4 text-[11px] font-bold uppercase tracking-widest text-gray-400">
                                    <span class="flex items-center gap-1">
                                        <Clock class="h-3.5 w-3.5" /> {{ mainNews.date }}
                                    </span>
                                    <span class="text-gray-200 dark:text-gray-700">|</span>
                                    <span class="text-red-700 italic">Oleh {{ mainNews.author }}</span>
                                </div>
                            </div>
                        </article>
                    </Link>
                </section>
                <section>
                    <div class="flex items-center gap-3 mb-8">
                        <div class="h-8 w-1.5 bg-gray-900 dark:bg-gray-100"></div>
                        <h2 class="font-black text-2xl tracking-tighter uppercase dark:text-white">
                            Beranda<span class="text-red-700">Terbaru</span>
                        </h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-12">
                        <Link v-for="news in latestNews" :key="news.id" :href="`/news/${news.slug}`"
                            class="group border-l border-gray-100 dark:border-gray-800 pl-6 hover:border-red-700 transition-all duration-300">
                            <span class="text-[10px] font-black text-red-700 uppercase tracking-widest block mb-2">{{
                                news.category }}</span>
                            <h3
                                class="font-extrabold text-xl text-gray-900 dark:text-gray-100 group-hover:text-red-700 leading-tight transition-colors">
                                {{ news.title }}
                            </h3>
                            <p
                                class="text-[11px] text-gray-400 mt-3 font-bold uppercase tracking-tighter flex items-center gap-2">
                                <Clock class="h-3 w-3" /> {{ news.date }}
                            </p>
                        </Link>
                    </div>
                </section>
            </div>

            <aside class="lg:col-span-4 space-y-12">

                <div class="bg-white dark:bg-gray-800 border-l-4 border-red-700 shadow-xl p-8 transition-all">
                    <div class="flex items-center gap-2 mb-8 border-b border-gray-50 dark:border-gray-700 pb-4">
                        <TrendingUp class="h-5 w-5 text-red-700" />
                        <h2 class="font-black text-xl tracking-tighter uppercase dark:text-white">
                            Beranda<span class="text-red-700">Viral</span>
                        </h2>
                    </div>

                    <ul class="space-y-8">
                        <li v-for="(trend, index) in trendingNews" :key="trend.id">
                            <Link :href="`/news/${trend.slug}`" class="flex gap-5 items-start group">
                                <span
                                    class="text-4xl font-black text-gray-100 dark:text-gray-700 group-hover:text-red-700 transition-colors italic leading-none">
                                    0{{ index + 1 }}
                                </span>
                                <div>
                                    <h4
                                        class="font-bold text-gray-900 dark:text-gray-100 group-hover:text-red-700 leading-snug transition-colors">
                                        {{ trend.title }}
                                    </h4>
                                    <div class="flex items-center gap-2 mt-2">
                                        <div class="h-px w-4 bg-red-700"></div>
                                        <span class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em]">
                                            {{ trend.views }} Pembaca
                                        </span>
                                    </div>
                                </div>
                            </Link>
                        </li>
                    </ul>
                </div>

                <div class="bg-gray-900 dark:bg-red-700 p-8 text-white relative overflow-hidden group shadow-2xl">
                    <div class="relative z-10">
                        <Mail class="h-8 w-8 mb-4 text-red-500 dark:text-white" />
                        <h3 class="font-black text-2xl leading-none uppercase tracking-tighter">Tetap<br />Update.</h3>
                        <p class="text-xs text-gray-400 dark:text-red-100 mt-4 leading-relaxed font-medium">
                            Dapatkan kurasi berita terbaik langsung ke email Anda setiap pagi.
                        </p>
                        <div class="mt-6 space-y-3">
                            <input type="email" placeholder="Alamat Email Anda"
                                class="w-full bg-white/10 border-l-2 border-red-700 dark:border-white p-3 text-sm focus:bg-white/20 outline-none transition-all placeholder:text-gray-500 dark:placeholder:text-gray-200 placeholder:uppercase placeholder:text-[10px] placeholder:font-bold" />
                            <button
                                class="w-full bg-red-700 dark:bg-white dark:text-red-700 py-4 font-black text-xs transition-all uppercase tracking-[0.2em] hover:bg-red-600 dark:hover:bg-gray-100 shadow-lg cursor-pointer">
                                Gabung Sekarang
                            </button>
                        </div>
                    </div>
                    <div
                        class="absolute top-0 right-0 -mr-4 -mt-4 w-24 h-24 bg-red-700/10 dark:bg-white/5 rotate-45 transition-transform group-hover:scale-150 duration-700">
                    </div>
                </div>

                <div
                    class="bg-gray-50 dark:bg-gray-800 border border-dashed border-gray-200 dark:border-gray-700 p-10 flex flex-col items-center justify-center min-h-75 text-center">
                    <span
                        class="text-[10px] font-black text-gray-300 dark:text-gray-600 uppercase tracking-[0.4em] mb-2">Space
                        Advertisement</span>
                    <p class="text-[9px] text-gray-400 uppercase font-medium">Hubungi Redaksi Untuk Pemasangan Iklan</p>
                </div>

            </aside>
        </div>
    </DefaultLayout>

    <Head title="Laman Utama | Berandanesia" />
</template>

<script setup>
import { Head, Link } from '@inertiajs/vue3'
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import { TrendingUp, Clock, ChevronRight } from 'lucide-vue-next'

const mainNews = {
    id: 1,
    category: 'Nasional',
    title: 'Gebrakan Baru Pemerintah dalam Transformasi Digital 2026: Semua Layanan Publik Terintegrasi',
    excerpt: 'Langkah besar diambil pemerintah untuk memastikan efisiensi birokrasi melalui sistem satu pintu berbasis AI...',
    author: 'Admin Viral86',
    date: '2 Jam yang lalu',
    image: 'https://plus.unsplash.com/premium_photo-1754752265556-77115945cde2?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
}

const latestNews = [
    { id: 2, category: 'Tekno', title: 'Smartphone Lipat Generasi Terbaru Segera Meluncur', date: '3 Jam yang lalu' },
    { id: 3, category: 'Ekonomi', title: 'Harga Emas Mencapai Rekor Tertinggi di Awal Tahun 2026', date: '5 Jam yang lalu' },
    { id: 4, category: 'Olahraga', title: 'Tim Nasional Siap Hadapi Laga Penentuan Malam Ini', date: '6 Jam yang lalu' },
]

const trendingNews = [
    { id: 1, title: 'Cara Cepat Dapat Cuan dari AI', views: '12.4k' },
    { id: 2, title: 'Resep Viral Mie Instan Ala Viral86', views: '8.9k' },
    { id: 3, title: 'Update Cuaca Ekstrem Pekan Ini', views: '7.2k' },
]
</script>

<template>
    <DefaultLayout>
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
            <div class="lg:col-span-8 space-y-12">
                <section>
                    <div class="flex items-center gap-2 mb-6">
                        <div class="h-6 w-1 bg-red-700"></div>
                        <h2 class="font-black text-xl tracking-tighter uppercase">Headline Terkini</h2>
                    </div>
                    <article class="group cursor-pointer">
                        <div class="relative overflow-hidden rounded-sm">
                            <img :src="mainNews.image"
                                class="w-full h-100 object-cover group-hover:scale-105 transition-transform duration-500" />
                            <div class="absolute top-4 left-4">
                                <span
                                    class="bg-red-700 text-white text-xs font-bold px-3 py-1 uppercase tracking-widest italic">
                                    {{ mainNews.category }}
                                </span>
                            </div>
                        </div>
                        <div class="mt-6">
                            <h1
                                class="text-3xl md:text-4xl font-extrabold text-gray-950 leading-tight group-hover:text-red-700 transition-colors">
                                {{ mainNews.title }}
                            </h1>
                            <p class="mt-4 text-gray-600 leading-relaxed text-lg">
                                {{ mainNews.excerpt }}
                            </p>
                            <div class="mt-6 flex items-center text-sm text-gray-400 font-medium">
                                <Clock class="h-4 w-4 mr-1" /> {{ mainNews.date }} — Oleh {{ mainNews.author }}
                            </div>
                        </div>
                    </article>
                </section>
                <hr class="border-gray-200" />
                <section>
                    <div class="flex items-center gap-2 mb-6">
                        <div class="h-6 w-1 bg-red-700"></div>
                        <h2 class="font-black text-xl tracking-tighter uppercase">Berita Terbaru</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div v-for="news in latestNews" :key="news.id"
                            class="border-l-2 border-transparent hover:border-red-700 pl-0 hover:pl-4 transition-all duration-300 group">
                            <span class="text-xs font-bold text-red-700 uppercase tracking-wide">
                                {{ news.category }}
                            </span>
                            <h3 class="font-bold text-lg mt-1 group-hover:text-red-700 leading-snug">
                                {{ news.title }}
                            </h3>
                            <p class="text-xs text-gray-400 mt-2">{{ news.date }}</p>
                        </div>
                    </div>
                </section>
            </div>
            <aside class="lg:col-span-4 space-y-10">
                <div class="bg-gray-50 p-6 border-t-4 border-red-700 shadow-sm">
                    <div class="flex items-center gap-2 mb-6 text-gray-900">
                        <TrendingUp class="h-5 w-5 text-red-700" />
                        <h2 class="font-black text-lg tracking-tighter uppercase">Lagi Viral</h2>
                    </div>
                    <ul class="space-y-6">
                        <li v-for="(trend, index) in trendingNews" :key="trend.id" class="flex gap-4 items-start">
                            <span class="text-3xl font-black text-gray-200 italic leading-none">0{{ index + 1 }}</span>
                            <div>
                                <h4 class="font-bold text-gray-900 hover:text-red-700 cursor-pointer leading-tight">
                                    {{ trend.title }}
                                </h4>
                                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1 block">
                                    {{ trend.views }} Pembaca
                                </span>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="p-6 bg-gray-950 text-white relative overflow-hidden">
                    <div class="relative z-10">
                        <h3 class="font-bold text-xl leading-tight">Jangan Ketinggalan Info Viral!</h3>
                        <p class="text-sm text-gray-400 mt-2">Dapatkan update berita terpanas langsung di inbox Anda.
                        </p>
                        <input type="email" placeholder="Email Anda"
                            class="w-full mt-4 bg-gray-800 border-none text-white text-sm p-3 focus:ring-1 focus:ring-red-700 outline-none" />
                        <button
                            class="w-full mt-2 bg-red-700 hover:bg-red-800 py-3 font-bold text-sm transition-colors uppercase tracking-widest">Langganan</button>
                    </div>
                    <div class="absolute bottom-0 right-0 w-16 h-16 bg-red-700/20 -mr-8 -mb-8 rotate-45"></div>
                </div>

            </aside>

        </div>
    </DefaultLayout>

    <Head title="Berita Viral 24 Jam | Viral86 Online" />
</template>

<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Link } from '@inertiajs/vue3';
import { Calendar, User, Share2, Clock, Bookmark, ChevronRight, Facebook, Twitter, Link as LinkIcon } from 'lucide-vue-next'

const article = {
    category: 'Nasional',
    title: 'Pemerintah Sahkan Regulasi Baru Terkait Transisi Energi Terbarukan 2026',
    author: 'Johan S. Putra',
    date: '25 Februari 2026',
    readingTime: '5 Menit Baca',
    image: 'https://plus.unsplash.com/premium_photo-1754752265556-77115945cde2?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
}
</script>

<template>
    <DefaultLayout>
        <div class="min-h-screen transition-colors duration-300">
            <main class="max-w-7xl mx-auto py-8 lg:py-4">
                <nav
                    class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-8 overflow-x-auto whitespace-nowrap">
                    <Link href="/" class="hover:text-red-700">Beranda</Link>
                    <ChevronRight class="h-3 w-3" />
                    <Link href="/nasional" class="hover:text-red-700">{{ article.category }}</Link>
                    <ChevronRight class="h-3 w-3" />
                    <span class="text-gray-300 dark:text-gray-700">Detail Berita</span>
                </nav>

                <div class="flex flex-col lg:flex-row gap-12">
                    <article class="lg:w-2/3">
                        <span
                            class="inline-block border-l-4 border-red-700 pl-4 text-xs font-black uppercase tracking-[0.3em] text-red-700 dark:text-red-500 mb-6">
                            {{ article.category }}
                        </span>

                        <h1
                            class="text-4xl md:text-6xl font-black text-gray-900 dark:text-white tracking-tighter leading-[1.1] mb-8">
                            {{ article.title }}
                        </h1>

                        <div
                            class="flex flex-wrap items-center justify-between border-y border-gray-100 dark:border-gray-800 py-4 mb-10 gap-6">
                            <div
                                class="flex flex-wrap items-center gap-6 text-[11px] font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400">
                                <div class="flex items-center group cursor-pointer">
                                    <div
                                        class="p-2 bg-gray-50 dark:bg-gray-900 rounded-full mr-3 group-hover:bg-red-50 dark:group-hover:bg-red-950 transition-colors">
                                        <User class="h-4 w-4 text-red-700" />
                                    </div>
                                    <span class="dark:group-hover:text-white transition-colors">{{ article.author
                                    }}</span>
                                </div>
                                <div class="flex items-center">
                                    <Calendar class="h-4 w-4 mr-2 text-gray-400" />
                                    {{ article.date }}
                                </div>
                                <div class="flex items-center">
                                    <Clock class="h-4 w-4 mr-2 text-gray-400" />
                                    {{ article.readingTime }}
                                </div>
                            </div>

                            <div class="flex items-center space-x-2">
                                <button class="p-2 hover:text-red-700 dark:text-gray-400 transition-colors">
                                    <Bookmark class="h-5 w-5" />
                                </button>
                                <button class="p-2 hover:text-red-700 dark:text-gray-400 transition-colors">
                                    <Share2 class="h-5 w-5" />
                                </button>
                            </div>
                        </div>

                        <figure class="mb-12 relative">
                            <div class="aspect-video overflow-hidden rounded-sm border-l-8 border-red-700">
                                <img :src="article.image" :alt="article.title"
                                    class="w-full h-full object-cover transition-transform duration-1000 hover:scale-105" />
                            </div>
                            <figcaption
                                class="text-[10px] text-gray-400 dark:text-gray-500 font-bold uppercase tracking-widest mt-4 flex justify-between items-center">
                                <span>Sumber: Unsplash Editorial</span>
                                <span class="text-gray-300 dark:text-gray-700 italic">Berandanesia Exclusive</span>
                            </figcaption>
                        </figure>

                        <div class="prose prose-lg dark:prose-invert max-w-none">
                            <p class="text-gray-800 dark:text-gray-200 text-xl leading-relaxed font-serif mb-8">

                                <strong
                                    class="font-sans text-sm uppercase tracking-widest text-gray-900 dark:text-white border-b-2 border-red-700 pb-1">
                                    Jakarta, Berandanesia —
                                </strong>
                                Pemerintah secara resmi telah mengesahkan regulasi terbaru mengenai percepatan transisi
                                energi terbarukan. Langkah strategis ini diambil sebagai respons terhadap komitmen
                                net-zero emission yang ditargetkan tercapai lebih cepat.
                            </p>

                            <p class="text-gray-700 dark:text-gray-300 text-lg leading-relaxed mb-8">
                                Dalam konferensi pers siang ini, kementerian terkait menegaskan bahwa investasi di
                                sektor energi hijau akan mendapatkan insentif pajak khusus, yang diharapkan dapat
                                menarik lebih banyak investor domestik maupun internasional.
                            </p>

                            <div
                                class="my-12 p-8 bg-gray-50 dark:bg-gray-900/50 border-l-4 border-gray-200 dark:border-gray-800 relative group overflow-hidden">
                                <div
                                    class="absolute top-0 right-0 p-2 text-[9px] font-black uppercase tracking-tighter text-gray-300">
                                    Advertisement</div>
                                <div
                                    class="flex flex-col items-center justify-center min-h-50 border-2 border-dashed border-gray-200 dark:border-gray-800 rounded-lg group-hover:border-red-700/30 transition-colors">
                                    <span
                                        class="text-xs font-black text-gray-400 dark:text-gray-600 uppercase tracking-[0.4em]">Ruang
                                        Iklan Strategis</span>
                                </div>
                            </div>

                            <blockquote
                                class="my-12 border-l-4 border-red-700 pl-8 py-4 bg-red-50/30 dark:bg-red-950/10 relative">
                                <p
                                    class="text-2xl md:text-3xl font-black text-gray-900 dark:text-white leading-tight italic tracking-tight">
                                    "Ini bukan sekadar regulasi, ini adalah komitmen nyata kita untuk masa depan yang
                                    lebih bersih dan ekonomi yang tangguh di tahun 2026."
                                </p>
                                <footer
                                    class="text-xs font-black uppercase tracking-[0.2em] text-red-700 dark:text-red-500 mt-6 flex items-center">
                                    <span class="w-8 h-0.5 bg-red-700 mr-3"></span>
                                    Juru Bicara Kementerian
                                </footer>
                            </blockquote>

                            <p class="text-gray-700 dark:text-gray-300 text-lg leading-relaxed mb-8">
                                Kebijakan ini juga akan berdampak langsung pada sektor industri manufaktur yang
                                diwajibkan secara bertahap menggunakan persentase energi terbarukan dalam operasional
                                mereka mulai akhir kuartal ketiga tahun ini.
                            </p>
                        </div>

                        <div class="flex items-center gap-2 mt-12 pb-12 border-b border-gray-100 dark:border-gray-800">
                            <span class="text-[10px] font-black uppercase text-gray-400 mr-4">Tags:</span>
                            <Link href="#" v-for="tag in ['Energi', 'Regulasi', '2026']" :key="tag"
                                class="px-3 py-1 bg-gray-100 dark:bg-gray-900 text-[10px] font-bold uppercase tracking-widest hover:bg-red-700 hover:text-white transition-all">
                                #{{ tag }}
                            </Link>
                        </div>
                    </article>

                    <aside class="lg:w-1/3 space-y-12">
                        <div class="sticky top-28">
                            <h3
                                class="flex items-center text-sm font-black text-gray-900 dark:text-white tracking-[0.2em] uppercase mb-8">
                                <span class="w-3 h-3 bg-red-700 mr-3"></span>
                                Terpopuler
                            </h3>

                            <div class="space-y-8">
                                <Link href="#" v-for="i in 4" :key="i" class="block group">
                                    <div class="flex gap-4">
                                        <span
                                            class="text-3xl font-black text-gray-400 dark:text-gray-700 group-hover:text-red-700/20 transition-colors leading-none">
                                            0{{ i }}
                                        </span>
                                        <div class="space-y-2">
                                            <span
                                                class="text-[9px] font-black uppercase tracking-widest text-red-700 dark:text-red-500">Ekonomi</span>
                                            <h4
                                                class="font-bold text-gray-800 dark:text-gray-200 group-hover:text-red-700 dark:group-hover:text-red-500 transition-colors leading-snug tracking-tight">
                                                Pembangunan Infrastruktur Tol Baru di Sumatera Akan Dimulai Bulan Depan
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="mt-4 border-b border-gray-50 dark:border-gray-900 w-full"></div>
                                </Link>
                            </div>

                            <div class="mt-12 p-6 bg-gray-900 dark:bg-red-950 rounded-sm overflow-hidden relative">
                                <div class="relative z-10">
                                    <span class="text-[9px] font-bold text-red-500 tracking-[0.3em] uppercase">Edisi
                                        Premium</span>
                                    <h4 class="text-white font-black mt-2 leading-tight">Berlangganan Newsletter
                                        Eksklusif Berandanesia</h4>
                                    <button
                                        class="mt-4 w-full py-3 bg-red-700 text-white text-[10px] font-black uppercase tracking-widest hover:bg-red-600 transition-all">Daftar
                                        Sekarang</button>
                                </div>
                                <div class="absolute -right-4 -bottom-4 opacity-10">
                                    <Share2 class="h-32 w-32 text-white" />
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </main>
        </div>
    </DefaultLayout>
</template>

<style scoped>
.prose p:first-of-type::first-letter {
    initial-letter: 3;
    -webkit-initial-letter: 3;
    padding-right: 10px;
}
</style>

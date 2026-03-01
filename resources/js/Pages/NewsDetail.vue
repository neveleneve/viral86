<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { Calendar, User, Share2, Clock, Bookmark, ChevronRight, Twitter, Info, Facebook } from 'lucide-vue-next'

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
        <!-- <div class="grid grid-cols-1 gap-12 mb-8 lg:grid-cols-12">
            <div class="col-span-1 space-y-16 lg:col-span-12">
                <div
                    class="relative overflow-hidden transition-all duration-300 border-l-4 border-gray-200 bg-gray-50 dark:bg-gray-900/50 dark:border-gray-800 group hover:border-red-700">
                    <div
                        class="absolute top-0 right-0 z-10 flex items-center p-2 text-[8px] font-black uppercase tracking-widest text-white bg-gray-900/40 backdrop-blur-sm">
                        <Info class="w-2.5 h-2.5 mr-1 text-white" />
                        <span>Advertisement</span>
                    </div>
                    <div class="relative w-full overflow-hidden aspect-15/4">
                        <img src="https://images.unsplash.com/photo-1549213821-4708d624e1d1?q=80&w=1332&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Promosi Berandanesia"
                            class="object-cover w-full h-full transition-transform duration-700 group-hover:scale-105" />
                        <div
                            class="absolute inset-0 transition-opacity duration-300 opacity-0 bg-linear-to-t from-red-900/20 to-transparent group-hover:opacity-100">
                        </div>
                    </div>
                    <a target="_blank" href="#" class="absolute inset-0 z-20" aria-label="Buka Iklan"></a>
                </div>
            </div>
        </div> -->
        <div class="min-h-screen transition-colors duration-300">
            <main class="mx-auto max-w-7xl">
                <nav
                    class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-8 overflow-x-auto whitespace-nowrap">
                    <Link href="/" class="hover:text-red-700">Beranda</Link>
                    <ChevronRight class="w-3 h-3 text-gray-800 dark:text-gray-100" />
                    <Link href="/nasional" class="hover:text-red-700">{{ article.category }}</Link>
                    <ChevronRight class="w-3 h-3 text-gray-800 dark:text-gray-100" />
                    <span class="inline-block text-gray-900 truncate dark:text-gray-100 max-w-200">
                        {{ article.title }}
                    </span>
                </nav>
                <div class="flex flex-col gap-12 lg:flex-row">
                    <article class="lg:w-2/3">
                        <span
                            class="inline-block border-l-4 border-red-700 pl-4 text-xs font-black uppercase tracking-[0.3em] text-red-700 dark:text-red-500 mb-6">
                            {{ article.category }}
                        </span>
                        <h1
                            class="text-4xl md:text-6xl font-black text-gray-900 dark:text-white tracking-tighter leading-[1.1] mb-2">
                            {{ article.title }}
                        </h1>
                        <div
                            class="flex flex-col gap-6 py-6 mb-10 border-gray-100 border-y dark:border-gray-800 md:flex-row md:items-center md:justify-between">
                            <div
                                class="flex flex-wrap items-center gap-x-6 gap-y-4 text-[10px] md:text-[11px] font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400">
                                <div class="flex items-center shrink-0">
                                    <Calendar class="w-3.5 h-3.5 mr-2 text-red-700/60" />
                                    {{ article.date }}
                                </div>
                                <div class="flex items-center shrink-0">
                                    <Clock class="w-3.5 h-3.5 mr-2 text-red-700/60" />
                                    {{ article.readingTime }}
                                </div>
                                <div class="items-center hidden cursor-pointer group shrink-0 lg:flex">
                                    <div
                                        class="p-1.5 mr-2.5 transition-all duration-300 rounded-full bg-gray-100 dark:bg-gray-800 group-hover:bg-red-700">
                                        <User
                                            class="w-3.5 h-3.5 text-red-700 group-hover:text-white transition-colors" />
                                    </div>
                                    <span
                                        class="transition-colors group-hover:text-red-700 dark:group-hover:text-white">
                                        {{ article.author }}
                                    </span>
                                </div>
                            </div>
                            <div
                                class="flex flex-wrap items-center gap-x-6 gap-y-4 text-[10px] md:text-[11px] font-bold uppercase tracking-widest text-gray-500 dark:text-gray-400">
                                <div class="flex items-center uppercase cursor-pointer group shrink-0 lg:hidden">
                                    <div
                                        class="p-1.5 mr-2.5 transition-all duration-300 rounded-full bg-gray-100 dark:bg-gray-800 group-hover:bg-red-700">
                                        <User
                                            class="w-3.5 h-3.5 text-red-700 group-hover:text-white transition-colors" />
                                    </div>
                                    <span
                                        class="transition-colors group-hover:text-red-700 dark:group-hover:text-white">
                                        {{ article.author }}
                                    </span>
                                </div>
                            </div>
                            <div
                                class="flex items-center justify-between gap-2 pt-4 border-t border-gray-50 dark:border-gray-800/50 md:pt-0 md:border-t-0 md:justify-end">
                                <span class="text-[9px] font-black uppercase tracking-[0.2em] text-gray-400 md:hidden">
                                    Simpan & Bagikan
                                </span>
                                <div class="flex items-center gap-1">
                                    <button
                                        class="p-2.5 text-gray-400 hover:text-red-700 transition-colors rounded-full hover:bg-red-50 dark:hover:bg-red-950/30">
                                        <Bookmark class="w-5 h-5" />
                                    </button>
                                    <button
                                        class="p-2.5 text-gray-400 hover:text-red-700 transition-colors rounded-full hover:bg-red-50 dark:hover:bg-red-950/30">
                                        <Facebook class="w-5 h-5" />
                                    </button>
                                    <button
                                        class="p-2.5 text-gray-400 hover:text-red-700 transition-colors rounded-full hover:bg-red-50 dark:hover:bg-red-950/30">
                                        <Twitter class="w-5 h-5" />
                                    </button>
                                    <button
                                        class="p-2.5 text-gray-400 hover:text-red-700 transition-colors rounded-full hover:bg-red-50 dark:hover:bg-red-950/30">
                                        <Share2 class="w-5 h-5" />
                                    </button>
                                </div>
                            </div>
                        </div>
                        <figure class="relative mb-12">
                            <div class="overflow-hidden rounded-sm aspect-video">
                                <img :src="article.image" :alt="article.title"
                                    class="object-cover w-full h-full transition-transform duration-1000 hover:scale-105" />
                            </div>
                            <figcaption
                                class="text-[10px] text-gray-400 dark:text-gray-500 font-bold uppercase tracking-widest mt-4 flex justify-between items-center">
                                <span>Sumber: Unsplash Editorial</span>
                                <span class="italic text-gray-300 dark:text-gray-700">Berandanesia Exclusive</span>
                            </figcaption>
                        </figure>
                        <div class="prose prose-lg dark:prose-invert max-w-none">
                            <p class="mb-8 font-serif text-xl leading-relaxed text-gray-800 dark:text-gray-200">

                                <strong
                                    class="pb-1 font-sans text-sm tracking-widest text-gray-900 uppercase border-b-2 border-red-700 dark:text-white">
                                    Jakarta, Berandanesia —
                                </strong>
                                Pemerintah secara resmi telah mengesahkan regulasi terbaru mengenai percepatan transisi
                                energi terbarukan. Langkah strategis ini diambil sebagai respons terhadap komitmen
                                net-zero emission yang ditargetkan tercapai lebih cepat.
                            </p>
                            <p class="mb-8 text-lg leading-relaxed text-gray-700 dark:text-gray-300">
                                Dalam konferensi pers siang ini, kementerian terkait menegaskan bahwa investasi di
                                sektor energi hijau akan mendapatkan insentif pajak khusus, yang diharapkan dapat
                                menarik lebih banyak investor domestik maupun internasional.
                            </p>
                            <div
                                class="relative p-8 my-12 overflow-hidden border-l-4 border-gray-200 bg-gray-50 dark:bg-gray-900/50 dark:border-gray-800 group">
                                <div
                                    class="absolute top-0 right-0 flex items-center p-3 text-[9px] font-black uppercase tracking-widest text-gray-400">
                                    <Info class="w-3 h-3 mr-1.5 text-gray-400" />
                                    <span>Advertisement</span>
                                </div>
                                <div
                                    class="flex flex-col items-center justify-center transition-colors border-2 border-gray-200 border-dashed rounded-lg min-h-50 dark:border-gray-800 group-hover:border-red-700/30">
                                    <span
                                        class="text-xs font-black text-gray-400 dark:text-gray-600 uppercase tracking-[0.4em]">
                                        Ruang Iklan Strategis
                                    </span>
                                </div>
                            </div>
                            <blockquote
                                class="relative py-4 pl-8 my-12 border-l-4 border-red-700 bg-red-50/30 dark:bg-red-950/10">
                                <p
                                    class="text-2xl italic font-black leading-tight tracking-tight text-gray-900 md:text-3xl dark:text-white">
                                    "Ini bukan sekadar regulasi, ini adalah komitmen nyata kita untuk masa depan yang
                                    lebih bersih dan ekonomi yang tangguh di tahun 2026."
                                </p>
                                <footer
                                    class="text-xs font-black uppercase tracking-[0.2em] text-red-700 dark:text-red-500 mt-6 flex items-center">
                                    <span class="w-8 h-0.5 bg-red-700 mr-3"></span>
                                    Juru Bicara Kementerian
                                </footer>
                            </blockquote>
                            <p class="mb-8 text-lg leading-relaxed text-gray-700 dark:text-gray-300">
                                Kebijakan ini juga akan berdampak langsung pada sektor industri manufaktur yang
                                diwajibkan secara bertahap menggunakan persentase energi terbarukan dalam operasional
                                mereka mulai akhir kuartal ketiga tahun ini.
                            </p>
                        </div>
                        <div class="flex items-center gap-2 pb-12 mt-12 border-b border-gray-100 dark:border-gray-800">
                            <span class="text-[10px] font-black uppercase text-gray-400 mr-4">Tags:</span>
                            <Link :href="`/tag/${tag}`" v-for="tag in ['Energi', 'Regulasi', '2026']" :key="tag"
                                class="px-3 py-1 bg-gray-100 dark:bg-gray-900 text-[10px] font-bold uppercase tracking-widest hover:bg-red-700 hover:text-white transition-all">
                                #{{ tag }}
                            </Link>
                        </div>
                    </article>
                    <aside class="space-y-12 lg:w-1/3">
                        <div class="sticky top-28">
                            <h3
                                class="flex items-center text-sm font-black text-gray-900 dark:text-white tracking-[0.2em] uppercase mb-8">
                                <span class="w-3 h-3 mr-3 bg-red-700"></span>
                                Terpopuler
                            </h3>
                            <div class="space-y-8">
                                <Link href="#" v-for="i in 4" :key="i" class="block group">
                                    <div class="flex gap-4">
                                        <span
                                            class="text-3xl font-black leading-none text-red-500 transition-colors group-hover:text-red-400 dark:group-hover:text-red-600">
                                            0{{ i }}
                                        </span>
                                        <div class="space-y-2">
                                            <span
                                                class="text-[9px] font-black uppercase tracking-widest text-red-700 dark:text-red-500">Ekonomi</span>
                                            <h4
                                                class="font-bold leading-snug tracking-tight text-gray-800 transition-colors dark:text-gray-200 group-hover:text-red-700 dark:group-hover:text-red-500">
                                                Pembangunan Infrastruktur Tol Baru di Sumatera Akan Dimulai Bulan Depan
                                            </h4>
                                        </div>
                                    </div>
                                    <div class="w-full mt-4 border-b border-gray-50 dark:border-gray-900"></div>
                                </Link>
                            </div>

                            <div class="relative p-6 mt-12 overflow-hidden bg-gray-900 rounded-sm dark:bg-red-950">
                                <div class="relative z-10">
                                    <span class="text-[9px] font-bold text-red-500 tracking-[0.3em] uppercase">Edisi
                                        Premium</span>
                                    <h4 class="mt-2 font-black leading-tight text-white">Berlangganan Newsletter
                                        Eksklusif Berandanesia</h4>
                                    <button
                                        class="mt-4 w-full py-3 bg-red-700 text-white text-[10px] font-black uppercase tracking-widest hover:bg-red-600 transition-all">Daftar
                                        Sekarang</button>
                                </div>
                                <div class="absolute -right-4 -bottom-4 opacity-10">
                                    <Share2 class="w-32 h-32 text-white" />
                                </div>
                            </div>
                            <div
                                class="relative p-8 my-12 overflow-hidden border-l-4 border-gray-200 bg-gray-50 dark:bg-gray-900/50 dark:border-gray-800 group">
                                <div
                                    class="absolute top-0 right-0 flex items-center p-3 text-[9px] font-black uppercase tracking-widest text-gray-400">
                                    <Info class="w-3 h-3 mr-1.5 text-gray-400" />
                                    <span>Advertisement</span>
                                </div>
                                <div
                                    class="flex flex-col items-center justify-center transition-colors border-2 border-gray-200 border-dashed rounded-lg min-h-50 dark:border-gray-800 group-hover:border-red-700/30">
                                    <span
                                        class="text-xs font-black text-gray-400 dark:text-gray-600 uppercase tracking-[0.4em]">
                                        Ruang Iklan Strategis
                                    </span>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </main>
        </div>
    </DefaultLayout>

    <Head :title="`${article.title} | Berandanesia`" />
</template>

<style scoped>
.prose p:first-of-type::first-letter {
    initial-letter: 3;
    -webkit-initial-letter: 3;
    padding-right: 10px;
}
</style>

<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { Calendar, User, Share2, MessageSquare } from 'lucide-vue-next'

const article = {
    category: 'Nasional',
    title: 'Pemerintah Sahkan Regulasi Baru Terkait Transisi Energi Terbarukan 2026',
    author: 'Tim Redaksi Viral86',
    date: '25 Februari 2026',
    image: 'https://plus.unsplash.com/premium_photo-1754752265556-77115945cde2?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D'
}
</script>

<template>
    <DefaultLayout>
        <div class="min-h-screen bg-white">
            <main class="max-w-7xl mx-auto flex flex-col lg:flex-row gap-10">
                <article class="lg:w-2/3">
                    <!-- <div class="mb-1"> -->
                    <span
                        class="border-l-4 border-red-700 pl-3 text-sm font-black uppercase tracking-widest text-red-700">
                        {{ article.category }}
                    </span>
                    <!-- </div> -->

                    <h1 class="text-3xl md:text-5xl font-black text-gray-900 tracking-tighter leading-tight mb-6">
                        {{ article.title }}
                    </h1>
                    <div
                        class="flex flex-col sm:flex-row sm:items-center justify-between border-y border-gray-100 py-1 mb-8 gap-4">
                        <div
                            class="flex items-center space-x-6 text-[11px] font-bold uppercase tracking-widest text-gray-500">
                            <div class="flex items-center">
                                <User class="h-4 w-4 mr-2 text-gray-400" />
                                {{ article.author }}
                            </div>
                            <div class="flex items-center">
                                <Calendar class="h-4 w-4 mr-2 text-gray-400" />
                                {{ article.date }}
                            </div>
                        </div>

                        <div class="flex items-center space-x-3">
                            <button
                                class="flex items-center cursor-pointer text-[10px] font-bold uppercase tracking-widest text-gray-500 hover:text-red-700 transition-colors bg-gray-50 px-3 py-2 border-l-2 border-transparent hover:border-red-700">
                                <Share2 class="h-4 w-4 mr-2" /> Bagikan
                            </button>
                        </div>
                    </div>

                    <div class="mb-10 group overflow-hidden">
                        <img :src="article.image" :alt="article.title"
                            class="w-full h-auto object-cover bg-gray-100 transition-transform duration-700 group-hover:scale-105" />
                        <p class="text-[10px] text-gray-400 font-medium uppercase tracking-widest mt-2 text-right">Foto:
                            Ilustrasi Unsplash / Viral86</p>
                    </div>

                    <div class="text-gray-800 max-w-none text-lg leading-relaxed font-serif">
                        <p class="mb-6"><strong class="font-sans text-xl uppercase tracking-tighter">
                                Jakarta, Berandanesia - </strong> Pemerintah secara resmi telah mengesahkan regulasi
                            terbaru mengenai percepatan transisi energi terbarukan. Langkah strategis ini diambil
                            sebagai respons terhadap komitmen net-zero emission yang ditargetkan tercapai lebih cepat.
                        </p>

                        <p class="mb-6">
                            Dalam konferensi pers siang ini, kementerian terkait menegaskan bahwa investasi
                            di sektor energi hijau akan mendapatkan insentif pajak khusus, yang diharapkan dapat menarik
                            lebih banyak investor domestik maupun internasional.
                        </p>

                        <div
                            class="bg-gray-50 border-l-4 border-gray-200 p-6 flex items-center justify-center min-h-62.5">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Ruang Iklan</span>
                        </div>

                        <blockquote class="my-8 border-l-4 border-red-700 pl-6 py-2 bg-gray-50 font-sans italic">
                            <p class="text-xl font-bold text-gray-900 leading-snug">
                                "Ini bukan sekadar regulasi, ini adalah komitmen nyata kita untuk masa depan yang lebih
                                bersih dan ekonomi yang tangguh di tahun 2026."
                            </p>
                            <footer class="text-[11px] font-black uppercase tracking-widest text-red-700 mt-4">
                                - Juru Bicara Kementerian
                            </footer>
                        </blockquote>

                        <p class="mb-6">
                            Kebijakan ini juga akan berdampak langsung pada sektor industri manufaktur yang diwajibkan
                            secara bertahap menggunakan persentase energi terbarukan dalam operasional mereka mulai
                            akhir kuartal ketiga tahun ini.
                        </p>

                        <div
                            class="bg-gray-50 border-l-4 border-gray-200 p-6 flex items-center justify-center min-h-62.5">
                            <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Ruang Iklan</span>
                        </div>
                    </div>
                </article>

                <aside class="lg:w-1/3 space-y-10">
                    <div>
                        <h3
                            class="flex items-center text-lg font-black text-gray-900 tracking-tighter uppercase mb-6 border-b-2 border-gray-100 pb-2">
                            <span class="w-2 h-6 bg-red-700 mr-3"></span>
                            Terpopuler
                        </h3>

                        <div class="space-y-6">
                            <Link href="#" v-for="i in 4" :key="i"
                                class="block group pl-4 border-l-2 border-transparent hover:border-red-700 transition-all">
                            <span
                                class="text-[10px] font-black uppercase tracking-widest text-red-700 mb-1 block">Daerah</span>
                            <h4 class="font-bold text-gray-800 group-hover:text-red-700 transition-colors leading-snug">
                                Pembangunan Infrastruktur Tol Baru di Sumatera Akan Dimulai Bulan Depan
                            </h4>
                            </Link>
                        </div>
                    </div>

                    <div class="bg-gray-50 border-l-4 border-gray-200 p-6 flex items-center justify-center min-h-62.5">
                        <span class="text-xs font-bold text-gray-400 uppercase tracking-widest">Ruang Iklan</span>
                    </div>
                </aside>
            </main>
        </div>
    </DefaultLayout>
</template>

<style scoped></style>

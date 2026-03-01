<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import { Head, usePage, Link } from '@inertiajs/vue3'
import { TrendingUp, Clock, Mail, User, Info, ChevronLeft, ChevronRight } from 'lucide-vue-next'
import { computed } from 'vue'
import { Swiper, SwiperSlide } from 'swiper/vue'
import { Navigation, Pagination, Autoplay, EffectFade } from 'swiper/modules'
import 'swiper/css'
import 'swiper/css/navigation'
import 'swiper/css/pagination'
import 'swiper/css/effect-fade'
import { formatViewCount } from '@/Utils/formatters'

const page = usePage()
const user = computed(() => page.props.auth.user)

const sliderNews = [
    {
        id: 1,
        category: 'Nasional',
        slug: 'gebrakan-baru-pemerintah-dalam-transformasi-digital-2026',
        title: 'Gebrakan Baru Pemerintah dalam Transformasi Digital 2026: Semua Layanan Publik Terintegrasi',
        excerpt: 'Langkah besar diambil pemerintah untuk memastikan efisiensi birokrasi melalui sistem satu pintu berbasis AI yang diharapkan mampu memangkas waktu layanan hingga 80%...',
        author: 'Johan S. Putra',
        date: '2 Jam yang lalu',
        image: 'https://plus.unsplash.com/premium_photo-1754752265556-77115945cde2?q=80&w=2070&auto=format&fit=crop'
    },
    {
        id: 2,
        category: 'Ekonomi',
        slug: 'investasi-asing-meningkat-2026',
        title: 'Investasi Asing Meningkat Tajam, Sektor Teknologi Hijau Jadi Primadona di Kuartal I',
        excerpt: 'Laporan terbaru menunjukkan minat investor global terhadap ekosistem energi terbarukan di Indonesia mencapai puncaknya tahun ini dengan nilai kontrak triliunan rupiah...',
        author: 'Siska Amelia',
        date: '4 Jam yang lalu',
        image: 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?q=80&w=2015&auto=format&fit=crop'
    },
    {
        id: 3,
        category: 'Politik',
        slug: 'peta-politik-menuju-pemilu-2029',
        title: 'Peta Politik Menuju Pemilu 2029: Koalisi Besar Mulai Terbentuk di Awal Tahun Ini',
        excerpt: 'Sejumlah partai besar mulai melakukan pertemuan tertutup untuk membahas strategi jangka panjang dan potensi penggabungan kekuatan menjelang kontestasi politik mendatang...',
        author: 'Bambang Heru',
        date: '6 Jam yang lalu',
        image: 'https://images.unsplash.com/photo-1529107386315-e1a2ed48a620?q=80&w=2070&auto=format&fit=crop'
    },
    {
        id: 4,
        category: 'Tekno',
        slug: 'kecerdasan-buatan-nasional-nusantara-1',
        title: 'Kecerdasan Buatan Nasional "Nusantara-1" Resmi Diluncurkan untuk Sektor Pendidikan',
        excerpt: 'Pemerintah bekerja sama dengan talenta lokal meluncurkan LLM pertama yang dioptimalkan untuk bahasa daerah dan kurikulum nasional guna mengakselerasi kualitas belajar...',
        author: 'Rina Wijaya',
        date: '8 Jam yang lalu',
        image: 'https://images.unsplash.com/photo-1677442136019-21780ecad995?q=80&w=2070&auto=format&fit=crop'
    },
    {
        id: 5,
        category: 'Lingkungan',
        slug: 'proyek-ikn-tahap-akhir-2026',
        title: 'Proyek IKN Tahap Akhir: Transformasi Kota Hutan Pintar Pertama di Dunia Hampir Rampung',
        excerpt: 'Pembangunan infrastruktur inti di Ibu Kota Nusantara menunjukkan kemajuan signifikan dengan penerapan sistem transportasi otonom dan pengelolaan energi mandiri...',
        author: 'Aris Setiawan',
        date: '10 Jam yang lalu',
        image: 'https://images.unsplash.com/photo-1449824913935-59a10b8d2000?q=80&w=2070&auto=format&fit=crop'
    }
]

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

const swiperModules = [Navigation, Pagination, Autoplay, EffectFade]
</script>

<template>
    <DefaultLayout>
        <div class="grid grid-cols-1 gap-12 lg:grid-cols-12">
            <div class="space-y-16 lg:col-span-8">
                <section class="relative overflow-hidden group/slider">
                    <Swiper :modules="swiperModules" :slides-per-view="1" :loop="true" :effect="'fade'"
                        :fade-effect="{ crossFade: true }" :autoplay="{ delay: 5000, disableOnInteraction: false }"
                        :navigation="{ prevEl: '.prev-btn', nextEl: '.next-btn' }"
                        :pagination="{ clickable: true, el: '.custom-pagination', }">
                        <SwiperSlide v-for="news in sliderNews" :key="news.id">
                            <Link :href="`/news/${news.slug}`" class="block group">
                                <article class="relative">
                                    <div class="relative overflow-hidden shadow-2xl h-75 md:h-100">
                                        <img :src="news.image"
                                            class="object-cover w-full h-full transition-transform duration-1000 ease-out group-hover:scale-105" />
                                        <div
                                            class="absolute inset-0 bg-linear-to-t from-black/90 via-black/20 to-transparent opacity-90">
                                        </div>
                                        <div class="absolute left-0 z-10 top-2 lg:top-8">
                                            <span
                                                class="bg-red-700 text-white text-[10px] font-black px-5 py-2.5 uppercase tracking-[0.2em] shadow-2xl">
                                                {{ news.category }}
                                            </span>
                                        </div>
                                        <div class="absolute bottom-0 left-0 right-0 z-10 px-6 py-10">
                                            <div class="max-w-4xl pl-6 border-l-4 border-red-700">
                                                <h1
                                                    class="text-xl md:text-2xl lg:text-3xl font-black text-white leading-[1.05] tracking-tight uppercase group-hover:text-red-500 transition-colors duration-300">
                                                    {{ news.title }}
                                                </h1>
                                                <div
                                                    class="mt-6 hidden lg:flex items-center gap-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-300">
                                                    <span class="flex items-center gap-2">
                                                        <Clock class="h-3.5 w-3.5 text-red-700" /> {{ news.date }}
                                                    </span>
                                                    <span class="text-gray-600">/</span>
                                                    <span class="flex items-center gap-2">
                                                        <User class="h-3.5 w-3.5 text-red-700" /> {{ news.author }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                            </Link>
                        </SwiperSlide>
                        <div class="absolute bottom-0 right-0 z-20 flex items-center">
                            <button
                                class="p-2 text-white transition-colors outline-none cursor-pointer prev-btn bg-gray-950/50 backdrop-blur-md hover:bg-red-700">
                                <ChevronLeft class="w-6 h-6" />
                            </button>
                            <button
                                class="p-2 text-white transition-colors outline-none cursor-pointer next-btn bg-gray-950/50 backdrop-blur-md hover:bg-red-700">
                                <ChevronRight class="w-6 h-6" />
                            </button>
                        </div>
                    </Swiper>
                    <div class="static! flex gap-2 mt-6 custom-pagination"></div>
                </section>
                <div
                    class="relative overflow-hidden transition-all duration-300 border-l-4 border-gray-200 bg-gray-50 dark:bg-gray-900/50 dark:border-gray-800 group hover:border-red-700">
                    <div
                        class="absolute top-0 right-0 z-10 flex items-center p-2 text-[8px] font-black uppercase tracking-widest text-white bg-gray-900/40 backdrop-blur-sm">
                        <Info class="w-2.5 h-2.5 mr-1 text-white" />
                        <span>Advertisement</span>
                    </div>
                    <div class="relative w-full overflow-hidden aspect-15/4">
                        <img src="https://images.unsplash.com/photo-1549213821-4708d624e1d1?q=80&w=1332&auto=format&fit=crop"
                            alt="Promosi"
                            class="object-cover w-full h-full transition-transform duration-700 group-hover:scale-105" />
                    </div>
                    <a target="_blank" href="#" class="absolute inset-0 z-20"></a>
                </div>
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
                            <span class="text-[10px] font-black text-red-700 uppercase tracking-widest block mb-2">{{
                                news.category }}</span>
                            <h3
                                class="text-xl font-extrabold leading-tight text-gray-900 transition-colors dark:text-gray-100 group-hover:text-red-700">
                                {{ news.title }}
                            </h3>
                            <p
                                class="text-[11px] text-gray-400 mt-3 font-bold uppercase tracking-tighter flex items-center gap-2">
                                <Clock class="w-3 h-3" /> {{ news.date }}
                            </p>
                        </Link>
                    </div>
                </section>
            </div>

            <aside class="lg:col-span-4">
                <div class="space-y-12">
                    <div v-if="!user"
                        class="hidden p-6 bg-white border-l-4 border-red-700 shadow-sm dark:border-red-500 dark:bg-gray-800 lg:block">
                        <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-4">
                            Akses Pembaca
                        </h3>
                        <Link href="/login" class="flex items-center gap-3 group">
                            <div class="p-2 transition-colors bg-gray-100 group-hover:bg-red-700">
                                <User class="w-5 h-5 text-gray-600 group-hover:text-white" />
                            </div>
                            <span
                                class="text-sm font-bold tracking-tighter uppercase transition-colors group-hover:text-red-500">
                                Masuk ke Akun Saya
                            </span>
                        </Link>
                    </div>
                    <div class="p-8 bg-white border-l-4 border-red-700 shadow-xl dark:border-red-500 dark:bg-gray-800">
                        <div class="flex items-center gap-2 pb-4 mb-8 border-b border-gray-50 dark:border-gray-700">
                            <TrendingUp class="w-5 h-5 text-red-700" />
                            <h2 class="text-xl font-black tracking-tighter uppercase dark:text-white">
                                Beranda<span class="text-red-700">Viral</span>
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
                                            class="font-bold leading-snug text-gray-900 dark:text-gray-100 group-hover:text-red-500">
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
                    <div class="relative p-8 overflow-hidden text-white bg-gray-900 shadow-2xl dark:bg-red-700 group">
                        <Mail class="w-8 h-8 mb-4 text-red-500 dark:text-white" />
                        <h3 class="text-2xl font-black leading-none tracking-tighter uppercase">Tetap<br />Update.</h3>
                        <div class="mt-6 space-y-3">
                            <input type="email" placeholder="Alamat Email"
                                class="w-full p-3 text-sm border-l-2 border-red-700 outline-none bg-white/10 focus:bg-white/20" />
                            <button
                                class="w-full bg-red-700 dark:bg-white dark:text-red-700 py-4 font-black text-xs uppercase tracking-[0.2em]">Gabung
                                Sekarang</button>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </DefaultLayout>

    <Head title="Laman Utama | Berandanesia" />
</template>

<style scoped>
.swiper-slide {
    opacity: 0 !important;
    transition-property: opacity;
}

.swiper-slide-active {
    opacity: 1 !important;
}

.swiper-slide:not(.swiper-slide-active) {
    pointer-events: none;
}

.custom-pagination :deep(.swiper-pagination-bullet) {
    width: 30px;
    height: 4px;
    border-radius: 0;
    background: #4b5563;
    opacity: 1;
    transition: all 0.4s ease;
}

.custom-pagination :deep(.swiper-pagination-bullet-active) {
    background: #b91c1c !important;
    width: 60px;
}
</style>

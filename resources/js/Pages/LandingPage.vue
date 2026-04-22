<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue'
import { Head, usePage, Link } from '@inertiajs/vue3'
import { TrendingUp, Clock, Mail, User, Info, ChevronLeft, ChevronRight, ImageIcon } from 'lucide-vue-next'
import { computed } from 'vue'
import { Swiper, SwiperSlide } from 'swiper/vue'
import { Navigation, Pagination, Autoplay, EffectFade } from 'swiper/modules'
import 'swiper/css'
import 'swiper/css/navigation'
import 'swiper/css/pagination'
import 'swiper/css/effect-fade'
import { formatViewCount, formatRelativeTime, formatDate } from '@/Utils/formatters'

const props = defineProps({
    featuredNews: Array,
    latestNews: Array,
    trendingNews: Array
})

const page = usePage()
const user = computed(() => page.props.auth.user)

const swiperModules = [Navigation, Pagination, Autoplay, EffectFade]
</script>

<template>
    <DefaultLayout>
        <div class="grid grid-cols-1 gap-12 lg:grid-cols-12">
            <div class="lg:col-span-12">
                <section class="relative overflow-hidden group/slider">
                    <Swiper :modules="swiperModules" :slides-per-view="1" :loop="true" :effect="'fade'"
                        :fade-effect="{ crossFade: true }" :autoplay="{ delay: 5000, disableOnInteraction: false }"
                        :navigation="{ prevEl: '.prev-btn', nextEl: '.next-btn' }"
                        :pagination="{ clickable: true, el: '.custom-pagination' }">
                        <SwiperSlide v-for="news in featuredNews" :key="news.id">
                            <Link :href="`/news/${news.category.slug}/${news.slug}`" class="block group">
                                <article class="relative">
                                    <div class="relative overflow-hidden shadow-2xl h-100 md:h-150">
                                        <img v-if="news.media" :src="`/storage/${news.media.directory}`"
                                            class="object-cover w-full h-full transition-transform duration-1000 ease-out group-hover:scale-105"
                                            alt="featured-news" />
                                        <div v-else class="flex items-center justify-center w-full h-full bg-gray-900">
                                            <ImageIcon class="w-12 h-12 text-gray-700" />
                                        </div>
                                        <div
                                            class="absolute inset-0 opacity-90 bg-linear-to-t from-black/95 via-black/50 to-transparent">
                                        </div>
                                        <div class="absolute left-0 z-10 top-4 lg:top-8">
                                            <span
                                                class="bg-red-700 text-white text-[10px] font-black px-5 py-2.5 uppercase tracking-[0.2em] shadow-2xl">
                                                {{ news.category?.name }}
                                            </span>
                                        </div>
                                        <div class="absolute bottom-0 left-0 right-0 z-10 p-10 px-6">
                                            <div class="max-w-4xl pl-6 border-l-4 border-red-700">
                                                <h1
                                                    class="text-2xl md:text-3xl lg:text-4xl font-black text-white leading-[1.1] tracking-tight uppercase group-hover:text-red-500 transition-colors duration-300 line-clamp-2">
                                                    {{ news.title }}
                                                </h1>
                                                <p
                                                    class="hidden mt-4 text-sm font-medium text-gray-300 md:block line-clamp-2">
                                                    {{ news.excerpt }}
                                                </p>
                                                <div
                                                    class="mt-6 flex items-center gap-4 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">
                                                    <span class="flex items-center gap-2">
                                                        <Clock class="h-3.5 w-3.5 text-red-700" />
                                                        {{ formatRelativeTime(news.published_at) }}
                                                    </span>
                                                    <span class="text-gray-600">/</span>
                                                    <span class="flex items-center gap-2">
                                                        <User class="h-3.5 w-3.5 text-red-700" />
                                                        {{ news.user?.name }}
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
                                class="p-3 text-white transition-colors outline-none cursor-pointer prev-btn bg-gray-950/60 backdrop-blur-md hover:bg-red-700">
                                <ChevronLeft class="w-6 h-6" />
                            </button>
                            <button
                                class="p-3 text-white transition-colors outline-none cursor-pointer next-btn bg-gray-950/60 backdrop-blur-md hover:bg-red-700">
                                <ChevronRight class="w-6 h-6" />
                            </button>
                        </div>
                    </Swiper>
                    <div class="static! flex gap-2 mt-6 custom-pagination"></div>
                </section>
            </div>
            <div class="space-y-16 lg:col-span-8">
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
                            Beranda<span class="text-red-700">Terkini</span>
                        </h2>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-12">
                        <Link v-for="news in latestNews" :key="news.id"
                            :href="`/news/${news.category.slug}/${news.slug}`"
                            class="pl-6 transition-all duration-300 border-l border-gray-100 group dark:border-gray-800 hover:border-red-700">
                            <span class="text-[10px] font-black text-red-700 uppercase tracking-widest block mb-2">
                                {{ news.category.name }}
                            </span>
                            <h3
                                class="text-xl font-extrabold leading-tight text-gray-900 transition-colors dark:text-gray-100 group-hover:text-red-700">
                                {{ news.title }}
                            </h3>
                            <p
                                class="text-[11px] text-gray-400 mt-3 font-bold uppercase tracking-tighter flex items-center gap-2">
                                <Clock class="w-3 h-3" /> {{ formatDate(news.published_at) }}
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
                                <Link :href="`/news/${trend.category.slug}/${trend.slug}`"
                                    class="flex items-start gap-5 group">
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
                        class="relative p-8 my-12 overflow-hidden border border-red-200 bg-gray-50 dark:bg-gray-900/50 dark:border-red-800 group">
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
                                class="w-full bg-red-700 dark:bg-white dark:text-red-700 py-4 font-black text-xs uppercase tracking-[0.2em]">
                                Gabung Sekarang
                            </button>
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

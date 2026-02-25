<script setup>
import { ref } from 'vue'
import { Head, Link } from '@inertiajs/vue3' // Added Head import to prevent errors
import { Mail, Lock, ArrowRight, ChevronLeft } from 'lucide-vue-next'

const form = ref({
    email: '',
    password: ''
})
</script>

<template>

    <Head title="Masuk | Berandanesia" />

    <div
        class="min-h-screen bg-gray-50 dark:bg-gray-900 flex flex-col justify-center py-12 px-4 transition-colors duration-300">
        <div class="max-w-md w-full mx-auto">

            <div class="flex justify-center mb-8">
                <Link href="/" class="flex items-center text-3xl hover:opacity-80 transition-all">
                    <span class="text-gray-900 dark:text-gray-100 font-bold tracking-tighter">Beranda</span>
                    <span class="font-extrabold tracking-tighter text-red-700 dark:text-red-500">nesia</span>
                </Link>
            </div>

            <div class="bg-white dark:bg-gray-800 border-l-4 border-red-700 shadow-xl p-8 md:p-10 transition-all">

                <div class="mb-8">
                    <h1 class="text-2xl font-black text-gray-900 dark:text-white tracking-tight uppercase">Masuk</h1>
                    <p class="text-xs text-gray-500 dark:text-gray-400 font-medium uppercase tracking-widest mt-1">Akses
                        Portal Berita</p>
                </div>

                <form @submit.prevent="" class="space-y-6">
                    <div>
                        <label
                            class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500 mb-2">
                            Email / Username
                        </label>
                        <div class="relative group">
                            <Mail
                                class="absolute left-3 top-3.5 h-4 w-4 text-gray-400 group-focus-within:text-red-700 dark:group-focus-within:text-red-500 transition-colors" />
                            <input v-model="form.email" type="text" placeholder="email@contoh.com"
                                class="w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-gray-900/50 text-gray-900 dark:text-white border-l-2 border-gray-200 dark:border-gray-700 focus:border-red-700 dark:focus:border-red-500 outline-none transition-all text-sm placeholder-gray-400 dark:placeholder-gray-500" />
                        </div>
                    </div>

                    <div>
                        <div class="flex justify-between mb-2">
                            <label
                                class="text-[10px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500">Kata
                                Sandi</label>
                            <a href="#"
                                class="text-[10px] font-bold text-red-700 dark:text-red-500 hover:text-gray-900 dark:hover:text-gray-300 uppercase tracking-tighter transition-colors">Lupa?</a>
                        </div>
                        <div class="relative group">
                            <Lock
                                class="absolute left-3 top-3.5 h-4 w-4 text-gray-400 group-focus-within:text-red-700 dark:group-focus-within:text-red-500 transition-colors" />
                            <input v-model="form.password" type="password" placeholder="••••••••"
                                class="w-full pl-10 pr-4 py-3 bg-gray-50 dark:bg-gray-900/50 text-gray-900 dark:text-white border-l-2 border-gray-200 dark:border-gray-700 focus:border-red-700 dark:focus:border-red-500 outline-none transition-all text-sm placeholder-gray-400 dark:placeholder-gray-500" />
                        </div>
                    </div>

                    <button
                        class="w-full bg-gray-900 dark:bg-red-700 hover:bg-red-700 dark:hover:bg-red-600 text-white font-bold py-4 text-sm uppercase tracking-[0.2em] flex items-center justify-center transition-all duration-300 group shadow-md shadow-gray-200 dark:shadow-none">
                        Masuk
                        <ArrowRight class="ml-2 h-4 w-4 transform group-hover:translate-x-1 transition-transform" />
                    </button>
                </form>

                <div class="mt-10 pt-6 border-t border-gray-100 dark:border-gray-700 flex flex-col items-center">
                    <p class="text-[11px] text-gray-500 dark:text-gray-400 font-medium italic">Belum terdaftar di
                        Berandanesia?</p>
                    <Link href="/register"
                        class="mt-2 text-xs font-black uppercase text-gray-900 dark:text-white hover:text-red-700 dark:hover:text-red-500 transition-colors tracking-widest">
                        Buat Akun Baru
                    </Link>

                    <div class="mt-6 w-full flex justify-center">
                        <Link href="/"
                            class="group flex items-center text-[10px] font-bold uppercase text-gray-400 dark:text-gray-500 hover:text-red-700 dark:hover:text-red-500 transition-colors tracking-[0.15em]">
                            <ChevronLeft
                                class="h-3 w-3 mr-1 transform group-hover:-translate-x-1 transition-transform" />
                            Kembali ke Laman Utama
                        </Link>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-center">
                <p class="text-[9px] text-gray-400 dark:text-gray-600 font-bold tracking-[0.4em] uppercase">Berandanesia
                    Media Group &copy; 2026</p>
            </div>
        </div>
    </div>
</template>

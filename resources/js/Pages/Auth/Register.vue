<script setup>
import { ref } from 'vue'
import { Link } from '@inertiajs/vue3'
import { User, Mail, Lock, ArrowRight, ChevronLeft } from 'lucide-vue-next'

const form = ref({
    name: '',
    email: '',
    username: '',
    password: '',
    password_confirmation: ''
})
</script>

<template>
    <div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12 px-4">
        <div class="max-w-md w-full mx-auto">
            <div class="flex justify-center mb-10">
                <Link href="/"
                    class="flex items-center text-4xl border-l-4 border-red-700 pl-4 hover:opacity-90 transition-all">
                    <span class="text-gray-900 font-bold tracking-tighter">Beranda</span>
                    <span class="font-extrabold tracking-tighter text-red-700">nesia</span>
                </Link>
            </div>

            <div class="bg-white border-l-4 border-red-700 shadow-sm p-8 md:p-10">
                <div class="mb-8">
                    <h2 class="text-sm uppercase tracking-[0.2em] font-black text-red-700 mb-1">Registrasi</h2>
                    <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Buat Akun Baru</h1>
                </div>

                <form @submit.prevent="" class="space-y-5">
                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">Nama
                            Lengkap</label>
                        <div class="relative group">
                            <User
                                class="absolute left-3 top-3.5 h-4 w-4 text-gray-400 group-focus-within:text-red-700 transition-colors" />
                            <input v-model="form.name" type="text" placeholder="Masukkan nama Anda"
                                class="w-full pl-10 pr-4 py-3 bg-gray-50 border-l-2 border-gray-300 focus:border-red-700 focus:bg-white outline-none transition-all text-sm" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">
                            Alamat Email</label>
                        <div class="relative group">
                            <Mail
                                class="absolute left-3 top-3.5 h-4 w-4 text-gray-400 group-focus-within:text-red-700 transition-colors" />
                            <input v-model="form.email" type="email" placeholder="email@contoh.com"
                                class="w-full pl-10 pr-4 py-3 bg-gray-50 border-l-2 border-gray-300 focus:border-red-700 focus:bg-white outline-none transition-all text-sm" />
                        </div>
                    </div>

                    <div>
                        <label
                            class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">Username</label>
                        <div class="relative group">
                            <User
                                class="absolute left-3 top-3.5 h-4 w-4 text-gray-400 group-focus-within:text-red-700 transition-colors" />
                            <input v-model="form.username" type="text" placeholder="username"
                                class="w-full pl-10 pr-4 py-3 bg-gray-50 border-l-2 border-gray-300 focus:border-red-700 focus:bg-white outline-none transition-all text-sm" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">
                            Kata Sandi</label>
                        <div class="relative group">
                            <Lock
                                class="absolute left-3 top-3.5 h-4 w-4 text-gray-400 group-focus-within:text-red-700 transition-colors" />
                            <input v-model="form.password" type="password" placeholder="••••••••"
                                class="w-full pl-10 pr-4 py-3 bg-gray-50 border-l-2 border-gray-300 focus:border-red-700 focus:bg-white outline-none transition-all text-sm" />
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-2">
                            Konfirmasi Sandi</label>
                        <div class="relative group">
                            <Lock
                                class="absolute left-3 top-3.5 h-4 w-4 text-gray-400 group-focus-within:text-red-700 transition-colors" />
                            <input v-model="form.password_confirmation" type="password" placeholder="••••••••"
                                class="w-full pl-10 pr-4 py-3 bg-gray-50 border-l-2 border-gray-300 focus:border-red-700 focus:bg-white outline-none transition-all text-sm" />
                        </div>
                    </div>

                    <button
                        class="w-full bg-gray-900 cursor-pointer hover:bg-red-700 text-white font-bold py-4 text-sm uppercase tracking-[0.15em] flex items-center justify-center transition-all duration-300 group mt-4">
                        Daftar Sekarang
                        <ArrowRight class="ml-2 h-4 w-4 transform group-hover:translate-x-1 transition-transform" />
                    </button>
                </form>

                <div class="pt-4 border-t border-gray-100 flex flex-col items-center">
                    <p class="text-xs text-gray-500 font-medium">Sudah memiliki akun?</p>
                    <Link href="/login"
                        class="mt-2 text-xs font-black uppercase text-red-700 hover:text-gray-900 transition-colors tracking-widest">
                        Masuk ke Akun
                    </Link>
                    <div class="mt-4 pt-4 border-t border-gray-50 w-full flex justify-center">
                        <Link href="/"
                            class="text-[10px] font-bold uppercase text-gray-400 hover:text-red-700 transition-colors tracking-widest flex items-center">
                            <ChevronLeft class="h-3 w-3 mr-1" />
                            Kembali ke Laman Utama
                        </Link>
                    </div>
                </div>
            </div>

            <div class="mt-8 text-center">
                <p class="text-[10px] text-gray-400 font-medium tracking-[0.3em] uppercase">Berandanesia Media Group</p>
            </div>
        </div>
    </div>

    <Head title="Register | Berandanesia" />
</template>

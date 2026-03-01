<script setup>
import { watch } from 'vue'
import { usePage, useForm, router, Link, Head } from '@inertiajs/vue3'
import { ArrowRight, Loader2, Lock, Mail } from 'lucide-vue-next'

const page = usePage()

const appName1 = usePage().props.appName1;
const appName2 = usePage().props.appName2;

const form = useForm({
    email: '',
    password: '',
    remember: false
})

const submit = () => {
    form.post('/login')
}
</script>

<template>
    <div
        class="flex flex-col justify-center min-h-screen px-4 py-12 transition-colors duration-300 bg-gray-50 dark:bg-gray-900">
        <div class="w-full max-w-md mx-auto">
            <div class="flex justify-center mb-8">
                <Link href="/" class="flex items-center text-3xl transition-all hover:opacity-80">
                    <span class="font-bold tracking-tighter text-gray-900 dark:text-gray-100">{{ appName1 }}</span>
                    <span class="font-extrabold tracking-tighter text-red-700 dark:text-red-500">{{ appName2 }}</span>
                </Link>
            </div>

            <div class="p-8 transition-all bg-white border-l-4 border-red-700 shadow-xl dark:bg-gray-800 md:p-10">
                <div class="mb-8">
                    <h1 class="text-2xl font-black tracking-tight text-gray-900 uppercase dark:text-white">Masuk</h1>
                    <p class="mt-1 text-xs font-medium tracking-widest text-gray-500 uppercase dark:text-gray-400">Akses
                        Portal Berita</p>
                </div>

                <form @submit.prevent="submit" class="space-y-6">
                    <div>
                        <label
                            class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500 mb-2">
                            Email
                        </label>
                        <div class="relative group">
                            <Mail :class="{ 'text-red-700': form.errors.email }"
                                class="absolute left-3 top-3.5 h-4 w-4 text-gray-400 group-focus-within:text-red-700 transition-colors" />
                            <input v-model="form.email" type="text" required
                                class="w-full py-3 pl-10 pr-4 text-sm text-gray-900 transition-all border-l-2 border-gray-200 outline-none bg-gray-50 dark:bg-gray-900/50 dark:text-white dark:border-gray-700 focus:border-red-700"
                                :class="{ 'border-red-700': form.errors.email }" />
                        </div>
                        <p v-if="form.errors.email"
                            class="text-[10px] text-red-600 font-bold mt-1 uppercase tracking-tight">{{
                                form.errors.email }}</p>
                    </div>

                    <div>
                        <div class="flex justify-between mb-2">
                            <label
                                class="text-[10px] font-bold uppercase tracking-widest text-gray-400 dark:text-gray-500">Kata
                                Sandi</label>
                            <a href="#"
                                class="text-[10px] font-bold text-red-700 dark:text-red-500 hover:text-gray-900 uppercase tracking-tighter transition-colors">Lupa?</a>
                        </div>
                        <div class="relative group">
                            <Lock :class="{ 'text-red-700': form.errors.password }"
                                class="absolute left-3 top-3.5 h-4 w-4 text-gray-400 group-focus-within:text-red-700 transition-colors" />
                            <input v-model="form.password" type="password" required
                                class="w-full py-3 pl-10 pr-4 text-sm text-gray-900 transition-all border-l-2 border-gray-200 outline-none bg-gray-50 dark:bg-gray-900/50 dark:text-white dark:border-gray-700 focus:border-red-700"
                                :class="{ 'border-red-700': form.errors.password }" />
                        </div>
                        <p v-if="form.errors.password"
                            class="text-[10px] text-red-600 font-bold mt-1 uppercase tracking-tight">{{
                                form.errors.password }}</p>
                    </div>

                    <div class="flex items-center mb-6">
                        <div class="flex items-center h-5">
                            <input id="remember" v-model="form.remember" type="checkbox"
                                class="w-4 h-4 text-red-700 transition-colors border-2 border-gray-200 rounded-sm cursor-pointer dark:border-gray-700 bg-gray-50 dark:bg-gray-900 focus:ring-red-700 dark:focus:ring-offset-gray-800 accent-red-700" />
                        </div>
                        <label for="remember"
                            class="ml-3 text-[10px] font-black uppercase tracking-widest text-gray-500 dark:text-gray-400 cursor-pointer select-none">
                            Ingat Saya di Perangkat Ini
                        </label>
                    </div>

                    <button type="submit" :disabled="form.processing"
                        class="w-full bg-gray-900 dark:bg-red-700 hover:bg-red-700 text-white font-bold py-4 text-sm uppercase tracking-[0.2em] flex items-center justify-center transition-all duration-300 group disabled:opacity-70">
                        <span v-if="form.processing" class="flex items-center">
                            <Loader2 class="w-4 h-4 mr-2 animate-spin" /> Menghubungkan...
                        </span>
                        <span v-else class="flex items-center">
                            Masuk
                            <ArrowRight class="w-4 h-4 ml-2 transition-transform transform group-hover:translate-x-1" />
                        </span>
                    </button>
                </form>

            </div>
        </div>
    </div>

    <Head title="Masuk | Berandanesia" />
</template>

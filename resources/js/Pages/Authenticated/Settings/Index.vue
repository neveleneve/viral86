<template>
    <DashboardLayout>
        <div class="mb-8">
            <h1 class="text-2xl font-black tracking-tighter text-gray-900 uppercase dark:text-white">
                Pengaturan <span class="text-red-700">Sistem</span>
            </h1>
            <p class="mt-1 text-[10px] font-bold tracking-widest text-gray-400 uppercase">
                Kelola preferensi akun dan aplikasi Berandanesia
            </p>
        </div>
        <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">
            <div
                class="p-6 bg-white border-l-4 border-red-700 shadow-xl dark:bg-gray-900 shadow-gray-200/50 dark:shadow-none">
                <div class="flex items-center gap-3 mb-6">
                    <User class="w-5 h-5 text-red-700" />
                    <h2 class="text-sm font-black tracking-[0.2em] text-gray-900 uppercase dark:text-white">Profil
                        Pengguna</h2>
                </div>
                <form @submit.prevent="submitProfile" class="space-y-5">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Nama
                            Lengkap</label>
                        <input type="text" v-model="formProfile.name"
                            class="w-full px-4 py-2 mt-2 text-sm font-bold text-gray-900 transition-all border-l-2 border-gray-200 outline-none bg-gray-50 dark:bg-gray-800 dark:border-gray-700 focus:border-red-700 dark:focus:border-red-700 dark:text-white" />
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Email
                            Utama</label>
                        <input type="email" v-model="formProfile.email"
                            class="w-full px-4 py-2 mt-2 text-sm font-bold text-gray-900 transition-all border-l-2 border-gray-200 outline-none bg-gray-50 dark:bg-gray-800 dark:border-gray-700 focus:border-red-700 dark:focus:border-red-700 dark:text-white" />
                    </div>
                    <div class="flex justify-end pt-4">
                        <button type="submit"
                            class="flex items-center gap-2 px-6 py-2 text-[10px] font-black tracking-widest text-white uppercase transition-colors bg-gray-900 dark:bg-red-700 hover:bg-red-700 dark:hover:bg-red-800">
                            <Save class="w-4 h-4" /> Simpan Profil
                        </button>
                    </div>
                </form>
            </div>
            <div
                class="p-6 bg-white border-l-4 border-red-700 shadow-xl dark:bg-gray-900 shadow-gray-200/50 dark:shadow-none">
                <div class="flex items-center gap-3 mb-6">
                    <Shield class="w-5 h-5 text-red-700" />
                    <h2 class="text-sm font-black tracking-[0.2em] text-gray-900 uppercase dark:text-white">Keamanan
                        Akun</h2>
                </div>
                <form @submit.prevent="submitPassword" class="space-y-5">
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400">
                            Password Saat Ini
                        </label>
                        <input type="password"
                            class="w-full px-4 py-2 mt-2 text-sm text-gray-900 transition-all border-l-2 border-gray-200 outline-none bg-gray-50 dark:bg-gray-800 dark:border-gray-700 focus:border-red-700 dark:focus:border-red-700 dark:text-white" />
                    </div>
                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400">Password
                            Baru</label>
                        <input type="password"
                            class="w-full px-4 py-2 mt-2 text-sm text-gray-900 transition-all border-l-2 border-gray-200 outline-none bg-gray-50 dark:bg-gray-800 dark:border-gray-700 focus:border-red-700 dark:focus:border-red-700 dark:text-white" />
                    </div>
                    <div class="flex justify-end pt-4">
                        <button type="submit"
                            class="flex items-center gap-2 px-6 py-2 text-[10px] font-black tracking-widest text-white uppercase transition-colors bg-gray-900 dark:bg-red-700 hover:bg-red-700 dark:hover:bg-red-800">
                            <Save class="w-4 h-4" /> Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </DashboardLayout>

    <Head :title="`Pengaturan | ${appName1}${appName2}`" />
</template>

<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import { usePage, useForm, Head } from '@inertiajs/vue3'
import { Save, User, Shield } from 'lucide-vue-next'

const page = usePage()

const appName1 = page.props.appName1;
const appName2 = page.props.appName2;

const formProfile = useForm({
    name: page.props.auth?.user?.name || '',
    email: page.props.auth?.user?.email || '',
})

const formApp = useForm({
    appName1: appName1,
    appName2: appName2,
})

const submitProfile = () => {
    console.log('Profil disimpan')
}

const submitPassword = () => {
    console.log('Password diubah')
}

const submitApp = () => {
    console.log('Aplikasi diupdate')
}
</script>

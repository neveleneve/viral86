<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import { usePage, useForm, Head } from '@inertiajs/vue3'
import { Save, User, Shield, Eye, EyeOff } from 'lucide-vue-next'
import { ref } from 'vue';

const page = usePage()

defineOptions({ layout: DashboardLayout })

const appName1 = page.props.appName1;
const appName2 = page.props.appName2;

const showOldPassword = ref(false)
const showNewPassword = ref(false)
const showConfirmPassword = ref(false)

const formProfile = useForm({
    username: page.props.auth?.user?.username || '',
    name: page.props.auth?.user?.name || '',
    email: page.props.auth?.user?.email || '',
})

const formPassword = useForm({
    oldPassword: '',
    password: '',
    password_confirmation: '',
})

const submitProfile = () => {
    formProfile.post('/admin/pengaturan/change-profile', {
        preserveScroll: true,
    })
}

const submitPassword = () => {
    formPassword.post('/admin/pengaturan/change-password', {
        preserveScroll: true,
        onSuccess: () => formPassword.reset(),
        onError: () => {
            formPassword.reset('password', 'password_confirmation')
        }
    })
}
</script>

<template>
    <div class="mb-8">
        <h1 class="text-2xl font-black tracking-tighter text-gray-900 uppercase dark:text-white">
            Pengaturan<span class="text-red-700">Sistem</span>
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
                <h2 class="text-sm font-black tracking-[0.2em] text-gray-900 uppercase dark:text-white">
                    Profil Pengguna
                </h2>
            </div>
            <form @submit.prevent="submitProfile" class="space-y-5">
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400">
                        Nama Lengkap
                    </label>
                    <input type="text" v-model="formProfile.name"
                        class="w-full px-4 py-2 mt-2 text-sm font-bold text-gray-900 transition-all border-l-2 border-gray-200 outline-none bg-gray-50 dark:bg-gray-800 dark:border-gray-700 focus:border-red-700 dark:focus:border-red-700 dark:text-white" />
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400">
                        Nama Pengguna
                    </label>
                    <input type="text" v-model="formProfile.username"
                        class="w-full px-4 py-2 mt-2 text-sm font-bold text-gray-900 transition-all border-l-2 border-gray-200 outline-none bg-gray-50 dark:bg-gray-800 dark:border-gray-700 focus:border-red-700 dark:focus:border-red-700 dark:text-white" />
                </div>
                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400">
                        Email Utama
                    </label>
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
                    <div class="relative">
                        <input :type="showOldPassword ? 'text' : 'password'" v-model="formPassword.oldPassword"
                            :class="formPassword.errors.oldPassword ? 'border-red-700' : 'border-gray-200 dark:border-gray-700'"
                            class="w-full px-4 py-2 mt-2 text-sm text-gray-900 transition-all border-l-2 outline-none bg-gray-50 dark:bg-gray-800 dark:text-white focus:border-red-700" />

                        <button type="button" @click="showOldPassword = !showOldPassword"
                            class="absolute text-gray-400 transition-colors right-3 top-1/2 -translate-y-1/4 hover:text-red-700">
                            <component :is="showOldPassword ? EyeOff : Eye" class="w-4 h-4" />
                        </button>
                    </div>
                    <div v-if="formPassword.errors.oldPassword"
                        class="mt-1 text-[9px] font-black text-red-700 uppercase italic">
                        {{ formPassword.errors.oldPassword }}
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400">
                        Password Baru
                    </label>
                    <div class="relative">
                        <input :type="showNewPassword ? 'text' : 'password'" v-model="formPassword.password"
                            :class="formPassword.errors.password ? 'border-red-700' : 'border-gray-200 dark:border-gray-700'"
                            class="w-full px-4 py-2 mt-2 text-sm text-gray-900 transition-all border-l-2 outline-none bg-gray-50 dark:bg-gray-800 dark:text-white focus:border-red-700" />

                        <button type="button" @click="showNewPassword = !showNewPassword"
                            class="absolute text-gray-400 transition-colors right-3 top-1/2 -translate-y-1/4 hover:text-red-700">
                            <component :is="showNewPassword ? EyeOff : Eye" class="w-4 h-4" />
                        </button>
                    </div>
                    <div v-if="formPassword.errors.password"
                        class="mt-1 text-[9px] font-black text-red-700 uppercase italic">
                        {{ formPassword.errors.password }}
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400">
                        Konfirmasi Password Baru
                    </label>
                    <div class="relative">
                        <input :type="showConfirmPassword ? 'text' : 'password'"
                            v-model="formPassword.password_confirmation"
                            class="w-full px-4 py-2 mt-2 text-sm text-gray-900 transition-all border-l-2 border-gray-200 outline-none dark:border-gray-700 bg-gray-50 dark:bg-gray-800 focus:border-red-700 dark:focus:border-red-700 dark:text-white" />

                        <button type="button" @click="showConfirmPassword = !showConfirmPassword"
                            class="absolute text-gray-400 transition-colors right-3 top-1/2 -translate-y-1/4 hover:text-red-700">
                            <component :is="showConfirmPassword ? EyeOff : Eye" class="w-4 h-4" />
                        </button>
                    </div>
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

    <Head :title="`Pengaturan | ${appName1}${appName2}`" />
</template>

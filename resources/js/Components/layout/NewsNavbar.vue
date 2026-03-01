<script setup>
import { ref, onMounted } from 'vue'
import { Search, TextAlignEnd, X, User, Sun, Moon, LogOut } from 'lucide-vue-next'
import { Link, router, usePage } from '@inertiajs/vue3'
import { computed } from 'vue'
import Swal from 'sweetalert2'

const isSidebarOpen = ref(false)
const isDark = ref(false)

const page = usePage()
const user = computed(() => page.props.auth.user)

const appName1 = page.props.appName1;
const appName2 = page.props.appName2;

const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value
}

const toggleTheme = () => {
    isDark.value = !isDark.value

    if (isDark.value) {
        document.documentElement.classList.add('dark')
        localStorage.setItem('theme', 'dark')
    } else {
        document.documentElement.classList.remove('dark')
        localStorage.setItem('theme', 'light')
    }
}

const logout = () => {
    isSidebarOpen.value = false
    const isDarkMode = document.documentElement.classList.contains('dark');
    Swal.fire({
        title: 'Konfirmasi Keluar?',
        text: "Sesi Anda akan diakhiri.",
        icon: 'warning',
        background: isDarkMode ? '#111827' : '#ffffff',
        color: isDarkMode ? '#ffffff' : '#111827',
        showCancelButton: true,
        confirmButtonColor: '#b91c1c',
        cancelButtonColor: '#374151',
        confirmButtonText: 'Keluar',
        cancelButtonText: 'Batal',
        reverseButtons: true,
        customClass: {
            popup: 'rounded-none border-l-4 border-red-700',
            confirmButton: 'text-xs uppercase tracking-widest',
            cancelButton: 'text-xs uppercase tracking-widest'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            router.post('/logout');
        }
    })
}

onMounted(() => {
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches
    if (!localStorage.getItem('theme')) {
        const theme = prefersDark ? 'dark' : 'light'
        localStorage.setItem('theme', theme)
        isDark.value = prefersDark
        if (prefersDark) {
            document.documentElement.classList.add('dark')
        }
    } else {
        if (localStorage.getItem('theme') === 'dark') {
            isDark.value = true
            document.documentElement.classList.add('dark')
        } else {
            isDark.value = false
            document.documentElement.classList.remove('dark')
        }
    }
})
</script>

<template>
    <header
        class="sticky top-0 z-50 py-4 transition-all duration-300 border-b border-gray-100 bg-white/90 dark:bg-gray-900/90 backdrop-blur-md dark:border-gray-800">
        <div class="flex items-center justify-between px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <Link href="/" class="flex items-center text-2xl transition-all hover:opacity-80">
                <span class="font-bold tracking-tighter text-gray-900 dark:text-gray-100">{{ appName1 }}</span>
                <span class="font-extrabold tracking-tighter text-red-700 dark:text-red-500">{{ appName2 }}</span>
            </Link>
            <nav class="items-center hidden space-x-8 md:flex">
                <Link v-for="item in ['Terkini', 'Daerah', 'Nasional', 'Redaksi']" :key="item"
                    :href="`/${item.toLowerCase()}`"
                    class="text-[11px] uppercase tracking-[0.2em] text-gray-500 dark:text-gray-400 hover:text-red-700 dark:hover:text-red-500 font-black transition-colors">
                    {{ item }}
                </Link>
            </nav>
            <div class="items-center hidden space-x-4 md:flex">
                <div class="relative group">
                    <input type="text" placeholder="CARI BERITA..."
                        class="pl-4 pr-10 py-2 border-l-2 border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:border-red-700 transition-all outline-none w-40 lg:w-56 text-[10px] font-bold tracking-widest" />
                    <Search
                        class="absolute right-3 top-2.5 h-4 w-4 text-gray-400 group-focus-within:text-red-700 transition-colors" />
                </div>
                <button @click="toggleTheme"
                    class="p-2 text-gray-500 transition-colors cursor-pointer dark:text-gray-400 hover:text-red-700">
                    <Sun v-if="isDark" class="w-5 h-5" />
                    <Moon v-else class="w-5 h-5" />
                </button>
                <div class="flex items-center pl-4 border-l border-gray-100 dark:border-gray-800">
                    <Link v-if="!user" href="/login" class="flex items-center gap-2 group">
                        <User class="w-5 h-5 text-gray-400 transition-colors group-hover:text-red-700" />
                        <span
                            class="text-[10px] font-black text-gray-900 dark:text-gray-100 uppercase tracking-widest group-hover:text-red-700 transition-colors">
                            Masuk
                        </span>
                    </Link>
                    <div v-else class="flex items-center gap-6">
                        <Link href="/admin/dashboard" class="flex items-center gap-2 text-right group">
                            <div class="flex flex-col">
                                <span
                                    class="text-[8px] font-black text-red-700 uppercase tracking-tighter">Redaksi</span>
                                <span
                                    class="text-[10px] font-bold text-gray-900 dark:text-gray-100 uppercase tracking-widest">
                                    {{ user.name.split(' ')[0] }}
                                </span>
                            </div>
                        </Link>
                        <button @click="logout"
                            class="text-gray-400 transition-colors cursor-pointer hover:text-red-700">
                            <LogOut class="w-4 h-4" />
                        </button>
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-4 md:hidden">
                <button @click="toggleTheme" class="p-2 text-gray-500 cursor-pointer dark:text-gray-400">
                    <Sun v-if="isDark" class="w-5 h-5" />
                    <Moon v-else class="w-5 h-5" />
                </button>
                <button @click="toggleSidebar" class="text-gray-900 dark:text-gray-100">
                    <TextAlignEnd class="h-7 w-7" />
                </button>
            </div>
        </div>
    </header>
    <Transition enter-active-class="transition duration-300 ease-out" enter-from-class="opacity-0"
        enter-to-class="opacity-100" leave-active-class="transition duration-200 ease-in" leave-from-class="opacity-100"
        leave-to-class="opacity-0">
        <div v-if="isSidebarOpen" @click="toggleSidebar"
            class="fixed inset-0 bg-gray-900/80 backdrop-blur-sm z-60 md:hidden"></div>
    </Transition>
    <aside :class="isSidebarOpen ? 'translate-x-0' : 'translate-x-full'"
        class="fixed top-0 right-0 w-full h-full transition-transform duration-500 transform bg-white border-l-4 border-red-700 shadow-2xl max-w-75 dark:bg-gray-900 z-70 md:hidden">
        <div class="flex flex-col h-full p-8">
            <div class="flex items-center justify-between mb-12">
                <span class="font-black text-xs text-gray-400 tracking-[0.3em] uppercase">Menu Utama</span>
                <button @click="toggleSidebar"
                    class="p-2 text-gray-900 rounded-full bg-gray-50 dark:bg-gray-800 dark:text-white">
                    <X class="w-5 h-5" />
                </button>
            </div>
            <nav class="flex flex-col space-y-6">
                <Link v-for="item in ['Terkini', 'Daerah', 'Nasional', 'Redaksi']" :key="item"
                    :href="`/${item.toLowerCase()}`" @click="toggleSidebar"
                    class="text-2xl font-black tracking-tighter text-gray-900 uppercase transition-all dark:text-white hover:text-red-700">
                    {{ item }}
                </Link>
            </nav>
            <div class="pt-6 mt-auto border-t border-gray-100 dark:border-gray-800">
                <div v-if="user" class="space-y-6">
                    <div class="flex items-center gap-3">
                        <div
                            class="flex items-center justify-center w-10 h-10 font-black text-white bg-red-700 rounded-sm">
                            {{ user.name.charAt(0) }}
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Login Sebagai</p>
                            <Link href="/admin/dashboard"
                                class="text-sm font-black text-gray-900 uppercase dark:text-white">{{ user.name }}
                            </Link>
                        </div>
                    </div>
                    <button @click="logout" href="/logout" method="post" as="button"
                        class="flex items-center gap-2 text-xs font-black tracking-widest text-red-700 uppercase">
                        <LogOut class="w-4 h-4" /> Keluar Sesi
                    </button>
                </div>
                <Link v-else href="/login" @click="toggleSidebar"
                    class="flex items-center gap-3 text-lg font-black tracking-widest text-red-700 uppercase">
                    <User class="w-6 h-6" /> Masuk Akun
                </Link>
            </div>
        </div>
    </aside>
</template>

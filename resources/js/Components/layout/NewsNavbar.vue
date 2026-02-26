<script setup>
import { ref, onMounted } from 'vue'
import { Search, TextAlignEnd, X, User, Sun, Moon } from 'lucide-vue-next'

const isSidebarOpen = ref(false)
const isDark = ref(false)

const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
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
            <span class="font-bold tracking-tighter text-gray-900 dark:text-gray-100">Beranda</span>
            <span class="font-extrabold tracking-tighter text-red-700 dark:text-red-500">nesia</span>
            </Link>

            <nav class="items-center hidden space-x-8 md:flex">
                <Link v-for="item in ['Terkini', 'Daerah', 'Nasional']" :key="item" :href="`/${item.toLowerCase()}`"
                    class="text-[11px] uppercase tracking-[0.2em] text-gray-500 dark:text-gray-400 hover:text-red-700 dark:hover:text-red-500 font-black transition-colors">
                {{ item }}
                </Link>
            </nav>

            <div class="items-center hidden space-x-4 md:flex">
                <div class="relative group">
                    <input type="text" placeholder="CARI BERITA..."
                        class="pl-4 pr-10 py-2 border-l-2 border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:border-red-700 dark:focus:border-red-500 transition-all outline-none w-40 lg:w-56 text-[10px] font-bold tracking-widest placeholder:text-gray-400" />
                    <Search
                        class="absolute right-3 top-2.5 h-4 w-4 text-gray-400 group-focus-within:text-red-700 transition-colors" />
                </div>

                <button @click="toggleTheme"
                    class="p-2 text-gray-500 transition-colors cursor-pointer dark:text-gray-400 hover:text-red-700 dark:hover:text-red-500">
                    <Sun v-if="isDark" class="w-5 h-5" />
                    <Moon v-else class="w-5 h-5" />
                </button>

                <Link href="/login"
                    class="flex items-center gap-2 pl-4 border-l border-gray-100 group dark:border-gray-800">
                <User class="w-5 h-5 text-gray-400 transition-colors group-hover:text-red-700" />
                <span
                    class="text-[10px] font-black text-gray-900 dark:text-gray-100 uppercase tracking-widest group-hover:text-red-700 transition-colors">Masuk</span>
                </Link>
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
        class="fixed top-0 right-0 w-full h-full transition-transform duration-500 ease-in-out transform bg-white border-l-4 border-red-700 shadow-2xl max-w-75 dark:bg-gray-900 z-70 md:hidden">
        <div class="flex flex-col h-full p-8">
            <div class="flex items-center justify-between mb-12">
                <span class="font-black text-xs text-gray-400 tracking-[0.3em] uppercase">Navigasi</span>
                <button @click="toggleSidebar"
                    class="p-2 text-gray-900 rounded-full bg-gray-50 dark:bg-gray-800 dark:text-white">
                    <X class="w-5 h-5" />
                </button>
            </div>

            <nav class="flex flex-col space-y-6">
                <Link v-for="item in ['Terkini', 'Daerah', 'Nasional']" :key="item" @click="toggleSidebar"
                    :href="`/${item.toLowerCase()}`"
                    class="flex items-center text-2xl font-black tracking-tighter text-gray-900 uppercase dark:text-white hover:text-red-700 dark:hover:text-red-500 group">
                <span
                    class="w-0 h-1 mr-0 transition-all duration-300 bg-red-700 group-hover:w-3 group-hover:mr-4"></span>
                {{ item }}
                </Link>

                <div class="pt-6 mt-6 border-t border-gray-100 dark:border-gray-800">
                    <Link @click="toggleSidebar" href="/login"
                        class="flex items-center gap-3 text-lg font-black tracking-widest text-red-700 uppercase">
                    <User class="w-5 h-5" />
                    Akun Saya
                    </Link>
                </div>
            </nav>

            <div class="mt-auto">
                <p class="text-[9px] text-gray-400 font-bold tracking-[0.4em] uppercase">Berandanesia Media Group</p>
            </div>
        </div>
    </aside>
</template>

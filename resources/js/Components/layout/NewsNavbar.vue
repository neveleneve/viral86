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
    if (localStorage.getItem('theme') === 'dark') {
        isDark.value = true
        document.documentElement.classList.add('dark')
    }
})
</script>

<template>
    <header
        class="bg-white/90 dark:bg-gray-900/90 backdrop-blur-md border-b border-gray-100 dark:border-gray-800 py-4 sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-4 sm:px-6 lg:px-8">

            <Link href="/" class="flex items-center text-2xl hover:opacity-80 transition-all">
            <span class="text-gray-900 dark:text-gray-100 font-bold tracking-tighter">Beranda</span>
            <span class="font-extrabold tracking-tighter text-red-700 dark:text-red-500">nesia</span>
            </Link>

            <nav class="hidden md:flex items-center space-x-8">
                <Link v-for="item in ['Terkini', 'Daerah', 'Nasional']" :key="item" :href="`/${item.toLowerCase()}`"
                    class="text-[11px] uppercase tracking-[0.2em] text-gray-500 dark:text-gray-400 hover:text-red-700 dark:hover:text-red-500 font-black transition-colors">
                {{ item }}
                </Link>
            </nav>

            <div class="hidden md:flex items-center space-x-4">
                <div class="relative group">
                    <input type="text" placeholder="CARI BERITA..."
                        class="pl-4 pr-10 py-2 border-l-2 border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:border-red-700 dark:focus:border-red-500 transition-all outline-none w-40 lg:w-56 text-[10px] font-bold tracking-widest placeholder:text-gray-400" />
                    <Search
                        class="absolute right-3 top-2.5 h-4 w-4 text-gray-400 group-focus-within:text-red-700 transition-colors" />
                </div>

                <button @click="toggleTheme"
                    class="p-2 text-gray-500 dark:text-gray-400 hover:text-red-700 dark:hover:text-red-500 transition-colors">
                    <Sun v-if="isDark" class="h-5 w-5" />
                    <Moon v-else class="h-5 w-5" />
                </button>

                <Link href="/login"
                    class="flex items-center gap-2 group border-l border-gray-100 dark:border-gray-800 pl-4">
                <User class="h-5 w-5 text-gray-400 group-hover:text-red-700 transition-colors" />
                <span
                    class="text-[10px] font-black text-gray-900 dark:text-gray-100 uppercase tracking-widest group-hover:text-red-700 transition-colors">Masuk</span>
                </Link>
            </div>

            <div class="flex items-center space-x-4 md:hidden">
                <button @click="toggleTheme" class="p-2 text-gray-500 dark:text-gray-400">
                    <Sun v-if="isDark" class="h-5 w-5" />
                    <Moon v-else class="h-5 w-5" />
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
        class="fixed top-0 right-0 w-full max-w-75 h-full bg-white dark:bg-gray-900 z-70 shadow-2xl transform transition-transform duration-500 ease-in-out md:hidden border-l-4 border-red-700">
        <div class="p-8 flex flex-col h-full">
            <div class="flex justify-between items-center mb-12">
                <span class="font-black text-xs text-gray-400 tracking-[0.3em] uppercase">Navigasi</span>
                <button @click="toggleSidebar"
                    class="p-2 bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white rounded-full">
                    <X class="h-5 w-5" />
                </button>
            </div>

            <nav class="flex flex-col space-y-6">
                <Link v-for="item in ['Terkini', 'Daerah', 'Nasional']" :key="item" @click="toggleSidebar"
                    :href="`/${item.toLowerCase()}`"
                    class="text-2xl font-black text-gray-900 dark:text-white hover:text-red-700 dark:hover:text-red-500 flex items-center group uppercase tracking-tighter">
                <span
                    class="w-0 group-hover:w-3 h-1 bg-red-700 mr-0 group-hover:mr-4 transition-all duration-300"></span>
                {{ item }}
                </Link>

                <div class="pt-6 mt-6 border-t border-gray-100 dark:border-gray-800">
                    <Link @click="toggleSidebar" href="/login"
                        class="text-lg font-black text-red-700 flex items-center gap-3 uppercase tracking-widest">
                    <User class="h-5 w-5" />
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

<script setup>
import { ref } from 'vue'
import { Search, TextAlignEnd, X, User } from 'lucide-vue-next' // Tambahkan ikon User

const isSidebarOpen = ref(false)

const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value;
}
</script>

<template>
    <header class="bg-white border-b border-gray-200 py-3 sticky top-0 z-50 shadow-sm">
        <div class="max-w-7xl mx-auto flex justify-between items-center px-4 sm:px-6 lg:px-8">
            <Link href="/"
                class="flex items-center text-2xl border-l-4 md:border-0 border-red-700 pl-3 md:pl-0 hover:opacity-90 group transition-all duration-300">
                <span class="text-gray-900 font-bold tracking-tighter">Beranda</span>
                <span class="font-extrabold tracking-tighter text-red-700">nesia</span>
            </Link>

            <nav class="hidden md:flex items-center space-x-6">
                <Link href="/"
                    class="text-sm uppercase tracking-wider text-gray-600 hover:text-red-700 font-bold transition-colors">
                    Terkini
                </Link>
                <Link href="/daerah"
                    class="text-sm uppercase tracking-wider text-gray-600 hover:text-red-700 font-bold transition-colors">
                    Daerah
                </Link>
                <Link href="/nasional"
                    class="text-sm uppercase tracking-wider text-gray-600 hover:text-red-700 font-bold transition-colors">
                    Nasional
                </Link>
            </nav>

            <div class="hidden md:flex items-center space-x-4">
                <div class="relative">
                    <input type="text" placeholder="Cari berita..."
                        class="pl-4 pr-10 py-1.5 border-l-2 border-gray-300 bg-gray-50 focus:bg-white focus:border-red-700 focus:ring-0 text-sm transition-all outline-none w-40 lg:w-48" />
                    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                        <Search class="h-4 w-4 text-gray-400" />
                    </div>
                </div>

                <Link href="/login" class="flex items-center space-x-2 px-3 py-1.5 border-l-2 border-transparent hover:border-red-700 hover:bg-gray-50 transition-all duration-200 group">
                    <User class="h-5 w-5 text-gray-500 group-hover:text-red-700" />
                    <span class="text-sm font-bold text-gray-700 group-hover:text-red-700 uppercase tracking-tight">Masuk / Daftar</span>
                </Link>
            </div>

            <button @click="toggleSidebar" class="md:hidden text-gray-600 hover:text-red-700 transition-colors">
                <TextAlignEnd class="h-7 w-7" />
            </button>
        </div>
    </header>

    <Transition enter-active-class="transition duration-300 ease-out" enter-from-class="opacity-0"
        enter-to-class="opacity-100" leave-active-class="transition duration-200 ease-in" leave-from-class="opacity-100"
        leave-to-class="opacity-0">
        <div v-if="isSidebarOpen" @click="toggleSidebar"
            class="fixed inset-0 bg-black/60 z-60 backdrop-blur-[2px] md:hidden"></div>
    </Transition>

    <aside :class="isSidebarOpen ? 'translate-x-0' : 'translate-x-full'"
        class="fixed top-0 right-0 w-full max-w-sm h-full bg-white z-70 shadow-2xl transform transition-transform duration-300 ease-in-out md:hidden border-l-4 border-red-700">
        <div class="p-6 flex flex-col h-full">
            <div class="flex justify-between items-center mb-8">
                <span class="font-extrabold text-gray-900 tracking-tight border-b-2 border-red-700">MENU UTAMA</span>
                <button @click="toggleSidebar" class="p-1 text-gray-500 hover:text-red-700">
                    <X class="h-6 w-6" />
                </button>
            </div>

            <div class="relative mb-8">
                <input type="text" placeholder="Cari berita..."
                    class="w-full pl-4 pr-10 py-3 border-b-2 border-gray-100 focus:border-red-700 transition-all outline-none text-lg font-medium" />
                <Search class="absolute right-3 top-3.5 h-6 w-6 text-gray-300" />
            </div>

            <nav class="flex flex-col space-y-4">
                <Link @click="toggleSidebar" href="/"
                    class="text-xl font-bold text-gray-800 hover:text-red-700 flex items-center group">
                    <span class="w-0 group-hover:w-2 h-6 bg-red-700 mr-0 group-hover:mr-3 transition-all duration-300"></span>
                    Terkini
                </Link>
                <Link @click="toggleSidebar" href="/daerah"
                    class="text-xl font-bold text-gray-800 hover:text-red-700 flex items-center group">
                    <span class="w-0 group-hover:w-2 h-6 bg-red-700 mr-0 group-hover:mr-3 transition-all duration-300"></span>
                    Daerah
                </Link>
                <Link @click="toggleSidebar" href="/nasional"
                    class="text-xl font-bold text-gray-800 hover:text-red-700 flex items-center group">
                    <span class="w-0 group-hover:w-2 h-6 bg-red-700 mr-0 group-hover:mr-3 transition-all duration-300"></span>
                    Nasional
                </Link>

                <hr class="border-gray-100 my-2">

                <Link @click="toggleSidebar" href="/login"
                    class="text-xl font-bold text-red-700 flex items-center group bg-red-50/50 py-2">
                    <span class="w-2 h-6 bg-red-700 mr-3 transition-all duration-300"></span>
                    <User class="h-6 w-6 mr-2" />
                    Akun Saya
                </Link>
            </nav>

            <div class="mt-auto pb-6">
                <p class="text-xs text-gray-400 font-medium tracking-widest uppercase">Berandanesia.com</p>
            </div>
        </div>
    </aside>
</template>

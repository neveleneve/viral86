<script setup>
import { ref, onMounted, onBeforeUnmount } from 'vue'
import { Sun, Moon } from 'lucide-vue-next'
import AdminSidebar from '@/Components/layout/AdminSidebar.vue'
import AdminNavbar from '@/Components/layout/AdminNavbar.vue'

const isSidebarOpen = ref(true)
const isDark = ref(false)

const syncSidebarByViewport = () => {
    isSidebarOpen.value = window.innerWidth >= 1024
}

const toggleSidebar = () => {
    isSidebarOpen.value = !isSidebarOpen.value
}

const toggleTheme = () => {
    isDark.value = !isDark.value
    document.documentElement.classList.toggle('dark')
    localStorage.setItem('theme', isDark.value ? 'dark' : 'light')
}

onMounted(() => {
    if (localStorage.getItem('theme') === 'dark') {
        isDark.value = true
        document.documentElement.classList.add('dark')
    }

    syncSidebarByViewport()
    window.addEventListener('resize', syncSidebarByViewport)
})

onBeforeUnmount(() => {
    window.removeEventListener('resize', syncSidebarByViewport)
})
</script>

<template>
    <div class="relative flex min-h-screen transition-colors duration-300 bg-gray-50 dark:bg-gray-950">
        <AdminSidebar :isOpen="isSidebarOpen" @close="isSidebarOpen = false" />

        <div class="absolute inset-0 z-40 bg-gray-950/40 backdrop-blur-[1px] transition-opacity duration-300 lg:hidden"
            :class="isSidebarOpen ? 'opacity-100 pointer-events-auto' : 'opacity-0 pointer-events-none'"
            @click="isSidebarOpen = false" />

        <div class="relative z-10 flex flex-col flex-1 min-h-screen transition-all duration-300"
            :class="[isSidebarOpen ? 'lg:ml-64' : 'lg:ml-20', 'w-full']">
            <AdminNavbar :is-sidebar-open="isSidebarOpen" @toggle-sidebar="toggleSidebar" @toggle-theme="toggleTheme">
                <template #theme-icon>
                    <Sun v-if="isDark" class="w-5 h-5" />
                    <Moon v-else class="w-5 h-5" />
                </template>
            </AdminNavbar>

            <main class="p-4 md:p-6 lg:p-8">
                <slot />
            </main>

            <footer class="p-6 mt-auto border-t border-gray-100 lg:p-8 dark:border-gray-800">
                <p class="text-[9px] text-gray-400 font-bold tracking-[0.4em] uppercase text-center md:text-left">
                    Sistem Internal Berandanesia &copy; 2026
                </p>
            </footer>
        </div>
    </div>
</template>

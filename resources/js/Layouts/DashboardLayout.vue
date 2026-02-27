<script setup>
import { ref, onMounted } from 'vue'
import { Sun, Moon } from 'lucide-vue-next'
import AdminSidebar from '@/Components/layout/AdminSidebar.vue'
import AdminNavbar from '@/Components/layout/AdminNavbar.vue'

const isSidebarOpen = ref(true)
const isDark = ref(false)

const toggleSidebar = () => isSidebarOpen.value = !isSidebarOpen.value

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

    window.addEventListener('resize', () => {
        if (window.innerWidth < 1024) {
            isSidebarOpen.value = false
        } else {
            isSidebarOpen.value = true
        }
    })
})
</script>

<template>
    <div class="flex min-h-screen transition-colors duration-300 bg-gray-50 dark:bg-gray-950">
        <AdminSidebar :isOpen="isSidebarOpen" @close="isSidebarOpen = false" />
        <div :class="[isSidebarOpen ? 'ml-64' : 'ml-0 lg:ml-20']"
            class="flex flex-col flex-1 min-h-screen transition-all duration-300">
            <AdminNavbar :is-sidebar-open="isSidebarOpen" @toggle-sidebar="toggleSidebar" @toggle-theme="toggleTheme">
                <template #theme-icon>
                    <Sun v-if="isDark" class="w-5 h-5" />
                    <Moon v-else class="w-5 h-5" />
                </template>
            </AdminNavbar>

            <main class="p-8">
                <slot />
            </main>

            <footer class="p-8 mt-auto border-t border-gray-100 dark:border-gray-800">
                <p class="text-[9px] text-gray-400 font-bold tracking-[0.4em] uppercase text-center md:text-left">
                    Sistem Internal Berandanesia &copy; 2026
                </p>
            </footer>
        </div>
    </div>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3'
import { Menu, X, Sun, Moon, Bell, Search } from 'lucide-vue-next'
import { computed } from 'vue'

const page = usePage()
const user = computed(() => page.props.auth.user)

const appName1 = page.props.appName1;
const appName2 = page.props.appName2;

defineProps({ isSidebarOpen: Boolean })
const emit = defineEmits(['toggleSidebar', 'toggleTheme'])
</script>

<template>
    <header
        class="sticky top-0 z-40 flex items-center justify-between h-20 px-4 backdrop-blur-md border-b border-gray-100 dark:border-gray-800">
        <div class="flex items-center gap-4">
            <button @click="emit('toggleSidebar')" class="p-2 text-gray-400 hover:text-red-700 transition-colors">
                <X v-if="isSidebarOpen" class="w-6 h-6" />
                <Menu v-else class="w-6 h-6" />
            </button>
            <div class="relative hidden md:block">
                <Search class="absolute left-3 top-2.5 h-4 w-4 text-gray-400" />
                <input type="text" placeholder="CARI DATA..."
                    class="pl-10 pr-4 py-2 dark:bg-gray-800 border-l-2 border-gray-200 dark:border-gray-700 text-[10px] font-bold tracking-widest outline-none focus:border-red-700 transition-all w-64" />
            </div>
        </div>

        <div class="flex items-center gap-6">
            <button @click="emit('toggleTheme')" class="text-gray-400 hover:text-red-700 transition-colors cursor-pointer">
                <slot name="theme-icon" />
            </button>

            <div class="flex items-center gap-4 pl-6 border-l border-gray-100 dark:border-gray-800">
                <div class="text-right">
                    <p class="text-[10px] font-black uppercase tracking-widest dark:text-white leading-none">
                        {{ user ? user.name.split(' ')[0] : 'Tamu' }}
                    </p>
                </div>
                <div
                    class="w-10 h-10 bg-gray-900 dark:bg-red-700 flex items-center justify-center text-white font-black border-b-2 border-red-700">
                    {{ user ? user.name.split(' ')[0][0] : 'T' }}
                </div>
            </div>
        </div>
    </header>
</template>

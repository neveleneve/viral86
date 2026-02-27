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
        class="sticky top-0 z-40 flex items-center justify-between h-20 px-4 border-b border-gray-100 backdrop-blur-md dark:border-gray-800">
        <div class="flex items-center gap-4">
            <button @click="emit('toggleSidebar')" class="p-2 text-gray-400 transition-all hover:text-red-700">
                <X v-if="isSidebarOpen" class="hidden w-6 h-6 lg:inline-block" />
                <Menu v-else class="w-6 h-6" />
            </button>
        </div>

        <div class="flex items-center gap-6">
            <button @click="emit('toggleTheme')" class="text-gray-400 transition-colors cursor-pointer hover:text-red-700">
                <slot name="theme-icon" />
            </button>

            <div class="flex items-center gap-4 pl-6 border-l border-gray-100 dark:border-gray-800">
                <div class="text-right">
                    <p class="text-[10px] font-black uppercase tracking-widest dark:text-white leading-none">
                        {{ user ? user.name.split(' ')[0] : 'Tamu' }}
                    </p>
                </div>
                <div
                    class="flex items-center justify-center w-10 h-10 font-black text-white bg-gray-900 border-b-2 border-red-700 dark:bg-red-700">
                    {{ user ? user.name.split(' ')[0][0] : 'T' }}
                </div>
            </div>
        </div>
    </header>
</template>

<script setup>
import { usePage } from '@inertiajs/vue3'
import { Menu, X, Bell, Sparkles } from 'lucide-vue-next'
import { computed } from 'vue'

const page = usePage()
const user = computed(() => page.props.auth.user)

defineProps({ isSidebarOpen: Boolean })
const emit = defineEmits(['toggleSidebar', 'toggleTheme'])
</script>

<template>
    <header
        class="sticky top-0 z-30 flex items-center justify-between h-20 px-4 border-b border-gray-100 bg-white/85 backdrop-blur-md dark:border-gray-800 dark:bg-gray-900/80">

        <div class="flex items-center min-w-0 gap-4">
            <button @click="emit('toggleSidebar')"
                class="p-2 text-gray-400 transition-all rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-red-700">
                <Menu class="w-6 h-6" />
            </button>
        </div>

        <div class="flex items-center gap-2 ml-auto md:gap-4">

            <button @click="emit('toggleTheme')"
                class="p-2 text-gray-400 transition-colors rounded-lg cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-red-700">
                <slot name="theme-icon" />
            </button>

            <button
                class="relative hidden p-2 text-gray-400 transition-colors rounded-lg sm:block hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-red-700">
                <Bell class="w-5 h-5" />
                <span class="absolute block w-2 h-2 bg-red-700 rounded-full -right-0.5 -top-0.5" />
            </button>


            <div class="flex items-center gap-3 pl-3 border-l border-gray-100 md:pl-4 dark:border-gray-800">

                <div
                    class="items-center hidden px-3 py-2 border border-gray-100 bg-gray-50 dark:bg-gray-800/50 rounded-xl lg:flex dark:border-gray-800">
                    <Sparkles class="w-4 h-4 mr-2 text-red-700" />
                    <p class="text-[10px] font-bold tracking-[0.2em] uppercase text-gray-500 dark:text-gray-300">
                        Halo, {{ user ? user.name.split(' ')[0] : 'Tamu' }}
                    </p>
                </div>

                <div
                    class="flex items-center justify-center w-10 h-10 font-black text-white bg-gray-900 border-b-2 border-red-700 rounded-xl dark:bg-red-700">
                    {{ user ? user.name.split(' ')[0][0] : 'T' }}
                </div>
            </div>

        </div>
    </header>
</template>

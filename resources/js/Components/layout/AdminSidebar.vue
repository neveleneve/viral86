<script setup>
import { LayoutDashboard, FileText, Image as ImageIcon, BarChart3, Users, Settings, LogOut, PlusCircle } from 'lucide-vue-next'
import { usePage } from '@inertiajs/vue3'

const page = usePage()

const appName1 = page.props.appName1;
const appName2 = page.props.appName2;

defineProps({ isOpen: Boolean })

const menuItems = [
    { name: 'Dashboard', href: '/admin/dashboard', icon: LayoutDashboard },
    { name: 'Tulis Berita', href: '/admin/posts/create', icon: PlusCircle },
    { name: 'Manajemen Konten', href: '/admin/posts', icon: FileText },
    { name: 'Media Library', href: '/admin/media', icon: ImageIcon },
    { name: 'Analitik Iklan', href: '/admin/ads', icon: BarChart3 },
    { name: 'Pengguna', href: '/admin/users', icon: Users },
    { name: 'Pengaturan', href: '/admin/settings', icon: Settings },
]
</script>
<template>
    <aside :class="[isOpen ? 'w-64' : 'w-20']"
        class="fixed inset-y-0 left-0 z-50 transition-all duration-300 border-r border-gray-100 dark:border-gray-800 flex flex-col shadow-2xl shadow-gray-200/50 dark:shadow-none">
        <div class="flex items-center h-20 px-6 border-b border-gray-50 dark:border-gray-800 shrink-0">
            <Link href="/" class="flex items-center gap-3">
            <div class="w-8 h-8 bg-red-700 flex items-center justify-center font-black text-white shrink-0">
                {{ appName1 ? appName1.split(' ')[0][0] : 'T' }}
            </div>

            <span class="font-black text-lg tracking-tighter uppercase dark:text-white transition-all duration-300"
                :class="[isOpen ? 'opacity-100 delay-100 visible' : 'opacity-0 invisible w-0 overflow-hidden']">
                {{ appName1 }}<span class="text-red-700">{{ appName2 }}</span>
            </span>
            </Link>
        </div>

        <nav class="flex-1 p-4 space-y-2 overflow-y-auto">
            <Link v-for="item in menuItems" :key="item.name" :href="item.href"
                class="flex items-center p-3 transition-all group " :class="[
                    $page.url === item.href ? 'bg-gray-200 dark:bg-gray-800 text-red-700' : 'text-gray-400 border-transparent hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white',
                    isOpen ? 'rounded-lg border-l-4 border-red-700' : ''
                ]">
            <component :is="item.icon" class="w-5 h-5 shrink-0" />
            <span class="ml-4 text-[10px] font-black uppercase tracking-[0.2em] whitespace-nowrap" :class="[
                isOpen ? 'opacity-100 delay-100 visible' : 'opacity-0 delay-100 invisible'
            ]">
                {{ item.name }}
            </span>
            </Link>
        </nav>

        <div class="p-4 border-t border-gray-50 dark:border-gray-800 shrink-0">
            <Link href="/logout" method="post" as="button"
                class="flex items-center w-full p-3 text-gray-400 hover:text-red-700 transition-colors group">
            <LogOut class="w-5 h-5 shrink-0" />
            <span v-if="isOpen" class="ml-4 text-[10px] font-black uppercase tracking-widest">Keluar</span>
            </Link>
        </div>
    </aside>
</template>

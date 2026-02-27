<script setup>
import { LayoutDashboard, FileText, BarChart3, Users, Settings, LogOut, X, ChevronDown, ChevronRight } from 'lucide-vue-next'
import { router, usePage } from '@inertiajs/vue3'
import Swal from 'sweetalert2'
import { onMounted, ref } from 'vue'

const page = usePage()

const appName1 = page.props.appName1
const appName2 = page.props.appName2

defineProps({ isOpen: Boolean })

const emit = defineEmits(['close'])

const close = () => {
    emit('close')
}

const logout = () => {
    const isDarkMode = document.documentElement.classList.contains('dark')
    Swal.fire({
        title: 'Konfirmasi Keluar?',
        text: 'Sesi Anda akan diakhiri.',
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
            cancelButton: 'text-xs uppercase tracking-widest',
        },
    }).then((result) => {
        if (result.isConfirmed) {
            router.post('/logout')
        }
    })
}

const expandedMenus = ref([])

const isChildActive = (children) => {
    return children.some((child) => page.url === child.href)
}

onMounted(() => {
    menuItems.forEach((item) => {
        if (item.children && isChildActive(item.children) && !expandedMenus.value.includes(item.name)) {
            expandedMenus.value.push(item.name)
        }
    })
})

const toggleMenu = (menuName) => {
    if (expandedMenus.value.includes(menuName)) {
        expandedMenus.value = expandedMenus.value.filter((name) => name !== menuName)
    } else {
        expandedMenus.value.push(menuName)
    }
}

const menuItems = [
    { name: 'Dashboard', href: '/admin/dashboard', icon: LayoutDashboard },
    {
        name: 'Manajemen Konten',
        icon: FileText,
        children: [
            { name: 'Konten', href: '/admin/content' },
            { name: 'Media', href: '/admin/media' },
        ],
    },
    {
        name: 'Manajemen Iklan',
        icon: BarChart3,
        children: [
            { name: 'Iklan Aktif', href: '/admin/active-ads' },
            { name: 'Permintaan Iklan', href: '/admin/ads-request' },
        ],
    },
    {
        name: 'Pengguna',
        icon: Users,
        children: [
            { name: 'Redaksi', href: '/admin/users' },
            { name: 'Pembaca', href: '/admin/reader' },
            { name: 'Pengiklan', href: '/admin/advertiser' },
        ],
    },
    { name: 'Pengaturan', href: '/admin/settings', icon: Settings },
]
</script>

<template>
    <aside
        :class="[
            isOpen ? 'translate-x-0 w-[18rem]' : '-translate-x-full lg:translate-x-0 lg:w-24',
        ]"
        class="fixed inset-y-0 left-0 z-50 flex flex-col transition-all duration-300 bg-white border-r border-gray-100 shadow-2xl dark:border-gray-800 shadow-gray-200/50 dark:shadow-none dark:bg-gray-900"
    >
        <div
            class="flex items-center justify-between h-20 px-6 border-b border-gray-50 dark:border-gray-800 shrink-0"
            :class="!isOpen && 'lg:justify-center lg:px-4'"
        >
            <Link href="/" class="flex items-center gap-3">
                <div class="flex items-center justify-center w-10 h-10 font-black text-white bg-red-700 rounded-xl shrink-0">
                    {{ appName1 ? appName1.split(' ')[0][0] : 'T' }}
                </div>
                <span
                    class="text-base font-black tracking-tighter uppercase transition-all duration-300 dark:text-white"
                    v-if="isOpen"
                >
                    {{ appName1 }}<span class="text-red-700">{{ appName2 }}</span>
                </span>
            </Link>

            <button
                v-if="isOpen"
                @click="close"
                class="p-2 -mr-2 text-gray-500 transition-colors rounded-md lg:hidden hover:bg-gray-100 dark:hover:bg-gray-800 dark:text-gray-400"
            >
                <X class="w-6 h-6" />
            </button>
        </div>

        <nav class="flex-1 p-4 space-y-2 overflow-y-auto custom-scrollbar">
            <div v-for="item in menuItems" :key="item.name">
                <div v-if="item.children">
                    <button
                        @click="toggleMenu(item.name)"
                        class="flex items-center justify-between w-full p-3 transition-all outline-none group rounded-xl"
                        :class="[
                            isChildActive(item.children) || expandedMenus.includes(item.name)
                                ? 'text-red-700 bg-red-50/60 dark:bg-red-950/40 ring-1 ring-red-100 dark:ring-red-900/40'
                                : 'text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white',
                            !isOpen && 'justify-center',
                        ]"
                    >
                        <div class="flex items-center">
                            <component :is="item.icon" class="w-5 h-5 shrink-0" />
                            <span
                                v-if="isOpen"
                                class="ml-4 text-[10px] font-black uppercase tracking-[0.2em] whitespace-nowrap"
                            >
                                {{ item.name }}
                            </span>
                        </div>
                        <ChevronDown
                            v-if="isOpen"
                            class="w-4 h-4 transition-transform duration-300"
                            :class="[expandedMenus.includes(item.name) ? 'rotate-180' : '']"
                        />
                        <ChevronRight v-else class="hidden w-4 h-4 lg:inline-block" />
                    </button>

                    <div
                        v-if="isOpen && expandedMenus.includes(item.name)"
                        class="pt-1 mt-2 ml-6 space-y-1 border-l-2 border-gray-100 dark:border-gray-800"
                    >
                        <Link
                            v-for="child in item.children"
                            :key="child.name"
                            :href="child.href"
                            class="block py-2 pl-6 text-[9px] font-bold uppercase tracking-[0.2em] transition-all"
                            :class="[
                                $page.url === child.href
                                    ? 'text-red-700'
                                    : 'text-gray-400 hover:text-gray-900 dark:hover:text-white',
                            ]"
                        >
                            {{ child.name }}
                        </Link>
                    </div>
                </div>

                <Link
                    v-else
                    :href="item.href"
                    class="flex items-center p-3 transition-all group rounded-xl"
                    :class="[
                        $page.url === item.href
                            ? 'text-red-700 bg-red-50/60 dark:bg-red-950/40 ring-1 ring-red-100 dark:ring-red-900/40'
                            : 'text-gray-400 border-transparent hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white',
                        !isOpen && 'justify-center',
                    ]"
                >
                    <component :is="item.icon" class="w-5 h-5 shrink-0" />
                    <span class="ml-4 text-[10px] font-black uppercase tracking-[0.2em] whitespace-nowrap" v-if="isOpen">
                        {{ item.name }}
                    </span>
                </Link>
            </div>
        </nav>

        <div class="p-4 border-t border-gray-50 dark:border-gray-800 shrink-0">
            <button
                @click="logout"
                :class="[!isOpen && 'justify-center']"
                class="flex items-center w-full p-3 text-gray-400 transition-colors rounded-xl cursor-pointer hover:bg-red-50 dark:hover:bg-red-950/30 hover:text-red-700 group"
            >
                <LogOut class="w-5 h-5 shrink-0" />
                <span v-if="isOpen" class="ml-4 text-[10px] font-black uppercase tracking-widest">Keluar</span>
            </button>
        </div>
    </aside>
</template>

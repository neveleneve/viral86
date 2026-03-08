<script setup>
import { LayoutDashboard, FileText, BarChart3, Users, Settings, LogOut, X, ChevronDown } from 'lucide-vue-next'
import { Link, router, usePage } from '@inertiajs/vue3'
import Swal from 'sweetalert2'
import { computed, onMounted, ref, watch } from 'vue'

const page = usePage()
const permissions = computed(() => page.props.auth.user.permissions)

const appName1 = page.props.appName1
const appName2 = page.props.appName2

defineProps({ isOpen: Boolean })

const emit = defineEmits(['close'])

const close = () => {
    emit('close')
}

const checkActiveMenus = () => {
    menuItems.forEach((item) => {
        if (item.children && isChildActive(item.children)) {
            if (!expandedMenus.value.includes(item.name)) {
                expandedMenus.value.push(item.name)
            }
        }
    })
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
    return children.some((child) => page.url.startsWith(child.href))
}

const isMenuActive = (href) => {
    return href === '/admin/dashboard' ? page.url === href : page.url.startsWith(href)
}

const toggleMenu = (menuName) => {
    if (expandedMenus.value.includes(menuName)) {
        expandedMenus.value = expandedMenus.value.filter((name) => name !== menuName)
    } else {
        expandedMenus.value.push(menuName)
    }
}

const menuItems = [
    {
        name: 'Dashboard',
        href: '/admin/dashboard',
        icon: LayoutDashboard,
        permission: 'view-dashboard'
    },
    {
        name: 'Manajemen Konten',
        icon: FileText,
        permission: ['view-konten', 'view-media', 'view-kategori', 'view-tag'],
        children: [
            { name: 'Konten', href: '/admin/konten', permission: 'view-konten' },
            { name: 'Media', href: '/admin/media', permission: 'view-media' },
            { name: 'Kategori Postingan', href: '/admin/kategori', permission: 'view-kategori' },
            { name: 'Tag Postingan', href: '/admin/tag', permission: 'view-tag' },
        ],
    },
    {
        name: 'Manajemen Iklan',
        icon: BarChart3,
        permission: 'view-iklan',
        children: [
            { name: 'Iklan Aktif', href: '/admin/iklan-aktif', permission: 'view-iklan' },
            { name: 'Permintaan Iklan', href: '/admin/permintaan-iklan', permission: 'view-iklan' },
        ],
    },
    {
        name: 'Pengguna',
        icon: Users,
        permission: ['view-user-redaksi', 'view-user-pembaca', 'view-user-pengiklan'],
        children: [
            { name: 'Redaksi', href: '/admin/redaksi', permission: 'view-user-redaksi' },
            { name: 'Pembaca', href: '/admin/pembaca', permission: 'view-user-pembaca' },
            { name: 'Pengiklan', href: '/admin/pengiklan', permission: 'view-user-pengiklan' },
        ],
    },
    {
        name: 'Pengaturan',
        href: '/admin/pengaturan',
        icon: Settings,
        permission: 'view-pengaturan'
    },
]

const hasPermission = (permission) => {
    if (!permission) return true;
    if (Array.isArray(permission)) {
        return permission.some(p => permissions.value.includes(p));
    }
    return permissions.value.includes(permission);
}

const filteredMenuItems = computed(() => {
    return menuItems.filter(item => {
        const canViewParent = hasPermission(item.permission);

        if (item.children) {
            item.children = item.children.filter(child => hasPermission(child.permission));
            return item.children.length > 0;
        }

        return canViewParent;
    });
});

onMounted(() => {
    checkActiveMenus()
})

watch(() => page.url, () => {
    checkActiveMenus()
})
</script>

<template>
    <aside :class="[
        isOpen ? 'translate-x-0 w-64' : '-translate-x-full lg:translate-x-0 lg:w-20',
    ]"
        class="fixed inset-y-0 left-0 z-50 flex flex-col overflow-x-hidden transition-all duration-300 ease-in-out bg-white border-r border-gray-100 shadow-2xl dark:border-gray-800 shadow-gray-200/50 dark:shadow-none dark:bg-gray-900">

        <div class="flex items-center h-20 px-6 transition-all duration-300 border-b border-gray-50 dark:border-gray-800 shrink-0"
            :class="!isOpen && 'lg:justify-center lg:px-4'">
            <Link href="/" class="flex items-center">
                <div
                    class="flex items-center justify-center w-10 h-10 font-black text-white bg-red-700 rounded-xl shrink-0">
                    {{ appName1 ? appName1.split(' ')[0][0] : 'T' }}
                </div>
                <span
                    class="overflow-hidden text-base font-black tracking-tighter uppercase transition-all duration-300 whitespace-nowrap dark:text-white"
                    :class="isOpen ? 'opacity-100 max-w-50 ml-3' : 'opacity-0 max-w-0 ml-0'">
                    {{ appName1 }}<span class="text-red-700">{{ appName2 }}</span>
                </span>
            </Link>

            <button v-if="isOpen" @click="close"
                class="p-2 -mr-2 text-gray-500 transition-colors rounded-md lg:hidden hover:bg-gray-100 dark:hover:bg-gray-800 dark:text-gray-400">
                <X class="w-6 h-6" />
            </button>
        </div>

        <nav class="flex-1 p-4 space-y-2 overflow-x-hidden overflow-y-auto custom-scrollbar">
            <div v-for="item in filteredMenuItems" :key="item.name">

                <div v-if="item.children">
                    <button @click="toggleMenu(item.name)"
                        class="flex items-center justify-between w-full p-3 transition-all duration-300 outline-none group rounded-xl"
                        :class="[
                            isChildActive(item.children) ? 'text-red-700 bg-red-50/60 dark:bg-red-950/40 ring-1 ring-red-100 dark:ring-red-900/40' : 'text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white',
                            !isOpen && 'justify-center lg:px-0',
                        ]">
                        <div class="flex items-center overflow-hidden">
                            <component :is="item.icon" class="w-5 h-5 shrink-0" :class="!isOpen && 'mx-auto'" />
                            <span
                                class="text-[8px] font-black uppercase tracking-[0.2em] whitespace-nowrap transition-all duration-300 overflow-hidden"
                                :class="isOpen ? 'opacity-100 max-w-50 ml-4' : 'opacity-0 max-w-0 ml-0'">
                                {{ item.name }}
                            </span>
                        </div>
                        <ChevronDown class="w-4 h-4 transition-all duration-300 shrink-0" :class="[
                            expandedMenus.includes(item.name) ? 'rotate-180' : '',
                            isOpen ? 'opacity-100 max-w-4 ml-2' : 'opacity-0 max-w-0 ml-0 hidden lg:block'
                        ]" />
                    </button>

                    <div class="grid transition-all duration-300 ease-in-out"
                        :class="isOpen && expandedMenus.includes(item.name) ? 'grid-rows-[1fr] opacity-100 mt-2' : 'grid-rows-[0fr] opacity-0 mt-0'">
                        <div class="overflow-hidden">
                            <div class="pt-1 ml-6 space-y-1 border-l-2 border-gray-100 dark:border-gray-800">
                                <Link v-for="child in item.children" :key="child.name" :href="child.href"
                                    class="block py-2 pl-6 text-[9px] font-bold uppercase tracking-[0.2em] transition-all whitespace-nowrap"
                                    :class="[
                                        page.url.startsWith(child.href) ? 'text-red-700' : 'text-gray-400 hover:text-gray-900 dark:hover:text-white',
                                    ]">
                                    {{ child.name }}
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>

                <Link v-else :href="item.href"
                    class="flex items-center p-3 transition-all duration-300 group rounded-xl" :class="[
                        isMenuActive(item.href)
                            ? 'text-red-700 bg-red-50/60 dark:bg-red-950/40 ring-1 ring-red-100 dark:ring-red-900/40'
                            : 'text-gray-400 border-transparent hover:bg-gray-50 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white',
                        !isOpen && 'justify-center lg:px-0',
                    ]">
                    <component :is="item.icon" class="w-5 h-5 shrink-0" :class="!isOpen && 'mx-auto'" />
                    <span
                        class="text-[9px] font-black uppercase tracking-[0.2em] whitespace-nowrap transition-all duration-300 overflow-hidden"
                        :class="isOpen ? 'opacity-100 max-w-50 ml-4' : 'opacity-0 max-w-0 ml-0'">
                        {{ item.name }}
                    </span>
                </Link>
            </div>
        </nav>
        <div class="p-4 border-t border-gray-50 dark:border-gray-800 shrink-0">
            <button @click="logout" :class="[!isOpen && 'justify-center lg:px-0']"
                class="flex items-center w-full p-3 text-gray-400 transition-all duration-300 cursor-pointer rounded-xl hover:bg-red-50 dark:hover:bg-red-950/30 hover:text-red-700 group">
                <LogOut class="w-5 h-5 shrink-0" :class="!isOpen && 'mx-auto'" />
                <span
                    class="text-[10px] font-black uppercase tracking-widest whitespace-nowrap transition-all duration-300 overflow-hidden"
                    :class="isOpen ? 'opacity-100 max-w-50 ml-4' : 'opacity-0 max-w-0 ml-0'">
                    Keluar
                </span>
            </button>
        </div>
    </aside>
</template>

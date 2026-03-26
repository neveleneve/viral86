<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import Pagination from '@/Components/Pagination.vue'
import Swal from 'sweetalert2'
import AdminPageHeader from '@/Components/AdminPageHeader.vue'
import { Head, usePage, Link, router } from '@inertiajs/vue3'
import { Plus, Edit, Trash2, Search, ChevronDown, Tag, User, Star, ImageIcon, Clock } from 'lucide-vue-next'
import { ref, watch } from 'vue'
import { formatDate } from '@/Utils/formatters'

defineOptions({ layout: DashboardLayout })

const deleteContent = (id) => {
    const isDarkMode = document.documentElement.classList.contains('dark')
    Swal.fire({
        title: 'Yakin mau hapus?',
        text: "Data yang dihapus tidak bisa dikembalikan.",
        icon: 'warning',
        background: isDarkMode ? '#111827' : '#ffffff',
        color: isDarkMode ? '#ffffff' : '#111827',
        showCancelButton: true,
        confirmButtonColor: '#b91c1c',
        cancelButtonColor: '#374151',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(`/admin/konten/${id}`, {
                preserveScroll: true,
                onSuccess: () => { },
                preserveState: false,
            })
        }
    })
}

const props = defineProps({
    contents: Object,
    filters: Object,
    categories: Array,
    tags: Array,
})

const page = usePage()
const search = ref(props.filters?.search || '')
const category = ref(props.filters?.category || '')
const tag = ref(props.filters?.tag || '')
const status = ref(props.filters?.status || '')
const debounce = (fn, delay) => {
    let timeoutId;
    return (...args) => {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => fn(...args), delay);
    };
};
const applyFilters = debounce(() => {
    router.get('/admin/konten', {
        search: search.value,
        category: category.value,
        tag: tag.value,
        status: status.value
    }, {
        preserveState: true,
        replace: true,
        preserveScroll: true
    })
}, 500)

watch([search, category, tag, status], applyFilters)

const appName1 = page.props.appName1;
const appName2 = page.props.appName2;
</script>

<template>
    <AdminPageHeader :show-action="$can('view-konten')" title="Konten" subtitle="Postingan" action-label="Tambah"
        action-url="/admin/konten/create" :breadcrumbs="[
            { label: 'Dashboard', url: '/admin' },
            { label: 'Konten', url: '#' }
        ]">
        <template #action-icon>
            <Plus class="w-4 h-4" />
        </template>
    </AdminPageHeader>
    <div class="grid grid-cols-1 gap-3 mb-6 md:grid-cols-2 lg:grid-cols-4">
        <div class="relative">
            <select v-model="category"
                class="w-full py-3 pl-4 pr-10 text-sm font-bold bg-white border-l-4 border-gray-200 outline-none appearance-none dark:bg-gray-900 dark:text-white dark:border-gray-700 focus:border-red-700">
                <option value="">Semua Kategori</option>
                <option v-for="c in categories" :key="c.id" :value="c.slug">{{ c.name }}</option>
            </select>
            <ChevronDown class="absolute w-4 h-4 text-gray-400 -translate-y-1/2 pointer-events-none right-4 top-1/2" />
        </div>

        <div class="relative">
            <select v-model="tag"
                class="w-full py-3 pl-4 pr-10 text-sm font-bold bg-white border-l-4 border-gray-200 outline-none appearance-none dark:bg-gray-900 dark:text-white dark:border-gray-700 focus:border-red-700">
                <option value="">Semua Tag</option>
                <option v-for="t in tags" :key="t.id" :value="t.name">{{ t.name }}</option>
            </select>
            <ChevronDown class="absolute w-4 h-4 text-gray-400 -translate-y-1/2 pointer-events-none right-4 top-1/2" />
        </div>

        <div class="relative">
            <select v-model="status"
                class="w-full py-3 pl-4 pr-10 text-sm font-bold bg-white border-l-4 border-gray-200 outline-none appearance-none dark:bg-gray-900 dark:text-white dark:border-gray-700 focus:border-red-700">
                <option value="">Semua Status</option>
                <option value="published">Published</option>
                <option value="draft">Draft</option>
                <option value="archived">Archived</option>
            </select>
            <ChevronDown class="absolute w-4 h-4 text-gray-400 -translate-y-1/2 pointer-events-none right-4 top-1/2" />
        </div>
        <div class="relative group">
            <div
                class="absolute inset-y-0 right-0 flex items-center pr-4 text-gray-400 pointer-events-none group-focus-within:text-red-700">
                <Search class="w-4 h-4" />
            </div>
            <input v-model="search" type="text" placeholder="Cari judul..."
                class="w-full py-3 pl-4 pr-10 text-sm font-bold text-gray-900 transition-all bg-white border-l-4 border-gray-200 outline-none dark:bg-gray-900 dark:text-white focus:shadow-lg placeholder:font-normal dark:border-gray-700 focus:border-red-700">
        </div>
    </div>
    <div class="hidden overflow-hidden bg-white shadow-xl lg:block dark:bg-gray-900">
        <table class="w-full text-left">
            <thead class="text-[10px] font-black text-gray-400 uppercase tracking-widest bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th class="p-6">#</th>
                    <th class="p-6">Judul</th>
                    <th class="p-6">Kategori</th>
                    <th class="p-6 text-center">Featured</th>
                    <th class="p-6">Penulis</th>
                    <th class="p-6">Tanggal Terbit</th>
                    <th class="p-6 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="border-l-2 border-red-700 divide-y divide-gray-100 dark:divide-gray-800">
                <tr v-if="contents.data.length > 0" v-for="content in contents.data" :key="content.id"
                    class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                    <td class="p-6 font-bold text-gray-900 dark:text-white">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 overflow-hidden bg-gray-100 rounded shrink-0 dark:bg-gray-800">
                                <img v-if="content.media_id" :src="`/storage/${content.media.directory}`"
                                    class="object-cover w-full" alt="thumbnail">
                                <div v-else class="flex items-center justify-center w-full h-full text-gray-300">
                                    <ImageIcon class="w-5 h-5" />
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="p-6 font-bold text-gray-900 dark:text-white">{{ content.title }}</td>
                    <td class="p-6 text-sm text-gray-500">{{ content.category.name }}</td>
                    <td class="p-6 text-center">
                        <Star v-if="content.is_featured" class="w-4 h-4 mx-auto text-yellow-500 fill-yellow-500" />
                        <Star v-else class="w-4 h-4 mx-auto text-gray-200 dark:text-gray-700" />
                    </td>
                    <td class="p-6 text-sm text-gray-500">{{ content.user.name }}</td>
                    <td class="p-6 text-sm text-gray-500">{{ formatDate(content.published_at) }}</td>
                    <td class="p-6 text-right">
                        <div class="flex justify-end gap-3">
                            <Link v-if="$can('edit-konten')" :href="`/admin/konten/${content.id}`"
                                class="text-gray-400 hover:text-red-700">
                                <Edit class="w-4 h-4" />
                            </Link>
                            <button v-if="$can('delete-konten')" @click="deleteContent(content.id)"
                                class="text-gray-400 transition-colors cursor-pointer hover:text-red-700">
                                <Trash2 class="w-4 h-4" />
                            </button>
                        </div>
                    </td>
                </tr>
                <tr v-else>
                    <td colspan="6" class="p-6 font-bold text-center text-gray-900 dark:text-white"> Data Kosong
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="grid grid-cols-1 gap-4 lg:hidden">
        <div v-if="contents.data.length > 0" class="grid grid-cols-1 gap-6">
            <div v-for="content in contents.data" :key="content.id"
                class="overflow-hidden bg-white border-l-4 border-red-700 shadow-xl dark:bg-gray-900 rounded-r-xl">
                <div class="relative w-full bg-gray-200 border-b dark:bg-gray-800 dark:border-gray-700">
                    <img v-if="content.media_id" :src="`/storage/${content.media.directory}`"
                        class="object-cover w-full h-full" alt="cover">
                    <div v-else class="flex flex-col items-center justify-center w-full h-full gap-2 text-gray-400">
                        <ImageIcon class="w-10 h-10" />
                        <span class="font-mono text-xs text-gray-400">No Image</span>
                    </div>

                    <div v-if="content.is_featured"
                        class="absolute top-3 left-3 flex items-center gap-2 px-3 py-1.5 bg-yellow-500 text-white rounded-full shadow-lg backdrop-blur-sm bg-opacity-90">
                        <Star class="w-3.5 h-3.5 fill-current" />
                        <span class="text-[10px] font-black uppercase tracking-widest leading-none">
                            Featured
                        </span>
                    </div>
                </div>

                <div class="flex flex-col gap-5 p-5">
                    <div class="flex items-start justify-between gap-4">
                        <div class="flex flex-col flex-1 min-w-0 gap-1">
                            <h3
                                class="text-base font-black leading-tight text-gray-900 uppercase dark:text-white line-clamp-2">
                                {{ content.title }}
                            </h3>
                            <p
                                class="text-[10px] font-mono text-gray-500 break-all mt-1 bg-gray-100 dark:bg-gray-800 p-1 rounded inline-block self-start">
                                {{ content.slug }}
                            </p>
                        </div>
                        <div class="flex gap-3 mt-1 shrink-0">
                            <Link v-if="$can('edit-konten')" :href="`/admin/konten/${content.id}`"
                                class="text-gray-400 transition-colors hover:text-red-700">
                                <Edit class="w-5 h-5" />
                            </Link>
                            <button v-if="$can('delete-konten')" @click="deleteContent(content.id)"
                                class="text-gray-400 transition-colors cursor-pointer hover:text-red-700">
                                <Trash2 class="w-5 h-5" />
                            </button>
                        </div>
                    </div>
                    <div class="h-px bg-gray-100 dark:bg-gray-800"></div>
                    <div class="grid grid-cols-2 gap-x-4 gap-y-4">
                        <div class="flex items-center gap-2.5 min-w-0">
                            <div
                                class="flex items-center justify-center rounded-lg w-7 h-7 bg-red-50 dark:bg-gray-800 shrink-0">
                                <Tag class="w-4 h-4 text-red-700" />
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span
                                    class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Kategori</span>
                                <span class="text-[11px] font-bold text-gray-800 dark:text-gray-300 uppercase truncate">
                                    {{ content.category.name }}
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2.5 min-w-0">
                            <div
                                class="flex items-center justify-center bg-gray-100 rounded-lg w-7 h-7 dark:bg-gray-800 shrink-0">
                                <User class="w-4 h-4 text-gray-500" />
                            </div>
                            <div class="flex flex-col min-w-0">
                                <span
                                    class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Penulis</span>
                                <span class="text-[11px] font-bold text-gray-800 dark:text-gray-300 uppercase truncate">
                                    {{ content.user.name }}
                                </span>
                            </div>
                        </div>
                        <div
                            class="flex items-center gap-2.5 col-span-2 bg-gray-50 dark:bg-gray-800/40 p-2.5 rounded-lg border border-dashed dark:border-gray-700">
                            <div
                                class="flex items-center justify-center bg-white rounded-md shadow-sm w-7 h-7 dark:bg-gray-900 shrink-0">
                                <Clock class="w-4 h-4 text-red-700" />
                            </div>
                            <div class="flex flex-col">
                                <span class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Tanggal
                                    Terbit</span>
                                <span class="text-[11px] font-mono font-bold text-gray-700 dark:text-gray-300">
                                    {{ content.published_at ? formatDate(content.published_at) : 'BELUM TERBIT' }}
                                </span>
                            </div>
                        </div>
                        <div
                            class="flex items-center gap-2.5 col-span-2 bg-gray-100/50 dark:bg-gray-800/80 p-2 rounded-lg">
                            <div class="w-2 h-2 rounded-full shadow-sm shrink-0"
                                :class="content.status === 'published' ? 'bg-green-500' : 'bg-yellow-500'">
                            </div>
                            <span
                                class="text-[10px] font-black uppercase tracking-widest text-gray-700 dark:text-gray-300">
                                Status: {{ content.status }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div v-else
            class="p-10 text-center bg-white border-l-4 border-red-700 shadow-xl dark:bg-gray-900 rounded-r-xl lg:hidden">
            <ImageIcon class="w-12 h-12 mx-auto mb-4 text-gray-300" />
            <p class="text-xs font-black tracking-widest text-gray-400 uppercase">Data Konten Kosong</p>
        </div>
    </div>
    <Pagination :links="contents.links" />

    <Head :title="`Konten | ${appName1}${appName2}`" />
</template>

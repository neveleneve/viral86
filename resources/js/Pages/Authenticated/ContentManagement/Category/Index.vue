<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import Pagination from '@/Components/Pagination.vue'
import Swal from 'sweetalert2'
import AdminPageHeader from '@/Components/AdminPageHeader.vue'
import { Head, usePage, Link, router } from '@inertiajs/vue3'
import { Plus, Edit, Trash2, Search } from 'lucide-vue-next'
import { ref, watch } from 'vue'

defineOptions({ layout: DashboardLayout })

const deleteCategory = (id) => {
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
            router.delete(`/admin/kategori/${id}`, {
                preserveScroll: true,
                onSuccess: () => { },
                preserveState: false,
            })
        }
    })
}

const props = defineProps({
    categories: Object,
    filters: Object
})

const page = usePage()
const search = ref(props.filters?.search || '')

const debounce = (fn, delay) => {
    let timeoutId;
    return (...args) => {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(() => fn(...args), delay);
    };
};

watch(search, debounce((value) => {
    router.get('/admin/kategori',
        { search: value },
        {
            preserveState: true,
            replace: true,
            preserveScroll: true
        }
    )
}, 500))

const appName1 = page.props.appName1;
const appName2 = page.props.appName2;
</script>

<template>
    <AdminPageHeader :show-action="$can('create-kategori')" title="Kategori" subtitle="Postingan" action-label="Tambah"
        action-url="/admin/kategori/create" :breadcrumbs="[
            { label: 'Dashboard', url: '/admin' },
            { label: 'Kategori', url: '#' }
        ]">
        <template #action-icon>
            <Plus class="w-4 h-4" />
        </template>
    </AdminPageHeader>
    <div class="flex justify-end pb-3 mb-3 border-gray-900 not-md:border-b dark:border-gray-500">
        <div class="relative w-full md:w-1/2 lg:w-1/3 group">
            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                <Search class="w-4 h-4 text-gray-400 transition-colors group-focus-within:text-red-700" />
            </div>
            <input v-model="search" type="text" placeholder="Cari kategori..."
                class="w-full py-3 pl-4 text-sm font-bold text-gray-900 bg-white border-l-4 border-red-700 outline-none focus:shadow-xl dark:focus:shadow-md not-md:shadow-gray-200 not-md:dark:shadow-gray-500 pr-11 dark:bg-gray-900 dark:text-white focus:ring-0 placeholder:text-gray-400 placeholder:font-normal">
        </div>
    </div>
    <div class="hidden overflow-hidden bg-white shadow-xl lg:block dark:bg-gray-900">
        <table class="w-full text-left">
            <thead class="text-[10px] font-black text-gray-400 uppercase tracking-widest bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th class="p-6">Nama Kategori</th>
                    <th class="p-6">Slug</th>
                    <th class="p-6 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="border-l-2 border-red-700 divide-y divide-gray-100 dark:divide-gray-800">
                <tr v-if="categories.data.length > 0" v-for="cat in categories.data" :key="cat.id"
                    class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                    <td class="p-6 font-bold text-gray-900 dark:text-white">{{ cat.name }}</td>
                    <td class="p-6 text-sm text-gray-500">{{ cat.slug }}</td>
                    <td class="p-6 text-right">
                        <div class="flex justify-end gap-3">
                            <Link :href="`/admin/kategori/${cat.id}`" class="text-gray-400 hover:text-red-700">
                                <Edit class="w-4 h-4" />
                            </Link>
                            <button v-if="$can('delete-kategori')" @click="deleteCategory(cat.id)"
                                class="text-gray-400 transition-colors cursor-pointer hover:text-red-700">
                                <Trash2 class="w-4 h-4" />
                            </button>
                        </div>
                    </td>
                </tr>
                <tr v-else class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                    <td colspan="3" class="p-6 font-bold text-center text-gray-900 dark:text-white">
                        Data Kosong
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="grid grid-cols-1 gap-4 lg:hidden">
        <div v-if="categories.data.length > 0" v-for="cat in categories.data" :key="cat.id"
            class="p-6 bg-white border-l-4 border-red-700 shadow-md dark:bg-gray-900">
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="font-black text-gray-900 dark:text-white">{{ cat.name }}</h3>
                    <p class="text-[10px] text-gray-500 mt-1">{{ cat.slug }}</p>
                </div>
                <div class="flex gap-4">
                    <Link :href="`/admin/kategori/${cat.id}`">
                        <Edit class="w-4 h-4 text-gray-400 hover:text-red-700" />
                    </Link>
                    <button v-if="$can('delete-kategori')" @click="deleteCategory(cat.id)"
                        class="text-gray-400 cursor-pointer hover:text-red-700">
                        <Trash2 class="w-4 h-4" />
                    </button>
                </div>
            </div>
        </div>
        <div v-else class="p-10 text-center bg-white border-l-4 border-gray-200 dark:bg-gray-900 dark:border-gray-800">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Data Kosong</p>
        </div>
    </div>
    <Pagination :links="categories.links" />

    <Head :title="`Kategori | ${appName1}${appName2}`" />
</template>

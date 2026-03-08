<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import Pagination from '@/Components/Pagination.vue'
import { Head, usePage, Link, router } from '@inertiajs/vue3'
import { Plus, Edit, Trash2 } from 'lucide-vue-next'
import Swal from 'sweetalert2'

defineOptions({ layout: DashboardLayout })

const deleteCategory = (id) => {
    const isDarkMode = document.documentElement.classList.contains('dark')
    Swal.fire({
        title: 'Yakin mau hapus?',
        text: "Data yang dihapus tidak bisa dikembalikan, Wak!",
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
            })
        }
    })
}
const props = defineProps({ categories: Object })
const page = usePage()
const appName1 = page.props.appName1;
const appName2 = page.props.appName2;
</script>

<template>
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-black tracking-tighter text-gray-900 uppercase dark:text-white">
                Kategori<span class="text-red-700">Postingan</span>
            </h1>
        </div>
        <Link href="/admin/kategori/create"
            class="flex items-center gap-2 px-6 py-3 text-[10px] font-black text-white uppercase transition-colors bg-gray-900 hover:bg-red-700">
            <Plus class="w-4 h-4" /> Tambah Baru
        </Link>
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
                <tr v-for="cat in categories.data" :key="cat.id" class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                    <td class="p-6 font-bold text-gray-900 dark:text-white">{{ cat.name }}</td>
                    <td class="p-6 text-sm text-gray-500">{{ cat.slug }}</td>
                    <td class="p-6 text-right">
                        <div class="flex justify-end gap-3">
                            <Link :href="`/admin/kategori/${cat.id}`" class="text-gray-400 hover:text-red-700">
                                <Edit class="w-4 h-4" />
                            </Link>
                            <button @click="deleteCategory(cat.id)"
                                class="text-gray-400 transition-colors cursor-pointer hover:text-red-700">
                                <Trash2 class="w-4 h-4" />
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:hidden">
        <div v-for="cat in categories.data" :key="cat.id"
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
                    <button @click="deleteCategory(cat.id)" class="text-gray-400 cursor-pointer hover:text-red-700">
                        <Trash2 class="w-4 h-4" />
                    </button>
                </div>
            </div>
        </div>
    </div>
    <Pagination :links="categories.links" />

    <Head :title="`Kategori | ${appName1}${appName2}`" />
</template>

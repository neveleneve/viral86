<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import Pagination from '@/Components/Pagination.vue'
import Swal from 'sweetalert2'
import AdminPageHeader from '@/Components/AdminPageHeader.vue'
import { Head, usePage, Link, router } from '@inertiajs/vue3'
import { Edit, Trash2, Search, Upload } from 'lucide-vue-next'
import { ref, watch } from 'vue'

defineOptions({ layout: DashboardLayout })

const deleteMedia = async (id) => {
    const isDarkMode = document.documentElement.classList.contains('dark')

    const result = await Swal.fire({
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
    });

    if (result.isConfirmed) {
        try {
            router.delete(`/admin/media/${id}`, {
                preserveScroll: true,
                onError: (errors) => {
                    console.error(errors);
                    Swal.fire('Gagal!', 'Terjadi kesalahan saat menghapus data.', 'error');
                }
            });
        } catch (error) {
            Swal.fire('Oops!', 'Sesuatu yang salah terjadi di sistem.', 'error');
        }
    }
}

const props = defineProps({
    media: Object,
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
    router.get('/admin/media',
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
    <AdminPageHeader :show-action="$can('upload-media')" title="Media" subtitle="Postingan" action-label="Upload"
        action-url="/admin/media/create" :breadcrumbs="[
            { label: 'Dashboard', url: '/admin' },
            { label: 'Media', url: '#' }
        ]">
        <template #action-icon>
            <Upload class="w-4 h-4" />
        </template>
    </AdminPageHeader>

    <div class="flex justify-end pb-3 mb-3 border-gray-900 not-md:border-b dark:border-gray-500">
        <div class="relative w-full md:w-1/2 lg:w-1/3 group">
            <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none">
                <Search class="w-4 h-4 text-gray-400 transition-colors group-focus-within:text-red-700" />
            </div>
            <input v-model="search" type="text" placeholder="Cari media postingan..."
                class="w-full py-3 pl-4 text-sm font-bold text-gray-900 bg-white border-l-4 border-red-700 outline-none pr-11 focus:shadow-xl dark:focus:shadow-md not-md:shadow-gray-200 not-md:dark:shadow-gray-500 dark:bg-gray-900 dark:text-white focus:ring-0 placeholder:text-gray-400 placeholder:font-normal">
        </div>
    </div>

    <div class="hidden overflow-hidden bg-white shadow-xl lg:block dark:bg-gray-900">
        <table class="w-full text-left">
            <thead class="text-[10px] font-black text-gray-400 uppercase tracking-widest bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th class="w-32 p-6">Gambar</th>
                    <th class="w-2/5 p-6">Caption</th>
                    <th class="p-6">Sumber</th>
                    <th class="p-6 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="border-l-2 border-red-700 divide-y divide-gray-100 dark:divide-gray-800">
                <template v-if="media.data.length > 0">
                    <tr v-for="mediax in media.data" :key="mediax.id"
                        class="hover:bg-gray-50 dark:hover:bg-gray-800/50">
                        <td class="p-4">
                            <div
                                class="w-24 h-24 overflow-hidden bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                                <img :src="'/storage/' + mediax.directory" :alt="mediax.caption"
                                    class="object-cover w-full h-full" loading="lazy">
                            </div>
                        </td>
                        <td class="p-6">
                            <p class="text-sm font-bold text-gray-900 dark:text-white line-clamp-2">
                                {{ mediax.caption }}
                            </p>
                        </td>
                        <td class="p-6">
                            <span
                                class="px-3 py-1 text-[10px] font-bold text-gray-500 uppercase tracking-widest bg-gray-100 rounded-md dark:bg-gray-800 dark:text-gray-400">
                                {{ mediax.source }}
                            </span>
                        </td>
                        <td class="p-6 text-right">
                            <div class="flex justify-end gap-3">
                                <button v-if="$can('delete-media')" @click="deleteMedia(mediax.id)"
                                    class="text-gray-400 transition-colors cursor-pointer hover:text-red-700">
                                    <Trash2 class="w-4 h-4" />
                                </button>
                            </div>
                        </td>
                    </tr>
                </template>
                <tr v-else>
                    <td colspan="4" class="p-10 text-xs font-black tracking-widest text-center text-gray-400 uppercase">
                        Data Kosong
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="grid grid-cols-1 gap-4 lg:hidden">
        <template v-if="media.data.length > 0">
            <div v-for="mediax in media.data" :key="mediax.id"
                class="p-4 bg-white border-l-4 border-red-700 shadow-md dark:bg-gray-900">
                <div class="flex gap-4">
                    <div class="shrink-0">
                        <div
                            class="w-20 h-20 overflow-hidden bg-gray-100 border border-gray-200 rounded-lg dark:bg-gray-800 dark:border-gray-700">
                            <img :src="mediax.directory" :alt="mediax.caption" class="object-cover w-full h-full"
                                loading="lazy">
                        </div>
                    </div>

                    <div class="justify-between flex-1 min-w-0 flex-flex-col">
                        <div>
                            <h3 class="text-sm font-black tracking-tight text-gray-900 dark:text-white line-clamp-2">
                                {{ mediax.caption }}
                            </h3>
                            <p class="mt-2 text-[10px] font-bold text-gray-500 uppercase tracking-widest truncate">
                                SBR: {{ mediax.source }}
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col items-end gap-3 shrink-0">
                        <button v-if="$can('delete-media')" @click="deleteMedia(mediax.id)"
                            class="text-gray-400 cursor-pointer hover:text-red-700">
                            <Trash2 class="w-4 h-4" />
                        </button>
                    </div>
                </div>
            </div>
        </template>
        <div v-else class="p-10 text-center bg-white border-l-4 border-gray-200 dark:bg-gray-900 dark:border-gray-800">
            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">Data Kosong</p>
        </div>
    </div>

    <Pagination :links="media.links" />

    <Head :title="`Media | ${appName1}${appName2}`" />
</template>
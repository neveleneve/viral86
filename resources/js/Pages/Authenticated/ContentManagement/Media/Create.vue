<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import AdminPageHeader from '@/Components/AdminPageHeader.vue'
import { Head, usePage, Link, useForm } from '@inertiajs/vue3'
import { ref } from 'vue'
import { Save, X, Image as ImageIcon, UploadCloud, ChevronLeft } from 'lucide-vue-next'

defineOptions({ layout: DashboardLayout })

const page = usePage()
const appName1 = page.props.appName1;
const appName2 = page.props.appName2;

// Inisialisasi Form Inertia
const form = useForm({
    file: null,
    caption: '',
    source: ''
})

// State untuk preview gambar
const imagePreview = ref(null)

// Handle perubahan file & buat preview
const handleFileChange = (e) => {
    const file = e.target.files[0]
    if (file) {
        form.file = file
        imagePreview.value = URL.createObjectURL(file)
    } else {
        form.file = null
        imagePreview.value = null
    }
}

const submit = () => {
    form.post('/admin/media', {
        preserveScroll: true,
    })
}
</script>

<template>
    <AdminPageHeader :show-action="$can('view-media')" title="Media" subtitle="Postingan" action-url="/admin/media"
        :breadcrumbs="[
            { label: 'Dashboard', url: '/admin' },
            { label: 'Media', url: '/admin/media' },
            { label: 'Upload', url: '#' }
        ]">
        <template #action-icon>
            <ChevronLeft class="w-4 h-4" />
        </template>
    </AdminPageHeader>

    <div class="p-6 bg-white border-l-4 border-red-700 shadow-xl dark:bg-gray-900">
        <form @submit.prevent="submit" class="space-y-6">

            <div>
                <label class="block mb-2 text-xs font-black tracking-widest text-gray-400 uppercase">
                    File Gambar <span class="text-red-700">*</span>
                </label>

                <div class="relative flex justify-center px-6 py-10 transition-colors border-2 border-gray-300 border-dashed rounded-xl dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800/50 group"
                    :class="{ 'bg-gray-50 dark:bg-gray-800/50': imagePreview }">

                    <div class="text-center">
                        <div v-if="imagePreview" class="relative mx-auto mb-4 w-44 h-44">
                            <img :src="imagePreview"
                                class="object-cover w-full h-full border-4 border-white shadow-lg dark:border-gray-800 rounded-xl" />
                            <button type="button" @click.prevent="imagePreview = null; form.file = null"
                                class="absolute p-1 text-white bg-red-700 rounded-full shadow-md cursor-pointer -top-3 -right-3 hover:bg-red-800">
                                <X class="w-4 h-4" />
                            </button>
                        </div>

                        <ImageIcon v-else
                            class="w-12 h-12 mx-auto mb-3 text-gray-400 transition-colors group-hover:text-red-700" />

                        <div class="flex justify-center text-sm leading-6 text-gray-600 dark:text-gray-400">
                            <label for="file-upload"
                                class="relative font-bold text-red-700 transition-colors cursor-pointer hover:text-red-800 focus-within:outline-none">
                                <span v-if="!imagePreview">Pilih file gambar</span>
                                <span v-else>Ganti gambar</span>
                                <input id="file-upload" type="file" class="sr-only" accept="image/*"
                                    @change="handleFileChange">
                            </label>
                            <p class="pl-1" v-if="!imagePreview">atau drag and drop</p>
                        </div>
                        <p class="text-xs leading-5 text-gray-500 dark:text-gray-500" v-if="!imagePreview">
                            PNG, JPG, WEBP maksimal 2MB
                        </p>
                    </div>
                </div>
                <p v-if="form.errors.file" class="mt-2 text-xs font-bold text-red-600">{{ form.errors.file }}</p>
            </div>

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label class="block mb-2 text-xs font-black tracking-widest text-gray-400 uppercase">
                        Caption
                    </label>
                    <input v-model="form.caption" type="text" placeholder="Masukkan caption gambar..."
                        class="w-full px-4 py-3 text-sm font-bold text-gray-900 transition-all border-transparent rounded-lg outline-none bg-gray-50 focus:border-red-700 focus:ring-1 focus:ring-red-700 dark:bg-gray-800 dark:text-white placeholder:text-gray-400 placeholder:font-normal">
                    <p v-if="form.errors.caption" class="mt-2 text-xs font-bold text-red-600">{{ form.errors.caption
                    }}</p>
                </div>

                <div>
                    <label class="block mb-2 text-xs font-black tracking-widest text-gray-400 uppercase">
                        Sumber Gambar
                    </label>
                    <input v-model="form.source" type="text" placeholder="Contoh: Dok. Pribadi / Unsplash"
                        class="w-full px-4 py-3 text-sm font-bold text-gray-900 transition-all border-transparent rounded-lg outline-none bg-gray-50 focus:border-red-700 focus:ring-1 focus:ring-red-700 dark:bg-gray-800 dark:text-white placeholder:text-gray-400 placeholder:font-normal">
                    <p v-if="form.errors.source" class="mt-2 text-xs font-bold text-red-600">{{ form.errors.source
                    }}</p>
                </div>
            </div>

            <div class="flex items-center justify-end gap-4 pt-6 mt-6 border-t border-gray-100 dark:border-gray-800">
                <Link href="/admin/media"
                    class="px-6 py-2.5 text-xs font-black tracking-widest text-gray-500 uppercase transition-colors hover:text-gray-900 dark:hover:text-white">
                    Batal
                </Link>
                <button type="submit" :disabled="form.processing"
                    class="flex items-center gap-2 px-6 py-2.5 text-xs font-black tracking-widest text-white uppercase transition-all bg-gray-900 border-b-2 border-red-700 rounded-lg hover:bg-gray-800 active:translate-y-px disabled:opacity-50 disabled:cursor-not-allowed dark:bg-red-700 dark:border-red-900 dark:hover:bg-red-600">
                    <Save class="w-4 h-4" />
                    {{ form.processing ? 'Menyimpan...' : 'Simpan' }}
                </button>
            </div>
        </form>
    </div>

    <Head :title="`Tambah Media | ${appName1}${appName2}`" />
</template>
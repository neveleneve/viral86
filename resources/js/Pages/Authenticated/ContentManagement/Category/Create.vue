<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import AdminPageHeader from '@/Components/AdminPageHeader.vue'
import { Head, useForm, usePage } from '@inertiajs/vue3'
import { ChevronLeft, Save, Loader2 } from 'lucide-vue-next'
import { watch } from 'vue'

const page = usePage()

const form = useForm({
    name: '',
    slug: ''
})

defineOptions({ layout: DashboardLayout })

const appName1 = page.props.appName1;
const appName2 = page.props.appName2;

watch(() => form.name, (newVal) => {
    form.slug = newVal
        .toLowerCase()
        .replace(/[^a-z0-9]+/g, '-')
        .replace(/(^-|-$)+/g, '');
});

const submit = () => {
    form.post('/admin/kategori')
}
</script>

<template>
    <AdminPageHeader :show-action="$can('view-kategori')" title="Kategori" subtitle="Postingan" action-label="Kembali"
        action-url="/admin/kategori" :breadcrumbs="[
            { label: 'Dashboard', url: '/admin' },
            { label: 'Kategori', url: '/admin/kategori' },
            { label: 'Tambah', url: '#' }
        ]">
        <template #action-icon>
            <ChevronLeft class="w-4 h-4" />
        </template>
    </AdminPageHeader>
    <div class="p-6 bg-white border-l-4 border-red-700 shadow-xl dark:bg-gray-900">
        <form @submit.prevent="submit" class="space-y-6">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label
                        class="block text-[10px] font-black uppercase tracking-widest text-gray-400 dark:text-gray-500 mb-2">
                        Nama Kategori
                    </label>
                    <input type="text" v-model="form.name" placeholder="Misal: Politik Hukum"
                        :class="form.errors.name ? 'border-red-700' : 'border-gray-200 dark:border-gray-700'"
                        class="w-full px-4 py-3 text-sm text-gray-900 transition-all border-l-2 outline-none bg-gray-50 dark:bg-gray-800 dark:text-white focus:border-red-700">

                    <div v-if="form.errors.name" class="mt-1 text-[9px] font-black text-red-700 uppercase italic">
                        {{ form.errors.name }}
                    </div>
                </div>

                <div>
                    <label
                        class="block text-[10px] font-black uppercase tracking-widest text-gray-400 dark:text-gray-500 mb-2">
                        Slug Kategori
                    </label>
                    <input type="text" v-model="form.slug" placeholder="otomatis-terisi"
                        :class="form.errors.slug ? 'border-red-700' : 'border-gray-200 dark:border-gray-700'"
                        class="w-full px-4 py-3 text-sm text-gray-500 transition-all bg-gray-100 border-l-2 outline-none dark:bg-gray-800/80 dark:text-gray-400 focus:border-red-700"
                        readonly>

                    <div v-if="form.errors.slug" class="mt-1 text-[9px] font-black text-red-700 uppercase italic">
                        {{ form.errors.slug }}
                    </div>
                </div>
            </div>
            <div class="flex justify-end pt-4 mt-6 border-t border-gray-100 dark:border-gray-800">
                <button type="submit" :disabled="form.processing"
                    class="flex items-center gap-2 px-8 py-3 text-[10px] font-black tracking-widest text-white uppercase transition-colors bg-gray-900 dark:bg-red-700 hover:bg-red-700 disabled:opacity-70">

                    <Loader2 v-if="form.processing" class="w-4 h-4 animate-spin" />
                    <Save v-else class="w-4 h-4" />

                    {{ form.processing ? 'Menyimpan...' : 'Simpan Kategori' }}
                </button>
            </div>
        </form>
    </div>

    <Head :title="`Tambah Kategori | ${appName1}${appName2}`" />
</template>

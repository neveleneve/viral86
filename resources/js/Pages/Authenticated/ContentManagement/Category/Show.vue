<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import AdminPageHeader from '@/Components/AdminPageHeader.vue'
import { Head, useForm, usePage } from '@inertiajs/vue3'
import { ChevronLeft, Save, Loader2, ChevronDown, Palette } from 'lucide-vue-next'
import { watch } from 'vue'

defineOptions({ layout: DashboardLayout })

const props = defineProps({
    category: Object,
    categories: Object,
})
const page = usePage()

const form = useForm({
    name: props.category.name,
    slug: props.category.slug,
    description: props.category.description,
    parent_id: props.category.parent_id,
    color: props.category.color,
})

watch(() => form.name, (newVal) => {
    form.slug = newVal.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)+/g, '');
});

const submit = () => form.put(`/admin/kategori/${props.category.id}`)
</script>

<template>
    <AdminPageHeader :show-action="$can('view-kategori')" title="Kategori" subtitle="Postingan" action-label="Kembali"
        action-url="/admin/kategori" :breadcrumbs="[
            { label: 'Dashboard', url: '/admin' },
            { label: 'Kategori', url: '/admin/kategori' },
            { label: 'Detail', url: '#' }
        ]">
        <template #action-icon>
            <ChevronLeft class="w-4 h-4" />
        </template>
    </AdminPageHeader>
    <div class="p-6 bg-white border-l-4 border-red-700 shadow-xl dark:bg-gray-900">
        <form class="space-y-6" @submit.prevent="submit">
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label
                        class="block text-[10px] font-black uppercase tracking-widest text-gray-400 dark:text-gray-500 mb-2">
                        Nama Kategori
                    </label>
                    <input type="text" v-model="form.name" :readonly="!$can('edit-kategori')"
                        class="w-full px-4 py-3 text-sm transition-all border-l-2 outline-none" :class="[
                            $can('edit-kategori') ? 'bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-white focus:border-red-700' : 'bg-gray-100 dark:bg-gray-900 text-gray-500 border-gray-100',
                            form.errors.name ? 'border-red-700' : 'border-gray-200 dark:border-gray-700'
                        ]">
                    <div v-if="form.errors.name" class="mt-1 text-[9px] font-black text-red-700 uppercase italic">
                        {{ form.errors.name }}
                    </div>
                </div>
                <div>
                    <label
                        class="block text-[10px] font-black uppercase tracking-widest text-gray-400 dark:text-gray-500 mb-2">
                        Slug Kategori
                    </label>
                    <input type="text" v-model="form.slug" readonly
                        class="w-full px-4 py-3 text-sm text-gray-900 border-l-2 border-gray-100 cursor-not-allowed bg-gray-50 dark:bg-gray-800 dark:text-white dark:border-gray-700">
                    <div v-if="form.errors.slug" class="mt-1 text-[9px] font-black text-red-700 uppercase italic">
                        {{ form.errors.slug }}
                    </div>
                </div>
                <div>
                    <label
                        class="block text-[10px] font-black uppercase tracking-widest text-gray-400 dark:text-gray-500 mb-2">
                        Parent Kategori
                    </label>
                    <div class="relative flex items-center">
                        <select v-model="form.parent_id"
                            :class="form.errors.parent_id ? 'border-red-700' : 'border-gray-200 dark:border-gray-700'"
                            class="w-full px-4 py-3 text-sm text-gray-900 transition-all border-l-2 outline-none appearance-none cursor-pointer bg-gray-50 dark:bg-gray-800 dark:text-white focus:border-red-700">

                            <option :value="null">Tidak Ada</option>

                            <option v-for="cat in categories" :key="cat.id" :value="cat.id">
                                {{ cat.name }}
                            </option>
                        </select>

                        <ChevronDown class="absolute w-4 h-4 text-gray-400 pointer-events-none right-4" />
                    </div>
                    <div v-if="form.errors.parent_id" class="mt-1 text-[9px] font-black text-red-700 uppercase italic">
                        {{ form.errors.parent_id }}
                    </div>
                </div>
                <div>
                    <label
                        class="block text-[10px] font-black uppercase tracking-widest text-gray-400 dark:text-gray-500 mb-2">
                        Warna Kategori
                    </label>
                    <div class="relative group">
                        <input type="color" v-model="form.color"
                            class="absolute z-20 w-10 h-10 -translate-y-1/2 opacity-0 cursor-pointer left-4 top-1/2" />

                        <div class="absolute z-10 w-8 h-8 transition-transform -translate-y-1/2 border border-gray-200 rounded-sm shadow-sm left-4 top-1/2 dark:border-gray-700 group-hover:scale-110"
                            :style="{ backgroundColor: form.color || '#b91c1c' }"></div>

                        <input type="text" v-model="form.color" placeholder="#B91C1C" maxlength="7"
                            :class="form.errors.color ? 'border-red-700' : 'border-gray-200 dark:border-gray-700'"
                            class="w-full py-3 pl-16 pr-4 font-mono text-sm font-bold text-gray-900 uppercase transition-all border-l-2 outline-none bg-gray-50 dark:bg-gray-800 dark:text-white focus:border-red-700" />

                        <div class="absolute inset-y-0 flex items-center pointer-events-none right-4">
                            <Palette class="w-4 h-4 text-gray-400 group-focus-within:text-red-700" />
                        </div>
                    </div>
                    <div v-if="form.errors.color" class="mt-1 text-[9px] font-black text-red-700 uppercase italic">
                        {{ form.errors.color }}
                    </div>
                </div>
                <div class="col-span-2">
                    <label
                        class="block text-[10px] font-black uppercase tracking-widest text-gray-400 dark:text-gray-500 mb-2">
                        Deskripsi
                    </label>
                    <textarea v-model="form.description" rows="4" placeholder="Deskripsi singkat kategori"
                        :class="form.errors.description ? 'border-red-700' : 'border-gray-200 dark:border-gray-700'"
                        class="w-full px-4 py-3 text-sm text-gray-900 transition-all border-l-2 outline-none resize-none bg-gray-50 dark:bg-gray-800 dark:text-white focus:border-red-700 placeholder:text-gray-400 placeholder:font-normal"></textarea>
                    <div v-if="form.errors.description"
                        class="mt-1 text-[9px] font-black text-red-700 uppercase italic">
                        {{ form.errors.description }}
                    </div>
                </div>
            </div>

            <div v-if="$can('edit-kategori')"
                class="flex justify-end pt-4 mt-6 border-t border-gray-100 dark:border-gray-800">
                <button type="submit" :disabled="form.processing || !form.isDirty"
                    class="flex items-center gap-2 px-8 py-3 text-[10px] font-black tracking-widest text-white uppercase transition-colors bg-gray-900 dark:bg-red-700 hover:bg-red-700 disabled:opacity-70"
                    :class="!form.isDirty ? 'cursor-not-allowed' : 'cursor-pointer'">

                    <Loader2 v-if="form.processing" class="w-4 h-4 animate-spin" />
                    <Save v-else class="w-4 h-4" />
                    {{ form.processing ? 'Mengubah...' : 'Ubah Kategori' }}
                </button>
            </div>
        </form>
    </div>

    <Head :title="`Detail Kategori | ${page.props.appName1}${page.props.appName2}`" />
</template>

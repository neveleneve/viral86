<script setup>
import DashboardLayout from '@/Layouts/DashboardLayout.vue'
import AdminPageHeader from '@/Components/AdminPageHeader.vue'
import { Head, useForm, usePage } from '@inertiajs/vue3'
import { ChevronLeft, Save, Loader2 } from 'lucide-vue-next'

defineOptions({ layout: DashboardLayout })

const props = defineProps({ tag: Object })
const page = usePage()

const form = useForm({
    name: props.tag.name,
})

const appName1 = page.props.appName1;
const appName2 = page.props.appName2;

const submit = () => form.put(`/admin/tag/${props.tag.id}`)
</script>

<template>
    <AdminPageHeader :show-action="$can('view-tag')" title="Tag" subtitle="Postingan" action-label="Kembali"
        action-url="/admin/tag" :breadcrumbs="[
            { label: 'Dashboard', url: '/admin' },
            { label: 'Tag', url: '/admin/tag' },
            { label: 'Detail', url: '#' }
        ]">
        <template #action-icon>
            <ChevronLeft class="w-4 h-4" />
        </template>
    </AdminPageHeader>
    <div class="p-6 bg-white border-l-4 border-red-700 shadow-xl dark:bg-gray-900">
        <form class="space-y-6" @submit.prevent="submit">
            <div class="grid grid-cols-1 gap-6">
                <div>
                    <label
                        class="block text-[10px] font-black uppercase tracking-widest text-gray-400 dark:text-gray-500 mb-2">
                        Nama Tag
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

            </div>

            <div v-if="$can('edit-kategori')"
                class="flex justify-end pt-4 mt-6 border-t border-gray-100 dark:border-gray-800">
                <button type="submit" :disabled="form.processing || !form.isDirty"
                    class="flex items-center gap-2 px-8 py-3 text-[10px] font-black tracking-widest text-white uppercase transition-colors bg-gray-900 dark:bg-red-700 hover:bg-red-700 disabled:opacity-70"
                    :class="!form.isDirty ? 'cursor-not-allowed' : 'cursor-pointer'">

                    <Loader2 v-if="form.processing" class="w-4 h-4 animate-spin" />
                    <Save v-else class="w-4 h-4" />
                    {{ form.processing ? 'Mengubah...' : 'Ubah Tag' }}
                </button>
            </div>
        </form>
    </div>

    <Head :title="`Detail Tag | ${appName1}${appName2}`" />
</template>

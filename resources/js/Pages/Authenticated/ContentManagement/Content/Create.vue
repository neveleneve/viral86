<script setup>
import { ref, watch, computed, onMounted, onBeforeUnmount } from 'vue';
import { Head, usePage, useForm } from '@inertiajs/vue3';
import { ImageIcon, ChevronDown, Star, Link as LinkIcon, ChevronLeft } from 'lucide-vue-next';
import AdminPageHeader from '@/Components/AdminPageHeader.vue';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import EditorJS from '@editorjs/editorjs';
import edjsHTML from 'editorjs-html';
import Header from '@editorjs/header';
import List from '@editorjs/list';
import MediaPicker from '@/Components/MediaPicker.vue';

const page = usePage();
const appName1 = page.props.appName1;
const appName2 = page.props.appName2;
const categories = page.props.categories || [];

defineOptions({ layout: DashboardLayout })

const showMediaModal = ref(false);
const selectedImage = ref(null);

const edjsParser = edjsHTML();

let editorInstance = null;

const form = useForm({
    user_id: page.props.auth.user.id,
    category_id: null,
    media_id: null,
    title: '',
    slug: '',
    body: '',
    status: 'draft',
    is_featured: false,
});

const selectedCategorySlug = computed(() => {
    if (!form.category_id) return null;
    const cat = categories.find(c => c.id === form.category_id);
    return cat ? cat.slug : null;
});

const slugify = (text) => {
    return text.toString().toLowerCase().trim()
        .replace(/\s+/g, '-')
        .replace(/[^\w-]+/g, '')
        .replace(/--+/g, '-');
};

watch(() => form.title, (val) => {
    form.slug = slugify(val);
});

const onMediaSelected = (media) => {
    selectedImage.value = media;
    form.media_id = media.id;
};

const removeImage = () => {
    selectedImage.value = null;
    form.media_id = null;
};

const submit = () => {
    form.post('/admin/konten', {
        preserveScroll: true,
    });
};

onMounted(() => {
    editorInstance = new EditorJS({
        holder: 'editorjs-container',
        placeholder: 'Mulai menulis berita hari ini... (Ketik Tab untuk memunculkan menu)',
        tools: {
            header: {
                class: Header,
                config: {
                    levels: [2, 3, 4],
                    defaultLevel: 2
                }
            },
            list: {
                class: List,
                inlineToolbar: true,
            }
        },
        onChange: async () => {
            try {
                const content = await editorInstance.save();

                const parsed = edjsParser.parse(content);

                if (Array.isArray(parsed)) {
                    form.body = parsed.join('');
                } else if (typeof parsed === 'string') {
                    form.body = parsed;
                } else {
                    form.body = '';
                    console.warn('Data editor kosong atau tidak dikenali:', parsed);
                }
            } catch (error) {
                console.error("Gagal menyimpan atau mem-parse data Editor.js:", error);
            }
        }
    });
});

onBeforeUnmount(() => {
    if (editorInstance) {
        editorInstance.destroy();
    }
});
</script>

<template>
    <AdminPageHeader :show-action="$can('view-konten')" title="Konten" subtitle="Postingan" action-label="Kembali"
        action-url="/admin/konten" :breadcrumbs="[
            { label: 'Dashboard', url: '/admin' },
            { label: 'Konten', url: '/admin/konten' },
            { label: 'Tambah', url: '#' }
        ]">
        <template #action-icon>
            <ChevronLeft class="w-4 h-4" />
        </template>
    </AdminPageHeader>

    <div class="grid grid-cols-1 gap-3 mb-6 md:grid-cols-2 lg:grid-cols-4">
        <div class="flex flex-col gap-4 mb-6 md:col-span-2 lg:col-span-4 md:flex-row md:items-end md:justify-between">
            <p class="text-[10px] font-bold text-gray-400 uppercase leading-relaxed tracking-wider">
                Pastikan informasi valid dan mematuhi kode etik jurnalistik
                <span class="text-red-700">Berandanesia</span>.
            </p>
        </div>

        <form @submit.prevent="submit" class="grid grid-cols-1 gap-6 md:col-span-2 lg:col-span-4 lg:grid-cols-3">

            <div class="space-y-6 lg:col-span-2">
                <div
                    class="overflow-hidden transition-all bg-white border-l-4 border-red-700 shadow-xl dark:bg-gray-900 rounded-r-xl">
                    <div class="p-8 border-b dark:border-gray-800">
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 block mb-3">
                            Judul Berita
                        </label>
                        <input v-model="form.title" type="text"
                            class="w-full px-4 py-3 text-xl font-black uppercase transition-colors bg-white border-l-4 border-gray-200 rounded-r-lg shadow-sm outline-none dark:bg-gray-900 dark:border-gray-700 focus:ring-0 focus:border-red-700 dark:text-white placeholder:font-normal placeholder:text-gray-300 dark:placeholder:text-gray-600 focus:shadow-lg"
                            placeholder="Ketik Judul di Sini..." />
                        <div v-if="form.errors.title" class="mt-2 text-[10px] font-bold text-red-600 uppercase pl-4">
                            {{ form.errors.title }}
                        </div>
                    </div>

                    <div class="p-6 bg-gray-50/50 dark:bg-gray-800/30">
                        <div
                            class="flex items-center gap-2.5 bg-white dark:bg-gray-900 p-3 rounded-lg border border-dashed dark:border-gray-700 shadow-inner">
                            <div
                                class="flex items-center justify-center border rounded-lg w-7 h-7 bg-red-50 dark:bg-gray-800 shrink-0 dark:border-gray-700">
                                <LinkIcon class="w-4 h-4 text-red-700" />
                            </div>
                            <div
                                class="flex-1 flex items-center gap-1 font-mono text-[11px] overflow-hidden text-gray-400 dark:text-gray-500 truncate">
                                <span class="font-black tracking-widest text-red-700 uppercase shrink-0">Live:</span>
                                <span class="shrink-0">/news/</span>
                                <span class="font-sans font-bold shrink-0 text-red-700/80">
                                    {{ selectedCategorySlug || '{kategori}' }}
                                </span>
                                <span>/</span>
                                <input v-model="form.slug" type="text"
                                    class="flex-1 p-0 italic text-gray-700 bg-transparent border-none dark:text-gray-200 focus:ring-0 min-w-25 font-mono text-[11px]"
                                    placeholder="slug-berita-anda" />
                            </div>
                        </div>
                    </div>
                </div>

                <div
                    class="p-8 transition-all bg-white border-l-4 border-gray-200 shadow-xl dark:bg-gray-900 rounded-xl dark:border-gray-700">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 block mb-4">
                        Isi Berita Lengkap
                    </label>

                    <div
                        class="w-full p-6 text-lg leading-relaxed transition-all border-none outline-none min-h-125 bg-gray-50 dark:bg-gray-950 rounded-2xl dark:text-gray-300 focus-within:ring-2 focus-within:ring-red-700/10 custom-scrollbar">
                        <div id="editorjs-container" class="prose max-w-none dark:prose-invert"></div>
                    </div>

                    <div v-if="form.errors.body" class="mt-2 text-[10px] font-bold text-red-600 uppercase">
                        {{ form.errors.body }}
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <div
                    class="p-6 bg-white border-l-4 border-gray-200 shadow-xl dark:bg-gray-900 rounded-r-xl dark:border-gray-700">
                    <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 block mb-4">Featured
                        Image</label>

                    <div v-if="!selectedImage" @click="showMediaModal = true"
                        class="flex flex-col items-center justify-center transition-all border-2 border-gray-200 border-dashed shadow-inner cursor-pointer bg-gray-50 aspect-video dark:bg-gray-950 dark:border-gray-800 rounded-2xl hover:border-red-700 group">
                        <ImageIcon class="w-10 h-10 mb-3 text-gray-300 transition-colors group-hover:text-red-700" />
                        <span
                            class="text-[10px] font-black uppercase tracking-widest text-gray-400 group-hover:text-red-700">
                            Buka Pustaka Media
                        </span>
                    </div>

                    <div v-else
                        class="relative overflow-hidden shadow-2xl group aspect-video rounded-2xl ring-4 ring-red-700">
                        <img :src="`/storage/${selectedImage.directory}`" class="object-cover w-full h-full"
                            alt="cover" />
                        <div
                            class="absolute inset-0 flex items-center justify-center gap-3 transition-all opacity-0 bg-gray-950/80 backdrop-blur-sm group-hover:opacity-100">
                            <button @click="showMediaModal = true" type="button"
                                class="px-4 py-2 bg-white text-black text-[10px] font-black uppercase rounded-lg hover:bg-red-700 hover:text-white transition-all shadow-lg">Ganti</button>
                            <button @click="removeImage" type="button"
                                class="px-4 py-2 bg-red-700 text-white text-[10px] font-black uppercase rounded-lg hover:bg-red-800 transition-all shadow-lg">Hapus</button>
                        </div>
                    </div>
                </div>

                <div
                    class="p-6 space-y-5 bg-white border-l-4 border-gray-200 shadow-xl dark:bg-gray-900 rounded-r-xl dark:border-gray-700">
                    <div>
                        <label class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 block mb-3">
                            Pilih Kategori
                        </label>
                        <div class="relative group">
                            <select v-model="form.category_id"
                                class="w-full px-4 py-3 text-xs font-bold tracking-wider uppercase transition-all bg-white border-l-4 border-gray-200 rounded-r-lg shadow-sm outline-none appearance-none dark:bg-gray-900 dark:border-gray-700 focus:ring-0 focus:border-red-700 dark:text-white focus:shadow-lg">
                                <option :value="null" disabled>-- Pilih Kategori --</option>
                                <option v-for="cat in categories" :key="cat.id" :value="cat.id">{{ cat.name }}
                                </option>
                            </select>
                            <ChevronDown
                                class="absolute w-4 h-4 text-gray-400 -translate-y-1/2 pointer-events-none right-4 top-1/2 group-focus-within:text-red-700" />
                        </div>
                    </div>

                    <div class="h-px bg-gray-100 dark:bg-gray-800"></div>

                    <div
                        class="flex items-center justify-between p-4 transition-all border border-transparent shadow-inner bg-gray-50 dark:bg-gray-950 rounded-xl hover:border-red-700/30">
                        <div class="flex items-center gap-3">
                            <div
                                class="flex items-center justify-center bg-gray-100 rounded-lg w-7 h-7 dark:bg-gray-800 shrink-0">
                                <Star class="w-4 h-4 text-yellow-500 fill-yellow-500" />
                            </div>
                            <div class="text-[10px] font-black uppercase tracking-widest dark:text-white text-gray-900">
                                Headline
                            </div>
                        </div>
                        <input v-model="form.is_featured" type="checkbox"
                            class="w-6 h-6 text-red-700 border-gray-300 rounded-lg shadow-sm focus:ring-red-700 dark:bg-gray-900 dark:border-gray-800" />
                    </div>
                </div>

                <div class="p-2 transition-all shadow-2xl bg-gray-950 dark:bg-red-700/10 rounded-2xl">
                    <button type="submit" :disabled="form.processing"
                        class="w-full bg-red-700 py-5 font-black uppercase tracking-[0.3em] text-white hover:bg-red-600 transition-all rounded-xl flex items-center justify-center gap-3 disabled:opacity-50 shadow-lg shadow-red-900/40 transform active:scale-95">
                        <span v-if="form.processing"
                            class="w-4 h-4 border-2 rounded-full border-white/30 border-t-white animate-spin"></span>
                        <span v-else>Publish Berita</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <MediaPicker v-if="showMediaModal" @close="showMediaModal = false" @select="onMediaSelected" />

    <Head :title="`Tambah Konten | ${appName1}${appName2}`" />
</template>

<style lang="postcss" scoped>
@reference "../../../../../css/app.css";

.custom-scrollbar::-webkit-scrollbar {
    width: 6px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: transparent;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    @apply bg-gray-200 dark:bg-gray-800 rounded-full;
}

.custom-scrollbar::-webkit-scrollbar-thumb:hover {
    @apply bg-red-700;
}

:deep(.codex-editor) {
    @apply text-gray-900 dark:text-gray-200;
}

:deep(.ce-toolbar__content),
:deep(.ce-block__content) {
    max-width: 100%;
}

:deep(.ce-popover),
:deep(.ce-inline-toolbar),
:deep(.ce-conversion-toolbar) {
    @apply bg-white dark:bg-gray-900 border-gray-200 dark:border-gray-800 text-gray-900 dark:text-white shadow-xl;
}

:deep(.ce-popover__item:hover),
:deep(.ce-inline-toolbar__buttons .ce-inline-tool:hover) {
    @apply bg-gray-100 dark:bg-gray-800;
}

:deep(.ce-inline-tool),
:deep(.ce-toolbar__plus),
:deep(.ce-toolbar__settings-btn) {
    @apply text-gray-700 dark:text-gray-300;
}

:deep(.ce-paragraph[data-placeholder]:empty::before) {
    @apply text-gray-400 dark:text-gray-600 font-medium;
}

:deep(.ce-block--selected .ce-block__content) {
    @apply bg-red-700/10 dark:bg-red-700/30 rounded;
}
</style>

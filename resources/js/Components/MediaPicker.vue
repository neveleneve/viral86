<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import { Search, X, CheckCircle, ImageIcon, Loader2 } from 'lucide-vue-next';

const props = defineProps(['modelValue']);
const emit = defineEmits(['update:modelValue', 'close', 'select']);

const mediaItems = ref([]);
const loading = ref(true);
const search = ref('');
const selectedMedia = ref(null);

const fetchMedia = async () => {
    loading.ref = true;
    try {
        const response = await axios.get('/admin/media/api', { params: { q: search.value } });
        mediaItems.value = response.data;
    } catch (e) {
        console.error("Gagal ambil media");
        media.value = []
    } finally {
        loading.value = false;
    }
};

const selectImage = (media) => {
    selectedMedia.value = media;
};

const confirmSelection = () => {
    if (selectedMedia.value) {
        emit('select', selectedMedia.value);
        emit('close');
    }
};

onMounted(fetchMedia);
</script>

<template>
    <Teleport to="body">

        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-gray-950/80 backdrop-blur-sm">
            <div
                class="bg-white dark:bg-gray-950 w-full max-w-6xl h-[85vh] flex flex-col shadow-2xl border border-gray-200 dark:border-gray-800 rounded-2xl overflow-hidden">

                <div
                    class="flex items-center justify-between p-6 bg-white border-b border-gray-100 dark:border-gray-800 dark:bg-gray-950">
                    <div class="flex items-center gap-3">
                        <div class="p-2 text-white bg-red-700 rounded-lg shadow-lg shadow-red-900/20">
                            <ImageIcon class="w-5 h-5" />
                        </div>
                        <h3 class="text-lg font-black tracking-tight uppercase dark:text-gray-100">Pustaka Media</h3>
                    </div>
                    <button @click="$emit('close')"
                        class="p-2 text-gray-400 transition-all rounded-full hover:text-red-700 hover:bg-gray-100 dark:hover:bg-gray-900">
                        <X class="w-6 h-6" />
                    </button>
                </div>

                <div class="flex flex-1 overflow-hidden">
                    <div class="flex-1 p-6 overflow-y-auto bg-gray-50/50 dark:bg-gray-900/20 custom-scrollbar">
                        <div class="relative mb-6">
                            <Search class="absolute w-4 h-4 text-gray-400 -translate-y-1/2 left-4 top-1/2" />
                            <input v-model="search" @input="fetchMedia" type="text" placeholder="Cari aset media..."
                                class="w-full py-3 pl-12 pr-4 text-sm transition-all bg-white border border-gray-200 shadow-sm outline-none dark:bg-gray-900 dark:border-gray-800 rounded-xl focus:ring-2 focus:ring-red-700 focus:border-transparent dark:text-gray-200" />
                        </div>

                        <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5">
                            <div v-for="media in mediaItems" :key="media.id" @click="selectImage(media)"
                                class="relative overflow-hidden transition-all bg-gray-200 cursor-pointer aspect-square rounded-xl dark:bg-gray-800 group"
                                :class="selectedMedia?.id === media.id ? 'ring-4 ring-red-700 ring-offset-4 dark:ring-offset-gray-950' : 'hover:scale-[0.98]'">
                                <img :src="`/storage/${media.directory}`" class="object-cover w-full h-full" />

                                <div
                                    class="absolute inset-0 transition-opacity opacity-0 bg-red-700/10 group-hover:opacity-100">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div
                        class="hidden p-6 overflow-y-auto bg-white border-l border-gray-100 w-80 dark:border-gray-800 dark:bg-gray-950 lg:block">
                        <div v-if="selectedMedia" class="space-y-6">
                            <div class="overflow-hidden border shadow-xl rounded-xl dark:border-gray-800">
                                <img :src="`/storage/${selectedMedia.directory}`"
                                    class="object-cover w-full aspect-square" />
                            </div>
                            <div>
                                <label
                                    class="text-[10px] font-black uppercase text-red-700 tracking-[0.2em] mb-2 block">Nama
                                    File</label>
                                <h4 class="text-sm font-bold break-all dark:text-gray-200">{{ selectedMedia.name }}</h4>
                            </div>
                            <button @click="confirmSelection"
                                class="w-full bg-red-700 hover:bg-red-800 text-white py-4 rounded-xl font-black text-xs uppercase tracking-[0.2em] transition-all transform active:scale-95 shadow-lg shadow-red-900/20">
                                Konfirmasi Pilihan
                            </button>
                        </div>
                        <div v-else class="flex flex-col items-center justify-center h-full text-center">
                            <div class="p-4 mb-4 rounded-full bg-gray-50 dark:bg-gray-900">
                                <ImageIcon class="w-10 h-10 text-gray-300 dark:text-gray-700" />
                            </div>
                            <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Pilih gambar
                                untuk<br />melihat detail</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Teleport>
</template>

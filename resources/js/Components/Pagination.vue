<script setup>
import { Link } from '@inertiajs/vue3';
import { ChevronLeft, ChevronRight } from 'lucide-vue-next';

defineProps({
    links: Array
});
</script>

<template>
    <div v-if="links.length > 3" class="flex flex-wrap items-center gap-1 mt-8">
        <template v-for="(link, key) in links" :key="key">
            <button v-if="link.url === null"
                class="flex items-center px-4 py-2 cursor-not-allowed text-[10px] font-black uppercase tracking-widest text-gray-300 dark:text-gray-700 bg-gray-100 dark:bg-gray-800 border-l-2 border-gray-200 dark:border-gray-800">
                <span v-if="link.label.includes('Previous')">
                    <ChevronLeft class="w-4 h-4" />
                </span>
                <span v-else-if="link.label.includes('Next')">
                    <ChevronRight class="w-4 h-4" />
                </span>
            </button>
            <button v-else-if="link.active"
                class="flex items-center px-4 py-2 text-[10px] font-black uppercase cursor-pointer tracking-widest transition-all duration-200 bg-red-700 text-white">
                <span>{{ link.label }}</span>
            </button>
            <Link v-else :href="link.url"
                class="flex items-center px-4 py-2 text-[10px] font-black uppercase tracking-widest transition-all duration-200"
                :class="[
                    link.active ? 'bg-red-700 text-white' : 'bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 hover:bg-gray-900 hover:text-white dark:hover:bg-red-700'
                ]">
                <span v-if="link.label.includes('Previous')">
                    <ChevronLeft class="w-4 h-4" />
                </span>
                <span v-else-if="link.label.includes('Next')">
                    <ChevronRight class="w-4 h-4" />
                </span>
                <span v-else>{{ link.label }}</span>
            </Link>
        </template>
    </div>
</template>

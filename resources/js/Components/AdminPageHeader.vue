<script setup>
import { Link } from '@inertiajs/vue3';
import { ChevronRight } from 'lucide-vue-next';

defineProps({
    title: String,
    subtitle: String,
    breadcrumbs: { type: Array, default: () => [] },
    actionUrl: { type: String, default: '#' },
    actionLabel: { type: String, default: 'Kembali' },
    showAction: { type: Boolean, default: true }
});
</script>

<template>
    <div class="mb-8">
        <nav class="flex items-center mb-4 text-[10px] font-black uppercase text-gray-400">
            <template v-for="(crumb, index) in breadcrumbs" :key="index">
                <Link v-if="index < breadcrumbs.length - 1" :href="crumb.url" class="hover:text-red-700">
                    {{ crumb.label }}
                </Link>
                <span v-else class="text-gray-900 dark:text-white">{{ crumb.label }}</span>

                <ChevronRight v-if="index < breadcrumbs.length - 1" class="w-3 h-3 mx-2" />
            </template>
        </nav>
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-black tracking-tighter text-gray-900 uppercase dark:text-white">
                {{ title }}<span class="text-red-700">{{ subtitle }}</span>
            </h1>

            <Link v-if="showAction" :href="actionUrl"
                class="flex items-center gap-2 px-6 py-3 text-[10px] font-black text-white uppercase transition-colors bg-gray-900 hover:bg-red-700">
                <slot name="action-icon" />
                {{ actionLabel }}
            </Link>
        </div>
    </div>
</template>

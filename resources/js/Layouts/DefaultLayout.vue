<template>
    <div class="flex flex-col min-h-screen bg-gray-50 dark:bg-gray-900 text-gray-900 dark:text-gray-100">
        <NewsNavbar />
        <main class="grow w-full max-w-7xl mx-auto my-8 px-4 sm:px-6 lg:px-8">

            <div class="min-h-[60vh]">
                <slot />
            </div>

        </main>
        <NewsFooter />
    </div>
</template>

<script setup>
import NewsNavbar from '@/components/layout/NewsNavbar.vue'
import NewsFooter from '@/components/layout/NewsFooter.vue'
</script>

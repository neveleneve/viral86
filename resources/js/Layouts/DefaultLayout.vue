<template>
    <div class="flex flex-col min-h-screen text-gray-900 bg-gray-50 dark:bg-gray-900 dark:text-gray-100">
        <NewsNavbar />
        <main class="w-full px-4 mx-auto my-8 grow max-w-7xl sm:px-6 lg:px-8">

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
import { watch } from 'vue'
import { usePage } from '@inertiajs/vue3'
import Swal from 'sweetalert2'

const page = usePage()
watch(() => page.props.flash, (flash) => {
    if (!flash) return;
    const isDarkMode = document.documentElement.classList.contains('dark');
    const Toast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        background: isDarkMode ? '#111827' : '#ffffff',
        color: isDarkMode ? '#ffffff' : '#111827',
        customClass: {
            popup: 'rounded-none border-l-4 border-red-700'
        },
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    });

    if (flash.toast == true) {
        Toast.fire({
            icon: flash.icon,
            title: flash.message
        });
    } else if (flash.toast == false) {
        Swal.fire({
            title: flash.title,
            text: flash.message,
            icon: flash.icon,
            confirmButtonColor: '#b91c1c',
            background: page.props.auth.user ? '#1f2937' : '#fff',
            color: page.props.auth.user ? '#fff' : '#000',
            customClass: {
                popup: 'rounded-none border-l-8 border-red-700',
            }
        });
    }
}, { deep: true, immediate: true });
</script>

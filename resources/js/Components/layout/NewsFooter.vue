<template>
    <footer class="bg-gray-900 text-gray-100 pt-12 pb-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-12 px-4 sm:px-6 lg:px-8">
            <div class="space-y-4">
                <h3 class="text-sm lg:text-xl font-bold border-l-[3px] border-red-500 pl-3">
                    Viral86
                </h3>
                <p class="text-gray-400 leading-relaxed text-sm">
                    Menyajikan berita dari seluruh penjuru negeri dengan akurasi dan kecepatan tinggi.
                </p>
            </div>
            <div class="space-y-4">
                <h3 class="text-sm lg:text-xl font-bold border-l-[3px] border-red-500 pl-3">
                    Kategori
                </h3>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="#" class="hover:text-red-400 transition-colors">Politik & Hukum</a></li>
                    <li><a href="#" class="hover:text-red-400 transition-colors">Ekonomi Bisnis</a></li>
                    <li><a href="#" class="hover:text-red-400 transition-colors">Teknologi</a></li>
                </ul>
            </div>
            <div class="space-y-4">
                <h3 class="text-sm lg:text-xl font-bold border-l-[3px] border-red-500 pl-3">
                    Newsletter
                </h3>
                <div class="flex gap-2">
                    <input type="email" placeholder="Email anda"
                        class="bg-gray-800 border-none rounded px-3 py-2 text-sm w-full  focus:ring-4 focus:ring-red-500" />
                    <button
                        class="bg-gray-900 font-bold text-red-700 border border-red-700 hover:bg-red-700 hover:text-gray-50 px-4 py-2 rounded text-sm transition-colors cursor-pointer">
                        Daftar
                    </button>
                </div>
            </div>
        </div>
        <div class="max-w-7xl mx-auto mt-12 pt-6 border-t border-gray-800 text-center text-xs text-gray-500">
            &copy; 2026 Viral86. Hak Cipta Dilindungi.
        </div>
    </footer>
</template>

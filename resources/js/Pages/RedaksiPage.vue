<script setup>
import DefaultLayout from '@/Layouts/DefaultLayout.vue';
import { ChevronRight, Info, MapPin, Phone, Mail, Share2 } from 'lucide-vue-next';

const editorialTeam = [
    {
        groupName: 'Manajemen & Direksi',
        members: [
            { role: 'Pemimpin Umum', name: 'Dr. Arya Wiratama' },
            { role: 'Pemimpin Redaksi / Penanggung Jawab', name: 'Bima Satriya, M.I.Kom' },
            { role: 'Wakil Pemimpin Redaksi', name: 'Siti Aminah' }
        ]
    },
    {
        groupName: 'Redaksi',
        members: [
            { role: 'Redaktur Pelaksana', name: 'Johan S. Putra' },
            { role: 'Redaktur Nasional', name: 'Dian Permatasari' },
            { role: 'Redaktur Ekonomi & Bisnis', name: 'Reza Fahlevi' },
            { role: 'Redaktur Teknologi', name: 'Andi Pratama' }
        ]
    },
    {
        groupName: 'Reporter & Kontributor',
        members: [
            { role: 'Koordinator Liputan', name: 'Bagus Setiawan' },
            { role: 'Reporter Daerah Khusus Jakarta', name: 'Rini Yulianti, Kevin Sanjaya, Aditya Rahman' },
            { role: 'Biro Daerah', name: 'Faisal (Surabaya), Winda (Medan), Anton (Makassar)' },
            { role: 'Fotografer & Videografer', name: 'Dimas Anggara' }
        ]
    }
];

const contactInfo = {
    address: 'Gedung Viral86 Media Group, Lantai 12. Jl. Jenderal Sudirman No. 86, Jakarta Selatan 12190',
    email: 'redaksi@berandanesia.id',
    phone: '+62 21 555 1234'
};
</script>

<template>
    <DefaultLayout>
        <div class="min-h-screen transition-colors duration-300">
            <main class="mx-auto max-w-7xl">
                <nav
                    class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-8 overflow-x-auto whitespace-nowrap">
                    <Link href="/" class="transition-colors hover:text-red-700">Beranda</Link>
                    <ChevronRight class="w-3 h-3" />
                    <span class="text-gray-700 dark:text-gray-300">Tim Redaksi</span>
                </nav>
                <div class="flex flex-col gap-12 lg:flex-row">
                    <article class="w-full">
                        <span
                            class="inline-block border-l-4 border-red-700 pl-4 text-lg lg:text-3xl font-black uppercase tracking-[0.3em] text-gray-50 mb-6">
                            Tim Redaksi
                        </span>
                        <p class="mb-12 text-lg leading-relaxed text-gray-700 dark:text-gray-300">
                            Berandanesia dikelola oleh tenaga profesional yang berdedikasi tinggi terhadap
                            prinsip-prinsip jurnalistik. Kami berkomitmen menyajikan informasi yang akurat, berimbang,
                            dan mencerdaskan kehidupan bangsa.
                        </p>
                        <div class="space-y-12">
                            <section v-for="(group, index) in editorialTeam" :key="index">
                                <h2
                                    class="flex items-center gap-3 mb-6 text-base font-black tracking-tighter text-gray-900 uppercase lg:text-2xl dark:text-white">
                                    <div class="h-6 w-1.5 bg-red-700"></div>
                                    {{ group.groupName }}
                                </h2>
                                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                    <div v-for="(member, mIndex) in group.members" :key="mIndex"
                                        class="p-5 transition-all duration-300 border-l-2 border-transparent hover:border-red-700 hover:bg-white dark:hover:bg-gray-900 group">
                                        <p
                                            class="text-[10px] font-black uppercase tracking-widest text-red-700 dark:text-red-500 mb-2">
                                            {{ member.role }}
                                        </p>
                                        <h3
                                            class="text-base font-bold leading-snug text-gray-900 transition-colors lg:text-2xl dark:text-gray-100 group-hover:text-red-700 dark:group-hover:text-red-500">
                                            {{ member.name }}
                                        </h3>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div
                            class="relative p-8 my-16 overflow-hidden border-l-4 border-gray-200 bg-gray-50 dark:bg-gray-900/50 dark:border-gray-800 group">
                            <div
                                class="absolute top-0 right-0 flex items-center p-3 text-[9px] font-black uppercase tracking-widest text-gray-400">
                                <Info class="w-3.5 h-3.5 mr-1.5 text-gray-400" />
                                <span>Advertisement</span>
                            </div>
                            <div
                                class="flex flex-col items-center justify-center transition-colors border-2 border-gray-200 border-dashed rounded-lg min-h-50 dark:border-gray-800 group-hover:border-red-700/30">
                                <span
                                    class="text-xs font-black text-gray-400 dark:text-gray-600 uppercase tracking-[0.4em]">
                                    Ruang Iklan Strategis
                                </span>
                            </div>
                        </div>
                        <div
                            class="relative p-8 mt-12 overflow-hidden text-white bg-gray-900 border-l-4 border-red-700 shadow-2xl dark:bg-red-950/20 group">
                            <div class="absolute -right-10 -top-10 opacity-5">
                                <MapPin class="w-64 h-64 text-white" />
                            </div>
                            <div class="relative z-10">
                                <h3 class="mb-6 text-xl font-black tracking-tighter uppercase">Alamat Redaksi</h3>
                                <div class="grid items-center grid-cols-1 gap-8 md:grid-cols-2">
                                    <div class="space-y-4 text-sm font-medium text-gray-300">
                                        <div class="flex items-start gap-4">
                                            <MapPin class="w-5 h-5 text-red-500 shrink-0 mt-0.5" />
                                            <p class="leading-relaxed">{{ contactInfo.address }}</p>
                                        </div>
                                        <div class="flex items-center gap-4">
                                            <Mail class="w-5 h-5 text-red-500 shrink-0" />
                                            <a :href="`mailto:${contactInfo.email}`"
                                                class="transition-colors hover:text-white">{{ contactInfo.email }}</a>
                                        </div>
                                        <div class="flex items-center gap-4">
                                            <Phone class="w-5 h-5 text-red-500 shrink-0" />
                                            <a :href="`tel:${contactInfo.phone}`"
                                                class="transition-colors hover:text-white">{{ contactInfo.phone }}</a>
                                        </div>
                                    </div>
                                    <div
                                        class="w-full h-48 overflow-hidden transition-all duration-500 border-2 border-gray-800 rounded-sm shadow-inner dark:border-red-900/50 grayscale hover:grayscale-0">
                                        <iframe
                                            src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d9760.181615368916!2d106.85254000000002!3d-6.258191000000001!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f3b2b5f25827%3A0xfb448f6e57a7a372!2sKalibata%20City%2C%20Jl.%20Raya%20Kalibata%20No.1%2C%20RT.9%2FRW.4%2C%20Rawajati%2C%20Kec.%20Pancoran%2C%20Kota%20Jakarta%20Selatan%2C%20Daerah%20Khusus%20Ibukota%20Jakarta%2012750!5e1!3m2!1sid!2sid!4v1772076111025!5m2!1sid!2sid"
                                            width="100%" height="100%" style="border:0;" allowfullscreen=""
                                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            </main>
        </div>
    </DefaultLayout>

    <Head title="Tim Redaksi | Berandanesia" />
</template>

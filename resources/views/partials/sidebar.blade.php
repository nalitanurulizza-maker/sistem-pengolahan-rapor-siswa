<aside class="w-[250px] min-h-screen fixed text-white flex flex-col shadow-xl"
       style="background: linear-gradient(180deg,#0d2856,#1e6fdc);">

    <!-- LOGO -->
    <div class="p-5 border-b border-white/10 text-center">
        <h4 class="text-xl font-extrabold">E - RAPOR</h4>
    </div>

    <!-- MENU -->
    <nav class="mt-4 flex-1">

        <a href="/admin/dashboard" class="block py-3 px-5 hover:bg-white/10 transition">
            <i class="fa-solid fa-house w-6"></i> Dashboard
        </a>

        <!-- DATA MASTER -->
        <div x-data="{open:false}">
            <button @click="open=!open"
                class="w-full text-left py-3 px-5 flex justify-between items-center hover:bg-white/10">
                <span><i class="fa-solid fa-database w-6"></i> Data Master</span>
                <i class="fa-solid fa-chevron-down text-xs transition-transform"
                   :class="open && 'rotate-180'"></i>
            </button>

            <div x-show="open" x-cloak class="text-sm pl-10">
                <a href="/admin/data-siswa" class="block py-2 hover:text-cyan-300">Data Siswa</a>
                <a href="#" class="block py-2 hover:text-cyan-300">Data Guru</a>
                <a href="#" class="block py-2 hover:text-cyan-300">Data Wali Kelas</a>
            </div>
        </div>

        <!-- AKADEMIK -->
        <div x-data="{open:false}">
            <button @click="open=!open"
                class="w-full text-left py-3 px-5 flex justify-between items-center hover:bg-white/10">
                <span><i class="fa-solid fa-graduation-cap w-6"></i> Akademik</span>
                <i class="fa-solid fa-chevron-down text-xs transition-transform"
                   :class="open && 'rotate-180'"></i>
            </button>

            <div x-show="open" x-cloak class="text-sm pl-10">
                <a href="#" class="block py-2 hover:text-cyan-300">Mata Pelajaran</a>
                <a href="#" class="block py-2 hover:text-cyan-300">Tahun Akademik</a>
            </div>
        </div>

    </nav>

    <!-- LOGOUT -->
    <a href="#" class="py-4 px-5 hover:bg-red-500 transition border-t border-white/10">
        <i class="fa-solid fa-right-from-bracket w-6"></i> Keluar
    </a>
</aside>
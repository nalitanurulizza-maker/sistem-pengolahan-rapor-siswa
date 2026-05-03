<aside class="w-[250px] h-screen fixed text-white shadow-xl z-50"
    style="background: linear-gradient(180deg,#0d2856,#1e6fdc);">

    <h4 class="p-5 text-xl font-extrabold text-center border-b border-white/10">
        E - RAPOR
    </h4>

    <nav class="mt-4">
        <a href="{{ route('admin-dashboard') }}" class="block py-3 px-5 hover:bg-white/10 transition">
            <i class="fa-solid fa-house w-6"></i> Dashboard
        </a>

        <!-- DATA MASTER -->
        <div x-data="{open:false}">
            <button @click="open=!open" class="w-full text-left py-3 px-5 flex justify-between hover:bg-white/10 transition">
                <span><i class="fa-solid fa-database w-6"></i> Data Master</span>
                <i class="fa-solid fa-chevron-down text-xs self-center transition-transform" :class="open && 'rotate-180'"></i>
            </button>
            <div x-show="open" x-cloak class="text-sm pl-12 pb-2 bg-black/10">
                <a href="{{ route('data-siswa') }}" class="block py-2 hover:text-cyan-300">Data Siswa</a>
                <a href="{{ route('data-guru') }}" class="block py-2 hover:text-cyan-300">Data Guru</a>
                <a href="{{ route('data-wali-kelas') }}" class="block py-2 hover:text-cyan-300">Data Wali Kelas</a>
            </div>
        </div>

        <!-- AKADEMIK -->
        <div x-data="{open:false}">
            <button @click="open=!open" class="w-full text-left py-3 px-5 flex justify-between hover:bg-white/10 transition">
                <span><i class="fa-solid fa-graduation-cap w-6"></i> Akademik</span>
                <i class="fa-solid fa-chevron-down text-xs self-center transition-transform" :class="open && 'rotate-180'"></i>
            </button>
            <div x-show="open" x-cloak class="text-sm pl-12 pb-2 bg-black/10">
                <a href="#" class="block py-2 hover:text-cyan-300">Mata Pelajaran</a>
                <a href="#" class="block py-2 hover:text-cyan-300">Tahun Akademik</a>
            </div>
        </div>

        <a href="/" class="block py-3 px-5 mt-10 hover:bg-red-500 transition">
            <i class="fa-solid fa-right-from-bracket w-6"></i> Keluar
        </a>
    </nav>
</aside>
@extends('layout.admin-app')

@section('title', 'Dashboard Admin')

@section('content')

<!-- WELCOME HEADER -->
<div class="mt-4 p-8 rounded-3xl shadow-sm border border-white/20" 
     style="background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.7) 100%); backdrop-filter: blur(15px);">
    <div class="flex items-center gap-5">
        <div class="p-4 bg-indigo-600 rounded-2xl text-white shadow-lg shadow-indigo-200">
            <i class="fa-solid fa-user-shield text-3xl"></i>
        </div>
        <div>
            <h2 class="text-2xl font-bold text-[#1a2340]">
                Selamat Datang di Halaman Admin
            </h2>
            <p class="text-gray-500 font-medium">Aplikasi E-RAPOR | Kendali Sistem Utama</p>
        </div>
    </div>
    <p class="mt-4 text-gray-600 leading-relaxed max-w-2xl">
        Halo Admin! Anda memiliki akses penuh untuk mengelola <strong>Data Master</strong>, <strong>Akademik</strong>, dan konfigurasi sistem lainnya melalui sidebar.
    </p>
</div>

<!-- DASHBOARD GRID -->
<div class="grid grid-cols-12 gap-6 mt-8">

    <!-- REKAP DATA UTAMA -->
    <div class="col-span-12 lg:col-span-8 bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
        <div class="flex justify-between items-center mb-8">
            <h3 class="font-bold text-lg tracking-tight text-gray-800 flex items-center gap-2">
                <span class="w-2 h-6 bg-indigo-500 rounded-full"></span>
                REKAPITULASI DATA MASTER
            </h3>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-5">
            <!-- Card Guru -->
            <div class="group p-6 rounded-2xl border border-gray-100 bg-slate-50 transition-all hover:bg-white hover:shadow-xl hover:shadow-indigo-100 hover:-translate-y-1">
                <div class="w-10 h-10 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center mb-4 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                    <i class="fa-solid fa-chalkboard-user text-lg"></i>
                </div>
                <p class="text-xs font-bold uppercase tracking-widest text-gray-400">Guru</p>
                <p class="text-3xl font-black text-gray-800 mt-1">40</p>
            </div>

            <!-- Card Siswa -->
            <div class="group p-6 rounded-2xl border border-gray-100 bg-slate-50 transition-all hover:bg-white hover:shadow-xl hover:shadow-blue-100 hover:-translate-y-1">
                <div class="w-10 h-10 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center mb-4 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                    <i class="fa-solid fa-user-graduate text-lg"></i>
                </div>
                <p class="text-xs font-bold uppercase tracking-widest text-gray-400">Siswa</p>
                <p class="text-3xl font-black text-gray-800 mt-1">210</p>
            </div>

            <!-- Card Kelas -->
            <div class="group p-6 rounded-2xl border border-gray-100 bg-slate-50 transition-all hover:bg-white hover:shadow-xl hover:shadow-purple-100 hover:-translate-y-1">
                <div class="w-10 h-10 rounded-lg bg-purple-100 text-purple-600 flex items-center justify-center mb-4 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                    <i class="fa-solid fa-door-open text-lg"></i>
                </div>
                <p class="text-xs font-bold uppercase tracking-widest text-gray-400">Kelas</p>
                <p class="text-3xl font-black text-gray-800 mt-1">12</p>
            </div>

            <!-- Card Mapel -->
            <div class="group p-6 rounded-2xl border border-gray-100 bg-slate-50 transition-all hover:bg-white hover:shadow-xl hover:shadow-emerald-100 hover:-translate-y-1">
                <div class="w-10 h-10 rounded-lg bg-emerald-100 text-emerald-600 flex items-center justify-center mb-4 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                    <i class="fa-solid fa-book-open text-lg"></i>
                </div>
                <p class="text-xs font-bold uppercase tracking-widest text-gray-400">Mapel</p>
                <p class="text-3xl font-black text-gray-800 mt-1">47</p>
            </div>
        </div>
    </div>

    <!-- PANDUAN & AKTIVITAS -->
    <div class="col-span-12 lg:col-span-4 bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
        <h3 class="font-bold text-lg mb-6 tracking-tight text-gray-800">
            Panduan Admin
        </h3>

        <div class="space-y-4">
            <div class="p-5 rounded-2xl flex gap-4 items-start bg-amber-50 border border-amber-100">
                <div class="p-2 bg-amber-400 rounded-xl text-white shadow-sm">
                    <i class="fa-solid fa-lightbulb"></i>
                </div>
                <div>
                    <p class="text-sm font-bold text-amber-900 mb-1">Tips Navigasi</p>
                    <p class="text-xs text-amber-800 leading-relaxed">
                        Gunakan menu <strong>Data Master & Akademik</strong> di sidebar untuk konfigurasi semester dan tahun ajaran.
                    </p>
                </div>
            </div>

            <div class="p-5 rounded-2xl flex gap-4 items-start bg-slate-50 border border-slate-200">
                <div class="p-2 bg-slate-400 rounded-xl text-white">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div>
                    <p class="text-sm font-bold text-slate-800 mb-1">Keamanan</p>
                    <p class="text-xs text-slate-600 leading-relaxed">
                        Jangan lupa untuk mencadangkan (backup) data secara berkala pada menu pengaturan.
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
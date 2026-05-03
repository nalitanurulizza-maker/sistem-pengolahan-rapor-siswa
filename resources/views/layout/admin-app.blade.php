<<<<<<< HEAD
@extends('layout.admin-app')

@section('title', 'Dashboard Admin | E-Rapor')

@section('content')

    <!-- HEADER BAR (Sama dengan Guru) -->
    <div class="rounded-2xl p-4 text-white shadow-lg flex justify-between items-center"
         style="background: linear-gradient(135deg,#1e6fdc,#00d4ff);">
        <div class="font-semibold">
            E-RAPOR SMA | <span class="opacity-80">2026/2027</span>
        </div>
        <div class="bg-white/20 px-4 py-1 rounded-full flex items-center gap-2 border border-white/30">
            <i class="fa-solid fa-user-shield"></i>
            <span class="text-sm font-bold">Admin Utama</span>
        </div>
    </div>

    <!-- WELCOME BANNER -->
    <div class="mt-6 bg-white p-8 rounded-3xl shadow-sm border border-gray-100 transition-all hover:shadow-md">
        <div class="flex items-center gap-5">
            <div class="p-4 bg-indigo-600 rounded-2xl text-white shadow-lg shadow-indigo-100">
                <i class="fa-solid fa-shield-halved text-2xl"></i>
            </div>
            <div>
                <h2 class="text-2xl font-extrabold text-[#1a2340]">
                    Selamat Datang di Kontrol Admin
                </h2>
                <p class="text-gray-500 font-medium italic">Manajemen Pusat Data E-Rapor</p>
            </div>
        </div>
        <p class="mt-4 text-gray-600 leading-relaxed max-w-3xl">
            Halo Admin! Anda sedang mengakses sistem dalam **Mode Administrator**. Gunakan sidebar untuk mengelola Data Master, Kurikulum, dan konfigurasi akademik lainnya.
        </p>
    </div>

    <!-- DASHBOARD STATS GRID -->
    <div class="mt-6 grid grid-cols-1 lg:grid-cols-12 gap-6">
        
        <!-- REKAP DATA (8 COLUMNS) -->
        <div class="lg:col-span-8 bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-8">
                <h3 class="font-bold text-gray-800 uppercase tracking-widest text-sm flex items-center gap-2">
                    <span class="w-1.5 h-5 bg-indigo-500 rounded-full"></span>
                    Statistik Data Master
                </h3>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                <!-- Card Guru -->
                <div class="group p-6 rounded-2xl bg-slate-50 border border-gray-100 transition-all hover:bg-white hover:shadow-xl hover:shadow-indigo-50 hover:-translate-y-1">
                    <div class="w-10 h-10 rounded-xl bg-indigo-100 text-indigo-600 flex items-center justify-center mb-4 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-chalkboard-user"></i>
                    </div>
                    <p class="text-[10px] font-black uppercase tracking-tighter text-gray-400">Guru</p>
                    <p class="text-3xl font-black text-gray-800 mt-1">40</p>
                </div>

                <!-- Card Siswa -->
                <div class="group p-6 rounded-2xl bg-slate-50 border border-gray-100 transition-all hover:bg-white hover:shadow-xl hover:shadow-blue-50 hover:-translate-y-1">
                    <div class="w-10 h-10 rounded-xl bg-blue-100 text-blue-600 flex items-center justify-center mb-4 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-user-graduate"></i>
                    </div>
                    <p class="text-[10px] font-black uppercase tracking-tighter text-gray-400">Siswa</p>
                    <p class="text-3xl font-black text-gray-800 mt-1">210</p>
                </div>

                <!-- Card Kelas -->
                <div class="group p-6 rounded-2xl bg-slate-50 border border-gray-100 transition-all hover:bg-white hover:shadow-xl hover:shadow-purple-50 hover:-translate-y-1">
                    <div class="w-10 h-10 rounded-xl bg-purple-100 text-purple-600 flex items-center justify-center mb-4 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-building"></i>
                    </div>
                    <p class="text-[10px] font-black uppercase tracking-tighter text-gray-400">Kelas</p>
                    <p class="text-3xl font-black text-gray-800 mt-1">12</p>
                </div>

                <!-- Card Mapel -->
                <div class="group p-6 rounded-2xl bg-slate-50 border border-gray-100 transition-all hover:bg-white hover:shadow-xl hover:shadow-emerald-50 hover:-translate-y-1">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 text-emerald-600 flex items-center justify-center mb-4 group-hover:bg-emerald-600 group-hover:text-white transition-colors">
                        <i class="fa-solid fa-book"></i>
                    </div>
                    <p class="text-[10px] font-black uppercase tracking-tighter text-gray-400">Mapel</p>
                    <p class="text-3xl font-black text-gray-800 mt-1">47</p>
                </div>
            </div>
        </div>

        <!-- PANDUAN / INFO (4 COLUMNS) -->
        <div class="lg:col-span-4 bg-white p-8 rounded-3xl shadow-sm border border-gray-100">
            <h3 class="font-bold text-gray-800 uppercase tracking-widest text-sm mb-8">
                Pusat Bantuan
            </h3>
            
            <div class="space-y-4">
                <div class="p-5 rounded-2xl flex gap-4 items-start bg-amber-50 border border-amber-100">
                    <div class="p-2.5 bg-amber-400 rounded-xl text-white shadow-sm">
                        <i class="fa-solid fa-circle-info"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-amber-900 mb-1">Panduan Master</p>
                        <p class="text-xs text-amber-800 leading-relaxed">
                            Pastikan data <strong>Tahun Ajaran</strong> sudah aktif sebelum guru menginput nilai.
                        </p>
                    </div>
                </div>

                <div class="p-5 rounded-2xl flex gap-4 items-start bg-indigo-50 border border-indigo-100">
                    <div class="p-2.5 bg-indigo-500 rounded-xl text-white shadow-sm">
                        <i class="fa-solid fa-database"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-indigo-900 mb-1">Backup Data</p>
                        <p class="text-xs text-indigo-800 leading-relaxed">
                            Lakukan pencadangan database secara rutin setiap akhir semester.
                        </p>
                    </div>
                </div>
            </div>
        </div>
=======
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <!-- Tailwind & FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- AlpineJS untuk Dropdown Sidebar -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="font-sans flex bg-[#f0f6ff]">

    <!-- Panggil Sidebar -->
    @include('partials.sidebar')

    <!-- Main Content Area -->
    <main class="ml-[250px] flex-1 p-6 min-h-screen">
        @yield('content')
    </main>
>>>>>>> 4c30cd140ee643bf35dbb8ea747f23723b0ad93c

    </div>

@endsection
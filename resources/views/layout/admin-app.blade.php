<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Alpine -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="bg-[#f0f6ff]">

<div class="flex">

  <!-- SIDEBAR -->
<aside class="w-[250px] min-h-screen fixed text-white flex flex-col shadow-xl bg-gradient-to-b from-[#0d2856] to-[#1e6fdc]">

    <div class="p-5 border-b border-white/10 text-center">
        <h4 class="text-xl font-extrabold tracking-widest">E - RAPOR</h4>
    </div>

    <nav class="mt-4 flex-1 overflow-y-auto">
        <!-- DASHBOARD -->
        <a href="{{ route('admin-dashboard') }}" 
           class="block py-3 px-5 hover:bg-white/10 transition {{ request()->routeIs('admin-dashboard') ? 'bg-white/20 font-bold' : '' }}">
            <i class="fa-solid fa-house w-6"></i> Dashboard
        </a>

        <!-- DATA MASTER -->
        <div x-data="{ open: {{ request()->is('admin/data-*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="w-full flex items-center justify-between py-3 px-5 hover:bg-white/10 transition">
                <span class="flex items-center">
                    <i class="fa-solid fa-database w-6"></i> Data Master
                </span>
                <i class="fa-solid fa-chevron-down text-xs transition-transform" :class="open ? 'rotate-180' : ''"></i>
            </button>
            <div x-show="open" x-cloak class="bg-black/10 pb-2">
                <a href="{{ route('data-siswa') }}" class="block py-2 pl-12 pr-5 hover:text-blue-300 transition text-sm {{ request()->routeIs('data-siswa') ? 'text-blue-300 font-bold' : '' }}">
                    + Data Siswa
                </a>
                <a href="{{ route('data-guru') }}" class="block py-2 pl-12 pr-5 hover:text-blue-300 transition text-sm {{ request()->routeIs('data-guru') ? 'text-blue-300 font-bold' : '' }}">
                    + Data Guru
                </a>
                <a href="{{ route('data-wali-kelas') }}" class="block py-2 pl-12 pr-5 hover:text-blue-300 transition text-sm {{ request()->routeIs('data-wali-kelas') ? 'text-blue-300 font-bold' : '' }}">
                    + Data Wali Kelas
                </a>
            </div>
        </div>

        <!-- AKADEMIK -->
        <div x-data="{ open: {{ request()->is('admin/mata-*') || request()->is('admin/tahun-*') ? 'true' : 'false' }} }">
            <button @click="open = !open" class="w-full flex items-center justify-between py-3 px-5 hover:bg-white/10 transition">
                <span class="flex items-center">
                    <i class="fa-solid fa-graduation-cap w-6"></i> Akademik
                </span>
                <i class="fa-solid fa-chevron-down text-xs transition-transform" :class="open ? 'rotate-180' : ''"></i>
            </button>
            <div x-show="open" x-cloak class="bg-black/10 pb-2">
                <a href="{{ route('mata-pelajaran') }}" class="block py-2 pl-12 pr-5 hover:text-blue-300 transition text-sm {{ request()->routeIs('mata-pelajaran') ? 'text-blue-300 font-bold' : '' }}">
                    + Mata Pelajaran
                </a>
                <a href="{{ route('tahun-akademik') }}" class="block py-2 pl-12 pr-5 hover:text-blue-300 transition text-sm {{ request()->routeIs('tahun-akademik') ? 'text-blue-300 font-bold' : '' }}">
                    + Tahun Akademik
                </a>
            </div>
        </div>
    </nav>

    <!-- LOGOUT -->
    <a href="{{ route('login') }}" class="py-4 px-5 hover:bg-red-500 transition border-t border-white/10 mt-auto">
        <i class="fa-solid fa-right-from-bracket w-6"></i> Keluar
    </a>

</aside>


    <!-- MAIN -->
    <div class="ml-[250px] flex-1 p-6">

        <!-- HEADER -->
        <div class="rounded-2xl p-4 text-white shadow-lg flex justify-between items-center bg-gradient-to-r from-[#1e6fdc] to-[#00d4ff]">
            <div class="font-semibold">
                E-RAPOR SMA | <span class="opacity-80">2026/2027</span>
            </div>

            <div class="bg-white/20 px-4 py-1 rounded-full flex items-center gap-2">
                <i class="fa-solid fa-chalkboard-user"></i>
                <span class="text-sm">Admin</span>
            </div>
        </div>

        <!-- ISI HALAMAN -->
        <div class="mt-2">
            @yield('content')
        </div>

    </div>

</div>

</body>
</html>

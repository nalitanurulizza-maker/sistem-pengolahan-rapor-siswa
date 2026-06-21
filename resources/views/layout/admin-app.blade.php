<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="bg-[#f0f6ff]">
<div class="flex">

    <aside class="w-[210px] min-h-screen fixed text-white flex flex-col shadow-xl bg-gradient-to-b from-[#0d2856] to-[#1e6fdc]">

        <div class="p-4 border-b border-white/10 text-center">
            <h4 class="text-lg font-extrabold tracking-widest">E - RAPOR</h4>
        </div>

        <nav class="mt-4 flex-1 overflow-y-auto">
            <a href="{{ route('admin.dashboard-admin') }}" 
               class="block py-3 px-4 hover:bg-white/10 transition text-sm {{ request()->routeIs('admin.dashboard-admin') ? 'bg-white/20 font-bold' : '' }}">
                <i class="fa-solid fa-house w-5"></i> Dashboard
            </a>

            <div x-data="{ open: {{ request()->is('admin/data-*') ? 'true' : 'false' }} }">
                <button @click="open = !open" class="w-full flex items-center justify-between py-3 px-4 hover:bg-white/10 transition text-sm">
                    <span class="flex items-center">
                        <i class="fa-solid fa-database w-5"></i> Data Master
                    </span>
                    <i class="fa-solid fa-chevron-down text-[10px] transition-transform" :class="open ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="open" x-cloak class="bg-black/10 pb-2">
                    <a href="{{ route('admin.data-siswa') }}" class="block py-2 pl-10 pr-4 hover:text-blue-300 transition text-xs {{ request()->routeIs('admin.data-siswa') ? 'text-blue-300 font-bold' : '' }}">
                        + Data Siswa
                    </a>
                    <a href="{{ route('admin.data-guru') }}" class="block py-2 pl-10 pr-4 hover:text-blue-300 transition text-xs {{ request()->routeIs('admin.data-guru') ? 'text-blue-300 font-bold' : '' }}">
                        + Data Guru
                    </a>
                    <a href="{{ route('admin.data-kelas') }}" class="block py-2 pl-10 pr-4 hover:text-blue-300 transition text-xs {{ request()->routeIs('admin.data-kelas') ? 'text-blue-300 font-bold' : '' }}">
                        + Data Kelas
                    </a>
                </div>
            </div>

            {{-- Awal Kelompok Akademik --}}
<div x-data="{ open: {{ request()->is('admin/mata-*') || request()->is('admin/tahun-*') || request()->is('admin/guru-pengampu*') ? 'true' : 'false' }} }">
    <button @click="open = !open" class="w-full flex items-center justify-between py-3 px-4 hover:bg-white/10 transition text-sm">
        <span class="flex items-center">
            <i class="fa-solid fa-graduation-cap w-5"></i> Akademik
        </span>
        <i class="fa-solid fa-chevron-down text-[10px] transition-transform" :class="open ? 'rotate-180' : ''"></i>
    </button>
    <div x-show="open" x-cloak class="bg-black/10 pb-2">
        <a href="{{ route('admin.mata-pelajaran') }}" class="block py-2 pl-10 pr-4 hover:text-blue-300 transition text-xs {{ request()->routeIs('admin.mata-pelajaran') ? 'text-blue-300 font-bold' : '' }}">
            + Mata Pelajaran
        </a>
        <a href="{{ route('admin.guru-pengampu.index') }}" class="block py-2 pl-10 pr-4 hover:text-blue-300 transition text-xs {{ request()->routeIs('admin.guru-pengampu.index') ? 'text-blue-300 font-bold' : '' }}">
            + Guru Pengampu
        </a>
        <a href="{{ route('admin.tahun-akademik') }}" class="block py-2 pl-10 pr-4 hover:text-blue-300 transition text-xs {{ request()->routeIs('admin.tahun-akademik') ? 'text-blue-300 font-bold' : '' }}">
            + Tahun Akademik
        </a>
        
    </div>
</div>
{{-- Akhir Kelompok Akademik --}}
        </nav>

                {{-- Form Logout  --}}
        <form id="logout-form" method="POST" action="{{ route('logout') }}" x-data>
            @csrf
            <button type="button" 
                    @click="if (confirm('Apakah Anda yakin ingin keluar?')) { $el.closest('form').submit(); }"
                    class="w-full py-4 px-4 hover:bg-red-500 transition border-t border-white/10 mt-auto text-sm text-left text-white bg-transparent">
                <i class="fa-solid fa-right-from-bracket w-5"></i> Keluar
            </button>
        </form>
    </aside>

    <div class="ml-[210px] flex-1 p-6 transition-all duration-300">

        <div class="rounded-2xl p-4 text-white shadow-lg flex justify-between items-center bg-gradient-to-r from-[#1e6fdc] to-[#00d4ff]">
            <div class="font-semibold text-sm sm:text-base">
                E-RAPOR SMA | <span class="opacity-80">2026/2027</span>
            </div>
            <div class="bg-white/20 px-4 py-1 rounded-full flex items-center gap-2">
                <i class="fa-solid fa-chalkboard-user"></i>
                <span class="text-sm">{{ Auth::user()->name }}</span>
            </div>
        </div>

        <div class="mt-4">
            @yield('content')
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>
</html>
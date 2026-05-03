<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Walas | @yield('title')</title>

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

    <!-- SIDEBAR WALI KELAS -->
    <aside class="w-[250px] min-h-screen fixed text-white flex flex-col shadow-xl bg-gradient-to-b from-[#0d2856] to-[#1e6fdc]">

        <div class="p-5 border-b border-white/10 text-center">
            <h4 class="text-xl font-extrabold tracking-widest">E - RAPOR</h4>
        </div>

        <nav class="mt-4 flex-1">

            <!-- DASHBOARD -->
            <a href="{{ route('walas-dashboard') }}" 
               class="block py-3 px-5 hover:bg-white/10 transition {{ request()->routeIs('walas-dashboard') ? 'bg-white/20 font-bold' : '' }}">
                <i class="fa-solid fa-house w-6"></i> Dashboard
            </a>

            <!-- INPUT DATA RAPOR (DROPDOWN) -->
            <div x-data="{ open: {{ request()->is('walas/input-*') ? 'true' : 'false' }} }">
                <button type="button" @click="open = !open"
                    class="w-full text-left py-3 px-5 flex justify-between items-center hover:bg-white/10 transition">
                    <span>
                        <i class="fa-solid fa-file-signature w-6"></i> Input Data Rapor
                    </span>
                    <i class="fa-solid fa-chevron-down text-xs transition-transform duration-300"
                       :class="open ? 'rotate-180' : ''"></i>
                </button>

                <div x-show="open" x-cloak x-transition class="text-sm pl-10 bg-black/10">
                    <a href="{{ route('walas.input-kehadiran') }}" 
                       class="block py-3 hover:text-cyan-300 flex items-center gap-2 {{ request()->routeIs('walas.input-kehadiran') ? 'text-cyan-300 font-bold' : '' }}">
                        <i class="fa-solid fa-plus text-[10px]"></i> Input Kehadiran
                    </a>
                    <a href="{{ route('walas.input-catatan') }}" 
                       class="block py-3 hover:text-cyan-300 flex items-center gap-2 {{ request()->routeIs('walas.input-catatan') ? 'text-cyan-300 font-bold' : '' }}">
                        <i class="fa-solid fa-plus text-[10px]"></i> Input Catatan Walas
                    </a>
                    <a href="{{ route('walas.input-predikat') }}" 
                       class="block py-3 hover:text-cyan-300 flex items-center gap-2 {{ request()->routeIs('walas.input-predikat') ? 'text-cyan-300 font-bold' : '' }}">
                        <i class="fa-solid fa-plus text-[10px]"></i> Input Predikat Nilai
                    </a>
                </div>
            </div>

            <!-- CETAK RAPOR (DROPDOWN) -->
            <div x-data="{ open: {{ request()->is('walas/cetak-*') ? 'true' : 'false' }} }">
                <button type="button" @click="open = !open"
                    class="w-full text-left py-3 px-5 flex justify-between items-center hover:bg-white/10 transition">
                    <span>
                        <i class="fa-solid fa-print w-6"></i> Cetak Rapor
                    </span>
                    <i class="fa-solid fa-chevron-down text-xs transition-transform duration-300"
                       :class="open ? 'rotate-180' : ''"></i>
                </button>

                <div x-show="open" x-cloak x-transition class="text-sm pl-10 bg-black/10">
                    <a href="{{ route('walas.cetak-pdf') }}" 
                       class="block py-3 hover:text-cyan-300 flex items-center gap-2 {{ request()->routeIs('walas.cetak-pdf') ? 'text-cyan-300 font-bold' : '' }}">
                        <i class="fa-solid fa-arrow-right text-[10px]"></i> Cetak PDF
                    </a>
                </div>
            </div>

        </nav>

        <!-- LOGOUT -->
        <a href="{{ route('login') }}" class="py-4 px-5 hover:bg-red-500 transition border-t border-white/10 mt-auto">
            <i class="fa-solid fa-right-from-bracket w-6"></i> Keluar
        </a>

    </aside>

    <!-- MAIN CONTENT -->
    <div class="ml-[250px] flex-1 p-6">

          <!-- HEADER -->
        <div class="rounded-2xl p-4 text-white shadow-lg flex justify-between items-center bg-gradient-to-r from-[#1e6fdc] to-[#00d4ff]">
            <div class="font-semibold">
                E-RAPOR SMA | <span class="opacity-80">2026/2027</span>
            </div>

            <div class="bg-white/20 px-4 py-1 rounded-full flex items-center gap-2">
                <i class="fa-solid fa-user"></i>
                <span class="text-sm">Wali Kelas</span>
            </div>
        </div>

        <!-- ISI KONTEN DINAMIS -->
        <div class="mt-4">
            @yield('content')
        </div>

    </div>

</div>

</body>
</html>
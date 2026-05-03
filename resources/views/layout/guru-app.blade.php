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
            <h4 class="text-xl font-extrabold">E - RAPOR</h4>
        </div>

        <nav class="mt-4 flex-1">

            <!-- DASHBOARD -->
            <a href="{{ route('guru.dashboard') }}" class="block py-3 px-5 hover:bg-white/10 transition">
                <i class="fa-solid fa-house w-6"></i> Dashboard
            </a>

            <!-- INPUT NILAI -->
<div x-data="{open:false}">
    <button type="button" @click="open = !open"
        class="w-full text-left py-3 px-5 flex justify-between items-center hover:bg-white/10">

        <span>
            <i class="fa-solid fa-book-open w-6"></i> Input Nilai
        </span>

        <i class="fa-solid fa-chevron-down text-xs transition"
           :class="open ? 'rotate-180' : ''"></i>
    </button>

    <div x-show="open" x-cloak x-transition class="text-sm pl-10">
        <a href="#" class="block py-2 hover:text-cyan-300 flex items-center gap-2">
            <i class="fa-solid fa-plus text-xs"></i>
            Input Nilai Rapor
        </a>
    </div>
</div>


<!-- NILAI TERSIMPAN -->
<div x-data="{open:false}">
    <button type="button" @click="open = !open"
        class="w-full text-left py-3 px-5 flex justify-between items-center hover:bg-white/10">

        <span>
            <i class="fa-solid fa-folder-open w-6"></i> Nilai Tersimpan
        </span>

        <i class="fa-solid fa-chevron-down text-xs transition"
           :class="open ? 'rotate-180' : ''"></i>
    </button>

    <div x-show="open" x-cloak x-transition class="text-sm pl-10">
        <a href="#" class="block py-2 hover:text-cyan-300 flex items-center gap-2">
            <i class="fa-solid fa-arrow-right text-xs"></i>
            Cek Nilai Rapor
        </a>
    </div>
</div>

        </nav>

        <!-- LOGOUT -->
        <a href="{{ route('login') }}" class="py-4 px-5 hover:bg-red-500 transition border-t border-white/10">
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
                <span class="text-sm">Guru</span>
            </div>
        </div>

        <!-- ISI HALAMAN -->
        @yield('content')

    </div>

</div>

</body>
</html>
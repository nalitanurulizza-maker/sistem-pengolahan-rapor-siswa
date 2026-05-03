<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'e-Rapor')</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        [x-cloak] { display: none !important; }
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="bg-[#f0f6ff]">

<div class="flex">

    <!-- SIDEBAR -->
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

    <!-- MAIN CONTENT -->
    <div class="ml-[250px] flex-1 p-6">

        <!-- HEADER -->
        <div class="rounded-2xl p-4 text-white shadow-lg flex justify-between items-center"
             style="background: linear-gradient(135deg,#1e6fdc,#00d4ff);">

            <div class="font-semibold">
                E-RAPOR SMA | <span class="opacity-80">2026/2027</span>
            </div>

            <div class="bg-white/20 px-4 py-1 rounded-full flex items-center gap-2">
                <i class="fa-solid fa-user"></i>
                <span class="text-sm">Admin</span>
            </div>
        </div>

        <!-- CONTENT -->
        <div class="mt-6 bg-white p-6 rounded-2xl shadow">
            @yield('content')
        </div>

    </div>

</div>

</body>
</html>
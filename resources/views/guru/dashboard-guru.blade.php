<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru | E-Rapor</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
</head>

<body class="font-sans flex bg-[#f0f6ff]">

<!-- SIDEBAR (Identik dengan Admin) -->
<aside class="w-[250px] h-screen fixed text-white shadow-xl bg-gradient-to-b from-[#0d2856] to-[#1e6fdc]">

    <h4 class="p-5 text-xl font-extrabold text-center border-b border-white/10">
        E - RAPOR
    </h4>

    <nav class="mt-4 text-sm">

        <a href="{{ route('guru.dashboard') }}" class="flex items-center gap-3 py-3 px-5 hover:bg-white/10 transition">
            <i class="fa-solid fa-house w-5 text-center"></i> Dashboard
        </a>

        <!-- INPUT NILAI (Sesuai Struktur Data Master Admin) -->
        <div x-data="{open:false}">
            <button @click="open=!open"
                class="w-full flex items-center justify-between py-3 px-5 hover:bg-white/10 transition">
                <span class="flex items-center gap-3">
                    <i class="fa-solid fa-book-open w-5 text-center"></i> Input Nilai
                </span>
                <i class="fa-solid fa-chevron-down text-xs transition" :class="open && 'rotate-180'"></i>
            </button>

            <div x-show="open" x-cloak class="text-sm pl-11">
                <a class="block py-2 hover:text-cyan-300 transition">+ Input Nilai Rapor</a>
            </div>
        </div>

        <!-- NILAI TERSIMPAN (Sesuai Struktur Akademik Admin) -->
        <div x-data="{open:false}">
            <button @click="open=!open"
                class="w-full flex items-center justify-between py-3 px-5 hover:bg-white/10 transition">
                <span class="flex items-center gap-3">
                    <i class="fa-solid fa-folder-open w-5 text-center"></i> Nilai Tersimpan
                </span>
                <i class="fa-solid fa-chevron-down text-xs transition" :class="open && 'rotate-180'"></i>
            </button>

            <div x-show="open" x-cloak class="text-sm pl-11">
                <a href="{{ route('guru.cek-nilai') }}" class="block py-2 hover:text-cyan-300 transition">-> Cek Nilai Rapor</a>
            </div>
        </div>

        <a class="flex items-center gap-3 py-3 px-5 mt-10 hover:bg-red-500 transition cursor-pointer">
            <i class="fa-solid fa-right-from-bracket w-5 text-center"></i> Keluar
        </a>

    </nav>
</aside>

<!-- MAIN -->
<main class="ml-[250px] flex-1 p-6">

    <!-- HEADER (Identik dengan Admin) -->
    <div class="rounded-2xl p-4 text-white shadow-lg bg-gradient-to-r from-[#1e6fdc] to-[#00d4ff]">
        <div class="flex justify-between items-center">
            <div class="font-semibold text-sm">
                E-RAPOR SMA | <span class="opacity-80">2026/2027</span>
            </div>

            <div class="bg-white/20 px-4 py-1 rounded-full flex items-center gap-2 text-sm">
                <i class="fa-solid fa-chalkboard-user"></i>
                <span>Guru</span>
            </div>
        </div>
    </div>

    <!-- WELCOME (Identik dengan Admin) -->
    <div class="mt-6 p-6 rounded-2xl shadow bg-white/90 backdrop-blur">
        <h2 class="text-xl font-bold text-[#1a2340]">
            Selamat Datang Dihalaman Guru , Aplikasi E-RAPOR
        </h2>
        <p class="mt-2 text-gray-600 text-sm">
            Anda sedang mengakses sistem dalam mode Guru. Silakan pilih menu di sidebar untuk mulai mengelola nilai.
        </p>
    </div>

    <!-- CONTENT -->
    <div class="grid grid-cols-12 gap-6 mt-6">

        <!-- DATA REKAP (Identik dengan Admin) -->
        <div class="col-span-12 lg:col-span-8 p-6 rounded-2xl shadow bg-white">
            <h6 class="font-bold mb-4 uppercase text-[#1a2340] text-sm">
                Rekap Data
            </h6>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-5 rounded-xl shadow-sm hover:shadow-md transition bg-blue-50">
                    <p class="text-sm font-semibold text-blue-600">Jumlah Guru</p>
                    <p class="text-2xl font-extrabold mt-1">40</p>
                </div>

                <div class="p-5 rounded-xl shadow-sm hover:shadow-md transition bg-blue-50">
                    <p class="text-sm font-semibold text-blue-600">Jumlah Siswa</p>
                    <p class="text-2xl font-extrabold mt-1">210</p>
                </div>

                <div class="p-5 rounded-xl shadow-sm hover:shadow-md transition bg-blue-50">
                    <p class="text-sm font-semibold text-blue-600">Jumlah Kelas</p>
                    <p class="text-2xl font-extrabold mt-1">12</p>
                </div>

                <div class="p-5 rounded-xl shadow-sm hover:shadow-md transition bg-blue-50">
                    <p class="text-sm font-semibold text-blue-600">Jumlah Mapel</p>
                    <p class="text-2xl font-extrabold mt-1">47</p>
                </div>
            </div>
        </div>

        <!-- INFO/PANDUAN (Identik dengan Admin) -->
        <div class="col-span-12 lg:col-span-4 p-6 rounded-2xl shadow bg-white">
            <h6 class="font-bold mb-4 text-sm text-[#1a2340]">
                Panduan
            </h6>

            <div class="p-4 rounded-xl flex gap-3 items-start bg-yellow-100 border border-yellow-300">
                <i class="fa-solid fa-circle-info text-yellow-500 mt-1"></i>
                <p class="text-sm text-yellow-800 leading-snug">
                    Panduan penggunaan aplikasi E - Rapor untuk Guru dan Wali Kelas.
                </p>
            </div>
        </div>

    </div>

</main>

</body>
</html>
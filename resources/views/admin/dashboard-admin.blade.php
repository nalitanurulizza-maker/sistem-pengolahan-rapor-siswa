<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Admin E-Rapor</title>

<!-- Tailwind -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Font Awesome FIX -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

<!-- Alpine -->
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

<!-- Ambil style HOME -->
<link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">

</head>

<body class="font-sans flex" style="background:#f0f6ff">

<!-- SIDEBAR -->
<aside class="w-[250px] h-screen fixed text-white shadow-xl"
style="background: linear-gradient(180deg,#0d2856,#1e6fdc);">

    <h4 class="p-5 text-xl font-extrabold text-center border-b border-white/10">
        E - RAPOR
    </h4>

    <nav class="mt-4">

        <a class="block py-3 px-5 hover:bg-white/10 transition">
            <i class="fa-solid fa-house w-6"></i> Dashboard
        </a>

        <!-- DATA MASTER -->
        <div x-data="{open:false}">
            <button @click="open=!open"
                class="w-full text-left py-3 px-5 flex justify-between hover:bg-white/10">
                <span><i class="fa-solid fa-database w-6"></i> Data Master</span>
                <i class="fa-solid fa-chevron-down text-xs" :class="open && 'rotate-180'"></i>
            </button>

            <div x-show="open" x-cloak class="text-sm pl-10">
                <a class="block py-2 hover:text-cyan-300">Data Siswa</a>
                <a class="block py-2 hover:text-cyan-300">Data Guru</a>
                <a class="block py-2 hover:text-cyan-300">Data Wali Kelas</a>
            </div>
        </div>

        <!-- AKADEMIK -->
        <div x-data="{open:false}">
            <button @click="open=!open"
                class="w-full text-left py-3 px-5 flex justify-between hover:bg-white/10">
                <span><i class="fa-solid fa-graduation-cap w-6"></i> Akademik</span>
                <i class="fa-solid fa-chevron-down text-xs" :class="open && 'rotate-180'"></i>
            </button>

            <div x-show="open" x-cloak class="text-sm pl-10">
                <a class="block py-2 hover:text-cyan-300">Mata Pelajaran</a>
                <a class="block py-2 hover:text-cyan-300">Tahun Akademik</a>
            </div>
        </div>

        <a class="block py-3 px-5 mt-10 hover:bg-red-500 transition">
            <i class="fa-solid fa-right-from-bracket w-6"></i> Keluar
        </a>

    </nav>
</aside>

<!-- MAIN -->
<main class="ml-[250px] flex-1 p-6">

<!-- HEADER -->
<div class="rounded-2xl p-4 text-white shadow-lg"
style="background: linear-gradient(135deg,#1e6fdc,#00d4ff);">

    <div class="flex justify-between items-center">
        <div class="font-semibold">
            E-RAPOR SMA | <span class="opacity-80">2026/2027</span>
        </div>

        <div class="bg-white/20 px-4 py-1 rounded-full flex items-center gap-2">
            <i class="fa-solid fa-user"></i>
            <span>Admin</span>
        </div>
    </div>
</div>

<!-- WELCOME -->
<div class="mt-6 p-6 rounded-2xl shadow"
style="background: rgba(255,255,255,0.85); backdrop-filter: blur(10px);">

    <h2 class="text-xl font-bold text-[#1a2340]">
        Selamat Datang Dihalaman Admin , Aplikasi  E-RAPOR
    </h2>

    <p class="mt-2 text-gray-600">
        Anda sedang mengakses sistem dalam mode Admin. Silakan pilih menu di sidebar untuk mulai mengelola nilai.
    </p>
</div>

<!-- CONTENT -->
<div class="grid grid-cols-12 gap-6 mt-6">

<!-- DATA -->
<div class="col-span-12 lg:col-span-8 p-6 rounded-2xl shadow bg-white">

<h6 class="font-bold mb-4" style="color:var(--primary-dark)">
REKAP DATA
</h6>

<div class="grid grid-cols-1 md:grid-cols-2 gap-4">

<!-- CARD -->
<div class="p-5 rounded-xl shadow-sm hover:shadow-md transition"
style="background:rgba(30,111,220,.08);">
<p class="text-sm" style="color:var(--primary)">Jumlah Guru</p>
<p class="text-2xl font-extrabold">40</p>
</div>

<div class="p-5 rounded-xl shadow-sm hover:shadow-md transition"
style="background:rgba(30,111,220,.08);">
<p class="text-sm" style="color:var(--primary)">Jumlah Siswa</p>
<p class="text-2xl font-extrabold">210</p>
</div>

<div class="p-5 rounded-xl shadow-sm hover:shadow-md transition"
style="background:rgba(30,111,220,.08);">
<p class="text-sm" style="color:var(--primary)">Jumlah Kelas</p>
<p class="text-2xl font-extrabold">12</p>
</div>

<div class="p-5 rounded-xl shadow-sm hover:shadow-md transition"
style="background:rgba(30,111,220,.08);">
<p class="text-sm" style="color:var(--primary)">Jumlah Mapel</p>
<p class="text-2xl font-extrabold">47</p>
</div>

</div>
</div>

<!-- INFO -->
<div class="col-span-12 lg:col-span-4 p-6 rounded-2xl shadow bg-white">

<h6 class="font-bold mb-4" style="color:var(--primary-dark)">
Panduan
</h6>

<div class="p-4 rounded-xl flex gap-3 items-start"
style="background:#fff3cd; border:1px solid #ffe69c">

<i class="fa-solid fa-circle-info text-yellow-500 mt-1"></i>

<p class="text-sm text-yellow-800">
Gunakan menu Data Master & Akademik untuk mengelola sistem.
</p>

</div>

</div>

</div>

</main>

</body>
</html>
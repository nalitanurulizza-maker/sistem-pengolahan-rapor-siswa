<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru | E-Rapor</title>

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
                <i class="fa-solid fa-border-all w-6"></i> Dashboard
            </a>

            <!-- INPUT NILAI -->
            <div x-data="{open:false}">
                <button @click="open=!open"
                    class="w-full text-left py-3 px-5 flex justify-between hover:bg-white/10">
                    <span><i class="fa-solid fa-book-open w-6"></i> Input Nilai</span>
                    <i class="fa-solid fa-chevron-down text-xs" :class="open && 'rotate-180'"></i>
                </button>

                <div x-show="open" x-cloak class="text-sm pl-10">
                    <a class="block py-2 hover:text-cyan-300">+ Input Nilai Rapor</a>
                </div>
            </div>

            <!-- NILAI TERSIMPAN -->
            <div x-data="{open:false}">
                <button @click="open=!open"
                    class="w-full text-left py-3 px-5 flex justify-between hover:bg-white/10">
                    <span><i class="fa-solid fa-folder-open w-6"></i> Nilai Tersimpan</span>
                    <i class="fa-solid fa-chevron-down text-xs" :class="open && 'rotate-180'"></i>
                </button>

                <div x-show="open" x-cloak class="text-sm pl-10">
                    <a class="block py-2 hover:text-cyan-300">-> Cek Nilai Rapor</a>
                </div>
            </div>

            <a class="block py-3 px-5 mt-10 hover:bg-red-500 transition cursor-pointer">
                <i class="fa-solid fa-rotate-left w-6"></i> Keluar
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
                    E-RAPOR SMA | <span class="opacity-80">Tahun Pelajaran : 2026/2027</span>
                </div>

                <div class="bg-white/20 px-4 py-1 rounded-full flex items-center gap-2">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    <span>Guru</span>
                </div>
            </div>
        </div>

        <!-- WELCOME -->
        <div class="mt-6 p-6 rounded-2xl shadow"
            style="background: rgba(255,255,255,0.85); backdrop-filter: blur(10px);">

            <h2 class="text-xl font-bold text-[#1a2340]">
                Selamat Datang Dihalaman Guru , Aplikasi E-RAPOR
            </h2>

            <p class="mt-2 text-gray-600">
                Anda sedang mengakses sistem dalam mode Guru. Silakan pilih menu di sidebar untuk mulai mengelola nilai.
            </p>
        </div>

        <!-- CONTENT -->
        <div class="grid grid-cols-12 gap-6 mt-6">

            <!-- DATA -->
            <div class="col-span-12 lg:col-span-8 p-6 rounded-2xl shadow bg-white">

                <h6 class="font-bold mb-4 uppercase" style="color:var(--primary-dark)">
                    Rekap Data
                </h6>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <!-- CARD -->
                    <div class="p-5 rounded-xl shadow-sm hover:shadow-md transition"
                        style="background:rgba(30,111,220,.08);">
                        <p class="text-sm font-semibold" style="color:var(--primary)">Jumlah Guru</p>
                        <!-- Angka ini bisa kamu isi dinamis dari database Laravel nantinya -->
                        <p class="text-2xl font-extrabold mt-1">40</p>
                    </div>

                    <div class="p-5 rounded-xl shadow-sm hover:shadow-md transition"
                        style="background:rgba(30,111,220,.08);">
                        <p class="text-sm font-semibold" style="color:var(--primary)">Jumlah Siswa</p>
                        <p class="text-2xl font-extrabold mt-1">210</p>
                    </div>

                    <div class="p-5 rounded-xl shadow-sm hover:shadow-md transition"
                        style="background:rgba(30,111,220,.08);">
                        <p class="text-sm font-semibold" style="color:var(--primary)">Jumlah Kelas</p>
                        <p class="text-2xl font-extrabold mt-1">12</p>
                    </div>

                    <div class="p-5 rounded-xl shadow-sm hover:shadow-md transition"
                        style="background:rgba(30,111,220,.08);">
                        <p class="text-sm font-semibold" style="color:var(--primary)">Jumlah Mapel</p>
                        <p class="text-2xl font-extrabold mt-1">47</p>
                    </div>

                </div>
            </div>

            <!-- INFO -->
            <div class="col-span-12 lg:col-span-4 p-6 rounded-2xl shadow bg-white">

                <h6 class="font-bold mb-4 uppercase" style="color:var(--primary-dark)">
                    Panduan Aplikasi
                </h6>

                <div class="p-4 rounded-xl flex gap-3 items-start"
                    style="background:#f8f9fa; border:1px solid #e9ecef">

                    <i class="fa-solid fa-circle-info text-blue-500 mt-1"></i>

                    <p class="text-sm text-gray-700">
                        Panduan penggunaan aplikasi E - Rapor untuk Guru dan Wali Kelas.
                    </p>

                </div>

            </div>

        </div>

    </main>

</body>
</html>
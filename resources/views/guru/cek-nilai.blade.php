<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Nilai Rapor | E-Rapor</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <!-- Alpine -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>

<body class="font-sans flex" style="background:#f0f6ff">

    <!-- SIDEBAR (Sesuai image_1bc280.jpg) -->
    <aside class="w-[250px] h-screen fixed text-white shadow-xl"
        style="background: linear-gradient(180deg,#0d2856,#1e6fdc);">

        <h4 class="p-5 text-xl font-extrabold text-center border-b border-white/10">
            E - RAPOR
        </h4>

        <nav class="mt-4">
            <a href="{{ route('guru.dashboard') }}" class="block py-3 px-5 hover:bg-white/10 transition">
                <i class="fa-solid fa-border-all w-6"></i> Dashboard
            </a>

            <!-- INPUT NILAI -->
            <div x-data="{open:false}">
                <button @click="open=!open" class="w-full text-left py-3 px-5 flex justify-between hover:bg-white/10">
                    <span><i class="fa-solid fa-book-open w-6"></i> Input Nilai</span>
                    <i class="fa-solid fa-chevron-down text-xs" :class="open && 'rotate-180'"></i>
                </button>
                <div x-show="open" x-cloak class="text-sm pl-10">
                    <a class="block py-2 hover:text-cyan-300">+ Input Nilai Rapor</a>
                </div>
            </div>

            <!-- NILAI TERSIMPAN -->
            <div x-data="{open:true}"> <!-- Open true agar menu aktif terlihat -->
                <button @click="open=!open" class="w-full text-left py-3 px-5 flex justify-between hover:bg-white/10 bg-white/10">
                    <span><i class="fa-solid fa-folder-open w-6"></i> Nilai Tersimpan</span>
                    <i class="fa-solid fa-chevron-down text-xs" :class="open && 'rotate-180'"></i>
                </button>
                <div x-show="open" x-cloak class="text-sm pl-10">
                    <a href="#" class="block py-2 text-cyan-300 font-bold">-> Cek Nilai Rapor</a>
                </div>
            </div>

            <a class="block py-3 px-5 mt-10 hover:bg-red-500 transition cursor-pointer">
                <i class="fa-solid fa-rotate-left w-6"></i> Keluar
            </a>
        </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="ml-[250px] flex-1 p-6">

        <!-- HEADER (Sesuai Akun Guru) -->
        <div class="rounded-2xl p-4 text-white shadow-lg mb-6"
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

        <!-- FORM CEK NILAI (Sesuai image_1b49de.png) -->
        <div class="bg-white rounded-2xl shadow-sm p-8 min-h-[500px] relative">
            <h5 class="text-center font-bold text-gray-800 uppercase tracking-wider mb-10">
                Cek Nilai Rapor Siswa
            </h5>

            <div class="max-w-4xl mx-auto space-y-6">
                <!-- Pilih Kelas -->
                <div class="flex items-center">
                    <label class="w-1/3 font-bold text-gray-700">Pilih Kelas</label>
                    <div class="w-2/3 relative">
                        <select class="w-full appearance-none bg-gray-200 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-400">
                            <option value="">-- Pilih Kelas --</option>
                            <option>X-IPA-1</option>
                            <option>X-IPA-2</option>
                        </select>
                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-caret-down text-gray-600"></i>
                        </div>
                    </div>
                </div>

                <!-- Pilih Mata Pelajaran -->
                <div class="flex items-center">
                    <label class="w-1/3 font-bold text-gray-700">Pilih Mata Pelajaran</label>
                    <div class="w-2/3 relative">
                        <select class="w-full appearance-none bg-gray-200 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-400">
                            <option value="">-- Pilih Mapel --</option>
                            <option>Matematika</option>
                            <option>Bahasa Indonesia</option>
                        </select>
                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-caret-down text-gray-600"></i>
                        </div>
                    </div>
                </div>

                <!-- Pilih Nilai -->
                <div class="flex items-center">
                    <label class="w-1/3 font-bold text-gray-700">Pilih Nilai</label>
                    <div class="w-2/3 relative">
                        <select class="w-full appearance-none bg-gray-200 border-none rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-400">
                            <option value="">-- Pilih Kategori Nilai --</option>
                            <option>Nilai Pengetahuan</option>
                            <option>Nilai Keterampilan</option>
                        </select>
                        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-caret-down text-gray-600"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PAGINATION (Pojok Kanan Bawah sesuai gambar) -->
            <div class="absolute bottom-6 right-8 flex items-center gap-1">
                <button class="px-3 py-1 border border-gray-300 text-gray-600 hover:bg-gray-100 rounded text-sm">&lt;&lt;</button>
                <button class="px-4 py-1 border border-gray-300 bg-gray-100 text-gray-800 font-bold rounded text-sm">1</button>
                <button class="px-3 py-1 border border-gray-300 text-gray-600 hover:bg-gray-100 rounded text-sm">&gt;&gt;</button>
            </div>
        </div>

    </main>
</body>
</html>
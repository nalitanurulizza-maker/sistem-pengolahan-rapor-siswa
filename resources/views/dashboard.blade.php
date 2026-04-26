<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Rapor Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Rapor Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-[#eef4ff] font-sans antialiased flex">

    <aside class="w-[250px] h-screen bg-[#0d47a1] text-white fixed overflow-y-auto shadow-2xl">
        <h4 class="p-5 text-xl font-bold border-b border-white/10 uppercase tracking-wider text-center">E - RAPOR</h4>

        <nav class="mt-4">
            <a href="#" class="block py-3 px-5 hover:bg-[#1565c0] transition-colors">
                <i class="fa fa-home w-6"></i> Dashboard
            </a>

            <div x-data="{ open: false }">
                <button @click="open = !open" class="w-full text-left py-3 px-5 hover:bg-[#1565c0] flex justify-between items-center transition-colors">
                    <span><i class="fa fa-database w-6"></i> Data Master</span>
                    <i class="fa fa-chevron-down text-[10px] transition-transform" :class="open ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="open" x-cloak class="bg-[#0a387e] text-sm py-2">
                    <a href="#" class="block py-2 pl-12 hover:bg-[#1565c0]">Data Siswa</a>
                    <a href="#" class="block py-2 pl-12 hover:bg-[#1565c0]">Data Guru</a>
                    <a href="#" class="block py-2 pl-12 hover:bg-[#1565c0]">Data Wali Kelas</a>
                </div>
            </div>

            <div x-data="{ open: false }">
                <button @click="open = !open" class="w-full text-left py-3 px-5 hover:bg-[#1565c0] flex justify-between items-center transition-colors">
                    <span><i class="fa fa-graduation-cap w-6"></i> Akademik</span>
                    <i class="fa fa-chevron-down text-[10px] transition-transform" :class="open ? 'rotate-180' : ''"></i>
                </button>
                <div x-show="open" x-cloak class="bg-[#0a387e] text-sm py-2">
                    <a href="#" class="block py-2 pl-12 hover:bg-[#1565c0]">Mata Pelajaran</a>
                    <a href="#" class="block py-2 pl-12 hover:bg-[#1565c0]">Tahun Akademik</a>
                </div>
            </div>

            <a href="#" class="block py-3 px-5 hover:bg-red-600 transition-colors mt-10">
                <i class="fa fa-sign-out-alt w-6"></i> Keluar
            </a>
            
        </nav>
    </aside>

    <main class="ml-[250px] flex-1 p-6">

        <header class="bg-[#1e88e5] text-white p-4 rounded-xl shadow-lg flex justify-between items-center">
            <div class="font-semibold tracking-wide">
                E-RAPOR SMA <span class="mx-2 opacity-50">|</span> <span class="text-blue-100">Tahun Pelajaran: 2026/2027</span>
            </div>
            <div class="flex items-center gap-2 bg-white/20 px-4 py-1.5 rounded-full">
                <i class="fa fa-user-circle"></i>
                <span class="text-sm font-medium">Admin</span>
            </div>
        </header>

        <div class="bg-white rounded-2xl p-6 mt-6 shadow-sm border border-blue-100">
            <h5 class="text-xl font-bold text-gray-800">Selamat Datang di Halaman Admin, Aplikasi E-RAPOR</h5>
            <p class="text-gray-500 mt-2 leading-relaxed">Anda sedang mengakses sistem dalam mode Admin. Silakan pilih menu di sidebar untuk mulai mengelola nilai.</p>
        </div>

        <div class="grid grid-cols-12 gap-6 mt-6">

            <div class="col-span-12 lg:col-span-8 bg-white rounded-2xl p-6 shadow-sm border border-blue-100">
                <h6 class="text-sm font-bold text-blue-900 uppercase tracking-widest mb-4">Rekap Data</h6>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 flex justify-between items-center hover:bg-blue-100 transition shadow-sm">
                        <div>
                            <p class="text-xs text-blue-600 font-bold uppercase">Jumlah Guru</p>
                            <p class="text-2xl font-black text-blue-900">40</p>
                        </div>
                        <i class="fa fa-user-tie text-3xl text-blue-300"></i>
                    </div>

                    <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 flex justify-between items-center hover:bg-blue-100 transition shadow-sm">
                        <div>
                            <p class="text-xs text-blue-600 font-bold uppercase">Jumlah Siswa</p>
                            <p class="text-2xl font-black text-blue-900">210</p>
                        </div>
                        <i class="fa fa-users text-3xl text-blue-300"></i>
                    </div>

                    <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 flex justify-between items-center hover:bg-blue-100 transition shadow-sm">
                        <div>
                            <p class="text-xs text-blue-600 font-bold uppercase">Jumlah Kelas</p>
                            <p class="text-2xl font-black text-blue-900">12</p>
                        </div>
                        <i class="fa fa-school text-3xl text-blue-300"></i>
                    </div>

                    <div class="bg-blue-50 border border-blue-100 rounded-xl p-5 flex justify-between items-center hover:bg-blue-100 transition shadow-sm">
                        <div>
                            <p class="text-xs text-blue-600 font-bold uppercase">Jumlah Mapel</p>
                            <p class="text-2xl font-black text-blue-900">47</p>
                        </div>
                        <i class="fa fa-book-open text-3xl text-blue-300"></i>
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-4 bg-white rounded-2xl p-6 shadow-sm border border-blue-100">
                <h6 class="text-sm font-bold text-blue-900 uppercase tracking-widest mb-4">Panduan Aplikasi</h6>
                <div class="bg-amber-50 border border-amber-100 rounded-xl p-5 flex gap-4 items-start shadow-sm">
                    <i class="fa fa-info-circle text-2xl text-amber-500 mt-1"></i>
                    <div class="text-sm text-amber-800 leading-relaxed">
                        Gunakan menu <strong>Data Master</strong> untuk mengatur profil pengguna, dan menu <strong>Akademik</strong> untuk input nilai raport.
                    </div>
                </div>
            </div>

        </div>
    </main>

</body>
</html>
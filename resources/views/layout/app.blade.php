<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
</head>

<body class="flex bg-slate-100 font-sans antialiased">

    <aside class="w-64 min-h-screen bg-gradient-to-b from-blue-400 to-blue-600 text-white p-5 shadow-xl">
        <h2 class="text-2xl font-bold mb-8 flex items-center gap-3">
            <i class="fa fa-school"></i> e-Rapor
        </h2>

        <nav class="space-y-2">
            <div>
                <div onclick="toggleDropdown('d1')" class="flex justify-between items-center p-3 hover:bg-white/20 rounded-lg cursor-pointer transition">
                    <span>Dashboard</span> <i class="fa fa-chevron-down text-xs"></i>
                </div>
                <div id="d1" class="hidden ml-4 mt-2 space-y-1">
                    <div class="p-2 bg-white/10 rounded-md text-sm hover:bg-white/20 cursor-pointer">Overview</div>
                </div>
            </div>

            <div>
                <div onclick="toggleDropdown('d2')" class="flex justify-between items-center p-3 hover:bg-white/20 rounded-lg cursor-pointer transition">
                    <span>Data Siswa</span> <i class="fa fa-chevron-down text-xs"></i>
                </div>
                <div id="d2" class="hidden ml-4 mt-2 space-y-1">
                    <div class="p-2 bg-white/10 rounded-md text-sm hover:bg-white/20 cursor-pointer">Tambah Siswa</div>
                    <div class="p-2 bg-white/10 rounded-md text-sm hover:bg-white/20 cursor-pointer">List Siswa</div>
                </div>
            </div>

            <div>
                <div onclick="toggleDropdown('d3')" class="flex justify-between items-center p-3 hover:bg-white/20 rounded-lg cursor-pointer transition">
                    <span>Data Guru</span> <i class="fa fa-chevron-down text-xs"></i>
                </div>
                <div id="d3" class="hidden ml-4 mt-2 space-y-1">
                    <div class="p-2 bg-white/10 rounded-md text-sm hover:bg-white/20 cursor-pointer">Tambah Guru</div>
                    <div class="p-2 bg-white/10 rounded-md text-sm hover:bg-white/20 cursor-pointer">List Guru</div>
                </div>
            </div>

            <div>
                <div onclick="toggleDropdown('d4')" class="flex justify-between items-center p-3 hover:bg-white/20 rounded-lg cursor-pointer transition">
                    <span>Mata Pelajaran</span> <i class="fa fa-chevron-down text-xs"></i>
                </div>
                <div id="d4" class="hidden ml-4 mt-2 space-y-1">
                    <div class="p-2 bg-white/10 rounded-md text-sm hover:bg-white/20 cursor-pointer">Tambah Mapel</div>
                    <div class="p-2 bg-white/10 rounded-md text-sm hover:bg-white/20 cursor-pointer">List Mapel</div>
                </div>
            </div>
        </nav>
    </aside>

    <main class="flex-1 p-6">
        <header class="bg-white text-slate-700 p-4 rounded-xl flex justify-between items-center shadow-sm mb-6 border border-slate-200">
            <div class="font-bold text-lg text-blue-600">Aplikasi e-Rapor</div>
            <div class="flex items-center gap-2 px-4 py-2 bg-slate-50 rounded-lg border">
                <i class="fa fa-user-circle text-blue-500"></i>
                <span class="font-medium">Admin</span>
            </div>
        </header>

        <div class="container mx-auto">
            @yield('content')
        </div>
    </main>

    <script>
        function toggleDropdown(id) {
            let el = document.getElementById(id);
            // Menggunakan class 'hidden' bawaan Tailwind
            el.classList.toggle('hidden');
        }
    </script>

</body>
</html>
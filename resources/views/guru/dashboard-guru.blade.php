@extends('layout.guru-app')

@section('title', 'Dashboard Guru | E-Rapor')

@section('content')

<!-- WELCOME -->
<div class="mt-2 p-6 rounded-2xl shadow" 
     style="background: rgba(255,255,255,0.85); backdrop-filter: blur(10px);">

    <h2 class="text-xl font-bold text-[#1a2340]">
        Selamat Datang Dihalaman Guru , Aplikasi E-RAPOR
    </h2>

    <p class="mt-2 text-gray-600">
        Anda sedang mengakses sistem dalam mode Guru. Silakan pilih menu di sidebar untuk mulai mengelola nilai siswa.
    </p>
</div>

<!-- CONTENT -->
<div class="grid grid-cols-12 gap-6 mt-6">

    <!-- REKAP DATA (IDENTIK DENGAN ADMIN) -->
    <div class="col-span-12 lg:col-span-8 p-6 rounded-2xl shadow bg-white">

        <h6 class="font-bold mb-4" style="color:var(--primary-dark)">
            REKAP DATA
        </h6>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

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

    <!-- INFO / PANDUAN (IDENTIK DENGAN ADMIN) -->
    <div class="col-span-12 lg:col-span-4 p-6 rounded-2xl shadow bg-white">

        <h6 class="font-bold mb-4" style="color:var(--primary-dark)">
            Panduan
        </h6>

        <div class="p-4 rounded-xl flex gap-3 items-start" 
             style="background:#fff3cd; border:1px solid #ffe69c">

            <i class="fa-solid fa-circle-info text-yellow-500 mt-1"></i>

            <p class="text-sm text-yellow-800 leading-snug">
                Gunakan menu <strong>Input Nilai</strong> untuk mengisi rapor dan <strong>Nilai Tersimpan</strong> untuk meninjau data.
            </p>

        </div>

        <div class="mt-4 p-4 rounded-xl flex gap-3 items-start bg-blue-50 border border-blue-100">
            <i class="fa-solid fa-chalkboard-user text-blue-500 mt-1"></i>
            <p class="text-sm text-blue-800 leading-snug">
                Pastikan tahun akademik yang aktif adalah <strong>2026/2027</strong> sebelum menginput nilai.
            </p>
        </div>

    </div>

</div>

@endsection
@extends('layout.admin-app')

@section('title', 'Dashboard Admin')

@section('content')

<!-- WELCOME -->
<div class="mt-6 bg-white p-6 rounded-2xl shadow">
    <h2 class="text-xl font-bold text-[#1a2340]">
        Selamat Datang di Halaman Admin, Aplikasi E-RAPOR
    </h2>
    <p class="mt-2 text-gray-600">
        Anda sedang mengakses sistem dalam mode Admin. Silakan pilih menu di sidebar untuk mulai mengelola data master dan akademik.
    </p>
</div>

<!-- DASHBOARD GRID -->
<div class="mt-6 grid grid-cols-1 lg:grid-cols-12 gap-6">
    
    <!-- REKAP DATA -->
    <div class="lg:col-span-8 bg-white p-6 rounded-2xl shadow">
        <h6 class="font-bold text-gray-800 uppercase tracking-wide border-b pb-3 mb-6 text-sm">
            Rekap Data Master
        </h6>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="p-5 rounded-xl bg-blue-50 border">
                <p class="text-sm font-semibold text-blue-600">Jumlah Guru</p>
                <p class="text-2xl font-bold mt-1">{{ $rekapData['jumlahGuru'] }}</p>
            </div>

            <div class="p-5 rounded-xl bg-blue-50 border">
                <p class="text-sm font-semibold text-blue-600">Jumlah Siswa</p>
                <p class="text-2xl font-bold mt-1">{{ $rekapData['jumlahSiswa'] }}</p>
            </div>

            <div class="p-5 rounded-xl bg-blue-50 border">
                <p class="text-sm font-semibold text-blue-600">Jumlah Kelas</p>
                <p class="text-2xl font-bold mt-1">{{ $rekapData['jumlahKelas'] }}</p>
            </div>

            <div class="p-5 rounded-xl bg-blue-50 border">
                <p class="text-sm font-semibold text-blue-600">Jumlah Mapel</p>
                <p class="text-2xl font-bold mt-1">{{ $rekapData['jumlahMapel'] }}</p>
            </div>
        </div>
    </div>

    <!-- PANDUAN -->
    <div class="lg:col-span-4 bg-white p-6 rounded-2xl shadow">
        <h6 class="font-bold text-gray-800 border-b pb-3 mb-6 text-sm">
            Panduan Admin
        </h6>

        <div class="p-4 bg-yellow-50 border rounded-lg flex gap-3">
            <i class="fa-solid fa-circle-info text-yellow-500"></i>
            <p class="text-sm text-yellow-800">
                Gunakan menu <strong>Data Master</strong> dan <strong>Akademik</strong> untuk mengatur konfigurasi semester dan tahun ajaran.
            </p>
        </div>
    </div>

</div>

@endsection
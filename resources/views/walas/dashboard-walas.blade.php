@extends('layout.walas-app')

@section('title', 'Dashboard Wali Kelas')

@section('content')

<!-- WELCOME -->
<div class="mt-6 bg-white p-6 rounded-2xl shadow border border-gray-100">
    <h2 class="text-xl font-bold text-[#1a2340]">
        Selamat Datang Dihalaman Wali Kelas , Aplikasi E-RAPOR
    </h2>
    <p class="mt-2 text-gray-600">
        Anda sedang mengakses sistem dalam mode <span class="font-semibold text-blue-600">Wali Kelas</span>. Silakan pilih menu di sidebar untuk mulai mengelola kehadiran, catatan, dan rapor siswa.
    </p>
</div>

<!-- DASHBOARD GRID -->
<div class="mt-6 grid grid-cols-1 lg:grid-cols-12 gap-6">
    
    <!-- REKAP DATA -->
    <div class="lg:col-span-8 bg-white p-6 rounded-2xl shadow border border-gray-100">
        <h6 class="font-bold text-gray-800 uppercase tracking-wide border-b pb-3 mb-6 text-sm">
            Rekap Data
        </h6>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="p-5 rounded-xl bg-blue-50 border border-blue-100">
                <p class="text-sm font-semibold text-blue-600">Jumlah Guru</p>
                <p class="text-2xl font-bold mt-1 text-gray-800">{{ $rekapData['jumlahGuru'] }}</p>
            </div>

            <div class="p-5 rounded-xl bg-blue-50 border border-blue-100">
                <p class="text-sm font-semibold text-blue-600">Jumlah Siswa</p>
                <p class="text-2xl font-bold mt-1 text-gray-800">{{ $rekapData['jumlahSiswa'] }}</p>
            </div>

            <div class="p-5 rounded-xl bg-blue-50 border border-blue-100">
                <p class="text-sm font-semibold text-blue-600">Jumlah Kelas</p>
                <p class="text-2xl font-bold mt-1 text-gray-800">{{ $rekapData['jumlahKelas'] }}</p>
            </div>

            <div class="p-5 rounded-xl bg-blue-50 border border-blue-100">
                <p class="text-sm font-semibold text-blue-600">Jumlah Mapel</p>
                <p class="text-2xl font-bold mt-1 text-gray-800">{{ $rekapData['jumlahMapel'] }}</p>
            </div>
        </div>
    </div>

    <!-- PANDUAN APLIKASI -->
    <div class="lg:col-span-4 bg-white p-6 rounded-2xl shadow border border-gray-100">
        <h6 class="font-bold text-gray-800 border-b pb-3 mb-6 text-sm">
            Panduan
        </h6>

        <div class="p-4 bg-yellow-50 border border-yellow-100 rounded-lg flex gap-3">
            <div class="mt-1">
                <i class="fa-solid fa-circle-info text-yellow-500 text-lg"></i>
            </div>
            <p class="text-sm text-yellow-800 leading-relaxed">
                Panduan penggunaan aplikasi E-Rapor untuk <span class="font-bold">Guru dan Wali Kelas</span>. Pastikan data kehadiran dan catatan siswa diisi sebelum mencetak rapor.
            </p>
        </div>
        
        <div class="mt-4 p-4 bg-blue-50 border border-blue-100 rounded-lg flex gap-3">
            <div class="mt-1">
                <i class="fa-solid fa-lightbulb text-blue-500 text-lg"></i>
            </div>
            <p class="text-sm text-blue-800 leading-relaxed">
                Gunakan menu <strong>Cetak Rapor</strong> untuk mengunduh berkas rapor siswa dalam format PDF.
            </p>
        </div>
    </div>

</div>

@endsection
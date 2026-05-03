@extends('layout.admin-app')

@section('title', 'Dashboard Admin')

@section('content')
    <!-- HEADER -->
    <div class="rounded-2xl p-4 text-white shadow-lg mb-6" style="background: linear-gradient(135deg,#1e6fdc,#00d4ff);">
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
    <div class="p-6 rounded-2xl shadow bg-white">
        <h2 class="text-xl font-bold text-[#1a2340]">Selamat Datang di Halaman Admin, Aplikasi E-RAPOR</h2>
        <p class="mt-2 text-gray-600">Anda sedang mengakses sistem dalam mode Admin. Silakan pilih menu di sidebar untuk mulai mengelola nilai.</p>
    </div>

    <!-- REKAP DATA -->
    <div class="grid grid-cols-12 gap-6 mt-6">
        <div class="col-span-12 lg:col-span-8 p-6 rounded-2xl shadow bg-white">
            <h6 class="font-bold mb-4 text-blue-900 uppercase tracking-wider">Rekap Data</h6>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-5 rounded-xl bg-blue-50 border border-blue-100 shadow-sm">
                    <p class="text-sm text-blue-600 font-semibold">Jumlah Guru</p>
                    <p class="text-2xl font-black text-blue-900">{{ $rekapData['jumlahGuru'] }}</p>
                </div>
                <div class="p-5 rounded-xl bg-blue-50 border border-blue-100 shadow-sm">
                    <p class="text-sm text-blue-600 font-semibold">Jumlah Siswa</p>
                    <p class="text-2xl font-black text-blue-900">{{ $rekapData['jumlahSiswa'] }}</p>
                </div>
                <div class="p-5 rounded-xl bg-blue-50 border border-blue-100 shadow-sm">
                    <p class="text-sm text-blue-600 font-semibold">Jumlah Kelas</p>
                    <p class="text-2xl font-black text-blue-900">{{ $rekapData['jumlahKelas'] }}</p>
                </div>
                <div class="p-5 rounded-xl bg-blue-50 border border-blue-100 shadow-sm">
                    <p class="text-sm text-blue-600 font-semibold">Jumlah Mapel</p>
                    <p class="text-2xl font-black text-blue-900">{{ $rekapData['jumlahMapel'] }}</p>
                </div>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-4 p-6 rounded-2xl shadow bg-white">
            <h6 class="font-bold mb-4 text-blue-900 uppercase tracking-wider">Panduan</h6>
            <div class="p-4 rounded-xl bg-yellow-50 border border-yellow-200 flex gap-3">
                <i class="fa-solid fa-circle-info text-yellow-500 mt-1"></i>
                <p class="text-sm text-yellow-800">Gunakan menu Data Master & Akademik untuk mengelola sistem secara efisien.</p>
            </div>
        </div>
    </div>
@endsection
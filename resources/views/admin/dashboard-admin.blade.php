@extends('layout.admin-app')

@section('title', 'Dashboard Admin')

@section('content')

<!-- WELCOME -->
<div class="p-6 rounded-2xl shadow bg-white/90 backdrop-blur">
    <h2 class="text-xl font-bold text-[#1a2340]">
        Selamat Datang di Halaman Admin, Aplikasi E-RAPOR
    </h2>

    <p class="mt-2 text-gray-600">
        Anda sedang mengakses sistem dalam mode Admin. Silakan pilih menu di sidebar untuk mulai mengelola data.
    </p>
</div>

<!-- GRID CONTENT -->
<div class="grid grid-cols-12 gap-6 mt-6">

    <!-- REKAP DATA -->
    <div class="col-span-12 lg:col-span-8 bg-white p-6 rounded-2xl shadow">

        <h3 class="font-bold mb-4 text-gray-700">
            REKAP DATA
        </h3>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

            <!-- CARD -->
            <div class="p-5 rounded-xl bg-blue-50 hover:shadow-md transition">
                <p class="text-sm text-blue-600">Jumlah Guru</p>
                <p class="text-2xl font-extrabold">40</p>
            </div>

            <div class="p-5 rounded-xl bg-blue-50 hover:shadow-md transition">
                <p class="text-sm text-blue-600">Jumlah Siswa</p>
                <p class="text-2xl font-extrabold">210</p>
            </div>

            <div class="p-5 rounded-xl bg-blue-50 hover:shadow-md transition">
                <p class="text-sm text-blue-600">Jumlah Kelas</p>
                <p class="text-2xl font-extrabold">12</p>
            </div>

            <div class="p-5 rounded-xl bg-blue-50 hover:shadow-md transition">
                <p class="text-sm text-blue-600">Jumlah Mapel</p>
                <p class="text-2xl font-extrabold">47</p>
            </div>

        </div>
    </div>

    <!-- INFO -->
    <div class="col-span-12 lg:col-span-4 bg-white p-6 rounded-2xl shadow">

        <h3 class="font-bold mb-4 text-gray-700">
            Panduan
        </h3>

        <div class="p-4 rounded-xl flex gap-3 items-start bg-yellow-100 border border-yellow-300">
            <i class="fa-solid fa-circle-info text-yellow-500 mt-1"></i>

            <p class="text-sm text-yellow-800">
                Gunakan menu Data Master & Akademik untuk mengelola sistem.
            </p>
        </div>

    </div>

</div>

@endsection
@extends('layout.guru-app')

@section('title', 'Dashboard Guru')

@section('content')

<div class="mt-6 bg-white p-6 rounded-2xl shadow">
    <h2 class="text-xl font-bold text-[#1a2340]">
        Selamat Datang, {{ Auth::user()->name }}!
    </h2>
    <p class="mt-2 text-gray-600">
        Anda sedang mengakses sistem sebagai 
        <span class="font-semibold text-blue-600">
            {{ strtolower(Auth::user()->role) === 'walas' ? 'Wali Kelas' : 'Guru Mata Pelajaran' }}
        </span>. 
        Silakan pilih menu di sidebar untuk mulai mengelola nilai dan data kelas Anda.
    </p>
</div>

<div class="mt-6 grid grid-cols-1 lg:grid-cols-12 gap-6">

    <div class="lg:col-span-8 bg-white p-6 rounded-2xl shadow">
        <h6 class="font-bold text-gray-800 uppercase tracking-wide border-b pb-3 mb-6 text-sm">
            Rekap Data Mengajar
        </h6>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="p-5 rounded-xl bg-blue-50 border">
                <p class="text-sm font-semibold text-blue-600">Mata Pelajaran Diampu</p>
                <p class="text-2xl font-bold mt-1">{{ $rekapData['jumlahMapel'] }}</p>
            </div>

            <div class="p-5 rounded-xl bg-blue-50 border">
                <p class="text-sm font-semibold text-blue-600">Jumlah Siswa Diajar</p>
                <p class="text-2xl font-bold mt-1">{{ $rekapData['jumlahSiswa'] }}</p>
            </div>

            <div class="p-5 rounded-xl bg-blue-50 border">
                <p class="text-sm font-semibold text-blue-600">Nilai Sudah Diinput</p>
                <p class="text-2xl font-bold mt-1">{{ $rekapData['nilaiSudahInput'] }}</p>
            </div>

            <div class="p-5 rounded-xl bg-blue-50 border">
                <p class="text-sm font-semibold text-blue-600">Nilai Belum Diinput</p>
                <p class="text-2xl font-bold mt-1 {{ $rekapData['nilaiBelumInput'] > 0 ? 'text-red-500' : 'text-gray-800' }}">
                    {{ $rekapData['nilaiBelumInput'] }}
                </p>
            </div>
        </div>

        {{-- ── MENU KOTAK TAMBAHAN KHUSUS WALAS (DI DALAM DASHBOARD) ── --}}
        @if(strtolower(Auth::user()->role) === 'walas')
        <div class="mt-6 border-t pt-6">
            <h6 class="font-bold text-purple-800 uppercase tracking-wide mb-4 text-xs flex items-center gap-2">
                <i class="fa-solid fa-star"></i> Menu Manajemen Wali Kelas ({{ $namaKelas }})
            </h6>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 text-center">
                <a href="{{ route('guru.input-kehadiran') }}" class="p-3 rounded-xl bg-purple-50 hover:bg-purple-100 border text-xs font-semibold text-purple-700 transition block">
                    <i class="fa-solid fa-clipboard-user block text-lg mb-1"></i> Input Kehadiran
                </a>
                <a href="{{ route('guru.input-catatan') }}" class="p-3 rounded-xl bg-purple-50 hover:bg-purple-100 border text-xs font-semibold text-purple-700 transition block">
                    <i class="fa-solid fa-comment-medical block text-lg mb-1"></i> Input Catatan
                </a>
                <a href="{{ route('guru.input-predikat') }}" class="p-3 rounded-xl bg-purple-50 hover:bg-purple-100 border text-xs font-semibold text-purple-700 transition block">
                    <i class="fa-solid fa-award block text-lg mb-1"></i> Input Predikat
                </a>
                <a href="{{ route('guru.cetak-rapor') }}" class="p-3 rounded-xl bg-emerald-50 hover:bg-emerald-100 border text-xs font-semibold text-emerald-700 transition block">
                    <i class="fa-solid fa-print block text-lg mb-1"></i> Cetak Rapor
                </a>
            </div>
        </div>
        @endif
    </div>

    <div class="lg:col-span-4 flex flex-col gap-6">

        <div class="bg-white p-6 rounded-2xl shadow">
            <h6 class="font-bold text-gray-800 border-b pb-3 mb-4 text-sm">
                Tahun Akademik Aktif
            </h6>
            <div class="p-4 bg-blue-50 border rounded-lg flex gap-3">
                <i class="fa-solid fa-calendar-check text-blue-500 mt-0.5"></i>
                <div>
                    <p class="text-sm font-bold text-blue-800">{{ $tahunAkademik->nama_tahun ?? '-' }}</p>
                    <p class="text-xs text-blue-600 mt-0.5">Semester {{ $tahunAkademik->semester ?? '-' }}</p>
                </div>
            </div>
        </div>

        {{-- CONDITIONAL PANEL KANAN BERDASARKAN ROLE --}}
        @if(strtolower(Auth::user()->role) === 'walas')
        <div class="bg-white p-6 rounded-2xl shadow">
            <h6 class="font-bold text-gray-800 border-b pb-3 mb-4 text-sm">
                Info Wali Kelas
            </h6>
            <div class="p-4 bg-purple-50 border rounded-lg flex gap-3">
                <i class="fa-solid fa-users text-purple-500 mt-0.5"></i>
                <div>
                    <p class="text-xs text-purple-600">Kelas yang Diampu</p>
                    <p class="text-sm font-bold text-purple-800 mt-0.5">{{ $namaKelas ?? '-' }}</p>
                </div>
            </div>

            <div class="mt-3 p-4 bg-yellow-50 border rounded-lg flex gap-3">
                <i class="fa-solid fa-circle-info text-yellow-500 mt-0.5"></i>
                <p class="text-sm text-yellow-800">
                    Lengkapi <strong>kehadiran</strong>, <strong>catatan</strong>, dan <strong>predikat</strong> sebelum mencetak rapor.
                </p>
            </div>
        </div>
        @else
        <div class="bg-white p-6 rounded-2xl shadow">
            <h6 class="font-bold text-gray-800 border-b pb-3 mb-4 text-sm">
                Panduan Guru
            </h6>
            <div class="p-4 bg-yellow-50 border rounded-lg flex gap-3">
                <i class="fa-solid fa-circle-info text-yellow-500 mt-0.5"></i>
                <p class="text-sm text-yellow-800">
                    Gunakan menu <strong>Input Nilai</strong> untuk mengisi nilai siswa dan <strong>Cek Nilai</strong> untuk memverifikasi data yang sudah diinput.
                </p>
            </div>
        </div>
        @endif

    </div>

</div>

@endsection
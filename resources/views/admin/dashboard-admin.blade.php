@extends('layout.app')

@section('title', 'Dashboard Admin')

@section('content')

<div class="space-y-8">
    <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-3xl p-8 text-white shadow-lg">
        <h1 class="text-3xl font-bold mb-2">Selamat Datang di Halaman Admin</h1>
        <p class="text-blue-100">Aplikasi E-RAPOR</p>
        <p class="mt-4 max-w-2xl text-blue-100">
            Anda sedang mengakses sistem dalam mode Admin. Silakan pilih menu di sidebar untuk mulai mengelola nilai.
        </p>
    </div>

    <div class="grid gap-8 lg:grid-cols-12">
        <div class="lg:col-span-8 grid grid-cols-1 sm:grid-cols-2 gap-6">
            <div class="bg-white rounded-3xl p-6 shadow hover:-translate-y-1 transition-transform">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Jumlah Guru</p>
                        <p id="guru-count" class="text-4xl font-bold text-gray-800 mt-2">{{ $jumlahGuru }}</p>
                    </div>
                    <div class="w-14 h-14 bg-orange-100 text-orange-600 rounded-2xl flex items-center justify-center text-3xl">
                        👨‍🏫
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 shadow hover:-translate-y-1 transition-transform">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Jumlah Siswa</p>
                        <p id="siswa-count" class="text-4xl font-bold text-gray-800 mt-2">{{ $jumlahSiswa }}</p>
                    </div>
                    <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-3xl">
                        👨‍🎓
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 shadow hover:-translate-y-1 transition-transform">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Jumlah Kelas</p>
                        <p id="kelas-count" class="text-4xl font-bold text-gray-800 mt-2">{{ $jumlahKelas }}</p>
                    </div>
                    <div class="w-14 h-14 bg-purple-100 text-purple-600 rounded-2xl flex items-center justify-center text-3xl">
                        🏫
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-3xl p-6 shadow hover:-translate-y-1 transition-transform">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Jumlah Mapel</p>
                        <p id="mapel-count" class="text-4xl font-bold text-gray-800 mt-2">{{ $jumlahMapel }}</p>
                    </div>
                    <div class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center text-3xl">
                        📚
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-4 bg-white rounded-3xl p-6 shadow">
            <h3 class="text-lg font-semibold mb-4 text-gray-700 flex items-center gap-2">
                <i class="fas fa-info-circle"></i>
                PANDUAN APLIKASI
            </h3>
            <p class="text-gray-600 leading-relaxed">
                Panduan penggunaan aplikasi E-Rapor untuk Guru dan Wali Kelas.
            </p>
            <div class="mt-8 space-y-4">
                <div class="flex gap-4 items-start">
                    <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center flex-shrink-0">1</div>
                    <div>
                        <p class="font-medium">Input Nilai</p>
                        <p class="text-sm text-gray-500">Masukkan nilai siswa per mata pelajaran</p>
                    </div>
                </div>
                <div class="flex gap-4 items-start">
                    <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center flex-shrink-0">2</div>
                    <div>
                        <p class="font-medium">Generate Raport</p>
                        <p class="text-sm text-gray-500">Cetak raport semesteran secara otomatis</p>
                    </div>
                </div>
                <div class="flex gap-4 items-start">
                    <div class="w-8 h-8 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center flex-shrink-0">3</div>
                    <div>
                        <p class="font-medium">Monitoring</p>
                        <p class="text-sm text-gray-500">Pantau perkembangan siswa secara real-time</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function animateValue(id, start, end, duration) {
        let startTimestamp = null;
        const step = (timestamp) => {
            if (!startTimestamp) startTimestamp = timestamp;
            const progress = Math.min((timestamp - startTimestamp) / duration, 1);
            const value = Math.floor(progress * (end - start) + start);
            document.getElementById(id).textContent = value.toLocaleString('id-ID');
            if (progress < 1) {
                window.requestAnimationFrame(step);
            }
        };
        window.requestAnimationFrame(step);
    }

    window.addEventListener('load', function () {
        animateValue('guru-count', 0, {{ $jumlahGuru }}, 1500);
        animateValue('siswa-count', 0, {{ $jumlahSiswa }}, 1800);
        animateValue('kelas-count', 0, {{ $jumlahKelas }}, 1400);
        animateValue('mapel-count', 0, {{ $jumlahMapel }}, 1300);
    });
</script>

@endsection
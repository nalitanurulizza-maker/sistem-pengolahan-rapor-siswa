@extends('layout.app')

@section('title', 'Dashboard Wali Kelas')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Dashboard Wali Kelas</h2>
    <div class="bg-white rounded-3xl p-6 shadow">
        <p class="text-gray-600 mb-4">Selamat datang di dashboard Wali Kelas. Halaman ini akan menampilkan informasi siswa, kelas, dan raport.</p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-blue-50 p-5 rounded-3xl">
                <p class="text-sm text-blue-500">Jumlah siswa bimbingan</p>
                <p class="text-3xl font-bold mt-3">28</p>
            </div>
            <div class="bg-emerald-50 p-5 rounded-3xl">
                <p class="text-sm text-emerald-600">Kelas</p>
                <p class="text-3xl font-bold mt-3">IPA 1</p>
            </div>
        </div>
    </div>
</div>
@endsection

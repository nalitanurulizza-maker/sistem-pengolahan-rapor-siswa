@extends('layout.app')

@section('title', 'Data Wali Kelas')

@section('content')
<div class="p-6">
    <h2 class="text-xl font-bold mb-4">DATA WALI KELAS</h2>

    <div class="bg-white rounded shadow p-4">
        <p class="text-gray-600 mb-4">Halaman ini menampilkan daftar wali kelas dan kelas yang mereka pegang.</p>
        <table class="w-full border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border p-2">No</th>
                    <th class="border p-2">Nama Wali Kelas</th>
                    <th class="border p-2">Kelas</th>
                    <th class="border p-2">Tingkat</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border p-2 text-center">1</td>
                    <td class="border p-2">Contoh Wali</td>
                    <td class="border p-2">IPA 1</td>
                    <td class="border p-2">10</td>
                    <td class="border p-2 text-center">
                        <button class="text-blue-500">Ubah</button>
                        <button class="text-red-500 ml-2">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
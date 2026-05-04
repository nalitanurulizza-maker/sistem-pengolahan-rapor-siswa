@extends('layout.app')

@section('title', 'Data Guru')

@section('content')
<div class="p-6">
    <h2 class="text-xl font-bold mb-4">DATA GURU</h2>

    <div class="bg-white rounded shadow p-4">
        <p class="text-gray-600 mb-4">Halaman ini adalah tempat untuk mengelola data guru.</p>
        <table class="w-full border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border p-2">No</th>
                    <th class="border p-2">Nama Guru</th>
                    <th class="border p-2">NIP</th>
                    <th class="border p-2">Mata Pelajaran</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border p-2 text-center">1</td>
                    <td class="border p-2">Contoh Guru</td>
                    <td class="border p-2">1987654321</td>
                    <td class="border p-2">Matematika</td>
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
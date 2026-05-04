@extends('layout.app')

@section('title', 'Mata Pelajaran')

@section('content')
<div class="p-6">
    <h2 class="text-xl font-bold mb-4">MATA PELAJARAN</h2>

    <div class="bg-white rounded shadow p-4">
        <p class="text-gray-600 mb-4">Halaman ini menampilkan daftar mata pelajaran yang tersedia.</p>
        <table class="w-full border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border p-2">No</th>
                    <th class="border p-2">Mata Pelajaran</th>
                    <th class="border p-2">KKM</th>
                    <th class="border p-2">Tingkat</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border p-2 text-center">1</td>
                    <td class="border p-2">Matematika</td>
                    <td class="border p-2">75</td>
                    <td class="border p-2">10</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
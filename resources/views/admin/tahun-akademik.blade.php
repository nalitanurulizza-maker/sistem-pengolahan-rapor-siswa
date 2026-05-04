@extends('layout.app')

@section('title', 'Tahun Akademik')

@section('content')
<div class="p-6">
    <h2 class="text-xl font-bold mb-4">TAHUN AKADEMIK</h2>

    <div class="bg-white rounded shadow p-4">
        <p class="text-gray-600 mb-4">Halaman ini berisi daftar tahun akademik yang aktif dan sudah pernah digunakan.</p>
        <table class="w-full border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border p-2">No</th>
                    <th class="border p-2">Tahun Akademik</th>
                    <th class="border p-2">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border p-2 text-center">1</td>
                    <td class="border p-2">2026/2027</td>
                    <td class="border p-2">Aktif</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
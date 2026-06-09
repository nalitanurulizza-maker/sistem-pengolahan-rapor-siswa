@extends('layout.guru-app')

@section('title', 'Input Kehadiran Siswa | E-Rapor Wali Kelas')

@section('content')

<div class="text-center mb-6 mt-4">
    <h6 class="font-bold text-lg text-gray-800 uppercase tracking-wide">
        Input Kehadiran Siswa
    </h6>
</div>

<div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 mt-6 min-h-[calc(100vh-180px)] flex flex-col">

    <div class="w-full space-y-4 mb-10">
        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/4 font-semibold text-gray-700 text-sm">Kelas Anda</label>
            <div class="md:w-3/4">
                <input type="text" disabled value="Kelas {{ $data_guru_aktif->nama_kelas_walas }}" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm font-bold text-blue-600">
            </div>
        </div>
        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/4 font-semibold text-gray-700 text-sm">Tahun Ajaran</label>
            <div class="md:w-3/4">
                <input type="text" disabled value="2026/2027" class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-600 font-medium">
            </div>
        </div>
    </div>

    <form action="{{ route('guru.simpan-kehadiran') }}" method="POST" class="flex flex-col flex-grow">
        @csrf
        <input type="hidden" name="kode_kelas" value="{{ $data_guru_aktif->nama_kelas_walas }}">

        <div class="overflow-x-auto border border-gray-100 rounded-xl shadow-sm">
            <table class="w-full text-sm text-left border-collapse">
                <thead class="bg-gray-50 text-gray-700 font-bold border-b border-gray-100 text-xs uppercase">
                    <tr>
                        <th class="px-4 py-3 border-r w-12 text-center">No</th>
                        <th class="px-4 py-3 border-r">Nama Siswa</th>
                        <th class="px-4 py-3 border-r text-center w-32">NIS</th>
                        <th class="px-4 py-3 text-center w-48">Status Kehadiran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-gray-700">
                    @forelse($siswa as $index => $s)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-4 py-3 border-r text-center font-mono">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 border-r font-semibold text-gray-900 uppercase">
                            {{ $s->nama_siswa }}
                        </td>
                        <td class="px-4 py-3 border-r text-center font-mono text-blue-600">
                            {{ $s->nis }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            <select name="kehadiran[{{ $s->nis }}]" class="w-full p-2 border border-gray-200 rounded-lg text-sm outline-none focus:ring-2 focus:ring-blue-500">
                                @foreach(['Hadir', 'Sakit', 'Izin', 'Alfa'] as $status)
                                    <option value="{{ $status }}" {{ ($s->absensi->jenis_kehadiran ?? 'Hadir') == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-12 text-center text-gray-400">
                            Data siswa tidak ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 flex justify-end">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-xl shadow-md transition-all text-sm font-semibold flex items-center gap-2">
                <i class="fa-solid fa-floppy-disk"></i> Simpan Data Kehadiran
            </button>
        </div>
    </form>
</div>

@endsection
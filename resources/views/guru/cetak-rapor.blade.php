@extends('layout.guru-app')

@section('title', 'Cetak Rapor | E-Rapor')

@section('content')

<div class="text-center mb-6 mt-4">
    <h6 class="font-bold text-lg text-gray-800 uppercase tracking-wide">
        Cetak Rapor — Kelas {{ $nama_kelas }}
    </h6>
    <p class="text-xs text-gray-500 mt-1">Pilih siswa yang akan dicetak rapornya dalam format PDF.</p>
</div>

<div class="bg-white p-8 rounded-t-3xl shadow-sm border border-gray-100 mt-6 min-h-[calc(100vh-180px)] flex flex-col">

    <div class="overflow-x-auto border rounded-lg shadow-sm">
        <table class="w-full text-sm text-left border-collapse">
            <thead class="bg-gray-50 text-gray-700 font-bold border-b text-xs uppercase">
                <tr>
                    <th class="px-4 py-3 border-r w-12 text-center">No</th>
                    <th class="px-4 py-3 border-r">Nama Siswa</th>
                    <th class="px-4 py-3 border-r">NIS</th>
                    <th class="px-4 py-3 text-center w-48">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y text-gray-600">
                @forelse($siswa as $i => $s)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 border-r text-center text-xs font-medium">{{ $i + 1 }}</td>
                    <td class="px-4 py-3 border-r font-semibold text-gray-800">{{ $s->nama_siswa }}</td>
                    <td class="px-4 py-3 border-r text-gray-500">{{ $s->nis }}</td>
                    <td class="px-4 py-3 text-center">
                        <a href="{{ route('guru.cetak-pdf', $s->nis) }}"
                           target="_blank"
                           class="inline-flex items-center gap-2 bg-red-600 text-white px-4 py-2 rounded-lg font-bold hover:bg-red-700 transition text-xs">
                            <i class="fa-solid fa-file-pdf"></i> Cetak PDF
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-4 py-6 text-center text-gray-400 italic">
                        Belum ada siswa di kelas ini.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>

@endsection

@extends('layout.admin-app')

@section('content')
<div class="p-4 sm:p-6">
    <h2 class="text-xl font-bold mb-1 text-gray-800">PAKET MATA PELAJARAN</h2>
    <p class="text-sm text-gray-500 mb-4">
        Tahun Ajaran: {{ $tahunAktif?->nama_tahun ?? '-' }} ({{ $tahunAktif?->semester ?? '' }})
    </p>

    @if(session('success'))
        <div class="mb-4 p-3 bg-emerald-50 text-emerald-700 rounded-xl border border-emerald-200 text-sm font-semibold">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-2 sm:p-4 w-full">
        <table class="w-full text-sm">
            <thead class="bg-gray-50 text-gray-600 border-b border-gray-100">
                <tr>
                    <th class="p-3 text-center w-10">No</th>
                    <th class="p-3 text-left">Kelas</th>
                    <th class="p-3 text-left">Wali Kelas</th>
                    <th class="p-3 text-center">Mapel Wajib</th>
                    <th class="p-3 text-center">Mapel Pilihan</th>
                    <th class="p-3 text-center">Status</th>
                    <th class="p-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 divide-y divide-gray-50">
                @forelse($kelasList as $i => $kelas)
                    @php
                        $paket = $paketExisting[$kelas->kode_kelas] ?? null;
                        $jmlWajib   = $paket ? $paket->details->where('jenis_mp', 'wajib')->count() : 0;
                        $jmlPilihan = $paket ? $paket->details->where('jenis_mp', 'pilihan')->count() : 0;
                    @endphp
                    <tr class="hover:bg-gray-50/70 transition">
                        <td class="p-3 text-center text-gray-400">{{ $i + 1 }}</td>
                        <td class="p-3 font-bold text-gray-800">{{ $kelas->nama_kelas }}</td>
                        <td class="p-3 text-gray-600">{{ $kelas->guru?->nama_guru ?? '-' }}</td>
                        <td class="p-3 text-center">
                            @if($paket && $jmlWajib > 0)
                                <span class="bg-gray-100 text-gray-600 px-2 py-0.5 rounded-md text-xs font-semibold">
                                    {{ $jmlWajib }} mapel
                                </span>
                            @else
                                <span class="text-gray-300">-</span>
                            @endif
                        </td>
                        <td class="p-3 text-center">
                            @if($paket && $jmlPilihan > 0)
                                <span class="bg-blue-50 text-blue-600 px-2 py-0.5 rounded-md text-xs font-semibold">
                                    {{ $jmlPilihan }} mapel
                                </span>
                            @else
                                <span class="text-gray-300">-</span>
                            @endif
                        </td>
                        <td class="p-3 text-center">
                            @if($paket)
                                <span class="bg-emerald-50 text-emerald-600 px-2 py-0.5 rounded-md text-xs font-semibold">
                                    Sudah Diatur
                                </span>
                            @else
                                <span class="bg-amber-50 text-amber-600 px-2 py-0.5 rounded-md text-xs font-semibold">
                                    Belum Diatur
                                </span>
                            @endif
                        </td>
                        <td class="p-3 text-center">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('admin.paket-mapel.create', ['kelas' => $kelas->kode_kelas]) }}"
                                   class="w-7 h-7 flex items-center justify-center rounded-lg
                                          {{ $paket ? 'bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white' : 'bg-blue-600 text-white hover:bg-blue-700' }}
                                          transition"
                                   title="{{ $paket ? 'Edit Paket' : 'Atur Paket' }}">
                                    <i class="fa-solid fa-pen text-xs"></i>
                                </a>

                                @if($paket)
                                    <a href="{{ route('admin.paket-mapel.show', $kelas->kode_kelas) }}"
                                       class="w-7 h-7 flex items-center justify-center rounded-lg bg-gray-100 text-gray-500 hover:bg-gray-500 hover:text-white transition"
                                       title="Lihat Detail">
                                        <i class="fa-solid fa-eye text-xs"></i>
                                    </a>

                                    <form action="{{ route('admin.paket-mapel.destroy', $kelas->kode_kelas) }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus paket mapel kelas {{ $kelas->kode_kelas }}?')">
                                        @csrf 
                                        @method('DELETE')
                                        <button type="submit"
                                                class="w-7 h-7 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition"
                                                title="Hapus Paket">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-8 text-center text-gray-400 italic">
                            Tidak ada data kelas untuk tahun ajaran aktif.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
@extends('layout.admin-app')

@section('content')
<div class="p-4 sm:p-6 max-w-4xl mx-auto">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <a href="{{ route('admin.paket-mapel.index') }}" class="text-sm text-blue-600 hover:underline flex items-center gap-1 mb-2">
                <i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke daftar paket
            </a>
            <h2 class="text-xl font-bold text-gray-800">Detail Paket Mata Pelajaran</h2>
            <p class="text-sm text-gray-500">
                Kelas: <span class="font-bold text-gray-700">{{ $paket->kelas->nama_kelas ?? $paket->kode_kelas }}</span> | 
                Tahun Ajaran: {{ $tahunAktif?->nama_tahun ?? $paket->tahun_ajaran }}
            </p>
        </div>
        <div>
            <a href="{{ route('admin.paket-mapel.create', ['kelas' => $paket->kode_kelas]) }}" class="px-4 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 text-sm font-semibold shadow-sm transition flex items-center gap-2">
                <i class="fa-solid fa-pen text-xs"></i> Edit Konfigurasi
            </a>
        </div>
    </div>

    <div class="space-y-6">
        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                <span class="w-1.5 h-4 bg-gray-400 rounded-full"></span> 
                Mata Pelajaran Umum (Wajib)
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                @forelse($paket->details->where('jenis_mp', 'wajib') as $detail)
                    <div class="p-3 bg-gray-50 rounded-xl border border-gray-100 flex items-center justify-between text-sm">
                        <span class="text-gray-700 font-medium">{{ $detail->mataPelajaran->nama_mp ?? $detail->kode_mp }}</span>
                        <span class="text-xs text-gray-400 bg-white px-2 py-1 rounded border border-gray-100 font-mono">{{ $detail->kode_mp }}</span>
                    </div>
                @empty
                    <p class="text-sm text-gray-400 italic col-span-2">Tidak ada mata pelajaran wajib yang terdaftar.</p>
                @endforelse
            </div>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
            <h3 class="font-bold text-gray-800 mb-3 flex items-center gap-2">
                <span class="w-1.5 h-4 bg-blue-500 rounded-full"></span> 
                Mata Pelajaran Pilihan 
                @if(str_starts_with($paket->kode_kelas, 'X.'))
                    <span class="text-xs font-semibold bg-emerald-50 text-emerald-600 px-2 py-0.5 rounded-md ml-1">Fase E (Semua Mapel)</span>
                @endif
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                @forelse($paket->details->where('jenis_mp', 'pilihan') as $detail)
                    <div class="p-3 bg-blue-50/30 rounded-xl border border-blue-100/50 flex items-center justify-between text-sm">
                        <span class="text-blue-900 font-medium">{{ $detail->mataPelajaran->nama_mp ?? $detail->kode_mp }}</span>
                        <span class="text-xs text-blue-400 bg-white px-2 py-1 rounded border border-blue-100/50 font-mono">{{ $detail->kode_mp }}</span>
                    </div>
                @empty
                    <p class="text-sm text-gray-400 italic col-span-2">Tidak ada mata pelajaran pilihan yang terdaftar.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
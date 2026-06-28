@extends('layout.admin-app')

@section('content')
<div class="p-4 sm:p-6 max-w-3xl">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('admin.paket-mapel.index') }}" class="text-gray-400 hover:text-gray-600 transition">
            <i class="fa-solid fa-arrow-left"></i>
        </a>
        <div>
            <h2 class="text-xl font-bold text-gray-800">
                {{ $paketAda ? 'Edit' : 'Atur' }} Paket Mata Pelajaran
            </h2>
            <p class="text-sm text-gray-500">
                Kelas: <strong>{{ $kelas->nama_kelas }}</strong> |
                Tahun Ajaran: {{ $tahunAktif?->nama_tahun }} ({{ $tahunAktif?->semester }})
            </p>
        </div>
    </div>

    @if($errors->any())
        <div class="mb-4 p-3 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.paket-mapel.store') }}" method="POST">
        @csrf
        <input type="hidden" name="kode_kelas"   value="{{ $kelas->kode_kelas }}">
        <input type="hidden" name="tahun_ajaran"  value="{{ $tahunAktif?->nama_tahun }}">

        {{-- ── BAGIAN 1: MAPEL WAJIB ── --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 mb-4">
            <div class="flex items-center gap-2 mb-3">
                <span class="w-6 h-6 rounded-full bg-gray-800 text-white text-xs font-bold flex items-center justify-center">1</span>
                <div>
                    <p class="font-bold text-gray-800">Mata Pelajaran Umum (Wajib)</p>
                    <p class="text-xs text-gray-400">Komponen mata pelajaran dasar yang otomatis dimasukkan ke dalam paket kelas.</p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-2">
                @foreach($mapelWajib as $mp)
                    <div class="flex items-center gap-2 p-2.5 bg-gray-50 border border-gray-100 rounded-lg">
                        <i class="fa-solid fa-lock text-gray-300 text-xs"></i>
                        <span class="text-sm text-gray-600">{{ $mp->nama_mp }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ── BAGIAN 2: MAPEL PILIHAN ── --}}
        <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-5 mb-5">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center gap-2">
                    <span class="w-6 h-6 rounded-full bg-gray-800 text-white text-xs font-bold flex items-center justify-center">2</span>
                    <div>
                        @if($isKelas10)
                            <p class="font-bold text-gray-800">Mata Pelajaran Fase E (Kelas 10)</p>
                            <p class="text-xs text-emerald-600 font-medium">
                                Sesuai aturan Kurikulum Merdeka, siswa kelas 10 dibebankan mempelajari seluruh kelompok peminatan (MIPA &amp; IPS).
                            </p>
                        @else
                            <p class="font-bold text-gray-800">Mata Pelajaran Pilihan (Peminatan)</p>
                            <p class="text-xs text-gray-400">Pilih 4–5 mapel peminatan untuk kelas ini (boleh campur MIPA &amp; IPS).</p>
                        @endif
                    </div>
                </div>
                @if(!$isKelas10)
                    <span id="counter"
                          class="text-xs px-2.5 py-1 rounded-full font-semibold bg-gray-100 text-gray-500">
                        0 / 5 dipilih
                    </span>
                @endif
            </div>

            {{-- MIPA --}}
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Kelompok MIPA</p>
            <div class="grid grid-cols-2 gap-2 mb-4">
                @foreach($mapelMIPA as $mp)
                    @if($isKelas10)
                        {{-- Kelas X: semua terkunci otomatis --}}
                        <div class="flex items-center gap-2 p-2.5 bg-blue-50 border border-blue-100 rounded-lg">
                            <i class="fa-solid fa-lock text-blue-300 text-xs"></i>
                            <span class="text-sm text-blue-700">{{ $mp->nama_mp }}</span>
                        </div>
                        <input type="hidden" name="mapel_pilihan[]" value="{{ $mp->kode_mp }}">
                    @else
                        {{-- Kelas XI/XII: bisa pilih --}}
                        <label class="flex items-center gap-2.5 p-2.5 border rounded-lg cursor-pointer transition
                                      hover:border-blue-400 hover:bg-blue-50
                                      has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50
                                      {{ in_array($mp->kode_mp, $terpilihPilihan) ? 'border-blue-500 bg-blue-50' : 'border-gray-200' }}">
                            <input type="checkbox" name="mapel_pilihan[]" value="{{ $mp->kode_mp }}"
                                   class="mapel-cb accent-blue-600 w-4 h-4"
                                   {{ in_array($mp->kode_mp, $terpilihPilihan) ? 'checked' : '' }}>
                            <span class="text-sm text-gray-700">{{ $mp->nama_mp }}</span>
                        </label>
                    @endif
                @endforeach
            </div>

            {{-- IPS --}}
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Kelompok IPS</p>
            <div class="grid grid-cols-2 gap-2">
                @foreach($mapelIPS as $mp)
                    @if($isKelas10)
                        <div class="flex items-center gap-2 p-2.5 bg-green-50 border border-green-100 rounded-lg">
                            <i class="fa-solid fa-lock text-green-300 text-xs"></i>
                            <span class="text-sm text-green-700">{{ $mp->nama_mp }}</span>
                        </div>
                        <input type="hidden" name="mapel_pilihan[]" value="{{ $mp->kode_mp }}">
                    @else
                        <label class="flex items-center gap-2.5 p-2.5 border rounded-lg cursor-pointer transition
                                      hover:border-green-400 hover:bg-green-50
                                      has-[:checked]:border-green-500 has-[:checked]:bg-green-50
                                      {{ in_array($mp->kode_mp, $terpilihPilihan) ? 'border-green-500 bg-green-50' : 'border-gray-200' }}">
                            <input type="checkbox" name="mapel_pilihan[]" value="{{ $mp->kode_mp }}"
                                   class="mapel-cb accent-green-600 w-4 h-4"
                                   {{ in_array($mp->kode_mp, $terpilihPilihan) ? 'checked' : '' }}>
                            <span class="text-sm text-gray-700">{{ $mp->nama_mp }}</span>
                        </label>
                    @endif
                @endforeach
            </div>

            @if(!$isKelas10)
                <p class="text-xs text-gray-400 mt-3 italic">* Minimal 4, maksimal 5 mata pelajaran peminatan.</p>
            @endif
        </div>

        {{-- Tombol --}}
        <div class="flex justify-end gap-3">
            <a href="{{ route('admin.paket-mapel.index') }}"
               class="px-5 py-2.5 text-sm border border-gray-200 text-gray-600 rounded-xl hover:bg-gray-50 transition">
                Batal
            </a>
            <button type="submit"
                    class="px-6 py-2.5 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 transition">
                <i class="fa-solid fa-floppy-disk mr-1.5"></i>
                {{ $paketAda ? 'Perbarui Paket' : 'Simpan Paket' }}
            </button>
        </div>
    </form>
</div>

@if(!$isKelas10)
<script>
const cbs      = document.querySelectorAll('.mapel-cb');
const counter  = document.getElementById('counter');
const MAX      = 5;

function updateCounter() {
    const n = document.querySelectorAll('.mapel-cb:checked').length;
    counter.textContent = `${n} / ${MAX} dipilih`;
    counter.className = `text-xs px-2.5 py-1 rounded-full font-semibold ${
        n >= 4 && n <= 5 ? 'bg-emerald-100 text-emerald-700' :
        n > 5            ? 'bg-red-100 text-red-600'         :
                           'bg-gray-100 text-gray-500'
    }`;
}

cbs.forEach(cb => cb.addEventListener('change', function () {
    if (document.querySelectorAll('.mapel-cb:checked').length > MAX) {
        this.checked = false;
        alert('Maksimal 5 mata pelajaran peminatan.');
    }
    updateCounter();
}));

updateCounter();
</script>
@endif
@endsection
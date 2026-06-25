@extends('layout.admin-app')

@section('content')
<div class="p-4 sm:p-6 max-w-5xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.paket-mapel.index') }}" class="text-sm text-blue-600 hover:underline flex items-center gap-1 mb-2">
            <i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke daftar paket
        </a>
        <h2 class="text-xl font-bold text-gray-800">Atur Paket Mata Pelajaran</h2>
        <p class="text-sm text-gray-500">
            Kelas: <span class="font-bold text-gray-700">{{ $kelas->nama_kelas }}</span> | 
            Tahun Ajaran: {{ $tahunAktif?->nama_tahun ?? '-' }} ({{ $tahunAktif?->semester ?? '' }})
        </p>
    </div>

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-xl text-sm">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.paket-mapel.store') }}" method="POST">
        @csrf
        <input type="hidden" name="kode_kelas" value="{{ $kelas->kode_kelas }}">
        <input type="hidden" name="tahun_ajaran" value="{{ $tahunAktif?->nama_tahun }}">

        <div class="space-y-6">
            
            {{-- LANGKAH 1: MAPEL UMUM (WAJIB) --}}
            <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex items-start gap-3 mb-4">
                    <div class="w-8 h-8 rounded-lg bg-gray-100 flex items-center justify-center text-gray-600 font-bold text-sm">1</div>
                    <div>
                        <h3 class="font-bold text-gray-800">Mata Pelajaran Umum (Wajib)</h3>
                        <p class="text-xs text-gray-400">Komponen mata pelajaran dasar utama yang otomatis dimasukkan ke dalam paket kelas.</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2 bg-gray-50/50 p-3 rounded-xl border border-gray-100">
                    @foreach($mapelWajib as $mp)
                        <div class="flex items-center gap-3 p-2.5 bg-white rounded-lg border border-gray-100 text-gray-500 text-sm">
                            <i class="fa-solid fa-circle-check text-emerald-500"></i>
                            <span>{{ $mp->nama_mp }} <code class="text-xs text-gray-400">({{ $mp->kode_mp }})</code></span>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- 🟢 KONDISI JIKA KELAS 10 (AWALAN NAMA KELAS ADALAH 'X.') --}}
            @if(str_starts_with($kelas->nama_kelas, 'X.'))
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex items-start gap-3 mb-4">
                        <div class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center text-sm font-bold">2</div>
                        <div>
                            <h3 class="font-bold text-gray-800">Mata Pelajaran Fase E (Kelas 10)</h3>
                            <p class="text-xs text-emerald-600 font-medium">Sesuai aturan Kurikulum Merdeka, siswa kelas 10 dibebankan mempelajari seluruh kelompok peminatan (MIPA & IPS).</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- MIPA otomatis --}}
                        <div class="p-3 bg-gray-50 rounded-xl">
                            <h4 class="text-xs font-bold text-gray-500 mb-2">Kelompok MIPA</h4>
                            <div class="space-y-1.5">
                                @foreach($mapelMIPA as $mp)
                                    <input type="hidden" name="mapel_pilihan[]" value="{{ $mp->kode_mp }}">
                                    <div class="text-xs p-2 bg-white border border-gray-200 rounded-lg text-gray-600 flex items-center gap-2">
                                        <i class="fa-solid fa-lock text-gray-400 text-[10px]"></i> {{ $mp->nama_mp }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{-- IPS otomatis --}}
                        <div class="p-3 bg-gray-50 rounded-xl">
                            <h4 class="text-xs font-bold text-gray-500 mb-2">Kelompok IPS</h4>
                            <div class="space-y-1.5">
                                @foreach($mapelIPS as $mp)
                                    <input type="hidden" name="mapel_pilihan[]" value="{{ $mp->kode_mp }}">
                                    <div class="text-xs p-2 bg-white border border-gray-200 rounded-lg text-gray-600 flex items-center gap-2">
                                        <i class="fa-solid fa-lock text-gray-400 text-[10px]"></i> {{ $mp->nama_mp }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @else
                {{-- 🔵 KONDISI UNTUK KELAS 11 DAN 12 (BISA MEMILIH MANDIRI) --}}
                <div class="bg-white p-5 rounded-2xl shadow-sm border border-gray-100">
                    <div class="flex items-start gap-3 mb-2">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center text-sm font-bold">2</div>
                        <div>
                            <h3 class="font-bold text-gray-800">Pilih Mata Pelajaran Pilihan (Kelas 11/12)</h3>
                            <p class="text-xs text-gray-400">Pilih rentang <span class="text-blue-600 font-bold">4 hingga 5 mata pelajaran</span> kombinasi kelompok di bawah ini.</p>
                        </div>
                    </div>

                    <div class="text-right mb-4">
                        <span id="counter-badge" class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-bold">
                            Terpilih: <span id="checked-count">0</span> / 5
                        </span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="p-4 bg-slate-50/50 rounded-xl border border-gray-100">
                            <h4 class="text-sm font-bold text-indigo-700 mb-3 flex items-center gap-2">
                                <i class="fa-solid fa-atom"></i> Matematika dan Sains (MIPA)
                            </h4>
                            <div class="space-y-2">
                                @foreach($mapelMIPA as $mp)
                                    <label class="flex items-center gap-3 p-3 bg-white rounded-xl border border-gray-200 cursor-pointer hover:border-blue-400 select-none transition">
                                        <input type="checkbox" name="mapel_pilihan[]" value="{{ $mp->kode_mp }}"
                                               {{ in_array($mp->kode_mp, $terpilihPilihan) ? 'checked' : '' }}
                                               class="mapel-checkbox w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                        <span class="text-sm text-gray-700 font-medium">{{ $mp->nama_mp }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <div class="p-4 bg-slate-50/50 rounded-xl border border-gray-100">
                            <h4 class="text-sm font-bold text-amber-700 mb-3 flex items-center gap-2">
                                <i class="fa-solid fa-earth-americas"></i> Sosial dan Humaniora (IPS)
                            </h4>
                            <div class="space-y-2">
                                @foreach($mapelIPS as $mp)
                                    <label class="flex items-center gap-3 p-3 bg-white rounded-xl border border-gray-200 cursor-pointer hover:border-blue-400 select-none transition">
                                        <input type="checkbox" name="mapel_pilihan[]" value="{{ $mp->kode_mp }}"
                                               {{ in_array($mp->kode_mp, $terpilihPilihan) ? 'checked' : '' }}
                                               class="mapel-checkbox w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                        <span class="text-sm text-gray-700 font-medium">{{ $mp->nama_mp }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- TOMBOL SUBMIT DINAMIS --}}
            <div class="flex items-center justify-end gap-3 bg-gray-50 p-4 rounded-xl border border-gray-100">
                <a href="{{ route('admin.paket-mapel.index') }}" class="px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-xl hover:bg-gray-50 text-sm font-semibold transition">
                    Batal
                </a>
                
                @if(str_starts_with($kelas->nama_kelas, 'X.'))
                    <button type="submit" id="btn-submit" class="px-5 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 text-sm font-semibold shadow-sm transition opacity-100">
                        Simpan Paket Mapel
                    </button>
                @else
                    <button type="submit" id="btn-submit" disabled class="px-5 py-2 bg-gray-300 text-gray-500 rounded-xl text-sm font-semibold shadow-sm transition opacity-50 cursor-not-allowed">
                        Simpan Paket Mapel
                    </button>
                @endif
            </div>
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.mapel-checkbox');
        const countDisplay = document.getElementById('checked-count');
        const badge = document.getElementById('counter-badge');
        const submitBtn = document.getElementById('btn-submit');

        if(checkboxes.length > 0) {
            function updateCounter() {
                const checkedCount = document.querySelectorAll('.mapel-checkbox:checked').length;
                if(countDisplay) countDisplay.textContent = checkedCount;

                if (checkedCount >= 4 && checkedCount <= 5) {
                    badge.className = "px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold";
                    submitBtn.disabled = false;
                    submitBtn.className = "px-5 py-2 bg-blue-600 text-white rounded-xl hover:bg-blue-700 text-sm font-semibold shadow-sm transition opacity-100 cursor-pointer";
                } else {
                    badge.className = "px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-xs font-bold";
                    submitBtn.disabled = true;
                    submitBtn.className = "px-5 py-2 bg-gray-300 text-gray-500 rounded-xl text-sm font-semibold shadow-sm transition opacity-50 cursor-not-allowed";
                }
            }

            checkboxes.forEach(cb => {
                cb.addEventListener('change', updateCounter);
            });

            updateCounter();
        }
    });
</script>
@endsection
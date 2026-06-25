@extends('layout.admin-app')

@section('content')
<div x-data="{ openTambah: false }" class="p-4 sm:p-6">
    
    <h2 class="text-xl font-bold mb-4 text-gray-800">DATA GURU PENGAMPU</h2>

    @if(session('success'))
        <div class="mb-4 p-3 bg-emerald-50 text-emerald-700 rounded-xl border border-emerald-200 text-sm font-semibold">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-4 p-3 bg-red-50 text-red-700 rounded-xl border border-red-200 text-sm font-semibold">
            {{ session('error') }}
        </div>
    @endif

    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
        <div class="flex items-center gap-2">
            <span class="text-xs font-bold text-gray-500 uppercase whitespace-nowrap">PILIH KELAS:</span>
            <form method="GET" action="{{ url()->current() }}">
                <select name="kelas" onchange="this.form.submit()" class="bg-white border border-gray-200 text-gray-700 text-sm rounded-xl px-3 py-2 w-full sm:w-44 shadow-sm focus:outline-none">
                    <option value="">Semua Kelas</option>
                    @foreach($list_kelas as $k)
                        <option value="{{ $k->id }}" {{ request('kelas') == $k->id ? 'selected' : '' }}>{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </form>
        </div>

        <button @click="openTambah = true" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl shadow text-sm font-semibold transition">
            + Tambah Guru Pengampu
        </button>
    </div>

    {{-- KOTAK PUTIH UTAMA TABEL --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-2 sm:p-4 w-full">
        <table class="w-full table-fixed text-sm">
            <thead class="bg-gray-50 text-gray-600 border-b border-gray-100">
                <tr>
                    <th class="p-3 text-center w-[6%]">No</th>
                    <th class="p-3 text-left w-[30%]">Nama Guru</th>
                    <th class="p-3 text-left w-[28%]">Mata Pelajaran</th>
                    <th class="p-3 text-center w-[12%]">Kelas</th>
                    <th class="p-3 text-center w-[14%]">Tahun Ajaran</th>
                    <th class="p-3 text-center w-[10%]">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700 divide-y divide-gray-50">
                @forelse($daftar_pengampu as $index => $data)
                    <tr class="hover:bg-gray-50/70 transition">
                        <td class="p-3 text-center font-medium text-gray-500">
                            {{ $daftar_pengampu->firstItem() + $index }}
                        </td>
                        <td class="p-3">
                            <span class="block font-semibold text-gray-900 truncate">{{ $data->guru->nama_guru ?? 'Guru tidak ditemukan' }}</span>
                            <span class="block text-xs font-mono text-gray-400">{{ $data->guru_id }}</span>
                        </td>
                        <td class="p-3 text-gray-600 truncate">{{ $data->mapel->nama_mp ?? 'Mapel tidak ditemukan' }}</td>
                        <td class="p-3 text-center">
                            <span class="font-bold text-gray-800">{{ $data->kelas->nama_kelas ?? 'Tanpa Kelas' }}</span>
                        </td>
                        <td class="p-3 text-center text-gray-500 font-medium">{{ $data->tahun_akademik }}</td>
                        <td class="p-3 text-center">
                            <div class="flex items-center justify-center gap-1.5">
                                <form action="{{ route('admin.guru-pengampu.destroy', $data->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus ploting guru ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-7 h-7 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-gray-400 italic">Belum ada data penugasan guru.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION (SEKARANG SUDAH BERADA DI LUAR KOTAK PUTIH TABEL) --}}
    <div class="mt-4 px-2">
        {{ $daftar_pengampu->links() }}
    </div>

    <div x-show="openTambah" class="fixed inset-0 z-50 overflow-y-auto bg-black/50 flex justify-center items-center" x-cloak>
        <div class="relative bg-white rounded-2xl shadow-xl w-full max-w-md p-6 mx-4 border border-gray-100" @click.away="openTambah = false">
            <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2 uppercase">Ploting Guru Pengampu</h3>
            
            <form action="{{ route('admin.guru-pengampu.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700">Pilih Guru</label>
                    <select name="guru_id" class="mt-1 block w-full rounded-lg border border-gray-300 p-2 text-sm bg-white focus:outline-none" required>
                        <option value="">-- Pilih Guru --</option>
                        @foreach($list_guru as $g)
                            <option value="{{ $g->nip }}">{{ $g->nama_guru }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Pilih Mata Pelajaran</label>
                    <select name="kode_mp" class="mt-1 block w-full rounded-lg border border-gray-300 p-2 text-sm bg-white focus:outline-none" required>
                        <option value="">-- Pilih Mapel --</option>
                        @foreach($list_mapel as $m)
                            <option value="{{ $m->kode_mp }}">{{ $m->nama_mp }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Pilih Kelas</label>
                    <select name="kelas_id" class="mt-1 block w-full rounded-lg border border-gray-300 p-2 text-sm bg-white focus:outline-none" required>
                        <option value="">-- Pilih Kelas --</option>
                        @foreach($list_kelas as $k)
                            <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Tahun Akademik</label>
                    <input type="text" name="tahun_akademik" value="2026/2027" class="mt-1 block w-full rounded-lg border border-gray-200 bg-gray-50 p-2 text-sm text-gray-500 focus:outline-none" required readonly>
                </div>

                <div class="flex justify-end gap-3 border-t pt-4">
                    <button type="button" @click="openTambah = false" class="px-4 py-2 text-sm text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200 transition">Batal</button>
                    <button type="submit" class="px-4 py-2 text-sm text-white bg-blue-600 rounded-xl shadow-md font-semibold hover:bg-blue-700 transition">Simpan Penugasan</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
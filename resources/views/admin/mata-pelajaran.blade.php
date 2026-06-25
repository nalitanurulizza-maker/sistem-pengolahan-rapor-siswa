@extends('layout.admin-app')

@section('title', 'Data Mata Pelajaran')

@section('content')
<div x-data="{ openTambah: false, openEdit: false, editKodeMp: '', editNamaMp: '' }">

    <div class="p-4 sm:p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">DATA MATA PELAJARAN</h2>

        @if($errors->any())
            <div class="mb-4 p-4 text-sm text-red-700 bg-red-50 rounded-xl border border-red-100 flex flex-col gap-1.5 shadow-sm">
                @foreach ($errors->all() as $error)
                    <div class="flex items-center gap-2 font-semibold">
                        <i class="fa-solid fa-circle-exclamation text-red-500"></i>
                        <span>{{ $error }}</span>
                    </div>
                @endforeach
            </div>
        @endif


        @if(session('success'))
            <div class="mb-4 p-4 text-sm text-green-700 bg-green-50 rounded-xl border border-green-100 flex items-center gap-2 shadow-sm">
                <i class="fa-solid fa-circle-check text-green-500 text-base"></i>
                <span class="font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        {{-- Filter Pencarian & Tombol Tambah --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
            {{-- Form Pencarian --}}
            <form action="{{ request()->url() }}" method="GET" class="w-full sm:max-w-xs">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode atau nama mapel..."
                           class="w-full pl-10 pr-9 py-2.5 rounded-xl border border-gray-200 text-sm focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 placeholder:text-gray-400 text-gray-700 shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <i class="fa-solid fa-magnifying-glass text-sm"></i>
                    </div>
                    @if(request('search'))
                        <a href="{{ request()->url() }}" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-400 hover:text-gray-600 transition text-sm" title="Reset Pencarian">
                            ✕
                        </a>
                    @endif
                </div>
            </form>

            {{-- Tombol Tambah --}}
            <div class="flex justify-end">
                <button @click="openTambah = true" class="w-full sm:w-auto bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl shadow transition text-sm font-semibold whitespace-nowrap">
                    + Tambah Mata Pelajaran
                </button>
            </div>
        </div>

        {{-- Notifikasi Hasil Pencarian --}}
        @if(request('search'))
            <div class="mb-3 text-sm text-gray-500 flex items-center gap-1.5 pl-1">
                <span>Hasil pencarian untuk: <strong class="text-gray-800">"{{ request('search') }}"</strong></span>
            </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-2 sm:p-4 w-full">
            <table class="w-full table-fixed text-sm">
                <thead class="bg-gray-50 text-gray-600 border-b border-gray-100">
                    <tr>
                        <th class="p-3 text-center w-[8%]">No</th>
                        <th class="p-3 text-left w-[25%]">Kode Mapel</th>
                        <th class="p-3 text-left w-[52%]">Nama Mata Pelajaran</th>
                        <th class="p-3 text-center w-[15%]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-50">
                    @forelse($data_mapel as $index => $mp)
                    <tr class="hover:bg-gray-50/70 transition">
                      
                        <td class="p-3 text-center">
                            {{ method_exists($data_mapel, 'firstItem') ? $data_mapel->firstItem() + $index : $index + 1 }}
                        </td>
                        
                        <td class="p-3">
                            <span class="block font-mono text-blue-600 font-semibold uppercase">{{ $mp->kode_mp }}</span>
                        </td>
                        
                        <td class="p-3">
                            <span class="block font-semibold text-gray-900 truncate" title="{{ $mp->nama_mp }}">{{ $mp->nama_mp }}</span>
                        </td>
                        
                        <td class="p-3 text-center">
                            <div class="flex items-center justify-center gap-1.5">
                                <button @click="openEdit = true; editKodeMp = '{{ $mp->kode_mp }}'; editNamaMp = '{{ $mp->nama_mp }}'" 
                                        title="Ubah Data" class="w-7 h-7 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition">
                                    <i class="fa-solid fa-pen text-xs"></i>
                                </button>

                                {{-- Form Hapus Data --}}
                                <form action="{{ route('admin.mata-pelajaran.destroy', $mp->kode_mp) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus mata pelajaran ini?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus Data" class="w-7 h-7 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-8 text-center text-gray-400 bg-gray-50/30 rounded-b-2xl">
                            <i class="fa-solid fa-folder-open text-2xl mb-2 block text-gray-300"></i>
                            Belum ada data mata pelajaran di dalam database.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
            <div class="mt-4 px-3">
                {{ $data_mapel->links() }}
            </div>
    </div>

    {{-- Modal Tambah --}}
    <div x-show="openTambah" x-transition.opacity class="fixed inset-0 z-[100] overflow-y-auto bg-black/50 flex items-center justify-center p-4 backdrop-blur-sm" x-cloak>
        <div @click.away="openTambah = false" class="relative transform overflow-hidden rounded-2xl bg-white shadow-2xl transition-all w-full max-w-lg border border-gray-100">
            <div class="flex justify-between items-center p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-900">Tambah Mata Pelajaran</h3>
                <button @click="openTambah = false" class="text-gray-400 hover:text-gray-600 transition text-sm p-1.5 hover:bg-gray-50 rounded-lg">✕</button>
            </div>
            
            <form action="{{ route('admin.mata-pelajaran.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Kode Mapel</label>
                    <input type="text" name="kode_mp" required placeholder="Contoh: MP001"
                           class="mt-1 block w-full rounded-xl border border-gray-200 p-2.5 shadow-sm focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 text-sm placeholder:text-gray-400 text-gray-700 font-mono uppercase">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Mata Pelajaran</label>
                    <input type="text" name="nama_mp" required placeholder="Contoh: Matematika"
                           class="mt-1 block w-full rounded-xl border border-gray-200 p-2.5 shadow-sm focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 text-sm text-gray-700">
                </div>

                <div class="mt-8 flex justify-end gap-2.5 pt-4 border-t border-gray-50">
                    <button @click="openTambah = false" type="button" class="px-4 py-2.5 border border-gray-200 text-gray-600 rounded-xl hover:bg-gray-50 text-xs font-bold transition uppercase tracking-wider">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 text-xs font-bold transition shadow-sm shadow-blue-500/20 uppercase tracking-wider">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal Edit --}}
    <div x-show="openEdit" x-transition.opacity class="fixed inset-0 z-[100] overflow-y-auto bg-black/50 flex items-center justify-center p-4 backdrop-blur-sm" x-cloak>
        <div @click.away="openEdit = false" class="relative transform overflow-hidden rounded-2xl bg-white shadow-2xl transition-all w-full max-w-lg border border-gray-100">
            <div class="flex justify-between items-center p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-900">Ubah Mata Pelajaran</h3>
                <button @click="openEdit = false" class="text-gray-400 hover:text-gray-600 transition text-sm p-1.5 hover:bg-gray-50 rounded-lg">✕</button>
            </div>
            
            <form :action="'{{ url('admin/mata-pelajaran') }}/' + editKodeMp" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PUT')
                
                <div>
                    <label class="block text-sm font-medium text-gray-500">Kode Mapel (Kunci)</label>
                    <input type="text" x-model="editKodeMp" disabled
                           class="mt-1 block w-full rounded-xl border border-gray-200 bg-gray-50 p-2.5 text-sm font-mono text-gray-400 uppercase">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Nama Mata Pelajaran</label>
                    <input type="text" name="nama_mp" x-model="editNamaMp" required
                           class="mt-1 block w-full rounded-xl border border-gray-200 p-2.5 shadow-sm focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 text-sm text-gray-700">
                </div>

                <div class="mt-8 flex justify-end gap-2.5 pt-4 border-t border-gray-50">
                    <button @click="openEdit = false" type="button" class="px-4 py-2.5 border border-gray-200 text-gray-600 rounded-xl hover:bg-gray-50 text-xs font-bold transition uppercase tracking-wider">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 text-xs font-bold transition shadow-sm uppercase tracking-wider">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
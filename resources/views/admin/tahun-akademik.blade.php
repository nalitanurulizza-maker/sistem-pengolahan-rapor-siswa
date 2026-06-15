@extends('layout.admin-app')

@section('title', 'Tahun Academic')

@section('content')
<div x-data="{ openTambah: false }">

    <div class="p-4 sm:p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">DATA TAHUN AKADEMIK</h2>

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

        <div class="flex justify-end mb-3">
            <button @click="openTambah = true" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl shadow transition text-sm font-semibold">
                + Tambah Tahun Akademik
            </button>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-2 sm:p-4 w-full">
            <table class="w-full table-fixed text-sm">
                <thead class="bg-gray-50 text-gray-600 border-b border-gray-100">
                    <tr>
                        <th class="p-3 text-center w-[10%]">No</th>
                        <th class="p-3 text-center w-[30%]">Tahun Akademik</th>
                        <th class="p-3 text-center w-[25%]">Semester</th>
                        <th class="p-3 text-center w-[20%]">Status</th>
                        <th class="p-3 text-center w-[15%]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-50">
                    @forelse($data_tahun as $index => $ta)
                    <tr class="{{ $ta->status == 'Aktif' ? 'bg-blue-50/40 hover:bg-blue-50/70' : 'hover:bg-gray-50/70' }} transition">
                        
                        <td class="p-3 text-center">
                            {{ method_exists($data_tahun, 'firstItem') ? $data_tahun->firstItem() + $index : $index + 1 }}
                        </td>
                        
                        <td class="p-3 text-center {{ $ta->status == 'Aktif' ? 'font-bold text-gray-900' : 'font-semibold text-gray-500' }}">
                            {{ $ta->nama_tahun }}
                        </td>
                        
                        <td class="p-3 text-center {{ $ta->status == 'Aktif' ? 'font-medium text-gray-900' : 'text-gray-500' }}">
                            {{ $ta->semester }}
                        </td>
                        
                        <td class="p-3 text-center">
                            @if($ta->status == 'Aktif')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-blue-600 text-white text-[10px] font-bold uppercase tracking-wider">
                                    <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span> Aktif
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-md bg-amber-50 text-amber-700 border border-amber-200 text-[10px] font-bold uppercase tracking-wider">
                                    <i class="fa-solid fa-box-archive text-[9px]"></i> Diarsipkan
                                </span>
                            @endif
                        </td>
                        
                        <td class="p-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                @if($ta->status == 'Aktif')
                                    <span class="text-xs text-gray-400 font-medium select-none px-2 py-1">Active</span>
                                @else
                                    <form action="{{ route('admin.tahun-akademik.aktifkan', $ta->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" title="Aktifkan Periode" class="text-xs font-bold text-blue-600 bg-blue-50 hover:bg-blue-600 hover:text-white px-2 py-1 rounded transition">
                                            Aktifkan
                                        </button>
                                    </form>
                                @endif
                                
                                <form action="{{ route('admin.tahun-akademik.destroy', $ta->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus periode akademik ini?')" class="inline">
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
                        <td colspan="5" class="p-8 text-center text-gray-400 bg-gray-50/30 rounded-b-2xl">
                            <i class="fa-solid fa-folder-open text-2xl mb-2 block text-gray-300"></i>
                            Belum ada data tahun akademik di dalam database.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            @if(method_exists($data_tahun, 'links'))
                <div class="mt-4 px-2">
                    {{ $data_tahun->links() }}
                </div>
            @endif
        </div>
    </div>

    <div x-show="openTambah" x-transition.opacity class="fixed inset-0 z-[100] overflow-y-auto bg-black/50 flex items-center justify-center p-4 backdrop-blur-sm" x-cloak>
        <div @click.away="openTambah = false" class="relative transform overflow-hidden rounded-2xl bg-white shadow-2xl transition-all w-full max-w-md border border-gray-100">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6 border-b pb-2">
                    <h3 class="text-xl font-bold text-gray-900">Tahun Akademik Baru</h3>
                    <button @click="openTambah = false" class="text-gray-400 hover:text-gray-600 text-sm">✕</button>
                </div>
                
                <form action="{{ route('admin.tahun-akademik.store') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tahun Pelajaran</label>
                        <input type="text" name="tahun_akademik" required placeholder="Contoh: 2026/2027"
                               class="mt-1 block w-full rounded-xl border border-gray-200 p-2.5 shadow-sm focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 text-sm placeholder:text-gray-400 text-gray-700">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Semester</label>
                        <div class="flex gap-6 items-center">
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="radio" name="semester" value="Ganjil" required 
                                       class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500"> 
                                <span class="text-sm font-medium text-gray-600 group-hover:text-gray-900 transition">Ganjil</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="radio" name="semester" value="Genap" required 
                                       class="w-4 h-4 text-blue-600 border-gray-300 focus:ring-blue-500"> 
                                <span class="text-sm font-medium text-gray-600 group-hover:text-gray-900 transition">Genap</span>
                            </label>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end gap-3 border-t pt-4">
                        <button @click="openTambah = false" type="button" 
                                class="px-4 py-2.5 border border-gray-200 text-gray-600 rounded-xl hover:bg-gray-50 text-xs font-bold transition uppercase tracking-wider">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-5 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 text-xs font-bold transition shadow-sm shadow-blue-500/20 uppercase tracking-wider">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layout.admin-app')

@section('title', 'Tahun Akademik')

@section('content')
<div x-data="{ openTambah: false }">

    <div class="p-4 sm:p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">DATA TAHUN AKADEMIK</h2>

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
                    <!-- Row 1: Status Aktif -->
                    <tr class="bg-blue-50/40 hover:bg-blue-50/70 transition">
                        <td class="p-3 text-center">1</td>
                        <td class="p-3 text-center font-bold text-gray-900">2026/2027</td>
                        <td class="p-3 text-center font-medium">Ganjil</td>
                        <td class="p-3 text-center">
                            <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-blue-600 text-white text-[10px] font-bold uppercase tracking-wider">
                                <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span> Aktif
                            </span>
                        </td>
                        <td class="p-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <span class="text-xs text-gray-400 font-medium select-none px-2 py-1">Active</span>
                                <button title="Hapus Data" class="w-7 h-7 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition">
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    
                    <!-- Row 2: Status Tidak Aktif -->
                    <tr class="hover:bg-gray-50/70 transition">
                        <td class="p-3 text-center">2</td>
                        <td class="p-3 text-center font-semibold text-gray-800">2025/2026</td>
                        <td class="p-3 text-center">Genap</td>
                        <td class="p-3 text-center">
                            <span class="inline-block px-2.5 py-1 rounded-md bg-gray-100 text-gray-500 text-[10px] font-bold uppercase tracking-wider">
                                Tidak Aktif
                            </span>
                        </td>
                        <td class="p-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <button title="Aktifkan Periode" class="text-xs font-bold text-blue-600 bg-blue-50 hover:bg-blue-600 hover:text-white px-2 py-1 rounded transition">
                                    Aktifkan
                                </button>
                                <button title="Hapus Data" class="w-7 h-7 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition">
                                    <i class="fa-solid fa-trash text-xs"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL TAMBAH TAHUN AKADEMIK -->
    <div x-show="openTambah" 
         x-transition.opacity
         class="fixed inset-0 z-[100] overflow-y-auto" x-cloak>
        
        <div class="fixed inset-0 bg-black/50" @click="openTambah = false"></div>
        
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative transform overflow-hidden rounded-2xl bg-white shadow-2xl transition-all sm:w-full sm:max-w-md">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 border-b pb-2">Tahun Akademik Baru</h3>
                    
                    <form action="#" method="POST" class="space-y-4">
                        @csrf
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tahun Pelajaran</label>
                            <input type="text" name="tahun_akademik" required placeholder="Contoh: 2027/2028"
                                   class="mt-1 block w-full rounded-lg border border-gray-300 p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm placeholder:text-gray-400">
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
                                    class="px-5 py-2 text-sm font-semibold text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                                Batal
                            </button>
                            <button type="submit" 
                                    class="px-5 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-md transition">
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
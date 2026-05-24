@extends('layout.admin-app')

@section('title', 'Data Mata Pelajaran')

@section('content')
<div x-data="{ openTambah: false }">

    <div class="p-4 sm:p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">DATA MATA PELAJARAN</h2>

        <div class="flex justify-end mb-3">
            <button @click="openTambah = true" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl shadow transition text-sm font-semibold">
                + Tambah Mata Pelajaran
            </button>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-2 sm:p-4 w-full">
            <table class="w-full table-fixed text-sm">
                <thead class="bg-gray-50 text-gray-600 border-b border-gray-100">
                    <tr>
                        <th class="p-3 text-center w-[8%]">No</th>
                        <th class="p-3 text-left w-[25%]">Kode Mapel</th>
                        <th class="p-3 text-left w-[44%]">Nama Mata Pelajaran</th>
                        <th class="p-3 text-center w-[15%] sm:table-cell hidden">Kelompok</th>
                        <th class="p-3 text-center w-[8%]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-50">
                    <tr class="hover:bg-gray-50/70 transition">
                        <td class="p-3 text-center">1</td>
                        
                        <td class="p-3">
                            <span class="block font-mono text-blue-600 font-semibold uppercase">MP001</span>
                        </td>
                        
                        <td class="p-3">
                            <span class="block font-semibold text-gray-900 truncate" title="Matematika (Wajib)">Matematika (Wajib)</span>
                            <!-- Info kelompok muncul di bawah nama mapel khusus layar HP -->
                            <span class="inline-block sm:hidden text-[10px] bg-emerald-50 text-emerald-600 px-1.5 py-0.5 rounded font-semibold mt-1">
                                Kelompok A
                            </span>
                        </td>
                        
                        <td class="p-3 text-center sm:table-cell hidden">
                            <span class="bg-emerald-50 text-emerald-600 px-2.5 py-0.5 rounded-md text-xs font-semibold whitespace-nowrap">
                                Kelompok A
                            </span>
                        </td>
                        
                        <td class="p-3 text-center">
                            <div class="flex items-center justify-center gap-1.5">
                                <button title="Ubah Data" class="w-7 h-7 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition">
                                    <i class="fa-solid fa-pen text-xs"></i>
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

    <!-- MODAL TAMBAH MAPEL -->
    <div x-show="openTambah" 
         x-transition.opacity
         class="fixed inset-0 z-[100] overflow-y-auto" x-cloak>
        
        <div class="fixed inset-0 bg-black/50" @click="openTambah = false"></div>
        
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative transform overflow-hidden rounded-2xl bg-white shadow-2xl transition-all sm:w-full sm:max-w-xl">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 border-b pb-2">Tambah Mata Pelajaran</h3>
                    
                    <form action="#" method="POST" class="space-y-4">
                        @csrf
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kode Mapel</label>
                                <input type="text" name="kode_mapel" required placeholder="Contoh: MTK-01"
                                       class="mt-1 block w-full rounded-lg border border-gray-300 p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm placeholder:text-gray-400">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kelompok</label>
                                <select name="kelompok" required 
                                        class="mt-1 block w-full rounded-lg border border-gray-300 p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm bg-white">
                                    <option value="">-- Pilih Kelompok --</option>
                                    <option value="Kelompok A">Kelompok A (Wajib)</option>
                                    <option value="Kelompok B">Kelompok B (Wajib)</option>
                                    <option value="Kelompok C">Kelompok C (Peminatan)</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama Mata Pelajaran</label>
                            <input type="text" name="nama_mapel" required 
                                   class="mt-1 block w-full rounded-lg border border-gray-300 p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                        </div>

                        <div class="mt-8 flex justify-end gap-3">
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
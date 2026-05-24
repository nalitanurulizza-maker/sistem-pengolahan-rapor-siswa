@extends('layout.admin-app')

@section('content')
<div x-data="{ openTambah: false }">

    <div class="p-4 sm:p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">DATA GURU</h2>

        <div class="flex justify-end mb-3">
            <button @click="openTambah = true" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl shadow transition text-sm font-semibold">
                + Tambah Data Guru
            </button>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-2 sm:p-4 w-full">
            <table class="w-full table-fixed text-sm">
                <thead class="bg-gray-50 text-gray-600 border-b border-gray-100">
                    <tr>
                        <th class="p-3 text-center w-[6%]">No</th>
                        <th class="p-3 text-left w-[27%]">Guru (NIP)</th>
                        <th class="p-3 text-center w-[12%]">L/P</th>
                        <th class="p-3 text-left w-[15%] lg:table-cell hidden">Tgl Lahir</th>
                        <th class="p-3 text-left w-[22%] md:table-cell hidden">Alamat</th>
                        <th class="p-3 text-center w-[10%] sm:table-cell hidden">Role</th>
                        <th class="p-3 text-center w-[8%]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-50">
                    <tr class="hover:bg-gray-50/70 transition">
                        <td class="p-3 text-center">1</td>
                        
                        <td class="p-3">
                            <span class="block font-semibold text-gray-900 truncate">Nama Guru, S.Pd</span>
                            <span class="block text-xs font-mono text-blue-600">198701022015031002</span>
                            <span class="block text-[11px] text-gray-400 sm:hidden">08123456789</span>
                        </td>
                        
                        <td class="p-3 text-center">
                            <span class="sm:inline hidden">Perempuan</span>
                            <span class="sm:hidden inline">P</span>
                        </td>
                        
                        <td class="p-3 lg:table-cell hidden text-gray-600">1987-01-02</td>
                        
                        <td class="p-3 md:table-cell hidden text-gray-500">
                            <span class="block truncate" title="Jl. Pendidikan No. 45">Jl. Pendidikan No. 45</span>
                            <span class="block text-xs text-gray-400">Hub: 08123456789</span>
                        </td>
                        
                        <td class="p-3 text-center sm:table-cell hidden">
                            <span class="bg-emerald-50 text-emerald-600 px-2.5 py-0.5 rounded-md text-xs font-semibold whitespace-nowrap">
                                Guru Mapel
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

    <div x-show="openTambah" 
         x-transition.opacity
         class="fixed inset-0 z-[100] overflow-y-auto" x-cloak>
        
        <div class="fixed inset-0 bg-black/50" @click="openTambah = false"></div>
        
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative transform overflow-hidden rounded-2xl bg-white shadow-2xl transition-all sm:w-full sm:max-w-xl">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 border-b pb-2">Tambah Data Guru</h3>
                    
                    <form action="#" method="POST" class="space-y-4">
                        @csrf
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">NIP</label>
                                <input type="text" name="nip" required 
                                       class="mt-1 block w-full rounded-lg border border-gray-300 p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Guru</label>
                                <input type="text" name="nama_guru" required 
                                       class="mt-1 block w-full rounded-lg border border-gray-300 p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                <select name="jenis_kelamin" required 
                                        class="mt-1 block w-full rounded-lg border border-gray-300 p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" required 
                                       class="mt-1 block w-full rounded-lg border border-gray-300 p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">No. Telepon</label>
                                <input type="text" name="no_telp" required
                                       class="mt-1 block w-full rounded-lg border border-gray-300 p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Role / Jabatan</label>
                                <select name="role" required 
                                        class="mt-1 block w-full rounded-lg border border-gray-300 p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                                    <option value="">-- Pilih Role --</option>
                                    <option value="Guru Mapel">Guru Mata Pelajaran</option>
                                    <option value="Wali Kelas">Wali Kelas</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Alamat</label>
                            <textarea name="alamat" rows="3" required 
                                      class="mt-1 block w-full rounded-lg border border-gray-300 p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"></textarea>
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
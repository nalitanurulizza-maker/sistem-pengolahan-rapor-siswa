@extends('layout.admin-app')

@section('content')
<div x-data="{ openTambah: false, filterKelas: '' }">

    <div class="p-4 sm:p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">DATA WALI KELAS</h2>

        <!-- Panel Kendali (Filter & Tombol Tambah) -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
            <!-- Dropdown Filter Kelas -->
            <div class="flex items-center gap-2 w-full sm:w-auto">
                <label class="text-xs font-bold text-gray-500 uppercase whitespace-nowrap">Pilih Kelas:</label>
                <select x-model="filterKelas" class="bg-white border border-gray-200 text-gray-700 text-sm rounded-xl px-3 py-2 w-full sm:w-44 shadow-sm focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                    <option value="">Semua Kelas</option>
                    <option value="X.1">X.1</option>
                    <option value="X.2">X.2</option>
                    <option value="X.3">X.3</option>
                    <option value="X.4">X.4</option>
                    <option value="XI.1">XI.1</option>
                    <option value="XI.2">XI.2</option>
                    <option value="XI.3">XI.3</option>
                    <option value="XI.4">XI.4</option>
                    <option value="XII.4">XII.1</option>
                    <option value="XII.2">XII.2</option>
                    <option value="XII.3">XII.3</option>
                    <option value="XII.4">XII.4</option>
                </select>
            </div>

            <!-- Tombol Tambah Data -->
            <div class="flex justify-end">
                <button @click="openTambah = true" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl shadow transition text-sm font-semibold w-full sm:w-auto text-center">
                    + Tambah Data Wali Kelas
                </button>
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-2 sm:p-4 w-full">
            <table class="w-full table-fixed text-sm">
                <thead class="bg-gray-50 text-gray-600 border-b border-gray-100">
                    <tr>
                        <th class="p-3 text-center w-[6%]">No</th>
                        <th class="p-3 text-left w-[27%]">Wali Kelas (NIP)</th>
                        <th class="p-3 text-center w-[12%]">L/P</th>
                        <th class="p-3 text-left w-[15%] lg:table-cell hidden">Kelas</th>
                        <th class="p-3 text-center w-[8%]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-50">
                   
                    <!-- Baris Data 2 -->
                    <tr x-show="filterKelas === '' || filterKelas === 'X IPA 1'" x-transition class="hover:bg-gray-50/70 transition">
                        <td class="p-3 text-center">1</td>
                        <td class="p-3">
                            <span class="block font-semibold text-gray-900 truncate">Ahmad Subarjo, S.Pd</span>
                            <span class="block text-xs font-mono text-blue-600">199203142020101003</span>
                        </td>
                        <td class="p-3 text-center">
                            <span class="sm:inline hidden">Laki-laki</span>
                            <span class="sm:hidden inline">L</span>
                        </td>
                        <td class="p-3 lg:table-cell hidden text-gray-600">X IPA 1</td>
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

    <!-- MODAL -->
    <div x-show="openTambah" x-transition.opacity class="fixed inset-0 z-50 overflow-auto bg-black/50 flex items-center justify-center p-4 backdrop-blur-sm" x-cloak>
        <!-- Card Modal -->
        <div @click.away="openTambah = false" class="bg-white w-full max-w-lg rounded-2xl shadow-2xl transition-all border border-gray-100">
            <!-- Header Modal -->
            <div class="flex justify-between items-center p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-800">Tambah Data Wali Kelas</h3>
                <button @click="openTambah = false" class="text-gray-400 hover:text-gray-600 transition text-sm p-1.5 hover:bg-gray-50 rounded-lg">✕</button>
            </div>

            <!-- Form Konten -->
            <form class="p-6 space-y-4">
                @csrf

                <!-- Input NIP -->
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">NIP</label>
                    <input type="text" name="nip" required placeholder="Masukkan NIP resmi" class="block w-full rounded-xl border border-gray-200 p-2.5 shadow-sm text-sm transition focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 placeholder:text-gray-400">
                </div>

                <!-- Input Nama Guru -->
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Nama Guru</label>
                    <input type="text" name="nama_guru" required placeholder="Contoh: Nama Guru, S.Pd." class="block w-full rounded-xl border border-gray-200 p-2.5 shadow-sm text-sm transition focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 placeholder:text-gray-400">
                </div>

                <!-- Pilih Kelas -->
                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Alokasi Kelas</label>
                    <select name="kelas" required class="block w-full rounded-xl border border-gray-200 p-2.5 shadow-sm text-sm transition focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 text-gray-700">
                        <option value="" disabled selected>Pilih Kelas</option>
                        <option value="X.1">X.1</option>
                        <option value="X.2">X.2</option>
                        <option value="X.3">X.3</option>
                        <option value="X.4">X.4</option>
                        <option value="XI.1">XI.1</option>
                        <option value="XI.2">XI.2</option>
                        <option value="XI.3">XI.3</option>
                        <option value="XI.4">XI.4</option>
                        <option value="XII.4">XII.1</option>
                        <option value="XII.2">XII.2</option>
                        <option value="XII.3">XII.3</option>
                        <option value="XII.4">XII.4</option>
                    </select>
                </div>

                <!-- Tombol Aksi -->
                <div class="flex justify-end gap-2.5 pt-4 border-t border-gray-50">
                    <button type="button" @click="openTambah = false" class="px-4 py-2.5 border border-gray-200 text-gray-600 rounded-xl hover:bg-gray-50 text-xs font-bold transition uppercase tracking-wider">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 text-xs font-bold transition shadow-sm shadow-blue-500/20 uppercase tracking-wider">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
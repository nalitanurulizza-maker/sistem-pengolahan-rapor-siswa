@extends('layout.admin-app')

@section('content')
<!-- Bungkus seluruh konten dengan x-data Alpine.js -->
<div x-data="{ openTambah: false }">

    <!-- HEADER -->
    <div class="rounded-2xl p-4 text-white shadow-lg mb-6" style="background: linear-gradient(135deg,#1e6fdc,#00d4ff);">
        <div class="flex justify-between items-center">
            <div class="font-semibold">
                E-RAPOR SMA | <span class="opacity-80">2026/2027</span>
            </div>
            <div class="bg-white/20 px-4 py-1 rounded-full flex items-center gap-2">
                <i class="fa-solid fa-user"></i>
                <span>Admin</span>
            </div>
        </div>
    </div>

    <div class="p-6">
        <h2 class="text-xl font-bold mb-4">DATA SISWA</h2>

        <!-- Button Tambah: Gunakan @click milik Alpine.js -->
        <div class="flex justify-end mb-3">
            <button @click="openTambah = true" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition">
                + Tambah Data Siswa
            </button>
        </div>

        <!-- Table -->
        <div class="bg-white rounded shadow p-4 overflow-x-auto">
            <table class="w-full border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-2 text-left">No</th>
                        <th class="border p-2 text-left">Nama Siswa</th>
                        <th class="border p-2 text-left">NIS</th>
                        <th class="border p-2 text-left">NISN</th>
                        <th class="border p-2 text-center">JK</th>
                        <th class="border p-2 text-center">Tingkat</th>
                        <th class="border p-2 text-left">Kelas</th>
                        <th class="border p-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="hover:bg-gray-50">
                        <td class="border p-2 text-center">1</td>
                        <td class="border p-2">Contoh Siswa</td>
                        <td class="border p-2">12345</td>
                        <td class="border p-2">67890</td>
                        <td class="border p-2 text-center">L</td>
                        <td class="border p-2 text-center">10</td>
                        <td class="border p-2">IPA 1</td>
                        <td class="border p-2 text-center">
                            <button class="text-blue-500 hover:underline">Ubah</button>
                            <button class="text-red-500 hover:underline ml-2">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL TAMBAH DATA SISWA -->
<div x-show="openTambah" 
     x-transition.opacity
     class="fixed inset-0 z-[100] overflow-y-auto" x-cloak>
    
    <!-- Overlay Backdrop -->
    <div class="fixed inset-0 bg-black/50" @click="openTambah = false"></div>
    
    <!-- Modal Content -->
    <div class="flex min-h-full items-center justify-center p-4">
        <div class="relative transform overflow-hidden rounded-2xl bg-white shadow-2xl transition-all sm:w-full sm:max-w-lg">
            <div class="p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-6 border-b pb-2">Tambah Data Siswa</h3>
                
                <form action="#" method="POST" class="space-y-4">
                    @csrf
                    
                    <!-- Nama Siswa -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Siswa</label>
                        <input type="text" name="nama_siswa" required 
                               class="mt-1 block w-full rounded-lg border border-gray-300 p-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <!-- NISN -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">NISN</label>
                            <input type="text" name="nisn" required 
                                   class="mt-1 block w-full rounded-lg border border-gray-300 p-2 shadow-sm">
                        </div>
                        <!-- NIS -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">NIS</label>
                            <input type="text" name="nis" required 
                                   class="mt-1 block w-full rounded-lg border border-gray-300 p-2 shadow-sm">
                        </div>
                    </div>

                    <!-- Jenis Kelamin -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700">JK (Jenis Kelamin)</label>
                        <select name="jk" required 
                                class="mt-1 block w-full rounded-lg border border-gray-300 p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">-- Pilih JK --</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <!-- Tingkat -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tingkat</label>
                            <select name="tingkat" required 
                                    class="mt-1 block w-full rounded-lg border border-gray-300 p-2 shadow-sm">
                                <option value="">-- Pilih --</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                            </select>
                        </div>
                        <!-- Kelas -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kelas</label>
                            <input type="text" name="kelas" placeholder="Contoh: IPA 1" required 
                                   class="mt-1 block w-full rounded-lg border border-gray-300 p-2 shadow-sm">
                        </div>
                    </div>

                    <!-- Action Buttons -->
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
{{-- Hapus script JavaScript manual karena sudah menggunakan Alpine.js --}}
@endsection
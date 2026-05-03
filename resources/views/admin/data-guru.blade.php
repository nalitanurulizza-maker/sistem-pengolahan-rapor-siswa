@extends('layout.admin-app')

@section('title', 'Data Guru | e-Rapor')

@section('content')
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
        <h2 class="text-xl font-bold mb-4 uppercase tracking-wider text-gray-700">Data Guru</h2>

        <!-- Button Tambah -->
        <div class="flex justify-end mb-3">
            <button @click="openTambah = true" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded shadow transition flex items-center gap-2">
                <span>Tambah Data Guru</span>
                <i class="fa-solid fa-plus text-xs"></i>
            </button>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-xl shadow-md p-4 overflow-x-auto">
            <table class="w-full border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border p-3 text-left text-sm font-bold text-gray-600">No</th>
                        <th class="border p-3 text-left text-sm font-bold text-gray-600">Nama Guru</th>
                        <th class="border p-3 text-left text-sm font-bold text-gray-600">NIP</th>
                        <th class="border p-3 text-left text-sm font-bold text-gray-600">Alamat</th>
                        <th class="border p-3 text-left text-sm font-bold text-gray-600">No Tlp</th>
                        <th class="border p-3 text-left text-sm font-bold text-gray-600">Tgl Lahir</th>
                        <th class="border p-3 text-center text-sm font-bold text-gray-600">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600">
                    <tr class="hover:bg-gray-50 transition">
                        <td class="border p-3 text-center">1</td>
                        <td class="border p-3">Nama Guru Contoh</td>
                        <td class="border p-3">198701012010011001</td>
                        <td class="border p-3">Batam Center</td>
                        <td class="border p-3">08123456789</td>
                        <td class="border p-3">01-01-1987</td>
                        <td class="border p-3 text-center">
                            <button class="text-blue-500 hover:text-blue-700 font-semibold mx-1">Ubah</button>
                            <button class="text-red-500 hover:text-red-700 font-semibold mx-1">Hapus</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- MODAL TAMBAH DATA GURU -->
    <div x-show="openTambah" 
         x-transition.opacity
         class="fixed inset-0 z-[100] overflow-y-auto" x-cloak>
        
        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="openTambah = false"></div>
        
        <!-- Modal Panel -->
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative transform overflow-hidden rounded-2xl bg-white shadow-2xl transition-all sm:w-full sm:max-w-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6 border-b pb-2">
                        <h3 class="text-xl font-bold text-gray-900">Tambah Data Guru</h3>
                        <button @click="openTambah = false" class="text-gray-400 hover:text-gray-600">
                            <i class="fa-solid fa-xmark text-lg"></i>
                        </button>
                    </div>
                    
                    <form action="#" method="POST" class="space-y-4">
                        @csrf
                        
                        <!-- Nama Guru -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Guru</label>
                            <input type="text" name="nama_guru" required 
                                   class="block w-full rounded-lg border border-gray-300 p-2.5 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition">
                        </div>

                        <!-- NIP -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">NIP</label>
                            <input type="text" name="nip" required 
                                   class="block w-full rounded-lg border border-gray-300 p-2.5 shadow-sm focus:ring-blue-500 focus:border-blue-500 transition">
                        </div>

                        <!-- Alamat -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                            <input type="text" name="alamat" required 
                                   class="block w-full rounded-lg border border-gray-300 p-2.5 shadow-sm focus:ring-blue-500 focus:border-blue-500 transition">
                        </div>

                        <!-- No Tlp -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">No Tlp</label>
                            <input type="text" name="no_tlp" required 
                                   class="block w-full rounded-lg border border-gray-300 p-2.5 shadow-sm focus:ring-blue-500 focus:border-blue-500 transition">
                        </div>

                        <!-- Tgl Lahir -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tgl Lahir</label>
                            <input type="date" name="tgl_lahir" required 
                                   class="block w-full rounded-lg border border-gray-300 p-2.5 shadow-sm focus:ring-blue-500 focus:border-blue-500 transition">
                        </div>

                        <!-- Buttons -->
                        <div class="mt-8 flex justify-center gap-4">
                            <button @click="openTambah = false" type="button" 
                                    class="px-8 py-2 text-sm font-bold text-gray-700 bg-white border border-gray-300 rounded-full hover:bg-gray-50 transition shadow-sm">
                                Batal
                            </button>
                            <button type="submit" 
                                    class="px-8 py-2 text-sm font-bold text-white bg-blue-600 border border-blue-600 rounded-full hover:bg-blue-700 shadow-md transition">
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
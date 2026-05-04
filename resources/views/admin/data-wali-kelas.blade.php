@extends('layout.admin-app')

@section('title', 'Data Wali Kelas')

@section('content')

<div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100 min-h-[500px]">
    <!-- TITLE & BUTTON TAMBAH -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-bold text-gray-800 uppercase tracking-tight">Data Wali Kelas</h2>
        <button onclick="toggleModal('modal-tambah')" class="bg-[#2563eb] hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-2 transition shadow-lg shadow-blue-200">
            Tambah Data Wali Kelas <i class="fa-solid fa-plus text-xs"></i>
        </button>
    </div>

    <!-- TABLE AREA -->
    <div class="overflow-x-auto border rounded-xl">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 border-b text-gray-700 font-bold text-center">
                <tr>
                    <th class="px-4 py-4 w-16">No</th>
                    <th class="px-4 py-4 text-left">Nama Guru</th>
                    <th class="px-4 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                <!-- Contoh Baris Data -->
                <tr class="hover:bg-gray-50 transition text-center">
                    <td class="px-4 py-4 text-gray-500">1</td>
                    <td class="px-4 py-4 text-left font-medium text-gray-800">Nama Guru Contoh</td>
                    <td class="px-4 py-4">
                        <div class="flex justify-center gap-4">
                            <a href="#" class="text-blue-600 hover:underline font-semibold">Ubah</a>
                            <a href="#" class="text-red-500 hover:underline font-semibold">Hapus</a>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- PAGINATION (Sesuai Wireframe) -->
    <div class="flex justify-end mt-6">
        <div class="inline-flex rounded-md shadow-sm border overflow-hidden">
            <button class="px-3 py-1 border-r hover:bg-gray-50 text-gray-400">&lt;&lt;</button>
            <button class="px-3 py-1 border-r bg-blue-50 text-blue-600 font-bold">1</button>
            <button class="px-3 py-1 hover:bg-gray-50 text-gray-400">&gt;&gt;</button>
        </div>
    </div>
</div>

<!-- MODAL TAMBAH DATA (Sesuai Wireframe Gambar 2) -->
<div id="modal-tambah" class="hidden fixed inset-0 z-50 overflow-auto bg-black/50 flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl animate-in fade-in zoom-in duration-200">
        <!-- Modal Header -->
        <div class="flex items-center justify-between p-6 border-b">
            <h3 class="text-xl font-bold text-gray-800">Tambah Data Wali Kelas</h3>
            <button onclick="toggleModal('modal-tambah')" class="text-gray-400 hover:text-gray-600">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>
        
        <!-- Modal Body -->
        <form action="#" method="POST" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Guru</label>
                <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition" placeholder="Masukkan nama guru...">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">NIP</label>
                <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition" placeholder="Masukkan NIP...">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Kelas</label>
                <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none transition" placeholder="Contoh: X IPA 1">
            </div>

            <!-- Modal Footer -->
            <div class="flex justify-end gap-3 pt-6">
                <button type="button" onclick="toggleModal('modal-tambah')" class="px-6 py-2 border rounded-full text-gray-600 hover:bg-gray-50 font-semibold transition">Batal</button>
                <button type="submit" class="px-6 py-2 bg-gray-100 border border-gray-300 rounded-full text-gray-800 font-semibold hover:bg-gray-200 transition shadow-sm">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleModal(id) {
        const modal = document.getElementById(id);
        modal.classList.toggle('hidden');
    }
</script>

@endsection
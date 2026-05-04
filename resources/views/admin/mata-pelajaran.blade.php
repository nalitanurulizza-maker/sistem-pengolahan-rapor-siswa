@extends('layout.admin-app')

@section('title', 'Data Mata Pelajaran')

@section('content')
<div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-bold text-gray-800 uppercase tracking-tight">Data Mata Pelajaran</h2>
        <!-- Tombol Pemicu Modal -->
        <button type="button" onclick="toggleModal('modal-mapel')" class="bg-[#2563eb] hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-2 transition shadow-lg shadow-blue-200">
            Tambah Mata Pelajaran <i class="fa-solid fa-plus text-xs"></i>
        </button>
    </div>

    <div class="overflow-x-auto border rounded-xl">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 border-b text-gray-700 font-bold text-center">
                <tr>
                    <th class="px-4 py-4 w-16">No</th>
                    <th class="px-4 py-4 text-left">Kode Mapel</th>
                    <th class="px-4 py-4 text-left">Nama Mata Pelajaran</th>
                    <th class="px-4 py-4">Kelompok</th>
                    <th class="px-4 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y text-center">
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-4 text-gray-500">1</td>
                    <td class="px-4 py-4 text-left font-mono text-blue-600">MP001</td>
                    <td class="px-4 py-4 text-left font-medium text-gray-800">Matematika (Wajib)</td>
                    <td class="px-4 py-4"><span class="px-2 py-1 bg-green-100 text-green-700 rounded-md text-xs font-bold">Kelompok A</span></td>
                    <td class="px-4 py-4">
                        <div class="flex justify-center gap-4">
                            <button class="text-blue-600 hover:underline font-semibold">Ubah</button>
                            <button class="text-red-500 hover:underline font-semibold">Hapus</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL TAMBAH MAPEL -->
<div id="modal-mapel" class="hidden fixed inset-0 z-50 overflow-auto bg-black/40 flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white w-full max-w-lg rounded-2xl shadow-2xl">
        <div class="flex items-center justify-between p-6 border-b">
            <h3 class="text-xl font-bold text-gray-800">Tambah Mata Pelajaran</h3>
            <button type="button" onclick="toggleModal('modal-mapel')" class="text-gray-400 hover:text-gray-600">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>
        <form action="#" class="p-6 space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Kode Mapel</label>
                <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Contoh: MTK-01">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Mata Pelajaran</label>
                <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Kelompok</label>
                <select class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none bg-white">
                    <option>Kelompok A (Wajib)</option>
                    <option>Kelompok B (Wajib)</option>
                    <option>Kelompok C (Peminatan)</option>
                </select>
            </div>
            <div class="flex justify-end gap-3 pt-6">
                <button type="button" onclick="toggleModal('modal-mapel')" class="px-6 py-2 border rounded-full text-gray-600 font-semibold hover:bg-gray-50 transition">Batal</button>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-full font-semibold hover:bg-blue-700 transition shadow-md">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

<!-- JAVASCRIPT UNTUK MODAL -->
<script>
    function toggleModal(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.toggle('hidden');
        }
    }

    // Opsional: Menutup modal jika user klik di luar kotak modal
    window.onclick = function(event) {
        const modal = document.getElementById('modal-mapel');
        if (event.target == modal) {
            modal.classList.add('hidden');
        }
    }
</script>

@endsection
@extends('layout.admin-app')

@section('title', 'Tahun Akademik')

@section('content')

<div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg font-bold text-gray-800 uppercase tracking-tight">Data Tahun Akademik</h2>
        <button onclick="toggleModal('modal-tahun')" class="bg-[#2563eb] hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold flex items-center gap-2 transition shadow-lg shadow-blue-200">
            Tambah Tahun Akademik <i class="fa-solid fa-plus text-xs"></i>
        </button>
    </div>

    <div class="overflow-x-auto border rounded-xl">
        <table class="w-full text-sm text-left">
            <thead class="bg-gray-50 border-b text-gray-700 font-bold text-center">
                <tr>
                    <th class="px-4 py-4 w-16">No</th>
                    <th class="px-4 py-4">Tahun Akademik</th>
                    <th class="px-4 py-4">Semester</th>
                    <th class="px-4 py-4">Status</th>
                    <th class="px-4 py-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y text-center">
                <tr class="bg-blue-50/50">
                    <td class="px-4 py-4 text-gray-500">1</td>
                    <td class="px-4 py-4 font-bold text-gray-800">2026/2027</td>
                    <td class="px-4 py-4">Ganjil</td>
                    <td class="px-4 py-4">
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-blue-600 text-white text-[10px] font-black uppercase tracking-widest">
                            <span class="w-1.5 h-1.5 bg-white rounded-full animate-pulse"></span> Aktif
                        </span>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex justify-center gap-4">
                            <button class="text-gray-400 cursor-not-allowed font-semibold" disabled>Aktifkan</button>
                            <button class="text-red-500 hover:underline font-semibold">Hapus</button>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="px-4 py-4 text-gray-500">2</td>
                    <td class="px-4 py-4 text-gray-800">2025/2026</td>
                    <td class="px-4 py-4">Genap</td>
                    <td class="px-4 py-4">
                        <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-500 text-[10px] font-bold uppercase">Tidak Aktif</span>
                    </td>
                    <td class="px-4 py-4">
                        <div class="flex justify-center gap-4">
                            <button class="text-blue-600 hover:underline font-semibold font-bold">Aktifkan</button>
                            <button class="text-red-500 hover:underline font-semibold">Hapus</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL TAMBAH TAHUN -->
<div id="modal-tahun" class="hidden fixed inset-0 z-50 overflow-auto bg-black/50 flex items-center justify-center p-4 backdrop-blur-sm">
    <div class="bg-white w-full max-w-md rounded-2xl shadow-2xl">
        <div class="flex items-center justify-between p-6 border-b">
            <h3 class="text-xl font-bold text-gray-800">Tahun Akademik Baru</h3>
            <button onclick="toggleModal('modal-tahun')" class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-xmark text-xl"></i></button>
        </div>
        <form action="#" class="p-6 space-y-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Tahun Pelajaran</label>
                <input type="text" class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none" placeholder="Contoh: 2027/2028">
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Semester</label>
                <div class="flex gap-4 mt-2">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="semester" class="text-blue-600"> <span class="text-sm">Ganjil</span>
                    </label>
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="radio" name="semester" class="text-blue-600"> <span class="text-sm">Genap</span>
                    </label>
                </div>
            </div>
            <div class="flex justify-end gap-3 pt-6 border-t mt-6">
                <button type="button" onclick="toggleModal('modal-tahun')" class="px-6 py-2 text-gray-500 font-semibold">Batal</button>
                <button type="submit" class="px-8 py-2 bg-gray-900 text-white rounded-xl font-bold hover:bg-black transition shadow-lg">Simpan Periode</button>
            </div>
        </form>
    </div>
</div>

<script>
    function toggleModal(id) {
        document.getElementById(id).classList.toggle('hidden');
    }
</script>
@endsection
@extends('layout.app')

@section('content')

<div class="p-6">
    <h2 class="text-xl font-bold mb-4">DATA SISWA</h2>

    <!-- Button Tambah -->
    <div class="flex justify-end mb-3">
        <button onclick="openModal()" class="bg-gray-300 px-4 py-2 rounded">
            + Tambah Data Siswa
        </button>
    </div>

    <!-- Table -->
    <div class="bg-white rounded shadow p-4">
        <table class="w-full border">
            <thead class="bg-gray-200">
                <tr>
                    <th class="border p-2">No</th>
                    <th class="border p-2">Nama Siswa</th>
                    <th class="border p-2">NIS</th>
                    <th class="border p-2">NISN</th>
                    <th class="border p-2">JK</th>
                    <th class="border p-2">Tingkat</th>
                    <th class="border p-2">Kelas</th>
                    <th class="border p-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="border p-2 text-center">1</td>
                    <td class="border p-2">Contoh Siswa</td>
                    <td class="border p-2">12345</td>
                    <td class="border p-2">67890</td>
                    <td class="border p-2">L</td>
                    <td class="border p-2">10</td>
                    <td class="border p-2">IPA 1</td>
                    <td class="border p-2 text-center">
                        <button class="text-blue-500">Ubah</button>
                        <button class="text-red-500 ml-2">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL -->
<div id="modal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center">
    <div class="bg-white p-6 rounded w-96">
        <h3 class="text-lg font-bold mb-4">Tambah Data Siswa</h3>

        <form action="#" method="POST">
            @csrf

            <input type="text" name="nama" placeholder="Nama Siswa" class="w-full border p-2 mb-2">
            <input type="text" name="nis" placeholder="NIS" class="w-full border p-2 mb-2">
            <input type="text" name="nisn" placeholder="NISN" class="w-full border p-2 mb-2">

            <select name="jk" class="w-full border p-2 mb-2">
                <option value="">Pilih Jenis Kelamin</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>

            <input type="text" name="tingkat" placeholder="Tingkat" class="w-full border p-2 mb-2">
            <input type="text" name="kelas" placeholder="Kelas" class="w-full border p-2 mb-4">

            <div class="flex justify-end">
                <button type="button" onclick="closeModal()" class="mr-2 px-3 py-1 bg-gray-400 rounded">Batal</button>
                <button type="submit" class="px-3 py-1 bg-blue-500 text-white rounded">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
function openModal() {
    document.getElementById('modal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('modal').classList.add('hidden');
}
</script>

@endsection
@extends('layout.walas-app')

@section('title', 'Input Predikat Nilai | E-Rapor')

@section('content')

<!-- JUDUL DI TENGAH (LUAR KOTAK) -->
<div class="text-center mb-6 mt-4">
    <h6 class="font-bold text-lg text-gray-800 uppercase tracking-wide">
        Input Predikat Nilai Siswa
    </h6>
</div>

<!-- KOTAK PUTIH UTAMA -->
<div class="bg-white p-8 rounded-t-3xl shadow-sm border border-gray-100 mt-6 min-h-[calc(100vh-180px)] flex flex-col">

    <!-- FORM FILTER - UKURAN DISAMAKAN PERSIS DENGAN KODE GURU -->
    <div class="w-full space-y-4 mb-10">
        <!-- KELAS -->
        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/4 font-semibold text-gray-700 text-sm">Pilih Kelas</label>
            <div class="md:w-3/4 relative">
                <select name="kelas" class="w-full appearance-none bg-gray-100 border border-transparent rounded-xl px-4 py-3 pr-10 outline-none focus:bg-white focus:ring-2 focus:ring-blue-500 transition-all text-sm cursor-pointer">
                    <option value="" selected disabled></option>
                    <option value="X-MIPA-1">X MIPA 1</option>
                    <option value="XI-IPS-2">XI IPS 2</option>
                </select>
                <i class="fa-solid fa-caret-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none"></i>
            </div>
        </div>

        <!-- SEMESTER -->
        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/4 font-semibold text-gray-700 text-sm">Pilih Semester</label>
            <div class="md:w-3/4 relative">
                <select name="semester" class="w-full appearance-none bg-gray-100 border border-transparent rounded-xl px-4 py-3 pr-10 outline-none focus:bg-white focus:ring-2 focus:ring-blue-500 transition-all text-sm cursor-pointer">
                    <option value="" selected disabled></option>
                    <option value="1">Semester Ganjil</option>
                    <option value="2">Semester Genap</option>
                </select>
                <i class="fa-solid fa-caret-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none"></i>
            </div>
        </div>

        <!-- MATA PELAJARAN -->
        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/4 font-semibold text-gray-700 text-sm">Pilih Mata Pelajaran</label>
            <div class="md:w-3/4 relative">
                <select name="mapel" class="w-full appearance-none bg-gray-100 border border-transparent rounded-xl px-4 py-3 pr-10 outline-none focus:bg-white focus:ring-2 focus:ring-blue-500 transition-all text-sm cursor-pointer">
                    <option value="" selected disabled></option>
                    <option value="matematika">Matematika</option>
                    <option value="b-indo">Bahasa Indonesia</option>
                </select>
                <i class="fa-solid fa-caret-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none"></i>
            </div>
        </div>

        <!-- NILAI -->
        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/4 font-semibold text-gray-700 text-sm">Pilih Nilai</label>
            <div class="md:w-3/4 relative">
                <select name="jenis_nilai" class="w-full appearance-none bg-gray-100 border border-transparent rounded-xl px-4 py-3 pr-10 outline-none focus:bg-white focus:ring-2 focus:ring-blue-500 transition-all text-sm cursor-pointer">
                    <option value="" selected disabled></option>
                    <option value="kognitif">Kognitif</option>
                    <option value="psikomotor">Psikomotor</option>
                </select>
                <i class="fa-solid fa-caret-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none"></i>
            </div>
        </div>
    </div>

    <!-- TABEL DATA SISWA - STRUKTUR & STYLE DISAMAKAN DENGAN KODE GURU -->
    <div class="overflow-x-auto border rounded-lg shadow-sm">
        <table class="w-full text-sm text-left border-collapse">
            <thead class="bg-gray-50 text-gray-700 font-bold border-b text-xs uppercase">
                <tr>
                    <th class="px-4 py-3 border-r w-12 text-center">No</th>
                    <th class="px-4 py-3 border-r">Nama Siswa</th>
                    <th class="px-4 py-3 border-r text-center">NISN</th>
                    <th class="px-4 py-3 border-r text-center">NIS</th>
                    <th class="px-4 py-3 border-r text-center">Nilai</th>
                    <th class="px-4 py-3 border-r text-center">Predikat</th>
                    <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y text-gray-600">
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-4 py-3 border-r text-center">1</td>
                    <td class="px-4 py-3 border-r uppercase">Nama Siswa Contoh</td>
                    <td class="px-4 py-3 border-r text-center">008234123</td>
                    <td class="px-4 py-3 border-r text-center">12345</td>
                    <td class="px-4 py-3 border-r text-center">-</td>
                    <td class="px-4 py-3 border-r text-center">-</td>
                    <td class="px-4 py-3">
                        <div class="flex justify-center gap-6">
                            <button class="text-blue-600 hover:underline font-semibold">Ubah</button>
                            <button class="text-red-500 hover:underline font-semibold">Hapus</button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- PAGINATION - DISAMAKAN UKURAN & POSISI POJOK KANAN -->
    <div class="mt-auto pt-10 flex justify-end">
        <div class="flex border border-gray-300 rounded-md overflow-hidden bg-gray-50 text-[10px] shadow-sm">
            <button class="px-2.5 py-1 border-r border-gray-300 hover:bg-gray-200 transition text-gray-500 font-bold">
                <<
            </button>
            <div class="px-3.5 py-1 bg-white border-r border-gray-300 text-blue-600 font-bold">
                1
            </div>
            <button class="px-2.5 py-1 hover:bg-gray-200 transition text-gray-500 font-bold">
                >>
            </button>
        </div>
    </div>

</div>

@endsection
@extends('layout.admin-app')

@section('content')
<div x-data="{ openTambah: false }">

    <div class="p-4 sm:p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">DATA SISWA</h2>

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">

            <div class="flex items-center gap-2">
                <span class="text-xs font-bold text-gray-500 uppercase whitespace-nowrap">
                    PILIH KELAS:
                </span>

                <form method="GET" action="{{ url()->current() }}">
                    <select name="kelas" onchange="this.form.submit()" 
                        class="bg-white border border-gray-200 text-gray-700 text-sm rounded-xl px-3 py-2 w-full sm:w-44 
                        shadow-sm focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                        
                        <option value="">Semua Kelas</option>
                        @foreach ($data_kelas as $kelas)
                            <option value="{{ $kelas->kode_kelas }}" {{ request('kelas') == $kelas->kode_kelas ? 'selected' : '' }}>
                                {{ $kelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <button @click="openTambah = true" 
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl shadow text-sm font-semibold transition">
                + Tambah Data Siswa
            </button>

        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-2 sm:p-4 w-full">
            <table class="w-full table-fixed text-sm">
                <thead class="bg-gray-50 text-gray-600 border-b border-gray-100">
                    <tr>
                        <th class="p-3 text-center w-[6%]">No</th>
                        <th class="p-3 text-left w-[26%]">Siswa (NIS)</th>
                        <th class="p-3 text-center w-[12%]">L/P</th>
                        <th class="p-3 text-left w-[15%] lg:table-cell hidden">Tgl Lahir</th>
                        <th class="p-3 text-left w-[20%] md:table-cell hidden">Alamat</th>
                        <th class="p-3 text-left w-[23%] sm:table-cell hidden">Wali Murid</th>
                        <th class="p-3 text-center w-[10%]">Kelas</th>
                        <th class="p-3 text-center w-[8%]">Aksi</th>
                    </tr>
                </thead>

                <tbody class="text-gray-700 divide-y divide-gray-50">
                    @forelse($data_siswa as $key => $siswa)
                        <tr class="hover:bg-gray-50/70 transition">
                            <td class="p-3 text-center">
                                {{ $data_siswa->firstItem() + $key }}
                            </td>

                            <td class="p-3">
                                <span class="block font-semibold text-gray-900 truncate">
                                    {{ $siswa->nama_siswa }}
                                </span>
                                <span class="block text-xs font-mono text-blue-600">
                                    {{ $siswa->nis }}
                                </span>
                            </td>

                            <td class="p-3 text-center">
                                <span class="sm:inline hidden">
                                    {{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}
                                </span>
                                <span class="sm:hidden inline">
                                    {{ $siswa->jenis_kelamin }}
                                </span>
                            </td>

                            <td class="p-3 lg:table-cell hidden text-gray-600">
                                {{ $siswa->tgl_lahir }}
                            </td>

                            <td class="p-3 md:table-cell hidden text-gray-500 truncate">
                                {{ $siswa->alamat }}
                            </td>

                            <td class="p-3 sm:table-cell hidden">
                                <span class="block font-medium text-gray-800 truncate">
                                    {{ $siswa->wali_murid }}
                                </span>
                                <span class="block text-xs text-gray-500">
                                    {{ $siswa->no_telp_wali }}
                                </span>
                            </td>

                            <td class="p-3 text-center">
                                <span class="bg-blue-50 text-blue-600 px-2 py-0.5 rounded-md text-xs font-semibold">
                                    {{ $siswa->kelas->nama_kelas ?? 'Tanpa Kelas' }}
                                </span>
                            </td>

                            <td class="p-3 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <button class="w-7 h-7 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition">
                                        <i class="fa-solid fa-pen text-xs"></i>
                                    </button>
                                    <button class="w-7 h-7 rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-8 text-center text-gray-400 italic">
                                Belum ada data siswa.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4 px-3">
                {{ $data_siswa->links() }}
            </div>
        </div>
    </div>

    <div x-show="openTambah" x-transition.opacity class="fixed inset-0 z-[100] overflow-y-auto" x-cloak>
        <div class="fixed inset-0 bg-black/50" @click="openTambah = false"></div>
        
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative transform overflow-hidden rounded-2xl bg-white shadow-2xl transition-all sm:w-full sm:max-w-xl">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 border-b pb-2">Tambah Data Siswa</h3>
                    
                    <form action="{{ route('admin.data-siswa') }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">NIS</label>
                                <input type="text" name="nis" required class="mt-1 block w-full rounded-lg border border-gray-300 p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Siswa</label>
                                <input type="text" name="nama_siswa" required class="mt-1 block w-full rounded-lg border border-gray-300 p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                <select name="jenis_kelamin" required class="mt-1 block w-full rounded-lg border border-gray-300 p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" required class="mt-1 block w-full rounded-lg border border-gray-300 p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">No. Telepon Siswa</label>
                                <input type="text" name="no_telp" class="mt-1 block w-full rounded-lg border border-gray-300 p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Kelas</label>
                                <select name="kode_kelas" required class="mt-1 block w-full rounded-lg border border-gray-300 p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                                    <option value="">-- Pilih Kelas --</option>
                                    @foreach ($data_kelas as $kelas)
                                        <option value="{{ $kelas->kode_kelas }}">{{ $kelas->nama_kelas }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Alamat</label>
                            <textarea name="alamat" rows="2" required class="mt-1 block w-full rounded-lg border border-gray-300 p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"></textarea>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 space-y-3">
                            <span class="block text-sm font-bold text-gray-800">Data Wali Murid</span>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-medium text-gray-600">Nama Wali</label>
                                    <input type="text" name="nama_wali" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                                </div>
                                <div>
                                    <label class="block text-xs font-medium text-gray-600">No. Telp Wali</label>
                                    <input type="text" name="no_telp_wali" class="mt-1 block w-full rounded-lg border border-gray-300 bg-white p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                                </div>
                            </div>
                        </div>

                        <div class="mt-8 flex justify-end gap-3">
                            <button @click="openTambah = false" type="button" class="px-5 py-2 text-sm font-semibold text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                                Batal
                            </button>
                            <button type="submit" class="px-5 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-md transition">
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
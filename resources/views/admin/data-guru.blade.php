@extends('layout.admin-app')

@section('content')
<div x-data="{ openTambah: false, openEdit: false }" 
     x-init="@if(request()->has('edit_nip')) openEdit = true @endif">

    <div class="p-4 sm:p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">DATA GURU</h2>

        @if(session('success'))
            <div class="mb-4 p-3 bg-emerald-50 text-emerald-700 rounded-xl border border-emerald-200 text-sm font-semibold">
                {{ session('success') }}
            </div>
        @endif

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
                    @forelse($data_guru as $index => $guru)
                    <tr class="hover:bg-gray-50/70 transition">
                        <td class="p-3 text-center">{{ $index + 1 }}</td>
                        
                        <td class="p-3">
                            <span class="block font-semibold text-gray-900 truncate">{{ $guru->nama_guru }}</span>
                            <span class="block text-xs font-mono text-blue-600">{{ $guru->nip }}</span>
                            <span class="block text-[11px] text-gray-400 sm:hidden">{{ $guru->no_telp }}</span>
                        </td>
                        
                        <td class="p-3 text-center">
                            <span class="sm:inline hidden">{{ $guru->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                            <span class="sm:hidden inline">{{ $guru->jenis_kelamin }}</span>
                        </td>
                        
                        <td class="p-3 lg:table-cell hidden text-gray-600">{{ $guru->tgl_lahir ?? '-' }}</td>
                        
                        <td class="p-3 md:table-cell hidden text-gray-500">
                            <span class="block truncate" title="{{ $guru->alamat }}">{{ $guru->alamat ?? '-' }}</span>
                            <span class="block text-xs text-gray-400">Hub: {{ $guru->no_telp ?? '-' }}</span>
                        </td>
                        
                        <td class="p-3 text-center sm:table-cell hidden">
                            <span class="bg-emerald-50 text-emerald-600 px-2.5 py-0.5 rounded-md text-xs font-semibold whitespace-nowrap">
                                {{ $guru->role == 'Walas' ? 'Wali Kelas' : 'Guru Mapel' }}
                            </span>
                        </td>
                        
                        <td class="p-3 text-center">
                            <div class="flex items-center justify-center gap-1.5">
                                <a href="{{ route('admin.data-guru', ['edit_nip' => $guru->nip]) }}" title="Ubah Data" 
                                   class="w-7 h-7 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition">
                                    <i class="fa-solid fa-pen text-xs"></i>
                                </a>

                                <form action="{{ route('admin.guru.destroy', $guru->nip) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus guru ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Hapus Data" class="w-7 h-7 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="p-8 text-center text-gray-400">
                            <i class="fa-solid fa-folder-open text-2xl mb-2 block"></i>
                            Belum ada data guru di dalam database.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div x-show="openTambah" x-transition.opacity class="fixed inset-0 z-[100] overflow-y-auto" x-cloak>
        <div class="fixed inset-0 bg-black/50" @click="openTambah = false"></div>
        
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative transform overflow-hidden rounded-2xl bg-white shadow-2xl transition-all sm:w-full sm:max-w-xl">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 border-b pb-2">Tambah Data Guru</h3>
                    
                    @if ($errors->any())
                        <div class="bg-red-50 text-red-600 p-3 rounded-lg text-xs font-semibold mb-4">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>⚠️ {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ route('admin.guru.store') }}" method="POST" class="space-y-4">
                        @csrf
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">NIP</label>
                                <input type="text" name="nip" required class="mt-1 block w-full rounded-lg border border-gray-300 p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Guru</label>
                                <input type="text" name="nama_guru" required class="mt-1 block w-full rounded-lg border border-gray-300 p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                <select name="jenis_kelamin" required class="mt-1 block w-full rounded-lg border border-gray-300 p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm bg-white">
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
                                <label class="block text-sm font-medium text-gray-700">No. Telepon</label>
                                <input type="text" name="no_telp" required class="mt-1 block w-full rounded-lg border border-gray-300 p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Role / Jabatan</label>
                                <select name="role" required class="mt-1 block w-full rounded-lg border border-gray-300 p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm bg-white">
                                    <option value="">-- Pilih Role --</option>
                                    <option value="Guru">Guru Mata Pelajaran</option>
                                    <option value="Walas">Wali Kelas</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Alamat</label>
                            <textarea name="alamat" rows="3" required class="mt-1 block w-full rounded-lg border border-gray-300 p-2 shadow-sm focus:ring-blue-500 focus:border-blue-500 text-sm"></textarea>
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

    @if($guru_edit)
    <div x-show="openEdit" x-transition.opacity class="fixed inset-0 z-[100] overflow-y-auto" x-cloak>
        <div class="fixed inset-0 bg-black/50" @click="window.location.href='{{ route('admin.data-guru') }}'"></div>
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative transform overflow-hidden rounded-2xl bg-white shadow-2xl transition-all sm:w-full sm:max-w-xl">
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 border-b pb-2">Edit Data Guru</h3>
                    
                    <form action="{{ route('admin.guru.update', $guru_edit->nip) }}" method="POST" class="space-y-4">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">NIP (Kunci)</label>
                                <input type="text" value="{{ $guru_edit->nip }}" disabled class="mt-1 block w-full rounded-lg border border-gray-200 bg-gray-50 p-2 text-sm font-mono">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Nama Guru</label>
                                <input type="text" name="nama_guru" value="{{ $guru_edit->nama_guru }}" required class="mt-1 block w-full rounded-lg border border-gray-300 p-2 text-sm">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                                <select name="jenis_kelamin" required class="mt-1 block w-full rounded-lg border border-gray-300 p-2 text-sm bg-white">
                                    <option value="L" {{ $guru_edit->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="P" {{ $guru_edit->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                                <input type="date" name="tgl_lahir" value="{{ $guru_edit->tgl_lahir }}" required class="mt-1 block w-full rounded-lg border border-gray-300 p-2 text-sm">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">No. Telepon</label>
                                <input type="text" name="no_telp" value="{{ $guru_edit->no_telp }}" required class="mt-1 block w-full rounded-lg border border-gray-300 p-2 text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Role / Jabatan</label>
                                <select name="role" required class="mt-1 block w-full rounded-lg border border-gray-300 p-2 text-sm bg-white">
                                    <option value="Guru" {{ $guru_edit->role == 'Guru' ? 'selected' : '' }}>Guru Mata Pelajaran</option>
                                    <option value="Walas" {{ $guru_edit->role == 'Walas' ? 'selected' : '' }}>Wali Kelas</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Alamat</label>
                            <textarea name="alamat" rows="3" required class="mt-1 block w-full rounded-lg border border-gray-300 p-2 text-sm">{{ $guru_edit->alamat }}</textarea>
                        </div>

                        <div class="mt-8 flex justify-end gap-3">
                            <button type="button" @click="window.location.href='{{ route('admin.data-guru') }}'" class="px-5 py-2 text-sm font-semibold text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                                Batal
                            </button>
                            <button type="submit" class="px-5 py-2 text-sm font-semibold text-white bg-blue-600 rounded-lg hover:bg-blue-700 shadow-md transition">
                                Perbarui
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection
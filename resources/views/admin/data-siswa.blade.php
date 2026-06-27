@extends('layout.admin-app')

@section('content')
<div x-data="{ openTambah: false, openEdit: false }" 
     x-init="@if(request()->has('edit_nis')) openEdit = true @endif">

    <div class="p-4 sm:p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">DATA SISWA</h2>

        @if(session('success'))
            <div class="mb-4 p-3 bg-emerald-50 text-emerald-700 rounded-xl border border-emerald-200 text-sm font-semibold">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
            <div class="flex items-center gap-2">
                <span class="text-xs font-bold text-gray-500 uppercase whitespace-nowrap">PILIH KELAS:</span>
                <form method="GET" action="{{ url()->current() }}">
                    <select name="kelas" onchange="this.form.submit()" 
                        class="bg-white border border-gray-200 text-gray-700 text-sm rounded-xl px-3 py-2 w-full sm:w-44 shadow-sm focus:outline-none">
                        <option value="">Semua Kelas</option>
                        @foreach ($data_kelas as $kelas)
                            <option value="{{ $kelas->kode_kelas }}" {{ request('kelas') == $kelas->kode_kelas ? 'selected' : '' }}>
                                {{ $kelas->nama_kelas }}
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>

            <button @click="openTambah = true" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-xl shadow text-sm font-semibold transition">
                + Tambah Data Siswa
            </button>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-2 sm:p-4 w-full">
            <table class="w-full table-fixed text-sm">
                <thead class="bg-gray-50 text-gray-600 border-b border-gray-100">
                    <tr>
                        <th class="p-3 text-center w-[5%]">No</th>
                        <th class="p-3 text-left w-[25%]">Siswa (NIS / NISN)</th>
                        <th class="p-3 text-center w-[10%]">L/P</th>
                        <th class="p-3 text-left w-[13%] lg:table-cell hidden">Tgl Lahir</th>
                        <th class="p-3 text-left w-[18%] md:table-cell hidden">Alamat</th>
                        <th class="p-3 text-left w-[18%] sm:table-cell hidden">Wali Murid</th>
                        <th class="p-3 text-center w-[8%]">Kelas</th>
                        <th class="p-3 text-center w-[8%]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-50">
                    @forelse($data_siswa as $key => $siswa)
                        <tr class="hover:bg-gray-50/70 transition">
                            <td class="p-3 text-center">{{ $data_siswa->firstItem() + $key }}</td>
                            <td class="p-3">
                                <span class="block font-semibold text-gray-900 truncate">{{ $siswa->nama_siswa }}</span>
                                <span class="block text-xs font-mono text-blue-600">NIS: {{ $siswa->nis }}</span>
                                {{-- NISN ditampilkan jika ada --}}
                                @if($siswa->nisn)
                                    <span class="block text-xs font-mono text-gray-400">NISN: {{ $siswa->nisn }}</span>
                                @endif
                            </td>
                            <td class="p-3 text-center">{{ $siswa->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td class="p-3 lg:table-cell hidden text-gray-600">{{ $siswa->tgl_lahir }}</td>
                            <td class="p-3 md:table-cell hidden text-gray-500 truncate">{{ $siswa->alamat }}</td>
                            <td class="p-3 sm:table-cell hidden">
                                <span class="block font-medium text-gray-800 truncate">{{ $siswa->wali_murid }}</span>
                                <span class="block text-xs text-gray-500">{{ $siswa->no_telp_wali }}</span>
                            </td>
                            <td class="p-3 text-center">
                                <span class="bg-blue-50 text-blue-600 px-2 py-0.5 rounded-md text-xs font-semibold">
                                    {{ $siswa->kelas->nama_kelas ?? 'Tanpa Kelas' }}
                                </span>
                            </td>
                            <td class="p-3 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <a href="{{ route('admin.data-siswa', array_merge(request()->query(), ['edit_nis' => $siswa->nis])) }}" 
                                       class="w-7 h-7 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition">
                                        <i class="fa-solid fa-pen text-xs"></i>
                                    </a>
                                    
                                    <form action="{{ route('admin.siswa.destroy', $siswa->nis) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus siswa ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-7 h-7 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-8 text-center text-gray-400 italic">Belum ada data siswa.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4 px-3">{{ $data_siswa->links() }}</div>
    </div>

    {{-- MODAL TAMBAH --}}
    <div x-show="openTambah" x-transition.opacity class="fixed inset-0 z-[100] overflow-y-auto" x-cloak>
        <div class="fixed inset-0 bg-black/50" @click="openTambah = false"></div>
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative rounded-2xl bg-white shadow-2xl sm:w-full sm:max-w-xl p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-6 border-b pb-2">Tambah Data Siswa</h3>
                
                <form action="{{ route('admin.siswa.store') }}" method="POST" class="space-y-4">
                    @csrf

                    {{-- NIS + NISN --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">NIS</label>
                            <input type="text" name="nis" required
                                   class="mt-1 block w-full rounded-lg border border-gray-300 p-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                NISN
                                <span class="text-xs text-gray-400 font-normal">(opsional)</span>
                            </label>
                            <input type="text" name="nisn" maxlength="20"
                                   class="mt-1 block w-full rounded-lg border border-gray-300 p-2 text-sm"
                                   placeholder="10 digit NISN">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Siswa</label>
                        <input type="text" name="nama_siswa" required
                               class="mt-1 block w-full rounded-lg border border-gray-300 p-2 text-sm">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                            <select name="jenis_kelamin" required class="mt-1 block w-full rounded-lg border border-gray-300 p-2 text-sm bg-white">
                                <option value="">-- Pilih --</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" required
                                   class="mt-1 block w-full rounded-lg border border-gray-300 p-2 text-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">No. Telepon Siswa</label>
                            <input type="text" name="no_telp"
                                   class="mt-1 block w-full rounded-lg border border-gray-300 p-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kelas</label>
                            <select name="kode_kelas" required class="mt-1 block w-full rounded-lg border border-gray-300 p-2 text-sm bg-white">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach ($data_kelas as $kelas)
                                    <option value="{{ $kelas->kode_kelas }}">{{ $kelas->nama_kelas }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="alamat" rows="2" required
                                  class="mt-1 block w-full rounded-lg border border-gray-300 p-2 text-sm"></textarea>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 space-y-3">
                        <span class="block text-sm font-bold text-gray-800">Data Wali Murid</span>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-600">Nama Wali</label>
                                <input type="text" name="nama_wali"
                                       class="mt-1 block w-full rounded-lg border border-gray-300 p-2 text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600">No. Telp Wali</label>
                                <input type="text" name="no_telp_wali"
                                       class="mt-1 block w-full rounded-lg border border-gray-300 p-2 text-sm">
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end gap-3">
                        <button @click="openTambah = false" type="button"
                                class="px-5 py-2 text-sm text-gray-700 bg-gray-100 rounded-lg">Batal</button>
                        <button type="submit"
                                class="px-5 py-2 text-sm text-white bg-blue-600 rounded-lg shadow-md font-semibold">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- MODAL EDIT --}}
    @if($siswa_edit)
    <div x-show="openEdit" x-transition.opacity class="fixed inset-0 z-[100] overflow-y-auto" x-cloak>
        <div class="fixed inset-0 bg-black/50" @click="window.location.href='{{ route('admin.data-siswa', request()->except('edit_nis')) }}'"></div>
        <div class="flex min-h-full items-center justify-center p-4">
            <div class="relative rounded-2xl bg-white shadow-2xl sm:w-full sm:max-w-xl p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-6 border-b pb-2">Edit Data Siswa</h3>
                
                <form action="{{ route('admin.siswa.update', $siswa_edit->nis) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    {{-- NIS (disabled) + NISN (editable) --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">NIS</label>
                            <input type="text" value="{{ $siswa_edit->nis }}" disabled
                                   class="mt-1 block w-full rounded-lg border border-gray-200 bg-gray-50 p-2 text-sm font-mono">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">
                                NISN
                                <span class="text-xs text-gray-400 font-normal">(opsional)</span>
                            </label>
                            <input type="text" name="nisn" maxlength="20"
                                   value="{{ $siswa_edit->nisn }}"
                                   class="mt-1 block w-full rounded-lg border border-gray-300 p-2 text-sm"
                                   placeholder="10 digit NISN">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Siswa</label>
                        <input type="text" name="nama_siswa" value="{{ $siswa_edit->nama_siswa }}" required
                               class="mt-1 block w-full rounded-lg border border-gray-300 p-2 text-sm">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
                            <select name="jenis_kelamin" required class="mt-1 block w-full rounded-lg border border-gray-300 p-2 text-sm bg-white">
                                <option value="L" {{ $siswa_edit->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="P" {{ $siswa_edit->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" value="{{ $siswa_edit->tgl_lahir }}" required
                                   class="mt-1 block w-full rounded-lg border border-gray-300 p-2 text-sm">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">No. Telepon Siswa</label>
                            <input type="text" name="no_telp" value="{{ $siswa_edit->no_telp_siswa }}"
                                   class="mt-1 block w-full rounded-lg border border-gray-300 p-2 text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kelas</label>
                            <select name="kode_kelas" required class="mt-1 block w-full rounded-lg border border-gray-300 p-2 text-sm bg-white">
                                @foreach ($data_kelas as $kelas)
                                    <option value="{{ $kelas->kode_kelas }}" {{ $siswa_edit->kode_kelas == $kelas->kode_kelas ? 'selected' : '' }}>
                                        {{ $kelas->nama_kelas }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Alamat</label>
                        <textarea name="alamat" rows="2" required
                                  class="mt-1 block w-full rounded-lg border border-gray-300 p-2 text-sm">{{ $siswa_edit->alamat }}</textarea>
                    </div>

                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-200 space-y-3">
                        <span class="block text-sm font-bold text-gray-800">Data Wali Murid</span>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-medium text-gray-600">Nama Wali</label>
                                <input type="text" name="nama_wali" value="{{ $siswa_edit->wali_murid }}"
                                       class="mt-1 block w-full rounded-lg border border-gray-300 p-2 text-sm">
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-600">No. Telp Wali</label>
                                <input type="text" name="no_telp_wali" value="{{ $siswa_edit->no_telp_wali }}"
                                       class="mt-1 block w-full rounded-lg border border-gray-300 p-2 text-sm">
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end gap-3">
                        <button type="button"
                                @click="window.location.href='{{ route('admin.data-siswa', request()->except('edit_nis')) }}'"
                                class="px-5 py-2 text-sm text-gray-700 bg-gray-100 rounded-lg">Batal</button>
                        <button type="submit"
                                class="px-5 py-2 text-sm text-white bg-blue-600 rounded-lg shadow-md font-semibold">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif

</div>
@endsection
@extends('layout.admin-app')

@section('content')
<div x-data="{ openTambah: false, openEdit: false, filterKelas: '', editKodeKelas: '', editNamaKelas: '', editNipGuru: '' }">

    <div class="p-4 sm:p-6">
        <h2 class="text-xl font-bold mb-4 text-gray-800">DATA KELAS</h2>

        @if($errors->any())
            <div class="mb-4 p-4 text-sm text-red-700 bg-red-50 rounded-xl border border-red-100 flex flex-col gap-1.5 shadow-sm">
                @foreach ($errors->all() as $error)
                    <div class="flex items-center gap-2 font-semibold">
                        <i class="fa-solid fa-circle-exclamation text-red-500 text-base"></i>
                        <span>{{ $error }}</span>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- NOTIFIKASI SUKSES --}}
        @if(session('success'))
            <div class="mb-4 p-4 text-sm text-green-700 bg-green-50 rounded-xl border border-green-100 flex items-center gap-2 shadow-sm">
                <i class="fa-solid fa-circle-check text-green-500 text-base"></i>
                <span class="font-semibold">{{ session('success') }}</span>
            </div>
        @endif

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
            <div class="flex items-center gap-2 w-full sm:w-auto">
                <label class="text-xs font-bold text-gray-500 uppercase whitespace-nowrap">Pilih Kelas:</label>
                <select x-model="filterKelas" class="bg-white border border-gray-200 text-gray-700 text-sm rounded-xl px-3 py-2 w-full sm:w-44 shadow-sm focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition">
                    <option value="">Semua Kelas</option>
                    @foreach($kelas->unique('nama_kelas') as $k)
                        <option value="{{ $k->nama_kelas }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end">
                <button @click="openTambah = true" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2.5 rounded-xl shadow transition text-sm font-semibold w-full sm:w-auto text-center">
                    + Tambah Data Kelas
                </button>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-2 sm:p-4 w-full">
            <table class="w-full table-fixed text-sm">
                <thead class="bg-gray-50 text-gray-600 border-b border-gray-100">
                    <tr>
                        <th class="p-3 text-center w-[8%]">No</th>
                        <th class="p-3 text-left w-[20%]">Nama Kelas</th>
                        <th class="p-3 text-left w-[42%]">Guru Pengajar / Wali Kelas</th>
                        <th class="p-3 text-center w-[15%] lg:table-cell hidden">Tahun Ajaran</th>
                        <th class="p-3 text-center w-[15%]">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700 divide-y divide-gray-50">
                    @forelse($kelas as $index => $k)
                        <tr x-show="filterKelas === '' || filterKelas === '{{ $k->nama_kelas }}'" x-transition class="hover:bg-gray-50/70 transition">
                            <td class="p-3 text-center">{{ $kelas->firstItem() + $index }}</td>
                            <td class="p-3 font-bold text-gray-900">{{ $k->nama_kelas }}</td>
                            <td class="p-3">
                                @if($k->guru)
                                    <span class="block font-semibold text-gray-800 truncate">{{ $k->guru->nama_guru }}</span>
                                    <span class="block text-xs font-mono text-blue-600">{{ $k->guru->nip ?? '-' }}</span>
                                @else
                                    <span class="text-gray-400 italic">Belum diatur</span>
                                @endif
                            </td>
                            <td class="p-3 lg:table-cell hidden text-center text-gray-600">{{ $k->tahun_ajaran }}</td>
                            <td class="p-3 text-center">
                                <div class="flex items-center justify-center gap-1.5">
                                    <button @click="openEdit = true; editKodeKelas = '{{ $k->kode_kelas }}'; editNamaKelas = '{{ $k->nama_kelas }}'; editNipGuru = '{{ $k->nip_guru ?? '' }}'" title="Ubah Data" class="w-7 h-7 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition">
                                        <i class="fa-solid fa-pen text-xs"></i>
                                    </button>
                                    
                                    <form action="{{ route('admin.kelas.destroy', $k->kode_kelas) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data kelas ini?')" class="inline">
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
                            <td colspan="5" class="p-8 text-center text-gray-400 bg-gray-50/30 rounded-b-2xl">
                                <i class="fa-solid fa-folder-open text-2xl mb-2 block text-gray-300"></i>
                                Belum ada data kelas yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="mt-4 px-2">
                {{ $kelas->links() }}
            </div>
        </div>
    </div>

    {{-- MODAL TAMBAH DATA --}}
    <div x-show="openTambah" x-transition.opacity class="fixed inset-0 z-50 overflow-auto bg-black/50 flex items-center justify-center p-4 backdrop-blur-sm" x-cloak>
        <div @click.away="openTambah = false" class="bg-white w-full max-w-lg rounded-2xl shadow-2xl transition-all border border-gray-100">
            <div class="flex justify-between items-center p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-800">Tambah Data Kelas</h3>
                <button @click="openTambah = false" class="text-gray-400 hover:text-gray-600 transition text-sm p-1.5 hover:bg-gray-50 rounded-lg">✕</button>
            </div>

            <form action="{{ route('admin.kelas.store') }}" method="POST" class="p-6 space-y-4">
                @csrf

                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Nama Kelas Baru</label>
                    <input type="text" name="nama_kelas" required placeholder="Contoh: X.1" class="block w-full rounded-xl border border-gray-200 p-2.5 shadow-sm text-sm transition focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 placeholder:text-gray-400 text-gray-700">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Guru Pengajar / Wali Kelas</label>
                    <select name="nip_guru" required class="block w-full rounded-xl border border-gray-200 p-2.5 shadow-sm text-sm transition focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 text-gray-700">
                        <option value="" disabled selected>Pilih Guru</option>
                        {{-- Menggunakan $gurusTersedia agar yang sudah punya kelas langsung disembunyikan --}}
                        @foreach($gurusTersedia as $guru)
                            <option value="{{ $guru->nip }}">{{ $guru->nama_guru }} ({{ $guru->nip ?? 'Tanpa NIP' }})</option>
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end gap-2.5 pt-4 border-t border-gray-50">
                    <button type="button" @click="openTambah = false" class="px-4 py-2.5 border border-gray-200 text-gray-600 rounded-xl hover:bg-gray-50 text-xs font-bold transition uppercase tracking-wider">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 text-xs font-bold transition shadow-sm shadow-blue-500/20 uppercase tracking-wider">
                        Simpan Data
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- MODAL EDIT DATA --}}
    <div x-show="openEdit" x-transition.opacity class="fixed inset-0 z-50 overflow-auto bg-black/50 flex items-center justify-center p-4 backdrop-blur-sm" x-cloak>
        <div @click.away="openEdit = false" class="bg-white w-full max-w-lg rounded-2xl shadow-2xl transition-all border border-gray-100">
            <div class="flex justify-between items-center p-6 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-800">Ubah Wali Kelas / Data Kelas</h3>
                <button @click="openEdit = false" class="text-gray-400 hover:text-gray-600 transition text-sm p-1.5 hover:bg-gray-50 rounded-lg">✕</button>
            </div>

            <form :action="'{{ route('admin.data-kelas') }}/' + editKodeKelas" method="POST" class="p-6 space-y-4">
                @csrf
                @method('PUT')

                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5">Nama Kelas</label>
                    <input type="text" name="nama_kelas" x-model="editNamaKelas" required class="block w-full rounded-xl border border-gray-200 p-2.5 shadow-sm text-sm text-gray-700 focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-gray-600 uppercase tracking-wider mb-1.5 font-bold text-blue-600">Pilih Wali Kelas Baru</label>
                    <select name="nip_guru" x-model="editNipGuru" required class="block w-full rounded-xl border border-gray-200 p-2.5 shadow-sm text-sm transition focus:outline-none focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 text-gray-700">
                        <option value="" disabled>Pilih Guru</option>
                        @foreach($gurus as $guru)
                            {{-- Jika guru belum memiliki kelas, tampilkan secara normal --}}
                            @if(!in_array($guru->nip, $nipGuruTerpakai))
                                <option value="{{ $guru->nip }}">{{ $guru->nama_guru }} ({{ $guru->nip ?? 'Tanpa NIP' }})</option>
                            @else
                                {{-- Jika guru sudah punya kelas, hanya tampilkan jika NIP-nya cocok dengan wali kelas yang sedang diedit saat ini --}}
                                <option value="{{ $guru->nip }}" x-show="editNipGuru === '{{ $guru->nip }}'">
                                    {{ $guru->nama_guru }} ({{ $guru->nip ?? 'Tanpa NIP' }}) [Wali Kelas Saat Ini]
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="flex justify-end gap-2.5 pt-4 border-t border-gray-50">
                    <button type="button" @click="openEdit = false" class="px-4 py-2.5 border border-gray-200 text-gray-600 rounded-xl hover:bg-gray-50 text-xs font-bold transition uppercase tracking-wider">
                        Batal
                    </button>
                    <button type="submit" class="px-5 py-2.5 bg-blue-600 text-white rounded-xl hover:bg-blue-700 text-xs font-bold transition shadow-sm uppercase tracking-wider">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
@extends('layout.guru-app')

@section('title', 'Cek Nilai Rapor | E-Rapor')

@section('content')

<div class="text-center mb-6 mt-4">
    <h6 class="font-bold text-lg text-gray-800 uppercase tracking-wide">
        Cek Status Nilai Rapor Siswa
    </h6>
</div>

<div class="bg-white p-8 rounded-t-3xl shadow-sm border border-gray-100 mt-6 min-h-[calc(100vh-180px)] flex flex-col">

    {{-- ── FILTER DROPDOWN ── --}}
    <div class="w-full space-y-4 mb-10">
        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/4 font-semibold text-gray-700 text-sm">Pilih Kelas</label>
            <div class="md:w-3/4 relative">
                <select id="select-kelas" class="w-full appearance-none bg-gray-100 border border-transparent rounded-xl px-4 py-3 pr-10 outline-none focus:bg-white focus:ring-2 focus:ring-blue-500 transition-all text-sm">
                    <option value="" disabled selected>-- Pilih Kelas --</option>
                    @foreach($kelas as $k)
                        <option value="{{ $k->kode_kelas }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
                <i class="fa-solid fa-caret-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none"></i>
            </div>
        </div>

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/4 font-semibold text-gray-700 text-sm">Pilih Mata Pelajaran</label>
            <div class="md:w-3/4 relative">
                <select id="select-mapel" class="w-full appearance-none bg-gray-100 border border-transparent rounded-xl px-4 py-3 pr-10 outline-none focus:bg-white focus:ring-2 focus:ring-blue-500 transition-all text-sm">
                    <option value="" disabled selected>-- Pilih Mata Pelajaran --</option>
                    @foreach($mata_pelajaran as $mp)
                        <option value="{{ $mp->kode_mp }}">{{ $mp->nama_mp }}</option>
                    @endforeach
                </select>
                <i class="fa-solid fa-caret-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none"></i>
            </div>
        </div>

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/4 font-semibold text-gray-700 text-sm">Lihat Kategori Nilai</label>
            <div class="md:w-3/4 relative">
                <select id="select-jenis" class="w-full appearance-none bg-gray-100 border border-transparent rounded-xl px-4 py-3 pr-10 outline-none focus:bg-white focus:ring-2 focus:ring-blue-500 transition-all text-sm">
                    <option value="" disabled selected>-- Pilih Kategori Nilai --</option>
                    <option value="Harian">Harian</option>
                    <option value="UTS">UTS</option>
                    <option value="UAS">UAS</option>
                </select>
                <i class="fa-solid fa-caret-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none"></i>
            </div>
        </div>
    </div>

    {{-- ── TABEL DATA SISWA ── --}}
    <div class="overflow-x-auto border rounded-lg shadow-sm">
        <table class="w-full text-sm text-left border-collapse">
            <thead class="bg-gray-50 text-gray-700 font-bold border-b text-xs uppercase">
                <tr>
                    <th class="px-4 py-3 border-r w-12 text-center">No</th>
                    <th class="px-4 py-3 border-r">Nama Siswa</th>
                    <th class="px-4 py-3 border-r">NISN</th>
                    <th class="px-4 py-3 border-r">NIS</th>
                    <th class="px-4 py-3 border-r text-center w-24">Nilai</th>
                    <th class="px-4 py-3 text-center w-48">Status Kelengkapan (3 Nilai)</th>
                </tr>
            </thead>
            <tbody id="tabel-siswa-body" class="divide-y text-gray-600">
                <tr id="row-placeholder">
                    <td colspan="6" class="px-4 py-6 text-center text-gray-400 italic">
                        Silakan lengkapi pilihan Kelas, Mata Pelajaran, dan Kategori Nilai di atas untuk melihat data.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- ── PAGINATION ── --}}
    <div class="mt-auto pt-10 flex justify-end" id="pagination-container" style="display: none;">
        <div class="flex border border-gray-300 rounded-md overflow-hidden bg-gray-50 text-[10px] shadow-sm">
            <button class="px-2.5 py-1 border-r border-gray-300 hover:bg-gray-200 transition text-gray-500 font-bold">&lt;&lt;</button>
            <div class="px-3.5 py-1 bg-white border-r border-gray-300 text-blue-600 font-bold">1</div>
            <button class="px-2.5 py-1 hover:bg-gray-200 transition text-gray-500 font-bold">&gt;&gt;</button>
        </div>
    </div>

</div>

<script>
(function () {
    'use strict';

    var dataSiswa    = [];
    var fetchUrl     = '{{ route("guru.cek-nilai") }}'; 

    var selKelas     = document.getElementById('select-kelas');
    var selMapel     = document.getElementById('select-mapel');
    var selJenis     = document.getElementById('select-jenis');
    var tbody        = document.getElementById('tabel-siswa-body');

    // Jalankan pencarian otomatis saat ada perubahan di filter dropdown
    [selKelas, selMapel, selJenis].forEach(function (el) {
        el.addEventListener('change', onFilterChange);
    });

    function onFilterChange() {
        var kelas = selKelas.value;
        var mapel = selMapel.value;
        var jenis = selJenis.value;

        if (!kelas || !mapel || !jenis) return;

        renderTabelLoading();

        var url = fetchUrl
            + '?kode_kelas=' + encodeURIComponent(kelas)
            + '&kode_mp='    + encodeURIComponent(mapel)
            + '&jenis_nilai='+ encodeURIComponent(jenis);

        fetch(url, { headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } })
            .then(function (res) {
                if (!res.ok) throw new Error('Status ' + res.status);
                return res.json();
            })
            .then(function (data) {
                dataSiswa = data;
                renderTabel();
            })
            .catch(function (err) {
                console.error('[E-Rapor] Gagal memuat data nilai:', err);
                renderTabelError();
            });
    }

    function renderTabelLoading() {
        tbody.innerHTML = '<tr><td colspan="6" class="px-4 py-6 text-center text-gray-400 italic">Memuat data nilai siswa...</td></tr>';
    }

    function renderTabelError() {
        tbody.innerHTML = '<tr><td colspan="6" class="px-4 py-6 text-center text-red-400 italic">Gagal memuat data. Silakan periksa koneksi internet Anda.</td></tr>';
    }

    function renderTabel() {
        tbody.innerHTML = '';

        if (!dataSiswa.length) {
            tbody.innerHTML = '<tr><td colspan="6" class="px-4 py-6 text-center text-gray-400 italic">Tidak ada siswa aktif untuk kelas ini.</td></tr>';
            return;
        }

        dataSiswa.forEach(function (s, i) {
            var nilai      = s.nilai_sekarang != null ? s.nilai_sekarang : '-';
            var colorClass = nilai !== '-' ? 'text-emerald-600 font-bold' : 'text-gray-400 italic';

            // ── LOGIKA PENGECEKAN STATUS 3 NILAI ──
            var harianTerisi = s.nilai_harian !== null && s.nilai_harian !== undefined && s.nilai_harian !== '';
            var utsTerisi    = s.nilai_uts    !== null && s.nilai_uts    !== undefined && s.nilai_uts    !== '';
            var uasTerisi    = s.nilai_uas    !== null && s.nilai_uas    !== undefined && s.nilai_uas    !== '';

            var statusBadge = '';
            
            if (harianTerisi && utsTerisi && uasTerisi) {
                // Desain Badge Lengkap dengan warna emerald soft bordered yang elegan
                statusBadge = '<span class="px-3 py-1 bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-full text-xs font-bold shadow-sm inline-flex items-center gap-1"><i class="fa-solid fa-circle-check"></i> Lengkap</span>';
            } else {
                // Hitung berapa nilai yang belum diinput
                var hitungBelum = 0;
                if (!harianTerisi) hitungBelum++;
                if (!utsTerisi) hitungBelum++;
                if (!uasTerisi) hitungBelum++;

                // Desain Badge Belum Lengkap dengan warna amber soft bordered yang serasi
                statusBadge = '<span class="px-3 py-1 bg-amber-50 text-amber-700 border border-amber-200 rounded-full text-xs font-bold shadow-sm inline-flex items-center gap-1"><i class="fa-solid fa-triangle-exclamation"></i> Kurang ' + hitungBelum + ' Nilai</span>';
            }

            var tr = document.createElement('tr');
            tr.className = 'hover:bg-gray-50 transition';
            tr.innerHTML  = '<td class="px-4 py-3 border-r text-center text-xs font-medium">' + (i + 1) + '</td>'
                          + '<td class="px-4 py-3 border-r font-semibold text-gray-800">'    + esc(s.nama_siswa) + '</td>'
                          + '<td class="px-4 py-3 border-r text-gray-500">'                  + esc(s.nisn || '-') + '</td>'
                          + '<td class="px-4 py-3 border-r text-gray-500">'                  + esc(s.nis  || '-') + '</td>'
                          + '<td class="px-4 py-3 border-r text-center text-base ' + colorClass + '">' + nilai + '</td>'
                          + '<td class="px-4 py-3 text-center">' + statusBadge + '</td>';

            tbody.appendChild(tr);
        });
    }

    function esc(str) {
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    }

})();
</script>

@endsection
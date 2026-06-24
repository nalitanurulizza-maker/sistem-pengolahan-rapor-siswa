@extends('layout.guru-app')

@section('title', 'Cek Rapor Siswa | E-Rapor')

@section('content')

<div class="text-center mb-6 mt-4">
    <h6 class="font-bold text-lg text-gray-800 uppercase tracking-wide">
        Cek Rapor Siswa — Kelas {{ $nama_kelas }}
    </h6>
    <p class="text-xs text-gray-500 mt-1">Rekap nilai akhir seluruh mata pelajaran, total, rata-rata, dan predikat tiap siswa.</p>
</div>

<div class="bg-white p-8 rounded-t-3xl shadow-sm border border-gray-100 mt-6 min-h-[calc(100vh-180px)] flex flex-col">

    <div id="notif-box" class="mb-4 p-4 rounded-xl text-sm font-semibold flex items-center gap-2" style="display:none;"></div>

    {{-- TABEL RINGKASAN --}}
    <div class="overflow-x-auto border rounded-lg shadow-sm">
        <table class="w-full text-sm text-left border-collapse">
            <thead class="bg-gray-50 text-gray-700 font-bold border-b text-xs uppercase">
                <tr>
                    <th class="px-4 py-3 border-r w-12 text-center">No</th>
                    <th class="px-4 py-3 border-r">Nama Siswa</th>
                    <th class="px-4 py-3 border-r">NIS</th>
                    <th class="px-4 py-3 border-r text-center">Mapel Dinilai</th>
                    <th class="px-4 py-3 border-r text-center">Total Nilai Akhir</th>
                    <th class="px-4 py-3 border-r text-center">Rata-rata</th>
                    <th class="px-4 py-3 text-center">Detail</th>
                </tr>
            </thead>
            <tbody id="tabel-rapor-body" class="divide-y text-gray-600">
                <tr>
                    <td colspan="7" class="px-4 py-6 text-center text-gray-400 italic">Memuat data...</td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

{{-- MODAL DETAIL NILAI PER MAPEL --}}
<div id="modal-detail" class="fixed inset-0 bg-black/40 hidden items-center justify-center z-50 p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-2xl max-h-[85vh] overflow-y-auto">
        <div class="p-6 border-b flex justify-between items-center sticky top-0 bg-white">
            <h3 class="font-bold text-gray-800 text-base" id="modal-title">Detail Nilai</h3>
            <button id="modal-close" class="text-gray-400 hover:text-gray-700 text-xl leading-none">&times;</button>
        </div>
        <div class="p-6">
            <table class="w-full text-sm text-left border-collapse">
                <thead class="bg-gray-50 text-gray-700 font-bold border-b text-xs uppercase">
                    <tr>
                        <th class="px-3 py-2 border-r">Mata Pelajaran</th>
                        <th class="px-3 py-2 border-r text-center">Harian</th>
                        <th class="px-3 py-2 border-r text-center">UTS</th>
                        <th class="px-3 py-2 border-r text-center">UAS</th>
                        <th class="px-3 py-2 border-r text-center">Nilai Akhir</th>
                        <th class="px-3 py-2 text-center">Predikat</th>
                    </tr>
                </thead>
                <tbody id="modal-tabel-body" class="divide-y text-gray-600"></tbody>
                <tfoot>
                    <tr class="font-bold bg-gray-50 border-t">
                        <td class="px-3 py-2 border-r" colspan="4">Total Nilai Akhir</td>
                        <td class="px-3 py-2 border-r text-center" id="modal-total" colspan="1"></td>
                        <td class="px-3 py-2 text-center"></td>
                    </tr>
                    <tr class="font-bold bg-gray-50">
                        <td class="px-3 py-2 border-r" colspan="4">Rata-rata</td>
                        <td class="px-3 py-2 border-r text-center" id="modal-rata"></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<script>
(function () {
    'use strict';

    var fetchUrl  = '{{ route("guru.cek-rapor") }}';
    var detailUrlTemplate = '{{ route("guru.detail-rapor", ["nis" => "__NIS__"]) }}';
    var tbody     = document.getElementById('tabel-rapor-body');
    var notifBox  = document.getElementById('notif-box');

    var modal          = document.getElementById('modal-detail');
    var modalTitle      = document.getElementById('modal-title');
    var modalBody       = document.getElementById('modal-tabel-body');
    var modalTotal       = document.getElementById('modal-total');
    var modalRata         = document.getElementById('modal-rata');

    document.getElementById('modal-close').addEventListener('click', function () {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    });
    modal.addEventListener('click', function (e) {
        if (e.target === modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    });

    muatData();

    function muatData() {
        fetch(fetchUrl, {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(function (res) {
            if (!res.ok) throw new Error('Status ' + res.status);
            return res.json();
        })
        .then(renderTabel)
        .catch(function () {
            tbody.innerHTML = '<tr><td colspan="8" class="px-4 py-6 text-center text-red-400 italic">Gagal memuat data rapor.</td></tr>';
        });
    }

    function renderTabel(data) {
        tbody.innerHTML = '';

        if (!data.length) {
            tbody.innerHTML = '<tr><td colspan="7" class="px-4 py-6 text-center text-gray-400 italic">Belum ada siswa di kelas ini.</td></tr>';
            return;
        }

        data.forEach(function (s, i) {

            var tr = document.createElement('tr');
            tr.className = 'hover:bg-gray-50 transition';
            tr.innerHTML =
                '<td class="px-4 py-3 border-r text-center text-xs font-medium">' + (i + 1) + '</td>'
              + '<td class="px-4 py-3 border-r font-semibold text-gray-800">' + esc(s.nama_siswa) + '</td>'
              + '<td class="px-4 py-3 border-r text-gray-500">' + esc(s.nis) + '</td>'
              + '<td class="px-4 py-3 border-r text-center">' + s.jumlah_mapel_dinilai + ' / ' + s.jumlah_mapel + '</td>'
              + '<td class="px-4 py-3 border-r text-center font-semibold">' + s.total_nilai_akhir + '</td>'
              + '<td class="px-4 py-3 border-r text-center font-semibold">' + s.rata_rata + '</td>'
              + '<td class="px-4 py-3 text-center"><button data-nis="' + s.nis + '" data-nama="' + esc(s.nama_siswa) + '" class="btn-detail text-blue-600 hover:underline font-semibold text-xs">Lihat Detail</button></td>';

            tbody.appendChild(tr);
        });

        document.querySelectorAll('.btn-detail').forEach(function (btn) {
            btn.addEventListener('click', function () {
                bukaDetail(btn.dataset.nis, btn.dataset.nama);
            });
        });
    }

    function bukaDetail(nis, nama) {
        modalTitle.textContent = 'Detail Nilai — ' + nama;
        modalBody.innerHTML = '<tr><td colspan="6" class="px-3 py-4 text-center text-gray-400 italic">Memuat...</td></tr>';
        modal.classList.remove('hidden');
        modal.classList.add('flex');

        fetch(detailUrlTemplate.replace('__NIS__', encodeURIComponent(nis)), {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(function (res) {
            if (!res.ok) throw new Error('Status ' + res.status);
            return res.json();
        })
        .then(function (data) {
            modalBody.innerHTML = '';
            data.mapel.forEach(function (m) {
                var tr = document.createElement('tr');
                tr.innerHTML =
                    '<td class="px-3 py-2 border-r">' + esc(m.nama_mp) + '</td>'
                  + '<td class="px-3 py-2 border-r text-center">' + (m.nilai_harian ?? '-') + '</td>'
                  + '<td class="px-3 py-2 border-r text-center">' + (m.nilai_uts ?? '-') + '</td>'
                  + '<td class="px-3 py-2 border-r text-center">' + (m.nilai_uas ?? '-') + '</td>'
                  + '<td class="px-3 py-2 border-r text-center font-semibold">' + (m.nilai_akhir ?? '-') + '</td>'
                  + '<td class="px-3 py-2 text-center"><span class="px-2 py-0.5 rounded-full text-xs font-bold ' + badgePredikat(m.predikat) + '">' + m.predikat + '</span></td>';
                modalBody.appendChild(tr);
            });
            modalTotal.textContent = data.total_nilai_akhir;
            modalRata.textContent = data.rata_rata;
        })
        .catch(function () {
            modalBody.innerHTML = '<tr><td colspan="6" class="px-3 py-4 text-center text-red-400 italic">Gagal memuat detail.</td></tr>';
        });
    }

    function badgePredikat(p) {
        if (p === 'A') return 'bg-emerald-100 text-emerald-700 border border-emerald-200';
        if (p === 'B') return 'bg-blue-100 text-blue-700 border border-blue-200';
        if (p === 'C') return 'bg-amber-100 text-amber-700 border border-amber-200';
        if (p === 'D') return 'bg-red-100 text-red-700 border border-red-200';
        return 'bg-gray-100 text-gray-500';
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

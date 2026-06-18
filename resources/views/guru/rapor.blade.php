@extends('layout.guru-app')

@section('title', 'Rapor Siswa | E-Rapor')

@section('content')

<div class="text-center mb-6 mt-4">
    <h6 class="font-bold text-lg text-gray-800 uppercase tracking-wide">
        Nilai Akhir & Rapor Siswa
    </h6>
</div>

<div class="bg-white p-8 rounded-t-3xl shadow-sm border border-gray-100 mt-6 min-h-[calc(100vh-180px)] flex flex-col">

    {{-- FILTER --}}
    <div class="w-full space-y-4 mb-6">
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
    </div>

    {{-- NOTIFIKASI --}}
    <div id="notif-box" class="mb-4 p-4 rounded-xl text-sm font-semibold flex items-center gap-2" style="display:none;"></div>

    {{-- TOMBOL HITUNG --}}
    <div id="wrapper-tombol" style="display:none;" class="mb-6">
        <button type="button" id="btn-hitung"
                class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl shadow-sm transition text-sm flex items-center gap-2">
            <i class="fa-solid fa-calculator"></i> Hitung & Simpan Nilai Akhir
        </button>
    </div>

    {{-- TABEL --}}
    <div class="overflow-x-auto border rounded-lg shadow-sm">
        <table class="w-full text-sm text-left border-collapse">
            <thead class="bg-gray-50 text-gray-700 font-bold border-b text-xs uppercase">
                <tr>
                    <th class="px-4 py-3 border-r w-12 text-center">No</th>
                    <th class="px-4 py-3 border-r">Nama Siswa</th>
                    <th class="px-4 py-3 border-r">NIS</th>
                    <th class="px-4 py-3 border-r text-center">Harian</th>
                    <th class="px-4 py-3 border-r text-center">UTS</th>
                    <th class="px-4 py-3 border-r text-center">UAS</th>
                    <th class="px-4 py-3 border-r text-center">Nilai Akhir</th>
                    <th class="px-4 py-3 text-center">Predikat</th>
                </tr>
            </thead>
            <tbody id="tabel-rapor-body" class="divide-y text-gray-600">
                <tr>
                    <td colspan="8" class="px-4 py-6 text-center text-gray-400 italic">
                        Silakan pilih Kelas dan Mata Pelajaran di atas.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

<script>
(function () {
    'use strict';

    var csrfToken  = '{{ csrf_token() }}';
    var fetchUrl   = '{{ route("guru.rapor") }}';
    var hitungUrl  = '{{ route("guru.hitung-nilai-akhir") }}';

    var selKelas   = document.getElementById('select-kelas');
    var selMapel   = document.getElementById('select-mapel');
    var wrapTombol = document.getElementById('wrapper-tombol');
    var btnHitung  = document.getElementById('btn-hitung');
    var tbody      = document.getElementById('tabel-rapor-body');
    var notifBox   = document.getElementById('notif-box');

    [selKelas, selMapel].forEach(function (el) {
        el.addEventListener('change', onFilterChange);
    });

    function onFilterChange() {
        var kelas = selKelas.value;
        var mapel = selMapel.value;
        if (!kelas || !mapel) {
            wrapTombol.style.display = 'none';
            return;
        }
        wrapTombol.style.display = 'block';
        muatData();
    }

    function muatData() {
        tbody.innerHTML = '<tr><td colspan="8" class="px-4 py-6 text-center text-gray-400 italic">Memuat data...</td></tr>';

        var url = fetchUrl
            + '?kode_kelas=' + encodeURIComponent(selKelas.value)
            + '&kode_mp='    + encodeURIComponent(selMapel.value);

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(function (res) {
            if (!res.ok) throw new Error('Status ' + res.status);
            return res.json();
        })
        .then(function (data) {
            renderTabel(data);
        })
        .catch(function (err) {
            tbody.innerHTML = '<tr><td colspan="8" class="px-4 py-6 text-center text-red-400 italic">Gagal memuat data.</td></tr>';
        });
    }

    function renderTabel(data) {
        tbody.innerHTML = '';

        if (!data.length) {
            tbody.innerHTML = '<tr><td colspan="8" class="px-4 py-6 text-center text-gray-400 italic">Tidak ada data siswa.</td></tr>';
            return;
        }

        data.forEach(function (s, i) {
            var harian  = s.nilai_harian  != null ? s.nilai_harian  : '-';
            var uts     = s.nilai_uts     != null ? s.nilai_uts     : '-';
            var uas     = s.nilai_uas     != null ? s.nilai_uas     : '-';
            var akhir   = s.nilai_akhir   != null ? s.nilai_akhir   : '-';
            var predikat = s.predikat     != null ? s.predikat      : '-';

            // Warna nilai akhir
            var warnaNilai = 'text-gray-400';
            if (akhir !== '-') {
                if (akhir >= 90)      warnaNilai = 'text-emerald-600 font-bold';
                else if (akhir >= 75) warnaNilai = 'text-blue-600 font-bold';
                else if (akhir >= 60) warnaNilai = 'text-amber-600 font-bold';
                else                  warnaNilai = 'text-red-600 font-bold';
            }

            // Warna predikat
            var warnaPredikat = 'bg-gray-100 text-gray-500';
            if (predikat === 'A')      warnaPredikat = 'bg-emerald-100 text-emerald-700 border border-emerald-200';
            else if (predikat === 'B') warnaPredikat = 'bg-blue-100 text-blue-700 border border-blue-200';
            else if (predikat === 'C') warnaPredikat = 'bg-amber-100 text-amber-700 border border-amber-200';
            else if (predikat === 'D') warnaPredikat = 'bg-red-100 text-red-700 border border-red-200';

            var tr = document.createElement('tr');
            tr.className = 'hover:bg-gray-50 transition';
            tr.innerHTML =
                '<td class="px-4 py-3 border-r text-center text-xs font-medium">' + (i + 1) + '</td>'
              + '<td class="px-4 py-3 border-r font-semibold text-gray-800">' + esc(s.nama_siswa) + '</td>'
              + '<td class="px-4 py-3 border-r text-gray-500">' + esc(s.nis || '-') + '</td>'
              + '<td class="px-4 py-3 border-r text-center">' + harian + '</td>'
              + '<td class="px-4 py-3 border-r text-center">' + uts + '</td>'
              + '<td class="px-4 py-3 border-r text-center">' + uas + '</td>'
              + '<td class="px-4 py-3 border-r text-center text-base ' + warnaNilai + '">' + akhir + '</td>'
              + '<td class="px-4 py-3 text-center"><span class="px-3 py-1 rounded-full text-xs font-bold ' + warnaPredikat + '">' + predikat + '</span></td>';

            tbody.appendChild(tr);
        });
    }

    btnHitung.addEventListener('click', function () {
        if (!selKelas.value || !selMapel.value) {
            tampilNotif('Pilih kelas dan mata pelajaran terlebih dahulu!', 'error');
            return;
        }

        btnHitung.disabled = true;
        btnHitung.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menghitung...';

        var formData = new FormData();
        formData.append('kode_kelas', selKelas.value);
        formData.append('kode_mp',    selMapel.value);
        formData.append('_token',     csrfToken);

        fetch(hitungUrl, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(function (res) {
            if (!res.ok) throw new Error('Status ' + res.status);
            return res.json();
        })
        .then(function (data) {
            tampilNotif('Nilai akhir berhasil dihitung untuk ' + data.diproses + ' siswa!', 'sukses');
            muatData();
        })
        .catch(function (err) {
            tampilNotif('Gagal menghitung nilai akhir: ' + err.message, 'error');
        })
        .finally(function () {
            btnHitung.disabled = false;
            btnHitung.innerHTML = '<i class="fa-solid fa-calculator"></i> Hitung & Simpan Nilai Akhir';
        });
    });

    function tampilNotif(pesan, tipe) {
        notifBox.style.display = 'flex';
        if (tipe === 'sukses') {
            notifBox.className = 'mb-4 p-4 rounded-xl text-sm font-semibold flex items-center gap-2 bg-emerald-50 border border-emerald-200 text-emerald-700';
            notifBox.innerHTML = '<i class="fa-solid fa-circle-check"></i> ' + pesan;
        } else {
            notifBox.className = 'mb-4 p-4 rounded-xl text-sm font-semibold flex items-center gap-2 bg-red-50 border border-red-200 text-red-700';
            notifBox.innerHTML = '<i class="fa-solid fa-circle-xmark"></i> ' + pesan;
        }
        setTimeout(function () { notifBox.style.display = 'none'; }, 4000);
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
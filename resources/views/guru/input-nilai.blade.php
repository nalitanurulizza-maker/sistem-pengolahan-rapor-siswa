@extends('layout.guru-app')

@section('title', 'Input Nilai Rapor | E-Rapor')

@section('content')

<div class="text-center mb-6 mt-4">
    <h6 class="font-bold text-lg text-gray-800 uppercase tracking-wide">
        Input Nilai Rapor Siswa
    </h6>
</div>

<div class="bg-white p-8 rounded-t-3xl shadow-sm border border-gray-100 mt-6 min-h-[calc(100vh-180px)] flex flex-col">

    {{-- ── FILTER ── --}}
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
                </select>
                <i class="fa-solid fa-caret-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none"></i>
            </div>
        </div>

        <div class="flex flex-col md:flex-row md:items-center gap-4">
            <label class="md:w-1/4 font-semibold text-gray-700 text-sm">Pilih Kategori Nilai</label>
            <div class="md:w-3/4 relative">
                <select id="select-jenis" class="w-full appearance-none bg-gray-100 border border-transparent rounded-xl px-4 py-3 pr-10 outline-none focus:bg-white focus:ring-2 focus:ring-blue-500 transition-all text-sm">
                    <option value="" disabled selected>-- Pilih Kategori Nilai --</option>
                    <option value="harian">Harian</option>
                    <option value="uts">UTS</option>
                    <option value="uas">UAS</option>
                </select>
                <i class="fa-solid fa-caret-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-500 pointer-events-none"></i>
            </div>
        </div>

    </div>

    {{-- ── NOTIFIKASI ── --}}
    <div id="notif-sukses-ajax"
         class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm font-semibold items-center gap-2"
         style="display:none;">
        <i class="fa-solid fa-circle-check text-base"></i>
        <span id="text-notif">Data berhasil disimpan!</span>
    </div>

    {{-- ── TOMBOL INPUT MASSAL ── --}}
    <div class="mb-6" id="wrapper-tombol-input" style="display:none;">
        <button type="button" id="btn-input-massal"
                class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl shadow-sm transition text-sm flex items-center gap-2">
            <i class="fa-solid fa-pen-to-square"></i> Input Nilai Massal
        </button>
    </div>

    {{-- ── TABEL SISWA ── --}}
    <div class="overflow-x-auto border rounded-lg shadow-sm">
        <table class="w-full text-sm text-left border-collapse">
            <thead class="bg-gray-50 text-gray-700 font-bold border-b text-xs uppercase">
                <tr>
                    <th class="px-4 py-3 border-r w-12 text-center">No</th>
                    <th class="px-4 py-3 border-r">Nama Siswa</th>
                    <th class="px-4 py-3 border-r">NISN</th>
                    <th class="px-4 py-3 border-r">NIS</th>
                    <th class="px-4 py-3 border-r text-center">Nilai</th>
                    <th class="px-4 py-3 text-center w-28">Aksi</th>
                </tr>
            </thead>
            <tbody id="tabel-siswa-body" class="divide-y text-gray-600">
                <tr>
                    <td colspan="6" class="px-4 py-6 text-center text-gray-400 italic">
                        Silakan lengkapi pilihan Kelas, Mata Pelajaran, dan Kategori Nilai di atas.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>

{{-- ── MODAL INPUT NILAI MASSAL / EDIT SATU SISWA ── --}}
<div id="overlay-modal"
     style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5);
            z-index:9999; align-items:center; justify-content:center;">

    <div style="background:#fff; border-radius:16px; width:100%; max-width:680px; max-height:85vh;
                display:flex; flex-direction:column; margin:1rem; overflow:hidden;
                box-shadow:0 20px 60px rgba(0,0,0,0.3);">

        {{-- Header --}}
        <div style="background:#1a2340; padding:1.25rem 1.5rem; display:flex;
                    justify-content:space-between; align-items:flex-start; flex-shrink:0;">
            <div>
                <p id="modal-main-title"
                   style="margin:0; color:#fff; font-weight:700; font-size:0.875rem;
                          text-transform:uppercase; letter-spacing:0.05em;">
                    Form Input Nilai
                </p>
                <p id="modal-sub-title"
                   style="margin:0.25rem 0 0; color:#94a3b8; font-size:0.75rem;"></p>
            </div>
            <button type="button" id="btn-tutup-x"
                    style="color:#fff; background:none; border:none; font-size:1.75rem;
                           line-height:1; cursor:pointer; padding:0; margin-left:1rem;"
                    aria-label="Tutup modal">&times;</button>
        </div>

        {{-- Form massal --}}
        <form id="form-nilai" action="{{ route('guru.simpan-nilai-batch') }}" method="POST"
              style="display:flex; flex-direction:column; flex:1; overflow:hidden;">
            @csrf
            <input type="hidden" name="kode_kelas"  id="hidden-kelas">
            <input type="hidden" name="kode_mp"     id="hidden-mapel">
            <input type="hidden" name="jenis_nilai" id="hidden-jenis">

            <div id="modal-list-siswa"
                 style="padding:1.5rem; overflow-y:auto; flex:1; background:#f9fafb;"></div>

            <div style="padding:1rem 1.5rem; background:#fff; border-top:1px solid #e5e7eb;
                        display:flex; justify-content:flex-end; gap:0.75rem; flex-shrink:0;">
                <button type="button" id="btn-tutup-batal"
                        style="padding:0.5rem 1rem; border:1px solid #d1d5db; border-radius:12px;
                               background:#fff; color:#374151; font-weight:600;
                               font-size:0.875rem; cursor:pointer;">
                    Batal
                </button>
                <button type="submit" id="btn-simpan-submit"
                        style="padding:0.5rem 1.25rem; border:none; border-radius:12px;
                               background:#059669; color:#fff; font-weight:700;
                               font-size:0.875rem; cursor:pointer;">
                    Simpan Semua Nilai
                </button>
            </div>
        </form>

    </div>
</div>

<script>
(function () {
    'use strict';

    // ── URL & TOKEN ──
    var URL_FETCH_SISWA = "{{ route('guru.input-nilai') }}";
    var URL_GET_MAPEL   = "{{ route('guru.get-mapel') }}";
    var URL_EDIT_NILAI  = "{{ route('guru.edit-nilai') }}";
    var URL_HAPUS_NILAI = "{{ route('guru.hapus-nilai') }}";
    var CSRF            = "{{ csrf_token() }}";

    // ── ELEMEN ──
    var selKelas    = document.getElementById('select-kelas');
    var selMapel    = document.getElementById('select-mapel');
    var selJenis    = document.getElementById('select-jenis');
    var wrapTombol  = document.getElementById('wrapper-tombol-input');
    var btnMassal   = document.getElementById('btn-input-massal');
    var overlay     = document.getElementById('overlay-modal');
    var formNilai   = document.getElementById('form-nilai');
    var modalTitle  = document.getElementById('modal-main-title');

    var dataSiswa = [];

    // ============================================================
    //  LOAD MAPEL SAAT KELAS BERUBAH
    // ============================================================
    selKelas.addEventListener('change', function () {
        selMapel.innerHTML = '<option value="">Loading...</option>';
        wrapTombol.style.display = 'none';

        fetch(URL_GET_MAPEL + '?kode_kelas=' + encodeURIComponent(this.value), {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(function (res) {
            if (!res.ok) throw new Error('Gagal memuat mapel');
            return res.json();
        })
        .then(function (data) {
            var html = '<option value="">-- Pilih Mata Pelajaran --</option>';
            data.forEach(function (mp) {
                html += '<option value="' + esc(mp.kode_mp) + '">' + esc(mp.nama_mp) + '</option>';
            });
            selMapel.innerHTML = html;
        })
        .catch(function () {
            selMapel.innerHTML = '<option value="">Mapel tidak ditemukan</option>';
        });
    });

    // ============================================================
    //  AUTO-FILTER DARI URL PARAMS
    // ============================================================
    window.addEventListener('DOMContentLoaded', function () {
        var p = new URLSearchParams(window.location.search);
        if (p.get('kelas') && p.get('mapel') && p.get('jenis')) {
            selKelas.value = p.get('kelas');
            selMapel.value = p.get('mapel');
            selJenis.value = p.get('jenis');
            muatDataSiswa();
        }
    });

    [selKelas, selMapel, selJenis].forEach(function (el) {
        el.addEventListener('change', muatDataSiswa);
    });

    // ============================================================
    //  MUAT DATA SISWA
    // ============================================================
    function muatDataSiswa() {
        var kelas = selKelas.value;
        var mapel = selMapel.value;
        var jenis = selJenis.value;

        if (!kelas || !mapel || !jenis) {
            wrapTombol.style.display = 'none';
            return;
        }

        wrapTombol.style.display = 'block';
        renderTabelLoading();

        var url = URL_FETCH_SISWA
            + '?kode_kelas='  + encodeURIComponent(kelas)
            + '&kode_mp='     + encodeURIComponent(mapel)
            + '&jenis_nilai=' + encodeURIComponent(jenis);

        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': CSRF
            }
        })
        .then(function (res) {
            if (!res.ok) throw new Error('Status ' + res.status);
            return res.json();
        })
        .then(function (data) {
            dataSiswa = data;
            renderTabel();
        })
        .catch(function (err) {
            console.error('[E-Rapor] Gagal fetch siswa:', err);
            renderTabelError();
        });
    }

    // ============================================================
    //  RENDER TABEL
    // ============================================================
    function renderTabelLoading() {
        document.getElementById('tabel-siswa-body').innerHTML =
            '<tr><td colspan="6" class="px-4 py-6 text-center text-gray-400 italic">Memuat data siswa...</td></tr>';
    }

    function renderTabelError() {
        document.getElementById('tabel-siswa-body').innerHTML =
            '<tr><td colspan="6" class="px-4 py-6 text-center text-red-400 italic">Gagal memuat data. Periksa koneksi atau konsol browser.</td></tr>';
    }

    function renderTabel() {
        var tbody = document.getElementById('tabel-siswa-body');
        tbody.innerHTML = '';

        if (!dataSiswa.length) {
            tbody.innerHTML =
                '<tr><td colspan="6" class="px-4 py-6 text-center text-gray-400 italic">Tidak ada siswa aktif untuk kelas ini.</td></tr>';
            return;
        }

        dataSiswa.forEach(function (s, i) {
            var nilai      = s.nilai_sekarang != null ? s.nilai_sekarang : '-';
            var colorClass = nilai !== '-' ? 'text-emerald-600 font-bold' : 'text-gray-400';

            var tr = document.createElement('tr');
            tr.className = 'hover:bg-gray-50 transition';
            tr.innerHTML =
                  '<td class="px-4 py-3 border-r text-center text-xs font-medium">' + (i + 1) + '</td>'
                + '<td class="px-4 py-3 border-r font-semibold text-gray-800">'     + esc(s.nama_siswa) + '</td>'
                + '<td class="px-4 py-3 border-r text-gray-500">'                   + esc(s.nisn || '-') + '</td>'
                + '<td class="px-4 py-3 border-r text-gray-500">'                   + esc(s.nis  || '-') + '</td>'
                + '<td class="px-4 py-3 border-r text-center text-base ' + colorClass + '">' + esc(String(nilai)) + '</td>'
                + '<td class="px-4 py-3 text-center">'
                +   '<div class="flex items-center justify-center gap-2">'
                    // Tombol Edit
                +     '<button type="button" data-nis="' + esc(s.nis) + '" data-nama="' + esc(s.nama_siswa) + '" data-nilai="' + (s.nilai_sekarang ?? '') + '"'
                +             ' class="btn-edit p-1.5 bg-amber-500 text-white rounded-lg hover:bg-amber-600 transition shadow-sm flex items-center justify-center w-8 h-8" title="Edit Nilai">'
                +       '<i class="fa-solid fa-pen-to-square text-xs"></i>'
                +     '</button>'
                    // Tombol Hapus
                +     '<button type="button" data-nis="' + esc(s.nis) + '" data-nama="' + esc(s.nama_siswa) + '"'
                +             ' class="btn-hapus p-1.5 bg-rose-50 text-rose-600 border border-rose-200 rounded-lg hover:bg-rose-600 hover:text-white transition shadow-sm flex items-center justify-center w-8 h-8" title="Hapus Nilai">'
                +       '<i class="fa-solid fa-trash-can text-xs"></i>'
                +     '</button>'
                +   '</div>'
                + '</td>';

            // Event edit — buka modal satu siswa
            tr.querySelector('.btn-edit').addEventListener('click', function () {
                bukaModalSatuSiswa(s);
            });

            // Event hapus — langsung hapus via AJAX
            tr.querySelector('.btn-hapus').addEventListener('click', function () {
                hapusNilai(s.nis, s.nama_siswa);
            });

            tbody.appendChild(tr);
        });
    }

    // ============================================================
    //  SUBMIT FORM MASSAL
    // ============================================================
    formNilai.addEventListener('submit', function (e) {
        e.preventDefault();

        var btnSubmit = document.getElementById('btn-simpan-submit');
        btnSubmit.disabled    = true;
        btnSubmit.textContent = 'Menyimpan...';

        fetch(formNilai.action, {
            method: 'POST',
            body: new FormData(formNilai),
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': CSRF
            }
        })
        .then(function (res) {
            if (!res.ok) throw new Error('Status ' + res.status);
            return res.json();
        })
        .then(function () {
            tutupModal();
            tampilNotif('Semua nilai berhasil disimpan!');
            muatDataSiswa();
        })
        .catch(function (err) {
            alert('Terjadi kesalahan saat menyimpan nilai: ' + err.message);
        })
        .finally(function () {
            btnSubmit.disabled    = false;
            btnSubmit.textContent = 'Simpan Semua Nilai';
        });
    });

    // ============================================================
    //  EDIT NILAI SATU SISWA (via prompt → POST /edit-nilai)
    // ============================================================
    function editNilai(nis, nama, nilaiLama) {
        var jenisLabel = selJenis.options[selJenis.selectedIndex].text;
        var input = prompt(
            'Edit nilai ' + jenisLabel + ' untuk ' + nama + ' (0–100):',
            nilaiLama !== null && nilaiLama !== '' ? nilaiLama : ''
        );

        if (input === null) return; // user klik Cancel

        var angka = parseFloat(input);
        if (isNaN(angka) || angka < 0 || angka > 100) {
            alert('Nilai harus berupa angka antara 0 sampai 100.');
            return;
        }

        var fd = new FormData();
        fd.append('nis',         nis);
        fd.append('kode_mp',     selMapel.value);
        fd.append('jenis_nilai', selJenis.value);
        fd.append('nilai',       angka);
        fd.append('_token',      CSRF);

        fetch(URL_EDIT_NILAI, {
            method: 'POST',
            body: fd,
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': CSRF }
        })
        .then(function (res) {
            if (!res.ok) throw new Error('Status ' + res.status);
            return res.json();
        })
        .then(function () {
            tampilNotif('Nilai berhasil diperbarui!');
            muatDataSiswa();
        })
        .catch(function () {
            alert('Gagal menyimpan nilai. Silakan coba lagi.');
        });
    }

    // ============================================================
    //  HAPUS NILAI SATU SISWA (POST /hapus-nilai)
    // ============================================================
    function hapusNilai(nis, nama) {
        var jenisLabel = selJenis.options[selJenis.selectedIndex].text;
        if (!confirm('Hapus nilai ' + jenisLabel + ' untuk ' + nama + '?')) return;

        var fd = new FormData();
        fd.append('nis',         nis);
        fd.append('kode_mp',     selMapel.value);
        fd.append('jenis_nilai', selJenis.value);
        fd.append('_token',      CSRF);

        fetch(URL_HAPUS_NILAI, {
            method: 'POST',
            body: fd,
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'X-CSRF-TOKEN': CSRF }
        })
        .then(function (res) {
            if (!res.ok) throw new Error('Status ' + res.status);
            return res.json();
        })
        .then(function () {
            tampilNotif('Nilai berhasil dihapus!');
            muatDataSiswa();
        })
        .catch(function () {
            alert('Gagal menghapus nilai. Silakan coba lagi.');
        });
    }

    // ============================================================
    //  MODAL MASSAL & SATU SISWA
    // ============================================================
    btnMassal.addEventListener('click', bukaModalMultiSiswa);
    document.getElementById('btn-tutup-x').addEventListener('click',    tutupModal);
    document.getElementById('btn-tutup-batal').addEventListener('click', tutupModal);
    overlay.addEventListener('click', function (e) { if (e.target === overlay) tutupModal(); });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && overlay.style.display === 'flex') tutupModal();
    });

    function siapkanBaseModal() {
        document.getElementById('hidden-kelas').value = selKelas.value;
        document.getElementById('hidden-mapel').value = selMapel.value;
        document.getElementById('hidden-jenis').value = selJenis.value;

        document.getElementById('modal-sub-title').textContent =
            selKelas.options[selKelas.selectedIndex].text
            + ' → ' + selMapel.options[selMapel.selectedIndex].text
            + ' · Kategori: ' + selJenis.options[selJenis.selectedIndex].text;
    }

    function bukaModalSatuSiswa(siswa) {
        siapkanBaseModal();
        modalTitle.textContent = 'Form Edit Nilai';

        var container = document.getElementById('modal-list-siswa');
        container.innerHTML = '';
        container.appendChild(
            generateRowInputSiswa(siswa, siswa.nilai_sekarang != null ? siswa.nilai_sekarang : '')
        );

        overlay.style.display        = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function bukaModalMultiSiswa() {
        if (!selKelas.value || !selMapel.value || !selJenis.value) {
            alert('Silakan lengkapi semua filter terlebih dahulu!');
            return;
        }

        siapkanBaseModal();
        modalTitle.textContent = 'Form Input Nilai Massal';

        var container = document.getElementById('modal-list-siswa');
        container.innerHTML = '';

        if (!dataSiswa.length) {
            container.innerHTML =
                '<p style="text-align:center;color:#9ca3af;padding:2rem 0;font-style:italic;">Tidak ada data siswa.</p>';
        } else {
            dataSiswa.forEach(function (s) {
                container.appendChild(
                    generateRowInputSiswa(s, s.nilai_sekarang != null ? s.nilai_sekarang : '')
                );
            });
        }

        overlay.style.display        = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function generateRowInputSiswa(s, nilaiLama) {
        var row = document.createElement('div');
        row.style.cssText =
            'display:flex;align-items:center;justify-content:space-between;'
            + 'padding:0.75rem 1rem;background:#fff;border:1px solid #f0f0f0;'
            + 'border-radius:12px;margin-bottom:0.5rem;';
        row.innerHTML =
              '<div style="flex:1;padding-right:1rem;">'
            +   '<p style="margin:0;font-weight:700;font-size:0.875rem;color:#1f2937;">' + esc(s.nama_siswa) + '</p>'
            +   '<p style="margin:0.15rem 0 0;font-size:0.7rem;color:#9ca3af;">'
            +     'NIS: ' + esc(s.nis || '-') + ' | NISN: ' + esc(s.nisn || '-')
            +   '</p>'
            + '</div>'
            + '<div style="width:6rem;">'
            +   '<input type="number" name="nilai[' + esc(s.nis) + ']"'
            +          ' min="0" max="100" placeholder="0-100"'
            +          ' value="' + esc(String(nilaiLama)) + '"'
            +          ' style="width:100%;padding:0.5rem;border:1px solid #d1d5db;'
            +                  'border-radius:10px;text-align:center;font-weight:700;'
            +                  'font-size:1rem;outline:none;"'
            +          ' onfocus="this.style.borderColor=\'#3b82f6\'"'
            +          ' onblur="this.style.borderColor=\'#d1d5db\'">'
            + '</div>';
        return row;
    }

    function tutupModal() {
        overlay.style.display        = 'none';
        document.body.style.overflow = '';
    }

    // ============================================================
    //  HELPER: NOTIFIKASI & ESCAPE
    // ============================================================
    function tampilNotif(pesan) {
        var notif = document.getElementById('notif-sukses-ajax');
        document.getElementById('text-notif').textContent = pesan;
        notif.style.display = 'flex';
        setTimeout(function () { notif.style.display = 'none'; }, 3000);
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
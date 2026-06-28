<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Rapor — {{ $siswa->nama_siswa }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 12px;
            color: #111;
            padding: 30px 40px;
        }

        /* ── HEADER ── */
        .header {
            text-align: center;
            border-bottom: 3px double #111;
            padding-bottom: 12px;
            margin-bottom: 14px;
        }
        .header-text { text-align: center; flex: 1; }
        .header-text h1 { font-size: 16px; font-weight: bold; text-transform: uppercase; letter-spacing: 1px; }
        .header-text h2 { font-size: 13px; font-weight: bold; margin-top: 2px; }
        .header-text p  { font-size: 11px; margin-top: 2px; color: #333; }

        /* ── JUDUL RAPOR ── */
        .judul-rapor {
            text-align: center;
            margin: 14px 0 12px;
            font-size: 14px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-decoration: underline;
        }

        /* ── INFO SISWA ── */
        .info-box {
            border: 1px solid #bbb;
            border-radius: 4px;
            padding: 10px 14px;
            margin-bottom: 14px;
            background: #fafafa;
        }
        .info-grid {
            width: 100%;
            border-collapse: collapse;
        }
        .info-grid td {
            padding: 3px 4px;
            vertical-align: top;
            font-size: 12px;
        }
        .info-grid .label { width: 120px; font-weight: bold; }
        .info-grid .sep   { width: 10px; }
        .info-grid .val   { width: 200px; }

        /* ── TABEL NILAI ── */
        table.nilai {
            width: 100%;
            border-collapse: collapse;
            margin-top: 4px;
            font-size: 12px;
        }
        table.nilai th {
            background-color: #1a2340;
            color: #fff;
            padding: 7px 6px;
            text-align: center;
            border: 1px solid #333;
            font-size: 11px;
        }
        table.nilai td {
            border: 1px solid #aaa;
            padding: 6px;
            text-align: center;
            vertical-align: middle;
        }
        table.nilai td.mapel { text-align: left; padding-left: 8px; }
        table.nilai td.deskripsi { text-align: left; padding-left: 8px; font-size: 11px; }
        table.nilai tbody tr:nth-child(even) { background-color: #f9f9f9; }

        /* Predikat warna */
        .pred-a { color: #16a34a; font-weight: bold; }
        .pred-b { color: #2563eb; font-weight: bold; }
        .pred-c { color: #d97706; font-weight: bold; }
        .pred-d { color: #dc2626; font-weight: bold; }

        /* ── FOOTER TABEL ── */
        table.nilai tfoot td {
            font-weight: bold;
            background-color: #eef2f7;
            border: 1px solid #aaa;
        }

        /* ── KETERANGAN PREDIKAT ── */
        .ket-predikat {
            margin-top: 10px;
            font-size: 10px;
            color: #555;
            border: 1px dashed #ccc;
            padding: 6px 10px;
            border-radius: 4px;
        }
        .ket-predikat span { margin-right: 16px; }

        /* ── TTD ── */
        .ttd-section {
            margin-top: 40px;
            width: 100%;
            border-collapse: collapse;
        }
        .ttd-section td {
            width: 50%;
            text-align: center;
            vertical-align: top;
            font-size: 12px;
            padding: 0 20px;
        }
        .ttd-garis {
            display: inline-block;
            width: 160px;
            border-bottom: 1px solid #111;
            margin-top: 60px;
        }

        /* ── HALAMAN ── */
        .page-number {
            text-align: right;
            font-size: 10px;
            color: #888;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    {{-- ── HEADER SEKOLAH ── --}}
    <div class="header">
            <h1>Pemerintah Provinsi</h1>
            <h2>Nama Sekolah</h2>
            <p>Jl. Pendidikan No. 1, Nama Kota, Nama Provinsi</p>
            <p>Telp. (021) 000-0000 | Email: sma@contoh.sch.id</p>
        </div>
    </div>

    {{-- ── JUDUL ── --}}
    <div class="judul-rapor">
        Laporan Hasil Belajar Siswa (Rapor)
    </div>

    {{-- ── INFO SISWA ── --}}
    <div class="info-box">
        <table class="info-grid">
            <tr>
                <td class="label">Nama Siswa</td>
                <td class="sep">:</td>
                <td class="val"><strong>{{ $siswa->nama_siswa }}</strong></td>

                <td class="label">Kelas</td>
                <td class="sep">:</td>
                <td class="val">{{ $namaKelas }}</td>
            </tr>
            <tr>
                <td class="label">NIS</td>
                <td class="sep">:</td>
                <td class="val">{{ $siswa->nis }}</td>

                <td class="label">Tahun Ajaran</td>
                <td class="sep">:</td>
                <td class="val">{{ $tahunAjaran }}</td>
            </tr>
            <tr>
                <td class="label">NISN</td>
                <td class="sep">:</td>
                <td class="val">{{ $siswa->nisn ?? '-' }}</td>

                <td class="label">Semester</td>
                <td class="sep">:</td>
                <td class="val">
                    @php
                        $ta = DB::table('tahun_akademik')->where('status','Aktif')->first();
                    @endphp
                    {{ $ta->semester ?? '-' }}
                </td>
            </tr>
            <tr>
                <td class="label">Jenis Kelamin</td>
                <td class="sep">:</td>
                <td class="val">
                    {{ $siswa->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}
                </td>

                <td class="label">Wali Kelas</td>
                <td class="sep">:</td>
                <td class="val">{{ $d->nama_guru ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Tanggal Lahir</td>
                <td class="sep">:</td>
                <td class="val">
                    {{ \Carbon\Carbon::parse($siswa->tgl_lahir)->translatedFormat('d F Y') }}
                </td>

                <td class="label">Orang Tua / Wali</td>
                <td class="sep">:</td>
                <td class="val">{{ $siswa->wali_murid ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Alamat</td>
                <td class="sep">:</td>
                <td class="val" colspan="4">{{ $siswa->alamat ?? '-' }}</td>
            </tr>
        </table>
    </div>

    {{-- ── TABEL NILAI ── --}}
    <table class="nilai">
        <thead>
            <tr>
                <th style="width:4%">No</th>
                <th style="width:22%">Mata Pelajaran</th>
                <th style="width:8%">Nilai</th>
                <th style="width:8%">Predikat</th>
                <th style="width:58%">Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($nilai as $i => $n)
            @php
                $pred = $n['predikat'] ?? '-';
                $predClass = match($pred) {
                    'A'     => 'pred-a',
                    'B'     => 'pred-b',
                    'C'     => 'pred-c',
                    'D'     => 'pred-d',
                    default => ''
                };
            @endphp
            <tr>
                <td>{{ $i + 1 }}</td>
                <td class="mapel">{{ $n['nama_mp'] }}</td>
                <td><strong>{{ $n['nilai_akhir'] ?? '-' }}</strong></td>
                <td class="{{ $predClass }}">{{ $pred }}</td>
                <td class="deskripsi">{{ $n['deskripsi'] ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center;font-style:italic;color:#888;">
                    Belum ada data nilai
                </td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" style="text-align:right;padding-right:8px;">
                    Total Nilai Akhir
                </td>
                <td>{{ $totalNilai }}</td>
            </tr>
            <tr>
                <td colspan="4" style="text-align:right;padding-right:8px;">
                    Rata-rata
                </td>
                <td>{{ $rataRata }}</td>
            </tr>
        </tfoot>
    </table>

    {{-- ── TANDA TANGAN ── --}}
    <table class="ttd-section">
        <tr>
            <td>
                <p>Orang Tua / Wali Murid,</p>
                <div class="ttd-garis"></div>
                <p><strong>{{ $siswa->wali_murid ?? '................................' }}</strong></p>
            </td>
            <td>
                @php
                    $tgl = \Carbon\Carbon::now()->translatedFormat('d F Y');
                @endphp
                <p>Mengetahui, Wali Kelas</p>
                <p style="font-size:11px;color:#555;margin-top:2px;">{{ $tgl }}</p>
                <div class="ttd-garis"></div>
                <p><strong>{{ $d->nama_guru ?? '................................' }}</strong></p>
                <p style="font-size:10px;color:#555;">NIP. {{ $d->nip ?? '-' }}</p>
            </td>
        </tr>
    </table>

</body>
</html>
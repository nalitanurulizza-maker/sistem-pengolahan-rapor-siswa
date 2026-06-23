<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Rapor {{ $siswa->nama_siswa }}</title>
    <style>
        body { font-family: sans-serif; font-size: 13px; color: #222; }
        .header { text-align: center; margin-bottom: 10px; }
        .header h2 { margin: 0; font-size: 18px; }
        .header p { margin: 2px 0; font-size: 12px; }
        .info-table { width: 100%; margin-top: 15px; margin-bottom: 10px; font-size: 12px; }
        .info-table td { padding: 2px 4px; }
        table.nilai { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table.nilai th, table.nilai td { border: 1px solid #444; padding: 7px; text-align: center; }
        table.nilai th { background-color: #f2f2f2; }
        table.nilai td.mapel { text-align: left; }
        table.nilai tfoot td { font-weight: bold; background-color: #f7f7f7; }
        .predikat { font-weight: bold; }
        .footer-ttd { margin-top: 60px; width: 100%; }
        .footer-ttd td { text-align: center; vertical-align: top; font-size: 12px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Laporan Hasil Belajar (Rapor)</h2>
        <p>Tahun Ajaran {{ $tahunAjaran }}</p>
    </div>

    <table class="info-table">
        <tr>
            <td style="width: 12%;">Nama</td>
            <td style="width: 38%;">: {{ $siswa->nama_siswa }}</td>
            <td style="width: 12%;">Kelas</td>
            <td style="width: 38%;">: {{ $namaKelas }}</td>
        </tr>
        <tr>
            <td>NIS</td>
            <td>: {{ $siswa->nis }}</td>
            <td></td>
            <td></td>
        </tr>
    </table>

    <table class="nilai">
        <thead>
            <tr>
                <th style="width: 5%;">No</th>
                <th style="width: 45%;">Mata Pelajaran</th>
                <th style="width: 17%;">Nilai Akhir</th>
                <th style="width: 17%;">Predikat</th>
            </tr>
        </thead>
        <tbody>
            @forelse($nilai as $i => $n)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td class="mapel">{{ $n['nama_mp'] }}</td>
                <td>{{ $n['nilai_akhir'] ?? '-' }}</td>
                <td class="predikat">{{ $n['predikat'] }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4">Belum ada data nilai</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="2">Total Nilai Akhir</td>
                <td colspan="2">{{ $totalNilai }}</td>
            </tr>
            <tr>
                <td colspan="2">Rata-rata</td>
                <td colspan="2">{{ $rataRata }}</td>
            </tr>
            <tr>
                <td colspan="2">Predikat Rata-rata</td>
                <td colspan="2">{{ $predikatRata }}</td>
            </tr>
        </tfoot>
    </table>

    <table class="footer-ttd">
        <tr>
            <td style="width: 50%;"></td>
            <td style="width: 50%;">
                <p>Wali Kelas,</p>
                <br><br><br>
                <p><strong>{{ $d->nama_guru ?? '...' }}</strong></p>
            </td>
        </tr>
    </table>
</body>
</html>

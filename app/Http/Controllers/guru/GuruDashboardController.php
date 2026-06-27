<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Siswa;
use App\Models\Admin\TahunAkademik;
use App\Models\Admin\GuruPengampu;
use App\Models\Admin\Kelas;
use App\Models\Guru\Nilai;
use Barryvdh\DomPDF\Facade\Pdf;

class GuruDashboardController extends Controller
{
    // Bobot komponen nilai akhir per mata pelajaran.
    // Nilai harian diberi bobot lebih besar dibanding UTS/UAS.
    private const BOBOT_HARIAN = 0.40;
    private const BOBOT_UTS    = 0.30;
    private const BOBOT_UAS    = 0.30;

    // Helper untuk mengambil data guru
    private function getGuruAktif()
    {
        $user = Auth::user();
        $data = DB::table('guru')->where('nip', $user->username)->first()
                ?? (object) ['nama_guru' => $user->name, 'role' => 'guru', 'nip' => $user->username];

        $cekWalas = DB::table('kelas')->where('nip_guru', $data->nip)->first();
        $data->role = $cekWalas ? 'wali kelas' : 'guru';
        $data->nama_kelas_walas = $cekWalas ? $cekWalas->nama_kelas : '-';
        $data->kode_kelas_walas = $cekWalas ? $cekWalas->kode_kelas : null;
        return $data;
    }

    // Helper: tahun ajaran aktif (fallback ke tahun ajaran berjalan jika belum ada data master)
    private function getTahunAjaranAktif()
    {
        $aktif = TahunAkademik::where('status', 'Aktif')->first();
        return $aktif->nama_tahun ?? '2026/2027';
    }

    /**
     * Hitung nilai akhir satu mata pelajaran dari komponen harian, UTS, UAS.
     * Komponen yang belum diisi dianggap 0.
     */
    private function hitungNilaiAkhir($harian, $uts, $uas): float
    {
        $harian = is_numeric($harian) ? (float) $harian : 0;
        $uts    = is_numeric($uts)    ? (float) $uts    : 0;
        $uas    = is_numeric($uas)    ? (float) $uas    : 0;

        $akhir = ($harian * self::BOBOT_HARIAN)
               + ($uts * self::BOBOT_UTS)
               + ($uas * self::BOBOT_UAS);

        return round($akhir, 2);
    }

    /**
     * Tentukan predikat A/B/C/D dari nilai akhir.
     * A: 85-100, B: 75-84, C: 65-74, D: <65
     */
    private function hitungPredikat(float $nilaiAkhir): string
    {
        if ($nilaiAkhir >= 85) return 'A';
        if ($nilaiAkhir >= 75) return 'B';
        if ($nilaiAkhir >= 65) return 'C';
        return 'D';
    }

    /**
     * Pastikan user yang sedang login adalah wali kelas dari kode_kelas tertentu.
     * Mengembalikan data guru aktif jika valid, atau abort 403 jika bukan wali kelas kelas tsb.
     */
    private function pastikanWaliKelas(?string $kodeKelas = null)
    {
        $d = $this->getGuruAktif();

        if ($d->role !== 'wali kelas' || empty($d->kode_kelas_walas)) {
            abort(403, 'Halaman ini hanya untuk Wali Kelas.');
        }

        if ($kodeKelas !== null && $kodeKelas !== $d->kode_kelas_walas) {
            abort(403, 'Anda hanya dapat mengakses data kelas yang Anda wali-i.');
        }

        return $d;
    }

    /**
     * Ambil rekap nilai semua mata pelajaran untuk satu siswa,
     * lengkap dengan nilai akhir & predikat per mapel, total, dan rata-rata.
     */
    private function rekapNilaiSiswa(string $nis, string $tahunAjaran): array

    {

        // Cari kelas siswa

        $siswa = DB::table('siswa')->where('nis', $nis)->first();

        // Ambil mapel dari paket kelas siswa

        $paket = \App\Models\Admin\PaketMapel::where('kode_kelas', $siswa?->kode_kelas)

            ->where('tahun_ajaran', $tahunAjaran)

            ->with(['details.mataPelajaran'])

            ->first();

        // Fallback ke semua mapel jika paket belum diatur

        $mapel = $paket

            ? $paket->details->map(fn($d) => $d->mataPelajaran)->filter()->sortBy('nama_mp')

            : collect(DB::table('mata_pelajaran')->orderBy('nama_mp')->get());

        $nilaiPerMapel = Nilai::where('nis', $nis)

            ->where('tahun_ajaran', $tahunAjaran)

            ->get()

            ->keyBy('kode_mp');

        $rekap = [];

        $totalNilaiAkhir = 0;

        $jumlahMapelDinilai = 0;

        foreach ($mapel as $mp) {

            $n = $nilaiPerMapel->get($mp->kode_mp);

            $harian = $n->nilai_harian ?? null;

            $uts    = $n->nilai_uts    ?? null;

            $uas    = $n->nilai_uas    ?? null;

            $adaNilai   = $harian !== null || $uts !== null || $uas !== null;

            $nilaiAkhir = $adaNilai ? $this->hitungNilaiAkhir($harian, $uts, $uas) : null;

            $predikat   = $nilaiAkhir !== null ? $this->hitungPredikat($nilaiAkhir) : '-';

            if ($nilaiAkhir !== null) {

                $totalNilaiAkhir += $nilaiAkhir;

                $jumlahMapelDinilai++;

            }

            $rekap[] = [

                'kode_mp'      => $mp->kode_mp,

                'nama_mp'      => $mp->nama_mp,

                'nilai_harian' => $harian,

                'nilai_uts'    => $uts,

                'nilai_uas'    => $uas,

                'nilai_akhir'  => $nilaiAkhir,

                'predikat'     => $predikat,

            ];

        }

        $rataRata = $jumlahMapelDinilai > 0

            ? round($totalNilaiAkhir / $jumlahMapelDinilai, 2)

            : 0;

        return [

            'mapel'                => $rekap,

            'total_nilai_akhir'    => round($totalNilaiAkhir, 2),

            'rata_rata'            => $rataRata,

            'jumlah_mapel'         => count($rekap),

            'jumlah_mapel_dinilai' => $jumlahMapelDinilai,

        ];

    }

    // --- DASHBOARD ---
    public function index()
    {
        $data_guru_aktif = $this->getGuruAktif();

        $tahun_aktif = DB::table('tahun_akademik')->where('status', 'Aktif')->first();

        if ($tahun_aktif) {
            $tahun_ajaran = $tahun_aktif->nama_tahun;
            $semester_aktif = $tahun_aktif->semester;
        } else {
            $tahun_ajaran = '-';
            $semester_aktif = '-';
        }

        // 3. Ambil data plot mengajar guru sesuai tahun ajaran yang sedang aktif
        $plotMengajar = GuruPengampu::where('guru_id', $data_guru_aktif->nip)
                                    ->where('tahun_akademik', $tahun_ajaran)
                                    ->get();

        $kelasDiampu = $plotMengajar->pluck('kelas_id')->unique()->toArray();

        $rekapData = [
            'jumlahMapel'     => $plotMengajar->unique('kode_mp')->count(),
            'jumlahSiswa'     => DB::table('siswa')->whereIn('kode_kelas', $kelasDiampu)->count(),
            'nilaiSudahInput' => Nilai::whereIn('kode_mp', $plotMengajar->pluck('kode_mp'))->whereNotNull('nilai_akhir')->count() ?: 0,
            'nilaiBelumInput' => 0
        ];

        return view('guru.dashboard-guru', compact('rekapData', 'data_guru_aktif', 'tahun_ajaran', 'semester_aktif'));
    }

    // --- FITUR INPUT NILAI ---
    public function inputNilai(Request $request)
    {
        $d = $this->getGuruAktif();

        if ($request->ajax()) {
            $kolom = ['harian' => 'nilai_harian', 'uts' => 'nilai_uts', 'uas' => 'nilai_uas'][$request->jenis_nilai] ?? 'nilai_akhir';

            return response()->json(
                Siswa::where('kode_kelas', $request->kode_kelas)
                    ->with(['nilai' => fn($q) => $q->where('kode_mp', $request->kode_mp)])
                    ->get()
                    ->map(fn($s) => [
                        'nama_siswa'     => $s->nama_siswa,
                        'nis'            => $s->nis,
                        'nisn'           => $s->nisn ?? '-',
                        'nilai_sekarang' => $s->nilai->first()?->$kolom
                    ])
            );
        }

        $plot = GuruPengampu::with(['kelas', 'mapel'])
                ->where('guru_id', $d->nip)
                ->get();

        return view('guru.input-nilai', [
            'kelas'           => $plot->pluck('kelas')->unique('kode_kelas'),
            'mata_pelajaran'   => $plot->pluck('mapel')->unique('kode_mp'),
            'data_guru_aktif' => $d
        ]);
    }

    public function getMapelByKelas(Request $request)
    {
        $guru = $this->getGuruAktif();

        // Cari data kelas berdasarkan kode_kelas
        $kelas = Kelas::where('kode_kelas', $request->kode_kelas)->first();

        if (!$kelas) {
            return response()->json([]);
        }

        // Ambil mapel yang diampu guru pada kelas tersebut
        $mapel = GuruPengampu::with('mapel')
            ->where('guru_id', $guru->nip)
            ->where('kelas_id', $kelas->id)
            ->get()
            ->pluck('mapel')
            ->unique('kode_mp')
            ->values();

        return response()->json($mapel);
    }

    public function simpanNilaiBatch(Request $request)
    {
        $request->validate([
            'nilai'   => 'required|array',
            'kode_mp' => 'required',
        ]);

        $kolom = ['harian' => 'nilai_harian', 'uts' => 'nilai_uts', 'uas' => 'nilai_uas'][$request->jenis_nilai] ?? 'nilai_akhir';

        foreach ($request->nilai as $nis => $val) {
            if (is_null($val) || $val === '') {
                continue;
            }

            $existing = Nilai::where('nis', $nis)->where('kode_mp', $request->kode_mp)->first();

            if ($existing) {

            $existing->$kolom = $val;

            $existing->nilai_akhir = $this->hitungNilaiAkhir(
                $existing->nilai_harian,
                $existing->nilai_uts,
                $existing->nilai_uas
            );

            $existing->predikat = $this->hitungPredikat(
                $existing->nilai_akhir
            );

            $existing->save();

            } else {
            $nilai = Nilai::create([
                'kode_nilai'   => 'NL-' . $nis . '-' . $request->kode_mp,
                'nis'          => $nis,
                'kode_mp'      => $request->kode_mp,
                $kolom         => $val,
                'tahun_ajaran' => $this->getTahunAjaranAktif()
            ]);

            $nilai->nilai_akhir = $this->hitungNilaiAkhir(
                $nilai->nilai_harian,
                $nilai->nilai_uts,
                $nilai->nilai_uas
            );

            $nilai->predikat = $this->hitungPredikat(
                $nilai->nilai_akhir
            );

            $nilai->save();
            }
        }

        return response()->json(['success' => 'Data berhasil disimpan']);
    }

    // --- FITUR CEK NILAI ---
    public function cekNilai(Request $request)
    {
        $d = $this->getGuruAktif();

        if ($request->ajax()) {
            $kolom = ['harian' => 'nilai_harian', 'uts' => 'nilai_uts', 'uas' => 'nilai_uas'][$request->jenis_nilai] ?? 'nilai_akhir';

            return response()->json(
                Siswa::where('kode_kelas', $request->kode_kelas)
                    ->with(['nilai' => fn($q) => $q->where('kode_mp', $request->kode_mp)])
                    ->get()
                    ->map(fn($s) => [
                        'nama_siswa'     => $s->nama_siswa,
                        'nis'            => $s->nis,
                        'nisn'           => $s->nisn ?? '-',
                        'nilai_sekarang' => $s->nilai->first()?->$kolom,
                        'nilai_harian'   => $s->nilai->first()?->nilai_harian,
                        'nilai_uts'      => $s->nilai->first()?->nilai_uts,
                        'nilai_uas'      => $s->nilai->first()?->nilai_uas,
                    ])
            );
        }

        $plot = GuruPengampu::with(['kelas', 'mapel'])
                ->where('guru_id', $d->nip)
                ->get();

        return view('guru.cek-nilai', [
            'kelas'           => $plot->pluck('kelas')->unique('kode_kelas'),
            'mata_pelajaran'   => $plot->pluck('mapel')->unique('kode_mp'),
            'data_guru_aktif' => $d
        ]);
    }

    // --- RAPOR & NILAI AKHIR (GURU MATA PELAJARAN) ---
    public function rapor(Request $request)
    {
        $d = $this->getGuruAktif();

        if ($request->ajax() || $request->wantsJson()) {
            $tahunAjaran = $this->getTahunAjaranAktif();

            $data = Siswa::where('kode_kelas', $request->kode_kelas)
                ->orderBy('nama_siswa')
                ->get()
                ->map(function ($s) use ($request, $tahunAjaran) {
                    $n = Nilai::where('nis', $s->nis)
                        ->where('kode_mp', $request->kode_mp)
                        ->where('tahun_ajaran', $tahunAjaran)
                        ->first();

                    $harian = $n->nilai_harian ?? null;
                    $uts    = $n->nilai_uts ?? null;
                    $uas    = $n->nilai_uas ?? null;
                    $adaNilai = $harian !== null || $uts !== null || $uas !== null;
                    $akhir = $adaNilai ? $this->hitungNilaiAkhir($harian, $uts, $uas) : null;

                    return [
                        'nis'          => $s->nis,
                        'nama_siswa'   => $s->nama_siswa,
                        'nilai_harian' => $harian,
                        'nilai_uts'    => $uts,
                        'nilai_uas'    => $uas,
                        'nilai_akhir'  => $akhir,
                        'predikat'     => $akhir !== null ? $this->hitungPredikat($akhir) : null,
                    ];
                });

            return response()->json($data);
        }

        $plot = DB::table('plot_guru')
            ->join('kelas', 'plot_guru.kode_kelas', 'kelas.kode_kelas')
            ->join('mata_pelajaran', 'plot_guru.kode_mp', 'mata_pelajaran.kode_mp')
            ->where('plot_guru.nip', $d->nip)
            ->get();

        return view('guru.rapor', ['kelas' => $plot->unique('kode_kelas'), 'mata_pelajaran' => $plot->unique('kode_mp'), 'd' => $d]);
    }

    // Menghitung & menyimpan nilai_akhir + predikat untuk seluruh siswa pada kelas & mapel terpilih.
    public function prosesHitungNilaiAkhir(Request $request)
    {
        $request->validate([
            'kode_kelas' => 'required',
            'kode_mp'    => 'required',
        ]);

        $tahunAjaran = $this->getTahunAjaranAktif();
        $siswa = Siswa::where('kode_kelas', $request->kode_kelas)->get();
        $diproses = 0;

        foreach ($siswa as $s) {
            $n = Nilai::where('nis', $s->nis)
                ->where('kode_mp', $request->kode_mp)
                ->where('tahun_ajaran', $tahunAjaran)
                ->first();

            if (!$n) continue;
            if ($n->nilai_harian === null && $n->nilai_uts === null && $n->nilai_uas === null) continue;

            $akhir = $this->hitungNilaiAkhir($n->nilai_harian, $n->nilai_uts, $n->nilai_uas);

            $n->nilai_akhir = $akhir;
            $n->predikat    = $this->hitungPredikat($akhir);
            $n->save();

            $diproses++;
        }

        return response()->json(['success' => true, 'diproses' => $diproses]);
    }

    // ============================================================
    //  FITUR KHUSUS WALI KELAS: CEK RAPOR & CETAK RAPOR
    // ============================================================

    public function cekRapor(Request $request)
    {
        $d = $this->pastikanWaliKelas();
        $tahunAjaran = $this->getTahunAjaranAktif();

        if ($request->ajax() || $request->wantsJson()) {
            $siswa = Siswa::where('kode_kelas', $d->kode_kelas_walas)
                ->orderBy('nama_siswa')
                ->get()
                ->map(function ($s) use ($tahunAjaran) {
                    $rekap = $this->rekapNilaiSiswa($s->nis, $tahunAjaran);
                    return [
                        'nis'                  => $s->nis,
                        'nama_siswa'           => $s->nama_siswa,
                        'jumlah_mapel'         => $rekap['jumlah_mapel'],
                        'jumlah_mapel_dinilai' => $rekap['jumlah_mapel_dinilai'],
                        'total_nilai_akhir'    => $rekap['total_nilai_akhir'],
                        'rata_rata'            => $rekap['rata_rata'],
                    ];
                });

            return response()->json($siswa);
        }

        return view('guru.cek-rapor', [
            'data_guru_aktif' => $d,
            'nama_kelas'      => $d->nama_kelas_walas,
        ]);
    }

    public function detailRapor(Request $request, string $nis)
    {
        $d = $this->pastikanWaliKelas();
        $siswa = Siswa::where('nis', $nis)->where('kode_kelas', $d->kode_kelas_walas)->firstOrFail();
        $tahunAjaran = $this->getTahunAjaranAktif();
        $rekap = $this->rekapNilaiSiswa($siswa->nis, $tahunAjaran);

        return response()->json([
            'nis'        => $siswa->nis,
            'nama_siswa' => $siswa->nama_siswa,
        ] + $rekap);
    }

    public function cetakRapor(Request $request)
    {
        $d = $this->pastikanWaliKelas();

        $siswa = Siswa::where('kode_kelas', $d->kode_kelas_walas)
            ->orderBy('nama_siswa')
            ->get();

        return view('guru.cetak-rapor', [
            'data_guru_aktif' => $d,
            'nama_kelas'      => $d->nama_kelas_walas,
            'siswa'           => $siswa,
        ]);
    }

    public function cetakPdf(Request $request, string $nis)
    {
        $d = $this->pastikanWaliKelas();

        $siswa = Siswa::where('nis', $nis)->where('kode_kelas', $d->kode_kelas_walas)->firstOrFail();
        $tahunAjaran = $this->getTahunAjaranAktif();
        $rekap = $this->rekapNilaiSiswa($siswa->nis, $tahunAjaran);

        $pdf = Pdf::loadView('guru.cetak-pdf', [
            'siswa'        => $siswa,
            'nilai'        => collect($rekap['mapel']),
            'totalNilai'   => $rekap['total_nilai_akhir'],
            'rataRata'     => $rekap['rata_rata'],
            'namaKelas'    => $d->nama_kelas_walas,
            'tahunAjaran'  => $tahunAjaran,
            'd'            => $d,
        ])->setPaper('a4', 'portrait');

        $namaFile = 'Rapor_' . str_replace(' ', '_', $siswa->nama_siswa) . '_' . $siswa->nis . '.pdf';

        return $pdf->stream($namaFile);
    }
}
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
    private const BOBOT_HARIAN = 0.5;
    private const BOBOT_UTS    = 0.25;
    private const BOBOT_UAS    = 0.25;

    // ============================================================
    //  HELPERS
    // ============================================================

    private function getGuruAktif()
    {
        $user = Auth::user();
        $data = DB::table('guru')->where('nip', $user->username)->first()
                ?? (object) ['nama_guru' => $user->name, 'role' => 'guru', 'nip' => $user->username];

        $cekWalas = DB::table('kelas')->where('nip_guru', $data->nip)->first();
        $data->role             = $cekWalas ? 'wali kelas' : 'guru';
        $data->nama_kelas_walas = $cekWalas ? $cekWalas->nama_kelas : '-';
        $data->kode_kelas_walas = $cekWalas ? $cekWalas->kode_kelas : null;

        return $data;
    }

    private function getTahunAjaranAktif(): string
    {
        $aktif = TahunAkademik::where('status', 'Aktif')->first();
        return $aktif->nama_tahun ?? '2026/2027';
    }

    private function hitungNilaiAkhir($harian, $uts, $uas): float
    {
        $harian = is_numeric($harian) ? (float) $harian : 0;
        $uts    = is_numeric($uts)    ? (float) $uts    : 0;
        $uas    = is_numeric($uas)    ? (float) $uas    : 0;

        return round(
            ($harian * self::BOBOT_HARIAN) +
            ($uts    * self::BOBOT_UTS)    +
            ($uas    * self::BOBOT_UAS),
            2
        );
    }

    private function hitungPredikat(float $nilaiAkhir): string
    {
        if ($nilaiAkhir >= 85) return 'A';
        if ($nilaiAkhir >= 75) return 'B';
        if ($nilaiAkhir >= 65) return 'C';
        return 'D';
    }

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

    private function kolomNilai(string $jenis): string
    {
        return match($jenis) {
            'harian' => 'nilai_harian',
            'uts'    => 'nilai_uts',
            'uas'    => 'nilai_uas',
            default  => 'nilai_akhir',
        };
    }

    private function simpanAtauUpdateNilai(Nilai $nilai): void
    {
        $nilai->nilai_akhir = $this->hitungNilaiAkhir(
            $nilai->nilai_harian,
            $nilai->nilai_uts,
            $nilai->nilai_uas
        );
        $nilai->predikat = $this->hitungPredikat($nilai->nilai_akhir);
        $nilai->save();
    }

    private function rekapNilaiSiswa(string $nis, string $tahunAjaran): array
    {
        $siswa = DB::table('siswa')->where('nis', $nis)->first();

        $paket = \App\Models\Admin\PaketMapel::where('kode_kelas', $siswa?->kode_kelas)
            ->where('tahun_ajaran', $tahunAjaran)
            ->with(['details.mataPelajaran'])
            ->first();

        $mapel = $paket
            ? $paket->details->map(fn($d) => $d->mataPelajaran)->filter()->sortBy('nama_mp')
            : collect(DB::table('mata_pelajaran')->orderBy('nama_mp')->get());

        $nilaiPerMapel = Nilai::where('nis', $nis)
            ->where('tahun_ajaran', $tahunAjaran)
            ->get()
            ->keyBy('kode_mp');

        $rekap              = [];
        $totalNilaiAkhir    = 0;
        $jumlahMapelDinilai = 0;

        foreach ($mapel as $mp) {
            $n       = $nilaiPerMapel->get($mp->kode_mp);
            $harian  = $n->nilai_harian ?? null;
            $uts     = $n->nilai_uts    ?? null;
            $uas     = $n->nilai_uas    ?? null;
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
                'deskripsi'    => $nilaiAkhir !== null  
                        ? $this->generateDeskripsi($mp->nama_mp, $predikat)
                        : '-',
            ];
        }

        return [
            'mapel'                => $rekap,
            'total_nilai_akhir'    => round($totalNilaiAkhir, 2),
            'rata_rata'            => $jumlahMapelDinilai > 0
                                        ? round($totalNilaiAkhir / $jumlahMapelDinilai, 2)
                                        : 0,
            'jumlah_mapel'         => count($rekap),
            'jumlah_mapel_dinilai' => $jumlahMapelDinilai,
        ];
    }

    // ============================================================
    //  DASHBOARD
    // ============================================================

    public function index()
    {
        $data_guru_aktif = $this->getGuruAktif();

        $tahun_aktif    = DB::table('tahun_akademik')->where('status', 'Aktif')->first();
        $tahun_ajaran   = $tahun_aktif->nama_tahun ?? '-';
        $semester_aktif = $tahun_aktif->semester   ?? '-';

        $plotMengajar = GuruPengampu::where('guru_id', $data_guru_aktif->nip)
                                    ->where('tahun_akademik', $tahun_ajaran)
                                    ->get();

        $kelasIdDiampu  = $plotMengajar->pluck('kelas_id')->unique()->filter()->toArray();
        $kodeMpDiampu   = $plotMengajar->pluck('kode_mp')->unique()->filter()->toArray();

        $kodeKelasDiampu = DB::table('kelas')
            ->whereIn('id', $kelasIdDiampu)
            ->pluck('kode_kelas')
            ->toArray();

        $jumlahSiswa = count($kodeKelasDiampu) > 0
            ? DB::table('siswa')->whereIn('kode_kelas', $kodeKelasDiampu)->count()
            : 0;

        $nisSiswaKelas = DB::table('siswa')
            ->whereIn('kode_kelas', $kodeKelasDiampu)
            ->pluck('nis');

        $nilaiSudahInput = count($kodeMpDiampu) > 0 && $nisSiswaKelas->count() > 0
            ? Nilai::whereIn('kode_mp', $kodeMpDiampu)
                   ->whereIn('nis', $nisSiswaKelas)
                   ->whereNotNull('nilai_akhir')
                   ->count()
            : 0;

        $totalKombinasi  = $jumlahSiswa * count($kodeMpDiampu);
        $nilaiBelumInput = max(0, $totalKombinasi - $nilaiSudahInput);

        $rekapData = [
            'jumlahMapel'     => $plotMengajar->unique('kode_mp')->count(),
            'jumlahSiswa'     => $jumlahSiswa,
            'nilaiSudahInput' => $nilaiSudahInput,
            'nilaiBelumInput' => $nilaiBelumInput,
        ];

        $namaKelas = $data_guru_aktif->nama_kelas_walas ?? '-';

        return view('guru.dashboard-guru', compact(
            'rekapData', 'data_guru_aktif', 'tahun_ajaran', 'semester_aktif', 'namaKelas'
        ));
    }

    // ============================================================
    //  INPUT NILAI
    // ============================================================

    public function inputNilai(Request $request)
    {
        $d = $this->getGuruAktif();

        if ($request->ajax()) {
            $kolom = $this->kolomNilai($request->jenis_nilai);

            return response()->json(
                Siswa::where('kode_kelas', $request->kode_kelas)
                    ->with(['nilai' => fn($q) => $q->where('kode_mp', $request->kode_mp)])
                    ->get()
                    ->map(fn($s) => [
                        'nama_siswa'     => $s->nama_siswa,
                        'nis'            => $s->nis,
                        'nisn'           => $s->nisn ?? '-',
                        'nilai_sekarang' => $s->nilai->first()?->$kolom,
                    ])
            );
        }

        $plot = GuruPengampu::with(['kelas', 'mapel'])
                ->where('guru_id', $d->nip)
                ->get();

        return view('guru.input-nilai', [
            'kelas'           => $plot->pluck('kelas')->unique('kode_kelas'),
            'mata_pelajaran'  => $plot->pluck('mapel')->unique('kode_mp'),
            'data_guru_aktif' => $d,
        ]);
    }

    public function getMapelByKelas(Request $request)
    {
        $guru  = $this->getGuruAktif();
        $kelas = Kelas::where('kode_kelas', $request->kode_kelas)->first();

        if (!$kelas) {
            return response()->json([]);
        }

        $mapel = GuruPengampu::with('mapel')
            ->where('guru_id', $guru->nip)
            ->where('kelas_id', $kelas->id)
            ->get()
            ->pluck('mapel')
            ->unique('kode_mp')
            ->values();

        return response()->json($mapel);
    }

    /**
     * Simpan nilai massal (semua siswa sekaligus via modal).
     */
    public function simpanNilaiBatch(Request $request)
    {
        $request->validate([
            'nilai'      => 'required|array',
            'kode_mp'    => 'required',
            'jenis_nilai' => 'required|in:harian,uts,uas',
        ]);

        $kolom = $this->kolomNilai($request->jenis_nilai);

        foreach ($request->nilai as $nis => $val) {
            if (is_null($val) || $val === '') continue;

            $nilai = Nilai::firstOrNew(
                ['nis' => $nis, 'kode_mp' => $request->kode_mp],
                [
                    'kode_nilai'   => 'NL-' . $nis . '-' . $request->kode_mp,
                    'tahun_ajaran' => $this->getTahunAjaranAktif(),
                ]
            );

            $nilai->$kolom = $val;
            $this->simpanAtauUpdateNilai($nilai);
        }

        return response()->json(['success' => true, 'message' => 'Semua nilai berhasil disimpan']);
    }

   
    public function editNilai(Request $request)
    {
        $request->validate([
            'nis'         => 'required',
            'kode_mp'     => 'required',
            'jenis_nilai' => 'required|in:harian,uts,uas',
            'nilai'       => 'required|numeric|min:0|max:100',
        ]);

        $kolom = $this->kolomNilai($request->jenis_nilai);

        $nilai = Nilai::firstOrNew(
            ['nis' => $request->nis, 'kode_mp' => $request->kode_mp],
            [
                'kode_nilai'   => 'NL-' . $request->nis . '-' . $request->kode_mp,
                'tahun_ajaran' => $this->getTahunAjaranAktif(),
            ]
        );

        $nilai->$kolom = $request->nilai;
        $this->simpanAtauUpdateNilai($nilai);

        return response()->json(['success' => true, 'message' => 'Nilai berhasil diperbarui']);
    }


    public function hapusNilai(Request $request)
    {
        $request->validate([
            'nis'         => 'required',
            'kode_mp'     => 'required',
            'jenis_nilai' => 'required|in:harian,uts,uas',
        ]);

        $kolom = $this->kolomNilai($request->jenis_nilai);

        $nilai = Nilai::where('nis', $request->nis)
                      ->where('kode_mp', $request->kode_mp)
                      ->first();

        if (!$nilai) {
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        $nilai->$kolom = null;

        if ($nilai->nilai_harian === null && $nilai->nilai_uts === null && $nilai->nilai_uas === null) {
            $nilai->delete();
            return response()->json(['success' => true, 'message' => 'Data nilai dihapus seluruhnya']);
        }

        $this->simpanAtauUpdateNilai($nilai);

        return response()->json(['success' => true, 'message' => 'Nilai berhasil dihapus']);
    }

    // ============================================================
    //  CEK NILAI
    // ============================================================

    public function cekNilai(Request $request)
    {
        $d = $this->getGuruAktif();

        if ($request->ajax()) {
            $kolom = $this->kolomNilai($request->jenis_nilai);

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
            'mata_pelajaran'  => $plot->pluck('mapel')->unique('kode_mp'),
            'data_guru_aktif' => $d,
        ]);
    }

    // ============================================================
    //  RAPOR & NILAI AKHIR (GURU MATA PELAJARAN)
    // ============================================================

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

                    $harian   = $n->nilai_harian ?? null;
                    $uts      = $n->nilai_uts    ?? null;
                    $uas      = $n->nilai_uas    ?? null;
                    $adaNilai = $harian !== null || $uts !== null || $uas !== null;
                    $akhir    = $adaNilai ? $this->hitungNilaiAkhir($harian, $uts, $uas) : null;

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

        return view('guru.rapor', [
            'kelas'          => $plot->unique('kode_kelas'),
            'mata_pelajaran' => $plot->unique('kode_mp'),
            'd'              => $d,
        ]);
    }

    public function prosesHitungNilaiAkhir(Request $request)
    {
        $request->validate([
            'kode_kelas' => 'required',
            'kode_mp'    => 'required',
        ]);

        $tahunAjaran = $this->getTahunAjaranAktif();
        $siswa       = Siswa::where('kode_kelas', $request->kode_kelas)->get();
        $diproses    = 0;

        foreach ($siswa as $s) {
            $n = Nilai::where('nis', $s->nis)
                ->where('kode_mp', $request->kode_mp)
                ->where('tahun_ajaran', $tahunAjaran)
                ->first();

            if (!$n) continue;
            if ($n->nilai_harian === null && $n->nilai_uts === null && $n->nilai_uas === null) continue;

            $this->simpanAtauUpdateNilai($n);
            $diproses++;
        }

        return response()->json(['success' => true, 'diproses' => $diproses]);
    }

        private function generateDeskripsi(string $namaMapel, string $predikat): string
    {
        return match($predikat) {
            'A' => "Memiliki penguasaan yang sangat baik dalam mata pelajaran $namaMapel.",
            'B' => "Memiliki penguasaan yang baik dalam mata pelajaran $namaMapel.",
            'C' => "Memiliki penguasaan yang cukup baik dalam mata pelajaran $namaMapel.",
            'D' => "Perlu mendapat bimbingan lebih lanjut dalam mata pelajaran $namaMapel.",
            default => "-",
        };
    }

    // ============================================================
    //  FITUR KHUSUS WALI KELAS
    // ============================================================

    public function cekRapor(Request $request)
    {
        $d           = $this->pastikanWaliKelas();
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
        $d     = $this->pastikanWaliKelas();
        $siswa = Siswa::where('nis', $nis)
                      ->where('kode_kelas', $d->kode_kelas_walas)
                      ->firstOrFail();

        $rekap = $this->rekapNilaiSiswa($siswa->nis, $this->getTahunAjaranAktif());

        return response()->json([
            'nis'        => $siswa->nis,
            'nama_siswa' => $siswa->nama_siswa,
        ] + $rekap);
    }

    public function cetakRapor(Request $request)
    {
        $d     = $this->pastikanWaliKelas();
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
        $d     = $this->pastikanWaliKelas();
        $siswa = Siswa::where('nis', $nis)
                      ->where('kode_kelas', $d->kode_kelas_walas)
                      ->firstOrFail();

        $tahunAjaran = $this->getTahunAjaranAktif();
        $rekap       = $this->rekapNilaiSiswa($siswa->nis, $tahunAjaran);

        $pdf = Pdf::loadView('guru.cetak-pdf', [
            'siswa'       => $siswa,
            'nilai'       => collect($rekap['mapel']),
            'totalNilai'  => $rekap['total_nilai_akhir'],
            'rataRata'    => $rekap['rata_rata'],
            'namaKelas'   => $d->nama_kelas_walas,
            'tahunAjaran' => $tahunAjaran,
            'd'           => $d,
        ])->setPaper('a4', 'portrait');

        return $pdf->stream(
            'Rapor_' . str_replace(' ', '_', $siswa->nama_siswa) . '_' . $siswa->nis . '.pdf'
        );
    }
}
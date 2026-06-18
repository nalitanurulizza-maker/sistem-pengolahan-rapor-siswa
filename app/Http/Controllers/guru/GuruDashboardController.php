<?php

namespace App\Http\Controllers\Guru; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Siswa;
use App\Models\Guru\Nilai;

class GuruDashboardController extends Controller
{
    private function getGuruAktif()
    {
        $user = Auth::user();
        $data = DB::table('guru')->where('nip', $user->username)->first() 
                ?? (object) ['nama_guru' => $user->name, 'role' => 'guru', 'nip' => $user->username];

        $cekWalas = DB::table('kelas')->where('nip_guru', $data->nip)->first();
        $data->role = $cekWalas ? 'wali kelas' : 'guru';
        $data->nama_kelas_walas = $cekWalas ? $cekWalas->nama_kelas : '-';
        return $data;
    }

    public function index()
    {
        $data_guru_aktif = $this->getGuruAktif();
        $plotMengajar = DB::table('plot_guru')->where('nip', $data_guru_aktif->nip)->get();
        $kelasDiampu = $plotMengajar->pluck('kode_kelas')->unique()->toArray();
        
        $rekapData = [
            'jumlahMapel'     => $plotMengajar->unique('kode_mp')->count(),
            'jumlahSiswa'     => DB::table('siswa')->whereIn('kode_kelas', $kelasDiampu)->count(),
            'nilaiSudahInput' => Nilai::whereIn('kode_mp', $plotMengajar->pluck('kode_mp'))->whereNotNull('nilai_akhir')->count() ?: 0,
            'nilaiBelumInput' => 0 
        ];

        return view('guru.dashboard-guru', compact('rekapData', 'data_guru_aktif'));
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
        
        $plot = DB::table('plot_guru')
                ->join('kelas', 'plot_guru.kode_kelas', 'kelas.kode_kelas')
                ->join('mata_pelajaran', 'plot_guru.kode_mp', 'mata_pelajaran.kode_mp')
                ->where('plot_guru.nip', $d->nip)
                ->get();
                
        return view('guru.input-nilai', [
            'kelas'          => $plot->unique('kode_kelas'), 
            'mata_pelajaran' => $plot->unique('kode_mp'), 
            'd'              => $d
        ]);
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
                $existing->save();
            } else {
                Nilai::create([
                    'kode_nilai'   => 'NL-' . $nis . '-' . $request->kode_mp,
                    'nis'          => $nis,
                    'kode_mp'      => $request->kode_mp,
                    $kolom         => $val,
                    'tahun_ajaran' => '2026/2027'
                ]);
            }
        }

        return response()->json(['success' => 'Data berhasil disimpan']);
    }

    // --- FITUR ABSENSI & KEHADIRAN ---
    public function inputKehadiran(Request $request)
    {
        $d = $this->getGuruAktif();
        
        $plot = DB::table('plot_guru')
                ->join('kelas', 'plot_guru.kode_kelas', 'kelas.kode_kelas')
                ->join('mata_pelajaran', 'plot_guru.kode_mp', 'mata_pelajaran.kode_mp')
                ->where('plot_guru.nip', $d->nip)
                ->get();

        $siswa = [];
        if ($request->has('kode_kelas')) {
            $siswa = Siswa::where('kode_kelas', $request->kode_kelas)->get();
        }

        return view('guru.input-kehadiran', [
            'kelas'           => $plot->unique('kode_kelas'), 
            'mata_pelajaran'  => $plot->unique('kode_mp'), 
            'data_guru_aktif' => $d,
            'siswa'           => $siswa
        ]);
    }

    public function simpanKehadiran(Request $request)
    {
        foreach ($request->kehadiran as $nis => $status) {
            \App\Models\Guru\Absensi::updateOrCreate(
                [
                    'nis'            => $nis,
                    'tahun_akademik' => '2026/2027' 
                ],
                [
                    'jenis_kehadiran' => $status
                ]
            );
        }

        return redirect()->back()->with('success', 'Data kehadiran berhasil disimpan!');
    }

    public function simpanAbsensiSesi(Request $request)
    {
        foreach ($request->absensi as $nis => $status) {
            DB::table('absensi')->insert([
                'nis'             => $nis, 
                'jenis_kehadiran' => 'SESI:' . $request->kode_mp . ':' . $status, 
                'tahun_akademik'  => '2026/2027'
            ]);
        }
        return back()->with('success', 'Absensi sesi disimpan!');
    }

    public function simpanRekapMingguan(Request $request)
    {
        foreach ($request->rekap as $nis => $status) {
            DB::table('absensi')->updateOrInsert(
                [
                    'nis'             => $nis,
                    'tahun_ajaran'    => '2026/2027',
                    'jenis_kehadiran' => 'REKAP:' . $request->minggu_ke . ':' . $status
                ],
                [
                    'jenis_kehadiran' => 'REKAP:' . $request->minggu_ke . ':' . $status
                ]
            );
        }
        return back()->with('success', 'Rekap mingguan disimpan!');
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

        $plot = DB::table('plot_guru')
                ->join('kelas', 'plot_guru.kode_kelas', 'kelas.kode_kelas')
                ->join('mata_pelajaran', 'plot_guru.kode_mp', 'mata_pelajaran.kode_mp')
                ->where('plot_guru.nip', $d->nip)
                ->get();

        return view('guru.cek-nilai', [
            'kelas'           => $plot->unique('kode_kelas'), 
            'mata_pelajaran'  => $plot->unique('kode_mp'), 
            'data_guru_aktif' => $d
        ]); 
    }
}
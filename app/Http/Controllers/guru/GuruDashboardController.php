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
   
    public function index()
    {
        $user = Auth::user();

        $jumlahMapel     = DB::table('mata_pelajaran')->count() ?: 0;
        $jumlahSiswa     = Siswa::count() ?: 0; // Bermigrasi ke Model Siswa
        $nilaiSudahInput = Nilai::whereNotNull('nilai_akhir')->count() ?: 0; // Bermigrasi ke Model Nilai
        $totalTarget     = $jumlahSiswa * ($jumlahMapel ?: 1);
        $nilaiBelumInput = max(0, $totalTarget - $nilaiSudahInput);

        $rekapData = [
            'jumlahMapel'     => $jumlahMapel,
            'jumlahSiswa'     => $jumlahSiswa,
            'nilaiSudahInput' => $nilaiSudahInput,
            'nilaiBelumInput' => $nilaiBelumInput,
        ];

        $cekTahun = DB::table('tahun_akademik')->where('status', 'Aktif')->first()
                 ?? DB::table('tahun_akademik')->first();

        $tahunAkademik = (object) [
            'nama_tahun' => $cekTahun ? $cekTahun->nama_tahun : '2025/2026',
            'semester'   => $cekTahun ? $cekTahun->semester   : 'Genap',
        ];

        $namaKelas = '-';
        $userRole  = strtolower($user->role ?? '');

        // Pencarian data guru aktif berdasarkan Auth User Name
        $data_guru_aktif = DB::table('guru')->where('nama_guru', $user->name)->first();
        
        // SOLUSI AMAN: Jika data nama tidak sinkron antar-tabel, buat fallback objek agar sidebar tidak hilang/crash
        if (!$data_guru_aktif) {
            $data_guru_aktif = (object) [
                'nama_guru' => $user->name,
                'role'      => $user->role ?? 'guru',
                'nip'       => '-'
            ];
        }

        $userRole = strtolower($data_guru_aktif->role ?? $userRole);

        if ($userRole === 'walas') {
            $cekKelas  = DB::table('kelas')->first();
            $namaKelas = $cekKelas ? $cekKelas->nama_kelas : 'Kelas X-A';
        }

        return view('guru.dashboard-guru', compact('rekapData', 'tahunAkademik', 'namaKelas', 'data_guru_aktif'));
    }

    /**
     * PROSES FILTER DAN AMBIL DATA SISWA UNTUK INPUT NILAI (AJAX & VIEW)
     */
    public function inputNilai(Request $request)
    {
        $kelas          = DB::table('kelas')->get();
        $mata_pelajaran = DB::table('mata_pelajaran')->get();

        if ($request->has('kode_kelas')) {
            $kode_kelas  = $request->kode_kelas;
            $kode_mp     = $request->kode_mp;
            $jenis_nilai = strtolower($request->jenis_nilai ?? '');

            $kolomNilai = 'nilai_akhir';
            if ($jenis_nilai === 'harian')  { $kolomNilai = 'nilai_harian'; }
            elseif ($jenis_nilai === 'uts') { $kolomNilai = 'nilai_uts'; }
            elseif ($jenis_nilai === 'uas') { $kolomNilai = 'nilai_uas'; }

            // Menggunakan ELOQUENT MODEL: Menarik siswa aktif beserta relasi nilai spesifik mapel terkait
            $siswa = Siswa::where('kode_kelas', $kode_kelas)
                ->with(['nilai' => function ($query) use ($kode_mp) {
                    $query->where('kode_mp', $kode_mp);
                }])
                ->orderBy('nama_siswa', 'asc')
                ->get()
                ->map(function ($s) use ($kolomNilai) {
                    // Mapping data agar JSON output kompatibel penuh dengan skrip JavaScript di Blade bawaan
                    $nilaiSiswa = $s->nilai->first();
                    $s->nilai_sekarang = $nilaiSiswa ? $nilaiSiswa->$kolomNilai : null;
                    return $s;
                });

            return response()->json($siswa);
        }

        $user = Auth::user();
        $data_guru_aktif = DB::table('guru')->where('nama_guru', $user->name)->first();
        
        if (!$data_guru_aktif) {
            $data_guru_aktif = (object) ['nama_guru' => $user->name, 'role' => $user->role ?? 'guru', 'nip' => '-'];
        }

        return view('guru.input-nilai', compact('kelas', 'mata_pelajaran', 'data_guru_aktif'));
    }

    /**
     * AKSI SIMPAN DAN PEMBARUAN BATCH NILAI MENGGUNAKAN MODEL ELOQUENT
     */
    public function simpanNilaiBatch(Request $request)
    {
        $request->validate([
            'kode_kelas'  => 'required',
            'kode_mp'     => 'required',
            'jenis_nilai' => 'required',
            'nilai'       => 'nullable|array', 
        ]);

        $dataNilai = $request->nilai ?? [];
        if ($request->has('nis') && empty($dataNilai)) {
            $dataNilai = [$request->nis => null];
        }

        if (!empty($dataNilai)) {
            foreach ($dataNilai as $nis => $nilai_angka) {
                
                $kolomNilai = 'nilai_akhir';
                if (strtolower($request->jenis_nilai) == 'harian')     { $kolomNilai = 'nilai_harian'; }
                elseif (strtolower($request->jenis_nilai) == 'uts')    { $kolomNilai = 'nilai_uts'; }
                elseif (strtolower($request->jenis_nilai) == 'uas')    { $kolomNilai = 'nilai_uas'; }

                // MENGGUNAKAN MODEL NILAI: Mencari baris record data nilai lama siswa
                $exists = Nilai::where('nis', $nis)
                    ->where('kode_mp', $request->kode_mp)
                    ->first();

                if ($exists) {
                    $nilai_simpan = ($nilai_angka === null || $nilai_angka === '') ? null : $nilai_angka;
                    
                    // MENGGUNAKAN MODEL NILAI: Melakukan update record (Otomatis memanipulasi kolom updated_at)
                    $exists->update([
                        $kolomNilai => $nilai_simpan
                    ]);
                } else {
                    if ($nilai_angka === null || $nilai_angka === '') continue;

                    // MENGGUNAKAN MODEL NILAI: Melakukan insert data baru (Otomatis memanipulasi kolom created_at & updated_at)
                    Nilai::create([
                        'kode_nilai'   => 'NILAI-' . rand(1000, 9999) . '-' . $nis,
                        'nis'          => $nis,
                        'kode_mp'      => $request->kode_mp,
                        $kolomNilai    => $nilai_angka,
                        'tahun_ajaran' => '2025/2026',
                    ]);
                }
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'status'  => 'success', 
                'message' => 'Data nilai berhasil diperbarui via Model Eloquent.'
            ]);
        }

        return redirect()->back()->with('success', 'Data nilai siswa berhasil diperbarui!');
    }

    /**
     * FITUR CEK STATUS KELENGKAPAN 3 NILAI MENGGUNAKAN MODEL ELOQUENT
     */
    public function cekNilai(Request $request) 
    { 
        $kelas          = DB::table('kelas')->get();
        $mata_pelajaran = DB::table('mata_pelajaran')->get();

        if ($request->has('kode_kelas')) {
            $kode_kelas  = $request->kode_kelas;
            $kode_mp     = $request->kode_mp;
            $jenis_nilai = strtolower($request->jenis_nilai ?? '');

            $kolomNilai = 'nilai_akhir';
            if ($jenis_nilai === 'harian')  { $kolomNilai = 'nilai_harian'; }
            elseif ($jenis_nilai === 'uts') { $kolomNilai = 'nilai_uts'; }
            elseif ($jenis_nilai === 'uas') { $kolomNilai = 'nilai_uas'; }

            // MENGGUNAKAN MODEL SISWA: Erat dengan Eager Loading menjamin query jauh lebih efisien & aman
            $siswa = Siswa::where('kode_kelas', $kode_kelas)
                ->with(['nilai' => function ($query) use ($kode_mp) {
                    $query->where('kode_mp', $kode_mp);
                }])
                ->orderBy('nama_siswa', 'asc')
                ->get()
                ->map(function ($s) use ($kolomNilai) {
                    $nilaiSiswa = $s->nilai->first();
                    // Menyediakan semua field penentu indikator kelengkapan nilai (Harian, UTS, UAS) untuk JavaScript
                    $s->nilai_sekarang = $nilaiSiswa ? $nilaiSiswa->$kolomNilai : null;
                    $s->nilai_harian   = $nilaiSiswa ? $nilaiSiswa->nilai_harian : null;
                    $s->nilai_uts      = $nilaiSiswa ? $nilaiSiswa->nilai_uts : null;
                    $s->nilai_uas      = $nilaiSiswa ? $nilaiSiswa->nilai_uas : null;
                    return $s;
                });

            return response()->json($siswa);
        }

        $user = Auth::user();
        $data_guru_aktif = DB::table('guru')->where('nama_guru', $user->name)->first();
        
        if (!$data_guru_aktif) {
            $data_guru_aktif = (object) ['nama_guru' => $user->name, 'role' => $user->role ?? 'guru', 'nip' => '-'];
        }

        return view('guru.cek-nilai', compact('kelas', 'mata_pelajaran', 'data_guru_aktif')); 
    }

    public function inputKehadiran() { return view('guru.input-kehadiran'); }
    public function inputCatatan()   { return view('guru.input-catatan'); }
    public function inputPredikat()  { return view('guru.input-predikat'); }
    public function cetakRapor()     { return view('guru.cetak-rapor'); }
}
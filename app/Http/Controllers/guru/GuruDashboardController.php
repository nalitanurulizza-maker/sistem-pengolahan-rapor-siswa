<?php

namespace App\Http\Controllers\Guru; 

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GuruDashboardController extends Controller
{
    public function index()
    {
        // 1. Ambil data user yang sedang login saat ini
        $user = Auth::user();

        // 2. Hitung jumlah data master asli dari phpMyAdmin kamu
        $jumlahMapel = DB::table('mata_pelajaran')->count() ?: 0;
        $jumlahSiswa = DB::table('siswa')->count() ?: 0;

        // 3. Hitung rekap nilai (Sesuai kolom asli 'nilai_akhir' di image_f68e26.jpg)
        $nilaiSudahInput = DB::table('nilai')->whereNotNull('nilai_akhir')->count() ?: 0;

        // Kalkulasi sisa target input nilai (Jumlah Siswa x Jumlah Mapel)
        $totalTarget = $jumlahSiswa * ($jumlahMapel ?: 1);
        $nilaiBelumInput = max(0, $totalTarget - $nilaiSudahInput);

        $rekapData = [
            'jumlahMapel'     => $jumlahMapel,
            'jumlahSiswa'     => $jumlahSiswa,
            'nilaiSudahInput' => $nilaiSudahInput,
            'nilaiBelumInput' => $nilaiBelumInput,
        ];

        // 4. AMBIL DATA TAHUN AKADEMIK (Sudah sinkron dengan kolom SQL barumu!)
        $cekTahun = DB::table('tahun_akademik')->where('status', 'Aktif')->first() 
                 ?? DB::table('tahun_akademik')->first();
        
        $tahunAkademik = (object) [
            'nama_tahun' => $cekTahun ? $cekTahun->nama_tahun : '2025/2026',
            'semester'   => $cekTahun ? $cekTahun->semester : 'Genap'
        ];

        // 5. Atur Nama Kelas dinamis jika role-nya adalah 'walas'
        $namaKelas = '-';
        $userRole = strtolower($user->role ?? '');

        // Validasi silang ke tabel guru untuk memastikan rolenya ketat
        $dataGuruAsli = DB::table('guru')->where('nama_guru', $user->name)->first();
        if ($dataGuruAsli) {
            $userRole = strtolower($dataGuruAsli->role ?? $userRole);
        }

        if ($userRole === 'walas') {
            $cekKelas = DB::table('kelas')->first();
            $namaKelas = $cekKelas ? $cekKelas->nama_kelas : 'Kelas X-A';
        }

        // Kirimkan semua variabel bersih ke file Blade guru
        return view('guru.dashboard-guru', compact('rekapData', 'tahunAkademik', 'namaKelas'));
    }

    // Method pembantu rute fitur guru & walas agar link di sidebar tidak error 404
    public function inputNilai() { return view('guru.input-nilai'); }
    public function cekNilai() { return view('guru.cek-nilai'); }
    public function inputKehadiran() { return view('guru.input-kehadiran'); }
    public function inputCatatan() { return view('guru.input-catatan'); }
    public function inputPredikat() { return view('guru.input-predikat'); }
    public function cetakRapor() { return view('guru.cetak-rapor'); }
}
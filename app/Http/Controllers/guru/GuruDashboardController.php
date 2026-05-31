<?php

namespace App\Http\Controllers\Guru; // Kunci: Folder Guru dengan G kapital sesuai rute

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class GuruDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Suntik fungsi isWalas() dinamis ke objek User saat ini agar Blade tidak crash
        if (!method_exists($user, 'isWalas')) {
            $user->macro('isWalas', function () {
                return strtolower($this->role) === 'walas';
            });
        }

        // 2. Sediakan data Rekap Mengajar (Set nilai dummy/aman dulu agar tidak crash)
        $rekapData = [
            'jumlahMapel'     => 2, // Sesuaikan nanti dengan query tabel mengajar kamu
            'jumlahSiswa'     => 36,
            'nilaiSudahInput' => 0,
            'nilaiBelumInput' => 36,
        ];

        // 3. Sediakan objek Tahun Akademik tiruan agar Blade aman membaca properti
        $tahunAkademik = (object) [
            'nama_tahun' => '2025/2026',
            'semester'   => 'Genap'
        ];

        // 4. Sediakan nama kelas dummy jika login sebagai wali kelas
        $namaKelas = strtolower($user->role) === 'walas' ? 'Kelas X-A' : null;

        // Kirimkan semua variabel yang diminta oleh file Blade
        return view('guru.dashboard-guru', compact('rekapData', 'tahunAkademik', 'namaKelas'));
    }

    // Sediakan method kosong lainnya dari image_f7e098.png agar rute web.php tidak teriak error
    public function inputNilai() { return view('guru.input-nilai'); }
    public function cekNilai() { return view('guru.cek-nilai'); }
    public function inputKehadiran() { return view('guru.input-kehadiran'); }
    public function inputCatatan() { return view('guru.input-catatan'); }
    public function inputPredikat() { return view('guru.input-predikat'); }
    public function cetakRapor() { return view('guru.cetak-rapor'); }
}
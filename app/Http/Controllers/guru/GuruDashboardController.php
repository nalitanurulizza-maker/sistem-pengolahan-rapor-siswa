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
        $user = Auth::user();

        $jumlahMapel     = DB::table('mata_pelajaran')->count() ?: 0;
        $jumlahSiswa     = DB::table('siswa')->count() ?: 0;
        $nilaiSudahInput = DB::table('nilai')->whereNotNull('nilai_akhir')->count() ?: 0;
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

        $dataGuruAsli = DB::table('guru')->where('nama_guru', $user->name)->first();
        if ($dataGuruAsli) {
            $userRole = strtolower($dataGuruAsli->role ?? $userRole);
        }

        if ($userRole === 'walas') {
            $cekKelas  = DB::table('kelas')->first();
            $namaKelas = $cekKelas ? $cekKelas->nama_kelas : 'Kelas X-A';
        }

        return view('guru.dashboard-guru', compact('rekapData', 'tahunAkademik', 'namaKelas'));
    }

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

            $siswa = DB::table('siswa')
                ->leftJoin('nilai', function ($join) use ($kode_mp) {
                    $join->on('siswa.nis', '=', 'nilai.nis')
                         ->where('nilai.kode_mp', '=', $kode_mp);
                })
                ->where('siswa.kode_kelas', $kode_kelas)
                ->select('siswa.*', "nilai.{$kolomNilai} as nilai_sekarang")
                ->orderBy('siswa.nama_siswa', 'asc') // Urutkan nama siswa dari A sampai Z
                ->get();

            return response()->json($siswa);
        }

        return view('guru.input-nilai', compact('kelas', 'mata_pelajaran'));
    }

    public function simpanNilaiBatch(Request $request)
    {
        $request->validate([
            'kode_kelas'  => 'required',
            'kode_mp'     => 'required',
            'jenis_nilai' => 'required',
            'nilai'       => 'nullable|array', 
        ]);

        // Intersepsi otomatis jika request hapus datang dari tombol aksi tabel tunggal (membawa payload NIS)
        if ($request->has('nis') && !$request->has('nilai')) {
            $request->merge([
                'nilai' => [$request->nis => null]
            ]);
        }

        if ($request->nilai) {
            foreach ($request->nilai as $nis => $nilai_angka) {
                
                $kolomNilai = 'nilai_akhir';
                if (strtolower($request->jenis_nilai) == 'harian')     { $kolomNilai = 'nilai_harian'; }
                elseif (strtolower($request->jenis_nilai) == 'uts')    { $kolomNilai = 'nilai_uts'; }
                elseif (strtolower($request->jenis_nilai) == 'uas')    { $kolomNilai = 'nilai_uas'; }

                $exists = DB::table('nilai')
                    ->where('nis', $nis)
                    ->where('kode_mp', $request->kode_mp)
                    ->first();

                if ($exists) {
                    // Jika data ada di DB dan input bernilai kosong/null, ubah data di DB menjadi null (Aksi Hapus)
                    $nilai_simpan = ($nilai_angka === null || $nilai_angka === '') ? null : $nilai_angka;
                    
                    DB::table('nilai')
                        ->where('kode_nilai', $exists->kode_nilai)
                        ->update([$kolomNilai => $nilai_simpan, 'updated_at' => now()]);
                } else {
                    // Jika data tidak ada di DB dan input kosong, lewati (jangan buat record kosong baru)
                    if ($nilai_angka === null || $nilai_angka === '') continue;

                    DB::table('nilai')->insert([
                        'kode_nilai'   => 'NILAI-' . rand(1000, 9999) . '-' . $nis,
                        'nis'          => $nis,
                        'kode_mp'      => $request->kode_mp,
                        $kolomNilai    => $nilai_angka,
                        'tahun_ajaran' => '2025/2026',
                        'created_at'   => now(),
                        'updated_at'   => now(),
                    ]);
                }
            }
        }

        // Return response JSON jika dipicu oleh AJAX JavaScript (Hapus atau Simpan Massal tanpa reload)
        if ($request->ajax()) {
            return response()->json([
                'status' => 'success', 
                'message' => 'Data nilai berhasil diperbarui secara real-time.'
            ]);
        }

        // Fallback jika diakses melalui submit form standar biasa
        return redirect()->back()->with('success', 'Data nilai siswa berhasil diperbarui!');
    }

    public function cekNilai()       { return view('guru.cek-nilai'); }
    public function inputKehadiran() { return view('guru.input-kehadiran'); }
    public function inputCatatan()   { return view('guru.input-catatan'); }
    public function inputPredikat()  { return view('guru.input-predikat'); }
    public function cetakRapor()     { return view('guru.cetak-rapor'); }
}
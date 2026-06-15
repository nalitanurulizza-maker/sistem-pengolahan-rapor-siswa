<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Mapel;

class MapelController extends Controller
{
    /**
     * READ: Menampilkan semua data mata pelajaran ke tabel dengan batasan halaman & filter pencarian.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        if (class_exists('App\Models\Admin\Mapel')) {
            $data_mapel = Mapel::query()
                ->when($search, function ($query, $search) {
                    return $query->where(function ($q) use ($search) {
                        $q->where('kode_mp', 'LIKE', "%{$search}%")
                          ->orWhere('nama_mp', 'LIKE', "%{$search}%");
                    });
                })
                ->paginate(10);
        } else {
            $data_mapel = collect();
        }

        return view('admin.mata-pelajaran', compact('data_mapel'));
    }

    /**
     * CREATE: Menyimpan data mata pelajaran baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_mp' => 'required|string|unique:mata_pelajaran,kode_mp',
            'nama_mp' => 'required|string',
        ], [
            'kode_mp.unique' => 'Kode Mata Pelajaran sudah digunakan!',
        ]);

        Mapel::create([
            'kode_mp' => strtoupper($request->kode_mp),
            'nama_mp' => $request->nama_mp,
        ]);

        return redirect()->route('admin.data-mata-pelajaran')->with('success', 'Mata Pelajaran berhasil ditambahkan!');
    }

    /**
     * UPDATE: Memperbarui nama mata pelajaran lama.
     */
    public function update(Request $request, $kode_mp)
    {
        $request->validate([
            'nama_mp' => 'required|string',
        ]);

        $mapel = Mapel::where('kode_mp', $kode_mp)->firstOrFail();
        $mapel->update([
            'nama_mp' => $request->nama_mp,
        ]);

        return redirect()->route('admin.data-mata-pelajaran')->with('success', 'Mata Pelajaran berhasil diperbarui!');
    }

    /**
     * DELETE: Menghapus data mata pelajaran dari database.
     */
    public function destroy($kode_mp)
    {
        $mapel = Mapel::where('kode_mp', $kode_mp)->firstOrFail();
        $mapel->delete();

        return redirect()->route('admin.data-mata-pelajaran')->with('success', 'Mata Pelajaran berhasil dihapus!');
    }
}
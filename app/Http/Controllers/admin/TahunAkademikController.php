<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\TahunAkademikModel; // Panggil model Tahun Akademik

class TahunAkademikController extends Controller
{
    public function index()
    {
        $data_tahun = TahunAkademikModel::all();

        return view('admin.tahun-akademik', compact('data_tahun'));
    }
}
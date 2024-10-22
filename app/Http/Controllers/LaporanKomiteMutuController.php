<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LaporanKomiteMutuController extends Controller
{
    public function index()
    {
        return view('laporan_komite_mutu.index');
    }
}

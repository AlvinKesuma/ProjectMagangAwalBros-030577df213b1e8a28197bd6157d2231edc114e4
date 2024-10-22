<?php

namespace App\Http\Controllers;

use App\Models\PasienPemberianObat;
use Illuminate\Http\Request;

class PasienPemberianObatController extends Controller
{
    public function index()
    {
        $data = PasienPemberianObat::all();
        return view('pasien_pemberianobat.index', compact('data'));
    }

    public function create()
    {
        $units = ['R.Pucuk Puteri/Pucuk Rebung','Bunga Kiambang', 'Bunga Kesumba','Poliklinik','UGD', 'Pucuk Bersusun', 'Tampuk Manggis', 'Perinatologi','ICU/ICCU']; // Add more units if needed
        return view('pasien_pemberianobat.create', compact('units'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'unit' => 'required|string|max:255',
            'num' => 'required|numeric|between:0,100.0',
            'denum' => 'required|numeric|between:0,100.0',
            'month' => 'required|in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
            'year' => 'required|in:2023,2024',
        ]);

        PasienPemberianObat::create($validated);

        return redirect()->route('pasien-pemberianobat.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = PasienPemberianObat::findOrFail($id);
        $units = ['R.Pucuk Puteri/Pucuk Rebung','Bunga Kiambang', 'Bunga Kesumba','Poliklinik','UGD', 'Pucuk Bersusun', 'Tampuk Manggis', 'Perinatologi','ICU/ICCU']; // Same unit options
        return view('pasien_pemberianobat.edit', compact('data', 'units'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'unit' => 'required|string|max:255',
            'num' => 'required|numeric|between:0,100.0',
            'denum' => 'required|numeric|between:0,100.0',
            'month' => 'required|in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
            'year' => 'required|in:2023,2024',
        ]);

        $data = PasienPemberianObat::findOrFail($id);
        $data->update($validated);

        return redirect()->route('pasien-pemberianobat.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = PasienPemberianObat::findOrFail($id);
        $data->delete();

        return redirect()->route('pasien-pemberianobat.index')->with('success', 'Data berhasil dihapus.');
    }
}

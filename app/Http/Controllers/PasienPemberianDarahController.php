<?php

namespace App\Http\Controllers;

use App\Models\PasienPemberianDarah;
use Illuminate\Http\Request;

class PasienPemberianDarahController extends Controller
{
    public function index()
    {
        $data = PasienPemberianDarah::all();
        return view('pasien_pemberiandarah.index', compact('data'));
    }

    public function create()
    {
        $units = ['Lt.3','Bunga Kiambang', 'Bunga Kesumba', 'Pucuk Bersusun', 'Tampuk Manggis', 'Perinatologi','Intensif']; // Add more units if needed
        return view('pasien-pemberiandarah.create', compact('units'));
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

        PasienPemberianDarah::create($validated);

        return redirect()->route('pasien-pemberiandarah.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = PasienPemberianDarah::findOrFail($id);
        $units = ['Lt.3','Bunga Kiambang', 'Bunga Kesumba', 'Pucuk Bersusun', 'Tampuk Manggis', 'Perinatologi','Intensif']; // Same unit options
        return view('pasien-pemberiandarah.edit', compact('data', 'units'));
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

        $data = PasienPemberianDarah::findOrFail($id);
        $data->update($validated);

        return redirect()->route('pasien-pemberiandarah.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = PasienPemberianDarah::findOrFail($id);
        $data->delete();

        return redirect()->route('pasien-pemberiandarah.index')->with('success', 'Data berhasil dihapus.');
    }
}

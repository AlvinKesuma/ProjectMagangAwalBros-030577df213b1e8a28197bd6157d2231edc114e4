<?php

namespace App\Http\Controllers;

use App\Models\RehospitalisasiGeriatri;
use Illuminate\Http\Request;

class RehospitalisasiGeriatriController extends Controller
{
    public function index()
    {
        $data = RehospitalisasiGeriatri::all();
        return view('rehospitalisasi_geriatri.index', compact('data'));
    }

    public function create()
    {
        $unit = 'PPI';
        return view('rehospitalisasi_geriatri.create', compact('unit'));
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

        // Create a new entry
        RehospitalisasiGeriatri::create($validated);

        return redirect()->route('rehospitalisasi-geriatri.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = RehospitalisasiGeriatri::findOrFail($id);
        $unit = 'PPI';
        return view('rehospitalisasi_geriatri.edit', compact('data', 'unit'));
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

        // Find the existing entry and update it
        $data = RehospitalisasiGeriatri::findOrFail($id);
        $data->update($validated);

        return redirect()->route('rehospitalisasi-geriatri.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = RehospitalisasiGeriatri::findOrFail($id);
        $data->delete();

        return redirect()->route('rehospitalisasi-geriatri.index')->with('success', 'Data berhasil dihapus.');
    }
}

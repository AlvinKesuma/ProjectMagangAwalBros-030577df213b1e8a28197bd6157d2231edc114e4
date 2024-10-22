<?php

namespace App\Http\Controllers;

use App\Models\PenundaanOperasiElectif30Min;
use Illuminate\Http\Request;

class PenundaanOperasiElectif30MinController extends Controller
{
    public function index()
    {
        $data = PenundaanOperasiElectif30Min::all();
        return view('penundaan_operasi_electif_30Min.index', compact('data'));
    }

    public function create()
    {
        $unit = 'Kamar Bedah';
        return view('penundaan_operasi_electif_30Min.create', compact('unit'));
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
        PenundaanOperasiElectif30Min::create($validated);

        return redirect()->route('penundaan-operasi-electif-30min.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = PenundaanOperasiElectif30Min::findOrFail($id);
        $unit = 'Kamar Bedah';
        return view('penundaan_operasi_electif_30Min.edit', compact('data', 'unit'));
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
        $data = PenundaanOperasiElectif30Min::findOrFail($id);
        $data->update($validated);

        return redirect()->route('penundaan-operasi-electif-30min.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = PenundaanOperasiElectif30Min::findOrFail($id);
        $data->delete();

        return redirect()->route('penundaan-operasi-electif-30min.index')->with('success', 'Data berhasil dihapus.');
    }
}

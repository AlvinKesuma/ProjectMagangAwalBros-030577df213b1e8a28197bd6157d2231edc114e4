<?php

namespace App\Http\Controllers;
use App\Models\PengelolaanKomplainPasien;
use Illuminate\Http\Request;

class PengelolaanKomplainPasienController extends Controller
{
    public function index()
    {
        $data = PengelolaanKomplainPasien::all();
        return view('pengelolaan_komplain_pasien.index', compact('data'));
    }

    public function create()
    {
        $unit = 'PPI';
        return view('pengelolaan_komplain_pasien.create', compact('unit'));
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
        PengelolaanKomplainPasien::create($validated);

        return redirect()->route('pengelolaan-komplain-pasien.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = PengelolaanKomplainPasien::findOrFail($id);
        $unit = 'PPI';
        return view('pengelolaan_komplain_pasien.edit', compact('data', 'unit'));
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
        $data = PengelolaanKomplainPasien::findOrFail($id);
        $data->update($validated);

        return redirect()->route('pengelolaan-komplain-pasien.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = PengelolaanKomplainPasien::findOrFail($id);
        $data->delete();

        return redirect()->route('pengelolaan-komplain-pasien.index')->with('success', 'Data berhasil dihapus.');
    }
}

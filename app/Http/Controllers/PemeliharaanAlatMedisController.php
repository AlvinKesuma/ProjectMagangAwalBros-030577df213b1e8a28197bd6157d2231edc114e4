<?php

namespace App\Http\Controllers;
use App\Models\PemeliharaanAlatMedis;
use Illuminate\Http\Request;

class PemeliharaanAlatMedisController extends Controller
{
    public function index()
    {
        $data = PemeliharaanAlatMedis::all();
        return view('pemeliharaan_alat_medis.index', compact('data'));
    }

    public function create()
    {
        $unit = 'Kamar Bedah';
        return view('pemeliharaan_alat_medis.create', compact('unit'));
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
        PemeliharaanAlatMedis::create($validated);

        return redirect()->route('pemeliharaan-alat-medis.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = PemeliharaanAlatMedis::findOrFail($id);
        $unit = 'Atem';
        return view('pemeliharaan_alat_medis.edit', compact('data', 'unit'));
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
        $data = PemeliharaanAlatMedis::findOrFail($id);
        $data->update($validated);

        return redirect()->route('pemeliharaan-alat-medis.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = PemeliharaanAlatMedis::findOrFail($id);
        $data->delete();

        return redirect()->route('pemeliharaan-alat-medis.index')->with('success', 'Data berhasil dihapus.');
    }
}

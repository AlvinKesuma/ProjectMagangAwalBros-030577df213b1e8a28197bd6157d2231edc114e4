<?php

namespace App\Http\Controllers;
use App\Models\KelengkapanResepRawatJalan;
use Illuminate\Http\Request;

class KelengkapanResepRawatJalanController extends Controller
{
    public function index()
    {
        $data = KelengkapanResepRawatJalan::all();
        return view('kelengkapan_resep_rawat_jalan.index', compact('data'));
    }

    public function create()
    {
        $unit = 'PPI';
        return view('kelengkapan_resep_rawat_jalan.create', compact('unit'));
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

        if ($validated['year'] == '2024') {
            $numdenum = ($validated['num'] / $validated['denum']) * 100;
            $validated['numdenum'] = $numdenum;
        } else {
            $validated['numdenum'] = '-';
        }

        // Create a new entry
        KelengkapanResepRawatJalan::create($validated);

        return redirect()->route('kelengkapan-resep-rawat-jalan.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = KelengkapanResepRawatJalan::findOrFail($id);
        $unit = 'Farmasi';
        return view('kelengkapan_resep_rawat_jalan.edit', compact('data', 'unit'));
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

        if ($validated['year'] == '2024') {
            $numdenum = ($validated['num'] / $validated['denum']) * 100;
            $validated['numdenum'] = $numdenum;
        } else {
            $validated['numdenum'] = '-';
        }

        // Find the existing entry and update it
        $data = KelengkapanResepRawatJalan::findOrFail($id);
        $data->update($validated);

        return redirect()->route('kelengkapan-resep-rawat-jalan.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = KelengkapanResepRawatJalan::findOrFail($id);
        $data->delete();

        return redirect()->route('kelengkapan-resep-rawat-jalan.index')->with('success', 'Data berhasil dihapus.');
    }
}


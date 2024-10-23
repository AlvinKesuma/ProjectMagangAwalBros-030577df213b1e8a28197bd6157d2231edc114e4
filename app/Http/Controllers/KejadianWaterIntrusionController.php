<?php

namespace App\Http\Controllers;
use App\Models\KejadianWaterIntrusion;
use Illuminate\Http\Request;

class KejadianWaterIntrusionController extends Controller
{
    public function index()
    {
        $data = KejadianWaterIntrusion::all();
        return view('kejadian_water_intrusion.index', compact('data'));
    }

    public function create()
    {
        $unit = 'Mntc';
        return view('kejadian_water_intrusion.create', compact('unit'));
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
        KejadianWaterIntrusion::create($validated);

        return redirect()->route('kejadian-water-intrusion.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = KejadianWaterIntrusion::findOrFail($id);
        $unit = 'Kamar Bedah';
        return view('kejadian_water_intrusion.edit', compact('data', 'unit'));
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
        $data = KejadianWaterIntrusion::findOrFail($id);
        $data->update($validated);

        return redirect()->route('kejadian-water-intrusion.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = KejadianWaterIntrusion::findOrFail($id);
        $data->delete();

        return redirect()->route('kejadian-water-intrusion.index')->with('success', 'Data berhasil dihapus.');
    }
}

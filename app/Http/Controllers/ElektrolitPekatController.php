<?php

namespace App\Http\Controllers;

use App\Models\ElektrolitPekat;
use Illuminate\Http\Request;

class ElektrolitPekatController extends Controller
{
    public function index()
    {
        $data = ElektrolitPekat::all();
        return view('elektrolit_pekat.index', compact('data'));
    }

    public function create()
    {
        $units = ['PPI', 'Kamar Bedah', 'ICU', 'Rawat Inap', 'UGD']; // Add more units if needed
        return view('elektrolit_pekat.create', compact('units'));
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

        ElektrolitPekat::create($validated);

        return redirect()->route('elektrolit-pekat.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = ElektrolitPekat::findOrFail($id);
        $units = ['Lt.3','Bunga Kiambang', 'Bunga Kesumba', 'Pucuk Bersusun', 'Tampuk Manggis', 'Perinatologi','Intensif']; // Same unit options
        return view('elektrolit_pekat.edit', compact('data', 'units'));
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

        $data = ElektrolitPekat::findOrFail($id);
        $data->update($validated);

        return redirect()->route('elektrolit-pekat.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = ElektrolitPekat::findOrFail($id);
        $data->delete();

        return redirect()->route('elektrolit-pekat.index')->with('success', 'Data berhasil dihapus.');
    }
}

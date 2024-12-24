<?php

namespace App\Http\Controllers;

use App\Models\LaporanKomiteMutu;
use Illuminate\Http\Request;

class ElektrolitPekatController extends Controller
{
    public function index()
    {
        $data = LaporanKomiteMutu::all();
        return view('elektrolit_pekat.index', compact('data'));
    }

    public function create()
    {
        $units = ['PPI', 'Kamar Bedah', 'ICU', 'Rawat Inap', 'UGD'];
        return view('elektrolit_pekat.create', compact('units'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'indikatorMutu' => 'nullable|string',
            'unit' => 'required|string|max:255',
            'num' => 'required|numeric|between:0,100.0',
            'denum' => 'required|numeric|between:0,100.0',
            'bulan' => 'required|in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
            'tahun' => 'required|numeric',
        ]);

        $tahun_2024 = ($validated['num'] / $validated['denum']) * 100;
        $validated['tahun_2024'] = $tahun_2024;

        LaporanKomiteMutu::create($validated);

        return redirect()->route('elektrolit-pekat.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = LaporanKomiteMutu::findOrFail($id);
        $units = ['Lt.3','Bunga Kiambang', 'Bunga Kesumba', 'Pucuk Bersusun', 'Tampuk Manggis', 'Perinatologi','Intensif']; // Same unit options
        return view('elektrolit_pekat.edit', compact('data', 'units'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'indikatorMutu' => 'nullable|string',
            'unit' => 'required|string|max:255',
            'num' => 'required|numeric|between:0,100.0',
            'denum' => 'required|numeric|between:0,100.0',
            'bulan' => 'required|in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
            'tahun' => 'required|numeric',
        ]);

        $tahun_2024 = ($validated['num'] / $validated['denum']) * 100;
        $validated['tahun_2024'] = $tahun_2024;

        $data = LaporanKomiteMutu::findOrFail($id);
        $data->update($validated);

        return redirect()->route('elektrolit-pekat.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = LaporanKomiteMutu::findOrFail($id);
        $data->delete();

        return redirect()->route('elektrolit-pekat.index')->with('success', 'Data berhasil dihapus.');
    }
}

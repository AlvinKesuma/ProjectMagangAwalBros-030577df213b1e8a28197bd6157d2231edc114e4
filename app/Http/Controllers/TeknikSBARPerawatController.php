<?php

namespace App\Http\Controllers;

use App\Models\TeknikSBARPerawat;
use Illuminate\Http\Request;

class TeknikSBARPerawatController extends Controller
{
    public function index()
    {
        $data = TeknikSBARPerawat::all();
        return view('tekniksbar_perawat.index', compact('data'));
    }

    public function create()
    {
        $units = ['Lt.3','Bunga Kiambang', 'Bunga Kesumba', 'Pucuk Bersusun', 'Tampuk Manggis']; // Add more units if needed
        return view('tekniksbar_perawat.create', compact('units'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'unit' => 'required|string|max:255',
            'num' => 'required|numeric|between:0,100.0',
            'denum' => 'required|numeric|between:0,100.0',
            'month' => 'required|in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
            'tahun_2023' => 'required|numeric|between:0,100.0',
        ]);

        $tahun_2024 = ($validated['num'] / $validated['denum']) * 100;
        $validated['tahun_2024'] = $tahun_2024;

        TeknikSBARPerawat::create($validated);

        return redirect()->route('tekniksbar-perawat.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = TeknikSBARPerawat::findOrFail($id);
        $units = ['Lt.3','Bunga Kiambang', 'Bunga Kesumba', 'Pucuk Bersusun', 'Tampuk Manggis']; // Same unit options
        return view('tekniksbar_perawat.edit', compact('data', 'units'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'unit' => 'required|string|max:255',
            'num' => 'required|numeric|between:0,100.0',
            'denum' => 'required|numeric|between:0,100.0',
            'month' => 'required|in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
            'tahun_2023' => 'required|numeric|between:0,100.0',
        ]);

        $tahun_2024 = ($validated['num'] / $validated['denum']) * 100;
        $validated['tahun_2024'] = $tahun_2024;

        $data = TeknikSBARPerawat::findOrFail($id);
        $data->update($validated);

        return redirect()->route('tekniksbar-perawat.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = TeknikSBARPerawat::findOrFail($id);
        $data->delete();

        return redirect()->route('tekniksbar-perawat.index')->with('success', 'Data berhasil dihapus.');
    }
}

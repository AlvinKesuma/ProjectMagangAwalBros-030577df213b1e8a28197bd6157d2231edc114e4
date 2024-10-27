<?php

namespace App\Http\Controllers;
use App\Models\KepatuhanVAP;
use Illuminate\Http\Request;

class KepatuhanVAPController extends Controller
{
    public function index()
    {
        $data = KepatuhanVAP::all()->map(function ($item) {
            $item->growth = $item->tahun_2023 != 0 
                ? number_format((($item->tahun_2024 / $item->tahun_2023 - 1) * 100), 1) 
                : 0;
            return $item;
        });
        return view('kepatuhan_vap.index', compact('data'));
    }

    public function create()
    {
        $unit = 'PPI';
        return view('kepatuhan_vap.create', compact('unit'));
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

        // Create a new entry
        KepatuhanVAP::create($validated);

        return redirect()->route('kepatuhan-vap.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = KepatuhanVAP::findOrFail($id);
        $unit = 'PPI';
        return view('kepatuhan_vap.edit', compact('data', 'unit'));
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

        // Find the existing entry and update it
        $data = KepatuhanVAP::findOrFail($id);
        $data->update($validated);

        return redirect()->route('kepatuhan-vap.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = KepatuhanVAP::findOrFail($id);
        $data->delete();

        return redirect()->route('kepatuhan-vap.index')->with('success', 'Data berhasil dihapus.');
    }
}

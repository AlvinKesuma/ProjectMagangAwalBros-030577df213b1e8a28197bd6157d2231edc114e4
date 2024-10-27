<?php

namespace App\Http\Controllers;

use App\Models\KepatuhanVisitDokterSpesialis;
use Illuminate\Http\Request;

class KepatuhanVisitDokterSpesialisController extends Controller
{
    public function index()
    {
        $data = KepatuhanVisitDokterSpesialis::all()->map(function ($item) {
            $item->growth = $item->tahun_2023 != 0 
                ? number_format((($item->tahun_2024 / $item->tahun_2023 - 1) * 100), 1) 
                : 0;
            return $item;
        });
        return view('kepatuhan_visit_dokter_spesialis.index', compact('data'));
    }

    public function create()
    {
        $unit = 'SOD';
        return view('kepatuhan_visit_dokter_spesialis.create', compact('unit'));
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
        KepatuhanVisitDokterSpesialis::create($validated);

        return redirect()->route('kepatuhan-visit-dokter-spesialis.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = KepatuhanVisitDokterSpesialis::findOrFail($id);
        $unit = 'SOD';
        return view('kepatuhan_visit_dokter_spesialis.edit', compact('data', 'unit'));
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
        $data = KepatuhanVisitDokterSpesialis::findOrFail($id);
        $data->update($validated);

        return redirect()->route('kepatuhan-visit-dokter-spesialis.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = KepatuhanVisitDokterSpesialis::findOrFail($id);
        $data->delete();

        return redirect()->route('kepatuhan-visit-dokter-spesialis.index')->with('success', 'Data berhasil dihapus.');
    }
}

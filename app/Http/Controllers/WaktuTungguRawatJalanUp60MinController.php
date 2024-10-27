<?php

namespace App\Http\Controllers;

use App\Models\WaktuTungguRawatJalanUp60Min;
use Illuminate\Http\Request;

class WaktuTungguRawatJalanUp60MinController extends Controller
{
    public function index()
    {
        $data = WaktuTungguRawatJalanUp60Min::all()->map(function ($item) {
            $item->growth = $item->tahun_2023 != 0 
                ? number_format((($item->tahun_2024 / $item->tahun_2023 - 1) * 100), 1) 
                : 0;
            return $item;
        });
        return view('waktu_tunggu_rawat_jalan_up60min.index', compact('data'));
    }

    public function create()
    {
        $unit = 'Mutu';
        return view('waktu_tunggu_rawat_jalan_up60min.create', compact('unit'));
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
        WaktuTungguRawatJalanUp60Min::create($validated);

        return redirect()->route('waktu-rawat-jalan-up60min.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = WaktuTungguRawatJalanUp60Min::findOrFail($id);
        $unit = 'Mutu';
        return view('waktu_tunggu_rawat_jalan_up60min.edit', compact('data', 'unit'));
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
        $data = WaktuTungguRawatJalanUp60Min::findOrFail($id);
        $data->update($validated);

        return redirect()->route('waktu-rawat-jalan-up60min.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = WaktuTungguRawatJalanUp60Min::findOrFail($id);
        $data->delete();

        return redirect()->route('waktu-rawat-jalan-up60min.index')->with('success', 'Data berhasil dihapus.');
    }
}



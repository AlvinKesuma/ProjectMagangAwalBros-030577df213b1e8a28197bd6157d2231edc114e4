<?php

namespace App\Http\Controllers;

use App\Models\WaktuTungguRawatJalanUnder30Min;
use Illuminate\Http\Request;

class WaktuTungguRawatJalanUnder30MinController extends Controller
{
    public function index()
    {
        $data = WaktuTungguRawatJalanUnder30Min::all();
        return view('waktu_tunggu_rawat_jalan_under30min.index', compact('data'));
    }

    public function create()
    {
        $unit = 'Mutu';
        return view('waktu_tunggu_rawat_jalan_under30min.create', compact('unit'));
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
        WaktuTungguRawatJalanUnder30Min::create($validated);

        return redirect()->route('waktu-rawat-jalan-under30min.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = WaktuTungguRawatJalanUnder30Min::findOrFail($id);
        $unit = 'Mutu';
        return view('waktu_tunggu_rawat_jalan_under30min.edit', compact('data', 'unit'));
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
        $data = WaktuTungguRawatJalanUnder30Min::findOrFail($id);
        $data->update($validated);

        return redirect()->route('waktu-rawat-jalan-under30min.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = WaktuTungguRawatJalanUnder30Min::findOrFail($id);
        $data->delete();

        return redirect()->route('waktu-rawat-jalan-under30min.index')->with('success', 'Data berhasil dihapus.');
    }
}



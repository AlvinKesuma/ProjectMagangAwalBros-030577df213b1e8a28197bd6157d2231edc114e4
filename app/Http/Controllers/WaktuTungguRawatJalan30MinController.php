<?php

namespace App\Http\Controllers;

use App\Models\WaktuTungguRawatJalan30Min;
use Illuminate\Http\Request;

class WaktuTungguRawatJalan30MinController extends Controller
{
    public function index()
    {
        $data = WaktuTungguRawatJalan30Min::all();
        return view('waktu_tunggu_rawat_jalan_30Min.index', compact('data'));
    }

    public function create()
    {
        $unit = 'Mutu';
        return view('waktu_tunggu_rawat_jalan_30Min.create', compact('unit'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'unit' => 'required|string|max:255',
            'month' => 'required|in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
            'tahun_2024' => 'required|numeric|between:0,100.0',
        ]);

        // Create a new entry
        WaktuTungguRawatJalan30Min::create($validated);

        return redirect()->route('waktu-tunggu-rawat-jalan-30min.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = WaktuTungguRawatJalan30Min::findOrFail($id);
        $unit = 'Mutu';
        return view('waktu_tunggu_rawat_jalan_30Min.edit', compact('data', 'unit'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'unit' => 'required|string|max:255',
            'month' => 'required|in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
            'tahun_2024' => 'required|numeric|between:0,100.0',
        ]);

        // Find the existing entry and update it
        $data = WaktuTungguRawatJalan30Min::findOrFail($id);
        $data->update($validated);

        return redirect()->route('waktu-tunggu-rawat-jalan-30min.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = WaktuTungguRawatJalan30Min::findOrFail($id);
        $data->delete();

        return redirect()->route('waktu-tunggu-rawat-jalan-30min.index')->with('success', 'Data berhasil dihapus.');
    }
}


<?php

namespace App\Http\Controllers;

use App\Models\WaktuTungguRawatJalanUp60Min;
use Illuminate\Http\Request;

class WaktuTungguRawatJalanUp60MinController extends Controller
{
    public function index()
    {
        $data = WaktuTungguRawatJalanUp60Min::all();
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
            'year' => 'required|in:2023,2024', 
        ]);

        if ($validated['year'] == '2024') {
            $numdenum = ($validated['num'] / $validated['denum']) * 100;
            $validated['numdenum'] = $numdenum;
        } else {
            $validated['numdenum'] = '-';
        }

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
            'year' => 'required|in:2023,2024', 
        ]);

        if ($validated['year'] == '2024') {
            $numdenum = ($validated['num'] / $validated['denum']) * 100;
            $validated['numdenum'] = $numdenum;
        } else {
            $validated['numdenum'] = '-';
        }

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



<?php

namespace App\Http\Controllers;

use App\Models\PembuanganObatNarkotika;
use Illuminate\Http\Request;

class PembuanganObatNarkotikaController extends Controller
{
    public function index()
    {
        $data = PembuanganObatNarkotika::all();
        return view('pembuangan_obatnarkotika.index', compact('data'));
    }

    public function create()
    {
        $unit = 'Farmasi'; 
        return view('pembuangan_obatnarkotika.create', compact('unit'));
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

        PembuanganObatNarkotika::create($validated);

        return redirect()->route('pembuangan-obatnarkotika.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = PembuanganObatNarkotika::findOrFail($id);
        $unit = 'Kamar Bedah'; 
        return view('pembuangan_obatnarkotika.edit', compact('data', 'unit'));
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

        $data = PembuanganObatNarkotika::findOrFail($id);
        $data->update($validated);

        return redirect()->route('pembuangan-obatnarkotika.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = PembuanganObatNarkotika::findOrFail($id);
        $data->delete();

        return redirect()->route('pembuangan-obatnarkotika.index')->with('success', 'Data berhasil dihapus.');
    }
}

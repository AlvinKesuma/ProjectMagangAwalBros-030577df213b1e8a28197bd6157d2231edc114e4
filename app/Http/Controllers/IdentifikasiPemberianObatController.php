<?php

namespace App\Http\Controllers;

use App\Models\IdentifikasiPemberianObat;
use Illuminate\Http\Request;

class IdentifikasiPemberianObatController extends Controller
{
    public function index()
    {
        $data = IdentifikasiPemberianObat::all();
        return view('identifikasi_pemberianobat.index', compact('data'));
    }

    public function create()
    {
        $unit = 'Farmasi'; 
        return view('identifikasi-pemberianobat.create', compact('unit'));
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

        IdentifikasiPemberianObat::create($validated);

        return redirect()->route('identifikasi-pemberianobat.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = IdentifikasiPemberianObat::findOrFail($id);
        $unit = 'Kamar Bedah'; 
        return view('identifikasi_pemberianobat.edit', compact('data', 'unit'));
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

        $data = IdentifikasiPemberianObat::findOrFail($id);
        $data->update($validated);

        return redirect()->route('identifikasi-pemberianobat.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = IdentifikasiPemberianObat::findOrFail($id);
        $data->delete();

        return redirect()->route('identifikasi-pemberianobat.index')->with('success', 'Data berhasil dihapus.');
    }
}

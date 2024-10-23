<?php

namespace App\Http\Controllers;

use App\Models\IdentifikasiPasienRadiologi;
use Illuminate\Http\Request;

class IdentifikasiPasienRadiologiController extends Controller
{
    public function index()
    {
        $data = IdentifikasiPasienRadiologi::all();
        return view('identifikasi_pasienradiologi.index', compact('data'));
    }

    public function create()
    {
        $unit = 'Radiologi'; 
        return view('identifikasi-pasienradiologi.create', compact('unit'));
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

        IdentifikasiPasienRadiologi::create($validated);

        return redirect()->route('identifikasi-pasienradiologi.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = IdentifikasiPasienRadiologi::findOrFail($id);
        $unit = 'Kamar Bedah'; 
        return view('identifikasi_pasienradiologi.edit', compact('data', 'unit'));
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

        $data = IdentifikasiPasienRadiologi::findOrFail($id);
        $data->update($validated);

        return redirect()->route('identifikasi-pasienradiologi.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = IdentifikasiPasienRadiologi::findOrFail($id);
        $data->delete();

        return redirect()->route('identifikasi-pasienradiologi.index')->with('success', 'Data berhasil dihapus.');
    }
}

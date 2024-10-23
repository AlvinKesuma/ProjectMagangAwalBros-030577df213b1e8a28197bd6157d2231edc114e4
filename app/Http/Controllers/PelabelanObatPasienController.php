<?php

namespace App\Http\Controllers;

use App\Models\PelabelanObatPasien;
use Illuminate\Http\Request;

class PelabelanObatPasienController extends Controller
{
    public function index()
    {
        $data = PelabelanObatPasien::all();
        return view('pelabelan_obatpasien.index', compact('data'));
    }

    public function create()
    {
        $unit = 'Farmasi'; 
        return view('pelabelan_obatpasien.create', compact('unit'));
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

        PelabelanObatPasien::create($validated);

        return redirect()->route('pelabelan-obatpasien.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = PelabelanObatPasien::findOrFail($id);
        $unit = 'Kamar Bedah'; 
        return view('pelabelan_obatpasien.edit', compact('data', 'unit'));
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

        $data = PelabelanObatPasien::findOrFail($id);
        $data->update($validated);

        return redirect()->route('pelabelan-obatpasien.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = PelabelanObatPasien::findOrFail($id);
        $data->delete();

        return redirect()->route('pelabelan-obatpasien.index')->with('success', 'Data berhasil dihapus.');
    }
}

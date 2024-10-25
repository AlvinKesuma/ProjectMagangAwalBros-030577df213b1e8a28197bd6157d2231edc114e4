<?php

namespace App\Http\Controllers;

use App\Models\HasilKritisLaboratorium;
use Illuminate\Http\Request;

class HasilKritisLaboratoriumController extends Controller
{
    public function index()
    {
        $data = HasilKritisLaboratorium::all();
        return view('hasil_kritislaboratorium.index', compact('data'));
    }

    public function create()
    {
        $unit = 'Labor'; 
        return view('hasil_kritislaboratorium.create', compact('unit'));
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

        HasilKritisLaboratorium::create($validated);

        return redirect()->route('hasil-kritislaboratorium.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = HasilKritisLaboratorium::findOrFail($id);
        $unit = 'Kamar Bedah'; 
        return view('hasil_kritislaboratorium.edit', compact('data', 'unit'));
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

        $data = HasilKritisLaboratorium::findOrFail($id);
        $data->update($validated);

        return redirect()->route('hasil-kritislaboratorium.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = HasilKritisLaboratorium::findOrFail($id);
        $data->delete();

        return redirect()->route('hasil-kritislaboratorium.index')->with('success', 'Data berhasil dihapus.');
    }
}

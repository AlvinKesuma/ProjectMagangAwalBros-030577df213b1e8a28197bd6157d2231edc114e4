<?php

namespace App\Http\Controllers;

use App\Models\SampelDarahLaboratorium;
use Illuminate\Http\Request;

class SampelDarahLaboratoriumController extends Controller
{
    public function index()
    {
        $data = SampelDarahLaboratorium::all();
        return view('sampel_darahlaboratorium.index', compact('data'));
    }

    public function create()
    {
        $unit = 'Labor'; 
        return view('sampel_darahlaboratorium.create', compact('unit'));
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

        SampelDarahLaboratorium::create($validated);

        return redirect()->route('sampel-darahlaboratorium.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = SampelDarahLaboratorium::findOrFail($id);
        $unit = 'Kamar Bedah'; 
        return view('sampel-darahlaboratorium.edit', compact('data', 'unit'));
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

        $data = SampelDarahLaboratorium::findOrFail($id);
        $data->update($validated);

        return redirect()->route('sampel-darahlaboratorium.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = SampelDarahLaboratorium::findOrFail($id);
        $data->delete();

        return redirect()->route('sampel-darahlaboratorium.index')->with('success', 'Data berhasil dihapus.');
    }
}
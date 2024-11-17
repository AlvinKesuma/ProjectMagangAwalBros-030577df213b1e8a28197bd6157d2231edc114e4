<?php

namespace App\Http\Controllers;

use App\Models\TimeOutPoliGigi;
use Illuminate\Http\Request;

class TimeOutPoliGigiController extends Controller
{
    public function index()
    {
        $data = TimeOutPoliGigi::all();
        return view('timeout_poligigi.index', compact('data'));
    }

    public function create()
    {
        $unit = 'Poligigi'; 
        return view('timeout_poligigi.create', compact('unit'));
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

        TimeOutPoliGigi::create($validated);

        return redirect()->route('timeout-poligigi.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = TimeOutPoliGigi::findOrFail($id);
        $unit = 'Kamar Bedah'; 
        return view('timeout-poligigi.edit', compact('data', 'unit'));
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

        $data = TimeOutPoliGigi::findOrFail($id);
        $data->update($validated);

        return redirect()->route('timeout-poligigi.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = TimeOutPoliGigi::findOrFail($id);
        $data->delete();

        return redirect()->route('timeout-poligigi.index')->with('success', 'Data berhasil dihapus.');
    }
}
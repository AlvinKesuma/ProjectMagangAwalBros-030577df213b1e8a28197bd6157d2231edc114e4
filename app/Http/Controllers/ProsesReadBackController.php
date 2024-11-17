<?php

namespace App\Http\Controllers;

use App\Models\ProsesReadBack;
use Illuminate\Http\Request;

class ProsesReadBackController extends Controller
{
    public function index()
    {
        $data = ProsesReadBack::all();
        return view('proses_readback.index', compact('data'));
    }

    public function create()
    {
        $unit = 'Yanmed'; 
        return view('proses_readback.create', compact('unit'));
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

        ProsesReadBack::create($validated);

        return redirect()->route('proses-readback.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = ProsesReadBack::findOrFail($id);
        $unit = 'Kamar Bedah'; 
        return view('proses-readback.edit', compact('data', 'unit'));
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

        $data = ProsesReadBack::findOrFail($id);
        $data->update($validated);

        return redirect()->route('proses-readback.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = ProsesReadBack::findOrFail($id);
        $data->delete();

        return redirect()->route('proses-readback.index')->with('success', 'Data berhasil dihapus.');
    }
}
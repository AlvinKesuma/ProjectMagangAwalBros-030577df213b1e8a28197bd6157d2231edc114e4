<?php

namespace App\Http\Controllers;

use App\Models\InfoPenyakitPasien;
use Illuminate\Http\Request;

class InfoPenyakitPasienController extends Controller
{
    public function index()
    {
        $data = InfoPenyakitPasien::all();
        return view('info_penyakitpasien.index', compact('data'));
    }

    public function create()
    {
        $unit = 'Mutu'; 
        return view('info_penyakitpasien.create', compact('unit'));
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

        InfoPenyakitPasien::create($validated);

        return redirect()->route('info-penyakitpasien.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = InfoPenyakitPasien::findOrFail($id);
        $unit = 'Kamar Bedah'; 
        return view('info_penyakitpasien.edit', compact('data', 'unit'));
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

        $data = InfoPenyakitPasien::findOrFail($id);
        $data->update($validated);

        return redirect()->route('info-penyakitpasien.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = InfoPenyakitPasien::findOrFail($id);
        $data->delete();

        return redirect()->route('info-penyakitpasien.index')->with('success', 'Data berhasil dihapus.');
    }
}

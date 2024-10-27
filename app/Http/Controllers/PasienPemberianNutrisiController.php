<?php

namespace App\Http\Controllers;

use App\Models\PasienPemberianNutrisi;
use Illuminate\Http\Request;

class PasienPemberianNutrisiController extends Controller
{
    public function index()
    {
        $data = PasienPemberianNutrisi::all()->map(function ($item) {
            $item->growth = $item->tahun_2023 != 0 
                ? number_format((($item->tahun_2024 / $item->tahun_2023 - 1) * 100), 1) 
                : 0;
            return $item;
        });
        return view('pasien_pemberiannutrisi.index', compact('data'));
    }

    public function create()
    {
        $unit = 'Gizi'; 
        return view('pasien_pemberiannutrisi.create', compact('unit'));
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

        PasienPemberianNutrisi::create($validated);

        return redirect()->route('pasien-pemberiannutrisi.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = PasienPemberianNutrisi::findOrFail($id);
        $unit = 'Kamar Bedah'; 
        return view('pasien_pemberiannutrisi.edit', compact('data', 'unit'));
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

        $data = PasienPemberianNutrisi::findOrFail($id);
        $data->update($validated);

        return redirect()->route('pasien-pemberiannutrisi.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = PasienPemberianNutrisi::findOrFail($id);
        $data->delete();

        return redirect()->route('pasien-pemberiannutrisi.index')->with('success', 'Data berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\PasienPemberianNutrisi;
use Illuminate\Http\Request;

class PasienPemberianNutrisiController extends Controller
{
    public function index()
    {
        $data = PasienPemberianNutrisi::all();
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
            'year' => 'required|in:2023,2024',
        ]);

        if ($validated['year'] == '2024') {
            $numdenum = ($validated['num'] / $validated['denum']) * 100;
            $validated['numdenum'] = $numdenum;
        } else {
            $validated['numdenum'] = '-';
        }

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
            'year' => 'required|in:2023,2024',
        ]);

        if ($validated['year'] == '2024') {
            $numdenum = ($validated['num'] / $validated['denum']) * 100;
            $validated['numdenum'] = $numdenum;
        } else {
            $validated['numdenum'] = '-';
        }

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

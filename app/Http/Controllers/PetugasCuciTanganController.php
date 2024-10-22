<?php

namespace App\Http\Controllers;

use App\Models\PetugasCuciTangan;
use Illuminate\Http\Request;

class PetugasCuciTanganController extends Controller
{
    public function index()
    {
        $data = PetugasCuciTangan::all();
        return view('petugas_cucitangan.index', compact('data'));
    }

    public function create()
    {
        $unit = 'PPI'; 
        return view('petugas_cucitangan.create', compact('unit'));
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

        PetugasCuciTangan::create($validated);

        return redirect()->route('petugas-cucitangan.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = PetugasCuciTangan::findOrFail($id);
        $unit = 'Kamar Bedah'; 
        return view('petugas-cucitangan.edit', compact('data', 'unit'));
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

        $data = PetugasCuciTangan::findOrFail($id);
        $data->update($validated);

        return redirect()->route('petugas-cucitangan.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = PetugasCuciTangan::findOrFail($id);
        $data->delete();

        return redirect()->route('petugas-cucitangan.index')->with('success', 'Data berhasil dihapus.');
    }
}
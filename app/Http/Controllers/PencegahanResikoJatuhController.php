<?php

namespace App\Http\Controllers;

use App\Models\PencegahanResikoJatuh;
use Illuminate\Http\Request;

class PencegahanResikoJatuhController extends Controller
{
    public function index()
    {
        $data = PencegahanResikoJatuh::all();
        return view('pencegahan_resikojatuh.index', compact('data'));
    }

    public function create()
    {
        $units = ['Lt.3','Bunga Kiambang', 'Bunga Kesumba', 'Pucuk Bersusun', 'Tampuk Manggis', 'Perinatologi','Intensif']; // Add more units if needed
        return view('pencegahan_resikojatuh.create', compact('units'));
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

        PencegahanResikoJatuh::create($validated);

        return redirect()->route('pencegahan-resikojatuh.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = PencegahanResikoJatuh::findOrFail($id);
        $units = ['Lt.3','Bunga Kiambang', 'Bunga Kesumba', 'Pucuk Bersusun', 'Tampuk Manggis', 'Perinatologi','Intensif']; // Same unit options
        return view('pencegahan_resikojatuh.edit', compact('data', 'units'));
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

        $data = PencegahanResikoJatuh::findOrFail($id);
        $data->update($validated);

        return redirect()->route('pencegahan-resikojatuh.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = PencegahanResikoJatuh::findOrFail($id);
        $data->delete();

        return redirect()->route('pencegahan-resikojatuh.index')->with('success', 'Data berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\KepatuhanFormulariumNasional;
use Illuminate\Http\Request;

class KepatuhanFormulariumNasionalController extends Controller
{
    public function index()
    {
        $data = KepatuhanFormulariumNasional::all();
        return view('kepatuhan_formularium_nasional.index', compact('data'));
    }

    public function create()
    {
        $unit = 'Farmasi';
        return view('kepatuhan_formularium_nasional.create', compact('unit'));
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

        // Create a new entry
        KepatuhanFormulariumNasional::create($validated);

        return redirect()->route('kepatuhan-formularium-nasional.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = KepatuhanFormulariumNasional::findOrFail($id);
        $unit = 'Farmasi';
        return view('kepatuhan_formularium_nasional.edit', compact('data', 'unit'));
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

        // Find the existing entry and update it
        $data = KepatuhanFormulariumNasional::findOrFail($id);
        $data->update($validated);

        return redirect()->route('kepatuhan-formularium-nasional.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = KepatuhanFormulariumNasional::findOrFail($id);
        $data->delete();

        return redirect()->route('kepatuhan-formularium-nasional.index')->with('success', 'Data berhasil dihapus.');
    }
}

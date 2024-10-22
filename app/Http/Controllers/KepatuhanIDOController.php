<?php

namespace App\Http\Controllers;

use App\Models\KepatuhanIDO;

use Illuminate\Http\Request;

class KepatuhanIDOController extends Controller
{
    public function index()
    {
        $data = KepatuhanIDO::all();
        return view('kepatuhan_ido.index', compact('data'));
    }

    public function create()
    {
        $unit = 'PPI';
        return view('kepatuhan_ido.create', compact('unit'));
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
        KepatuhanIDO::create($validated);

        return redirect()->route('kepatuhan-ido.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = KepatuhanIDO::findOrFail($id);
        $unit = 'PPI';
        return view('kepatuhan_ido.edit', compact('data', 'unit'));
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
        $data = KepatuhanIDO::findOrFail($id);
        $data->update($validated);

        return redirect()->route('kepatuhan-ido.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = KepatuhanIDO::findOrFail($id);
        $data->delete();

        return redirect()->route('kepatuhan-ido.index')->with('success', 'Data berhasil dihapus.');
    }
}

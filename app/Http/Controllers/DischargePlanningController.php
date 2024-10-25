<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\DischargePlanning;
class DischargePlanningController extends Controller
{
    public function index()
    {
        $data = DischargePlanning::all();
        return view('discharge_planning.index', compact('data'));
    }

    public function create()
    {
        $unit = 'Yanmed';
        return view('discharge_planning.create', compact('unit'));
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

        // Create a new entry
        DischargePlanning::create($validated);

        return redirect()->route('discharge-planning.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = DischargePlanning::findOrFail($id);
        $unit = 'Yanmed';
        return view('discharge_planning.edit', compact('data', 'unit'));
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

        // Find the existing entry and update it
        $data = DischargePlanning::findOrFail($id);
        $data->update($validated);

        return redirect()->route('discharge-planning.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = DischargePlanning::findOrFail($id);
        $data->delete();

        return redirect()->route('discharge-planning.index')->with('success', 'Data berhasil dihapus.');
    }
}


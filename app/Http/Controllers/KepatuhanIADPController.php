<?php

namespace App\Http\Controllers;
use App\Models\KepatuhanIADP;
use Illuminate\Http\Request;

class KepatuhanIADPController extends Controller
{
    public function index()
    {
        $data = KepatuhanIADP::all();
        return view('kepatuhan_iadp.index', compact('data'));
    }

    public function create()
    {
        $unit = 'PPI';
        return view('kepatuhan_iadp.create', compact('unit'));
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

        // Create a new entry
        KepatuhanIADP::create($validated);

        return redirect()->route('kepatuhan-iadp.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = KepatuhanIADP::findOrFail($id);
        $unit = 'PPI';
        return view('kepatuhan_iadp.edit', compact('data', 'unit'));
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

        // Find the existing entry and update it
        $data = KepatuhanIADP::findOrFail($id);
        $data->update($validated);

        return redirect()->route('kepatuhan-iadp.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = KepatuhanIADP::findOrFail($id);
        $data->delete();

        return redirect()->route('kepatuhan-iadp.index')->with('success', 'Data berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\KepatuhanVisitDokterSpesialis;
use Illuminate\Http\Request;

class KepatuhanVisitDokterSpesialisController extends Controller
{
    public function index()
    {
        $data = KepatuhanVisitDokterSpesialis::all();
        return view('kepatuhan_visit_dokter_spesialis.index', compact('data'));
    }

    public function create()
    {
        $unit = 'SOD';
        return view('kepatuhan_visit_dokter_spesialis.create', compact('unit'));
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
        KepatuhanVisitDokterSpesialis::create($validated);

        return redirect()->route('kepatuhan-visit-dokter-spesialis.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = KepatuhanVisitDokterSpesialis::findOrFail($id);
        $unit = 'SOD';
        return view('kepatuhan_visit_dokter_spesialis.edit', compact('data', 'unit'));
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
        $data = KepatuhanVisitDokterSpesialis::findOrFail($id);
        $data->update($validated);

        return redirect()->route('kepatuhan-visit-dokter-spesialis.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = KepatuhanVisitDokterSpesialis::findOrFail($id);
        $data->delete();

        return redirect()->route('kepatuhan-visit-dokter-spesialis.index')->with('success', 'Data berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\AntibioticProphylaxistype;
use Illuminate\Http\Request;

class AntibioticProphylaxisTypeController extends Controller
{
    public function index()
    {
        $data = AntibioticProphylaxisType::all();
        return view('antibiotic_prophylaxistype.index', compact('data'));
    }

    public function create()
    {
        $unit = 'Kamar Bedah'; 
        return view('antibiotic_prophylaxistype.create', compact('unit'));
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

        AntibioticProphylaxisType::create($validated);

        return redirect()->route('antibiotic-prophylaxistype.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = AntibioticProphylaxisType::findOrFail($id);
        $unit = 'Kamar Bedah'; 
        return view('antibiotic_prophylaxistype.edit', compact('data', 'unit'));
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

        $data = AntibioticProphylaxisType::findOrFail($id);
        $data->update($validated);

        return redirect()->route('antibiotic-prophylaxistype.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = AntibioticProphylaxisType::findOrFail($id);
        $data->delete();

        return redirect()->route('antibiotic-prophylaxis.index')->with('success', 'Data berhasil dihapus.');
    }
}

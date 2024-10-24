<?php

namespace App\Http\Controllers;

use App\Models\AntibiotikProfilaksis;
use Illuminate\Http\Request;

class AntibiotikProfilaksisController extends Controller
{
    public function index()
    {
        $data = AntibiotikProfilaksis::all();
        return view('antibiotik_profilaksis.index', compact('data'));
    }

    public function create()
    {
        $unit = 'Kamar Bedah'; 
        return view('antibiotik_profilaksis.create', compact('unit'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'unit' => 'required|string|max:255',
            'num' => 'required|numeric|between:0,100.0',
            'denum' => 'required|numeric|between:0,100.0',
            'month' => 'required|in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
            'year' => 'required|digits:4|integer|in:2023,2024',
        ]);

        if ($validated['year'] == '2024') {
            $numdenum = ($validated['num'] / $validated['denum']) * 100;
            $validated['numdenum'] = $numdenum;
        } else {
            $validated['numdenum'] = '-';
        }

        // Simpan data ke database
        AntibiotikProfilaksis::create($validated);

        return redirect()->route('antibiotik-profilaksis.index')->with('success', 'Data bernumdenum disimpan.');
    }

    public function edit($id)
    {
        $data = AntibiotikProfilaksis::findOrFail($id);
        $unit = 'Kamar Bedah'; 
        return view('antibiotik_profilaksis.edit', compact('data', 'unit'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'unit' => 'required|string|max:255',
            'num' => 'required|numeric|between:0,100.0',
            'denum' => 'required|numeric|between:0,100.0',
            'month' => 'required|in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
            'year' => 'required|digits:4|integer|in:2023,2024',
        ]);

        if ($validated['year'] == '2024') {
            $numdenum = ($validated['num'] / $validated['denum']) * 100;
            $validated['numdenum'] = $numdenum;
        } else {
            $validated['numdenum'] = '-';
        }

        // Update data di database
        $data = AntibiotikProfilaksis::findOrFail($id);
        $data->update($validated);

        return redirect()->route('antibiotik-profilaksis.index')->with('success', 'Data bernumdenum diperbarui.');
    }

    public function destroy($id)
    {
        $data = AntibiotikProfilaksis::findOrFail($id);
        $data->delete();

        return redirect()->route('antibiotik-profilaksis.index')->with('success', 'Data bernumdenum dihapus.');
    }
}

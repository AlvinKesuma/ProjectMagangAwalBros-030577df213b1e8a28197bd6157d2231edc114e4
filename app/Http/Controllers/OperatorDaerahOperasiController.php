<?php

namespace App\Http\Controllers;

use App\Models\OperatorDaerahOperasi;
use Illuminate\Http\Request;

class OperatorDaerahOperasiController extends Controller
{
    public function index()
    {
        $data = OperatorDaerahOperasi::all();
        return view('operator_daerahoperasi.index', compact('data'));
    }

    public function create()
    {
        $unit = 'Kamar Bedah'; 
        return view('operator_daerahoperasi.create', compact('unit'));
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

        OperatorDaerahOperasi::create($validated);

        return redirect()->route('operator-daerahoperasi.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = OperatorDaerahOperasi::findOrFail($id);
        $unit = 'Kamar Bedah'; 
        return view('operator_daerahoperasi.edit', compact('data', 'unit'));
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

        $data = OperatorDaerahOperasi::findOrFail($id);
        $data->update($validated);

        return redirect()->route('operator-daerahoperasi.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = OperatorDaerahOperasi::findOrFail($id);
        $data->delete();

        return redirect()->route('operator-daerahoperasi.index')->with('success', 'Data berhasil dihapus.');
    }
}

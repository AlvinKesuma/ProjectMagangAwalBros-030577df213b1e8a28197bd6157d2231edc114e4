<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\LOSgagalJantungAkut;
class LOSgagalJantungAkutController extends Controller
{
    public function index()
    {
        $data = LOSgagalJantungAkut::all();
        return view('los_gagal_jantung_akut.index', compact('data'));
    }

    public function create()
    {
        return view('los_gagal_jantung_akut.create', compact('unit'));
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
        LOSgagalJantungAkut::create($validated);

        return redirect()->route('los-gagal-jantung-akut.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = LOSgagalJantungAkut::findOrFail($id);
        return view('los_gagal_jantung_akut.edit', compact('data', 'unit'));
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
        $data = LOSgagalJantungAkut::findOrFail($id);
        $data->update($validated);

        return redirect()->route('los-gagal-jantung-akut.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = LOSgagalJantungAkut::findOrFail($id);
        $data->delete();

        return redirect()->route('los-gagal-jantung-akut.index')->with('success', 'Data berhasil dihapus.');
    }
}


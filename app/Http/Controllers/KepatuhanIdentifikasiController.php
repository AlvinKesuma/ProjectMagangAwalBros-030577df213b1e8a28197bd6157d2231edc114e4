<?php

namespace App\Http\Controllers;

use App\Models\KepatuhanIdentifikasi;
use Illuminate\Http\Request;

class KepatuhanIdentifikasiController extends Controller
{
    public function index()
    {
        $data = KepatuhanIdentifikasi::all();
        return view('kepatuhan_identifikasi.index', compact('data'));
    }

    public function create()
    {
        $unit = 'Mutu'; 
        return view('kepatuhan_identifikasi.create', compact('unit'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'unit' => 'required|string|max:255',
            'kip1' => 'required|numeric|between:0,100.0',
            'kip2' => 'required|numeric|between:0,100.0',
            'kip3' => 'required|numeric|between:0,100.0',
            'kip4' => 'required|numeric|between:0,100.0',
            'month' => 'required|in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
            'year' => 'required|in:2023,2024',
        ]);

        // Hitung total num dan denum dari kip1 hingga kip4
        $num = $validated['kip1'] + $validated['kip2'] + $validated['kip3'] + $validated['kip4'];
        $denum = $num;

        // Gabungkan num dan denum ke dalam data yang akan disimpan
        $validated['num'] = $num;
        $validated['denum'] = $denum;

        if ($validated['year'] == '2024') {
            $numdenum = ($validated['num'] / $validated['denum']) * 100;
            $validated['numdenum'] = $numdenum;
        } else {
            $validated['numdenum'] = '-';
        }

        KepatuhanIdentifikasi::create($validated);

        return redirect()->route('kepatuhan-identifikasi.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = KepatuhanIdentifikasi::findOrFail($id);
        $unit = 'Kamar Bedah'; 
        return view('kepatuhan_identifikasi.edit', compact('data', 'unit'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'unit' => 'required|string|max:255',
            'kip1' => 'required|numeric|between:0,100.0',
            'kip2' => 'required|numeric|between:0,100.0',
            'kip3' => 'required|numeric|between:0,100.0',
            'kip4' => 'required|numeric|between:0,100.0',
            'month' => 'required|in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
            'year' => 'required|in:2023,2024',
        ]);

        // Hitung total num dan denum dari kip1 hingga kip4
        $num = $validated['kip1'] + $validated['kip2'] + $validated['kip3'] + $validated['kip4'];
        $denum = $num;

        // Gabungkan num dan denum ke dalam data yang akan diperbarui
        $validated['num'] = $num;
        $validated['denum'] = $denum;

        if ($validated['year'] == '2024') {
            $numdenum = ($validated['num'] / $validated['denum']) * 100;
            $validated['numdenum'] = $numdenum;
        } else {
            $validated['numdenum'] = '-';
        }

        $data = KepatuhanIdentifikasi::findOrFail($id);
        $data->update($validated);

        return redirect()->route('kepatuhan-identifikasi.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = KepatuhanIdentifikasi::findOrFail($id);
        $data->delete();

        return redirect()->route('kepatuhan-identifikasi.index')->with('success', 'Data berhasil dihapus.');
    }
}

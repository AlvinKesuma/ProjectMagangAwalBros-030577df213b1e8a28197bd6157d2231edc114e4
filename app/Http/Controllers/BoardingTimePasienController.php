<?php

namespace App\Http\Controllers;

use App\Models\BoardingTimePasien;
use Illuminate\Http\Request;

class BoardingTimePasienController extends Controller
{
    public function index()
    {
        $data = BoardingTimePasien::all();
        return view('boarding_timepasien.index', compact('data'));
    }

    public function create()
    {
        $unit = 'UGD'; 
        return view('boarding_timepasien.create', compact('unit'));
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

        BoardingTimePasien::create($validated);

        return redirect()->route('boarding-timepasien.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = BoardingTimePasien::findOrFail($id);
        $unit = 'Kamar Bedah'; 
        return view('boarding_timepasien.edit', compact('data', 'unit'));
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

        $data = BoardingTimePasien::findOrFail($id);
        $data->update($validated);

        return redirect()->route('boarding-timepasien.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = BoardingTimePasien::findOrFail($id);
        $data->delete();

        return redirect()->route('boarding-timepasien.index')->with('success', 'Data berhasil dihapus.');
    }
}

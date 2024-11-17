<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\FeedbackPelanggan;
class FeedbackPelangganController extends Controller
{
    public function index()
    {
        $data = FeedbackPelanggan::all();
        return view('feedback_pelanggan.index', compact('data'));
    }

    public function create()
    {
        return view('feedback_pelanggan.create', compact('unit'));
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
        FeedbackPelanggan::create($validated);

        return redirect()->route('feedback-pelanggan.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = FeedbackPelanggan::findOrFail($id);
        return view('feedback_pelanggan.edit', compact('data', 'unit'));
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
        $data = FeedbackPelanggan::findOrFail($id);
        $data->update($validated);

        return redirect()->route('feedback-pelanggan.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = FeedbackPelanggan::findOrFail($id);
        $data->delete();

        return redirect()->route('feedback-pelanggan.index')->with('success', 'Data berhasil dihapus.');
    }
}


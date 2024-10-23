<?php

namespace App\Http\Controllers;

use App\Models\TimeOutVK;
use Illuminate\Http\Request;

class TimeOutVKController extends Controller
{
    public function index()
    {
        $data = TimeOutVK::all();
        return view('timeout_vk.index', compact('data'));
    }

    public function create()
    {
        $unit = 'VK'; 
        return view('timeout_vk.create', compact('unit'));
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

        TimeOutVK::create($validated);

        return redirect()->route('timeout-vk.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = TimeOutVK::findOrFail($id);
        $unit = 'Kamar Bedah'; 
        return view('timeout-vk.edit', compact('data', 'unit'));
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

        $data = TimeOutVK::findOrFail($id);
        $data->update($validated);

        return redirect()->route('timeout-vk.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = TimeOutVK::findOrFail($id);
        $data->delete();

        return redirect()->route('timeout-vk.index')->with('success', 'Data berhasil dihapus.');
    }
}
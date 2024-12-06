<?php

namespace App\Http\Controllers;
use App\Models\KepuasanPasien;
use Illuminate\Http\Request;

class KepuasanPasienController extends Controller
{
    public function index()
    {
        $data = KepuasanPasien::all();
        $results = $this->calculateTwAndGrowth($data);
        return view('kepuasan_pasien.index', compact('data', 'results'));
    }

    public function create()
    {
        $unit = 'CRO';
        return view('kepuasan_pasien.create', compact('unit'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'unit' => 'required|string|max:255',
            'month' => 'required|in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
            'tahun_2023' => 'required|numeric|between:0,100.0',
            'tahun_2024' => 'required|numeric|between:0,100.0',
        ]);

        // Create a new entry
        KepuasanPasien::create($validated);

        return redirect()->route('kepuasan-pasien.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = KepuasanPasien::findOrFail($id);
        $unit = 'CRO';
        return view('kepuasan_pasien.edit', compact('data', 'unit'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'unit' => 'required|string|max:255',
            'month' => 'required|in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
            'tahun_2023' => 'required|numeric|between:0,100.0',
            'tahun_2024' => 'required|numeric|between:0,100.0',
        ]);

        // Find the existing entry and update it
        $data = KepuasanPasien::findOrFail($id);
        $data->update($validated);

        return redirect()->route('kepuasan-pasien.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = KepuasanPasien::findOrFail($id);
        $data->delete();

        return redirect()->route('kepuasan-pasien.index')->with('success', 'Data berhasil dihapus.');
    }

    private function calculateTwAndGrowth($data)
    {
        $tw1tahun2023 = $tw2tahun2023 = $tw3tahun2023 = $tw4tahun2023 = 0;
        $tw1tahun2024 = $tw2tahun2024 = $tw3tahun2024 = $tw4tahun2024 = 0;

        $firstQuarterMonths = ['Januari', 'Februari', 'Maret'];
        $secondQuarterMonths = ['April', 'Mei', 'Juni'];
        $thirdQuarterMonths = ['Juli', 'Agustus', 'September'];
        $fourthQuarterMonths = ['Oktober', 'November', 'Desember'];

        foreach ($data as $item) {
            $tahun_2023 = (float) $item->tahun_2023;
            $tahun_2024 = (float) $item->tahun_2024;
            $month = $item->month;

            if (in_array($month, $firstQuarterMonths)) {
                $tw1tahun2023 += $tahun_2023;
                $tw1tahun2024 += $tahun_2024;
            } elseif (in_array($month, $secondQuarterMonths)) {
                $tw2tahun2023 += $tahun_2023;
                $tw1tahun2024 += $tahun_2024;
            } elseif (in_array($month, $thirdQuarterMonths)) {
                $tw3tahun2023 += $tahun_2023;
                $tw1tahun2024 += $tahun_2024;
            } elseif (in_array($month, $fourthQuarterMonths)) {
                $tw4tahun2023 += $tahun_2023;
                $tw1tahun2024 += $tahun_2024;
            }
        }

        $tw1tahun2023 = $tw1tahun2023 / count($firstQuarterMonths);
        $tw2tahun2023 = $tw2tahun2023 / count($secondQuarterMonths);
        $tw3tahun2023 = $tw3tahun2023 / count($thirdQuarterMonths);
        $tw4tahun2023 = $tw4tahun2023 / count($fourthQuarterMonths);

        $tw1tahun2024 = $tw1tahun2024 / count($firstQuarterMonths);
        $tw2tahun2024 = $tw2tahun2024 / count($secondQuarterMonths);
        $tw3tahun2024 = $tw3tahun2024 / count($thirdQuarterMonths);
        $tw4tahun2024 = $tw4tahun2024 / count($fourthQuarterMonths);

        $hasiltw2023 = ($tw1tahun2023 + $tw2tahun2023 + $tw3tahun2023 + $tw4tahun2023) / 4;
        $hasiltw2024 = ($tw1tahun2024 + $tw2tahun2024 + $tw3tahun2024 + $tw4tahun2024) / 4;

        return [
            'tw1tahun2024' => $tw1tahun2024,
            'tw2tahun2024' => $tw2tahun2024,
            'tw3tahun2024' => $tw3tahun2024,
            'tw4tahun2024' => $tw4tahun2024,
            'tw1tahun2023' => $tw1tahun2023,
            'tw2tahun2023' => $tw2tahun2023,
            'tw3tahun2023' => $tw3tahun2023,
            'tw4tahun2023' => $tw4tahun2023,
            'hasiltw2024' => $hasiltw2024,
            'hasiltw2023' => $hasiltw2023
        ];
    }
}

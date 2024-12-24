<?php

namespace App\Http\Controllers;

use App\Models\LaporanKomiteMutu;
use Illuminate\Http\Request;

class WaktuTungguRawatJalan30MinController extends Controller
{
    public function index()
    {
        $data = LaporanKomiteMutu::all();
        $results = $this->calculateTwAndGrowth($data);
        return view('waktu_tunggu_rawat_jalan_30Min.index', compact('data', 'results'));
    }

    public function create()
    {
        $unit = 'Mutu';
        return view('waktu_tunggu_rawat_jalan_30Min.create', compact('unit'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'indikatorMutu' => 'nullable|string',
            'unit' => 'required|string|max:255',
            'bulan' => 'required|in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
            'tahun' => 'required|numeric|between:0,100.0',
        ]);

        // Create a new entry
        LaporanKomiteMutu::create($validated);

        return redirect()->route('waktu-tunggu-rawat-jalan-30min.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = LaporanKomiteMutu::findOrFail($id);
        $unit = 'Mutu';
        return view('waktu_tunggu_rawat_jalan_30Min.edit', compact('data', 'unit'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'indikatorMutu' => 'nullable|string',
            'unit' => 'required|string|max:255',
            'bulan' => 'required|in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
            'tahun' => 'required|numeric|between:0,100.0',
        ]);

        $data = LaporanKomiteMutu::findOrFail($id);
        $data->update($validated);

        return redirect()->route('waktu-tunggu-rawat-jalan-30min.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = LaporanKomiteMutu::findOrFail($id);
        $data->delete();

        return redirect()->route('waktu-tunggu-rawat-jalan-30min.index')->with('success', 'Data berhasil dihapus.');
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
            $tahun_2024 = (float) $item->tahun_2024;
            $month = $item->month;

            if (in_array($month, $firstQuarterMonths)) {
                $tw1tahun2024 += $tahun_2024;
            } elseif (in_array($month, $secondQuarterMonths)) {
                $tw1tahun2024 += $tahun_2024;
            } elseif (in_array($month, $thirdQuarterMonths)) {
                $tw1tahun2024 += $tahun_2024;
            } elseif (in_array($month, $fourthQuarterMonths)) {
                $tw1tahun2024 += $tahun_2024;
            }
        }

        $tw1tahun2024 = $tw1tahun2024 / count($firstQuarterMonths);
        $tw2tahun2024 = $tw2tahun2024 / count($secondQuarterMonths);
        $tw3tahun2024 = $tw3tahun2024 / count($thirdQuarterMonths);
        $tw4tahun2024 = $tw4tahun2024 / count($fourthQuarterMonths);

        $hasiltw2024 = ($tw1tahun2024 + $tw2tahun2024 + $tw3tahun2024 + $tw4tahun2024) / 4;

        return [
            'tw1tahun2024' => $tw1tahun2024,
            'tw2tahun2024' => $tw2tahun2024,
            'tw3tahun2024' => $tw3tahun2024,
            'tw4tahun2024' => $tw4tahun2024,
            'hasiltw2024' => $hasiltw2024
        ];
    }
}


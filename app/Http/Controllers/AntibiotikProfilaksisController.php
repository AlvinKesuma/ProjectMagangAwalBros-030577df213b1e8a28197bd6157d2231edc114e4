<?php

namespace App\Http\Controllers;

use App\Models\AntibiotikProfilaksis;
use Illuminate\Http\Request;

class AntibiotikProfilaksisController extends Controller
{
    public function index()
    {
        $data = AntibiotikProfilaksis::all();
        $results = $this->calculateTwAndGrowth($data);
        return view('antibiotik_profilaksis.index', compact('data', 'results'));
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
            'tahun_2023' => 'required|numeric|between:0,100.0',
        ]);

        $tahun_2024 = ($validated['num'] / $validated['denum']) * 100;
        $validated['tahun_2024'] = $tahun_2024;

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
            'tahun_2023' => 'required|numeric|between:0,100.0',
        ]);

        $tahun_2024 = ($validated['num'] / $validated['denum']) * 100;
        $validated['tahun_2024'] = $tahun_2024;

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

    private function calculateTwAndGrowth($data)
    {
        $tw1num = $tw1denum = $tw2num = $tw2denum = $tw3num = $tw3denum = $tw4num = $tw4denum = 0;
        $tw1tahun2023 = $tw2tahun2023 = $tw3tahun2023 = $tw4tahun2023 = 0;

        $firstQuarterMonths = ['Januari', 'Februari', 'Maret'];
        $secondQuarterMonths = ['April', 'Mei', 'Juni'];
        $thirdQuarterMonths = ['Juli', 'Agustus', 'September'];
        $fourthQuarterMonths = ['Oktober', 'November', 'Desember'];

        foreach ($data as $item) {
            $num = (float) $item->num;
            $denum = (float) $item->denum;
            $tahun_2023 = (float) $item->tahun_2023;
            $month = $item->month;

            if (in_array($month, $firstQuarterMonths)) {
                $tw1num += $num;
                $tw1denum += $denum;
                $tw1tahun2023 += $tahun_2023;
            } elseif (in_array($month, $secondQuarterMonths)) {
                $tw2num += $num;
                $tw2denum += $denum;
                $tw2tahun2023 += $tahun_2023;
            } elseif (in_array($month, $thirdQuarterMonths)) {
                $tw3num += $num;
                $tw3denum += $denum;
                $tw3tahun2023 += $tahun_2023;
            } elseif (in_array($month, $fourthQuarterMonths)) {
                $tw4num += $num;
                $tw4denum += $denum;
                $tw4tahun2023 += $tahun_2023;
            }
        }

        $tw1tahun2024 = ($tw1denum !== 0) ? ($tw1num / $tw1denum) * 100 : 0;
        $tw2tahun2024 = ($tw2denum !== 0) ? ($tw2num / $tw2denum) * 100 : 0;
        $tw3tahun2024 = ($tw3denum !== 0) ? ($tw3num / $tw3denum) * 100 : 0;
        $tw4tahun2024 = ($tw4denum !== 0) ? ($tw4num / $tw4denum) * 100 : 0;

        $tw1tahun2023 = ($tw1num !== 0 && $tw1denum !== 0) ? $tw1tahun2023 / count($firstQuarterMonths) : 0;
        $tw2tahun2023 = ($tw2num !== 0 && $tw2denum !== 0) ? $tw2tahun2023 / count($secondQuarterMonths) : 0;
        $tw3tahun2023 = ($tw3num !== 0 && $tw3denum !== 0) ? $tw3tahun2023 / count($thirdQuarterMonths) : 0;
        $tw4tahun2023 = ($tw4num !== 0 && $tw4denum !== 0) ? $tw4tahun2023 / count($fourthQuarterMonths) : 0;

        $hasiltwnum = $tw1num + $tw2num + $tw3num + $tw4num;
        $hasiltwdenum = $tw1denum + $tw2denum + $tw3denum + $tw4denum;

        $hasiltw2024 = ($hasiltwdenum !== 0) ? ($hasiltwnum / $hasiltwdenum) * 100 : 0;
        $hasiltw2023 = ($tw1tahun2023 + $tw2tahun2023 + $tw3tahun2023 + $tw4tahun2023) / 4;

        $growth = ($hasiltw2023 !== 0) ? (($hasiltw2024 / $hasiltw2023) - 1) * 100 : 0;

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
            'hasiltw2023' => $hasiltw2023,
            'growth' => $growth
        ];
    }
}

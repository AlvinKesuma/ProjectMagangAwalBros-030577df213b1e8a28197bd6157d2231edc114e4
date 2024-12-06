<?php

namespace App\Http\Controllers;

use App\Models\KepatuhanIdentifikasi;
use Illuminate\Http\Request;

class KepatuhanIdentifikasiController extends Controller
{
    public function index()
    {
        $data = KepatuhanIdentifikasi::all();
        $results = $this->calculateTwAndGrowth($data);
        return view('kepatuhan_identifikasi.index', compact('data', 'results'));
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
            'tahun_2023' => 'required|numeric|between:0,100.0',
        ]);

        $num = $validated['kip1'] + $validated['kip2'] + $validated['kip3'] + $validated['kip4'];
        $denum = $num;

        $validated['num'] = $num;
        $validated['denum'] = $denum;

        $tahun_2024 = ($validated['num'] / $validated['denum']) * 100;
        $validated['tahun_2024'] = $tahun_2024;
        
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
            'kip4' => 'required|numeric|between:0,100.0',
            'month' => 'required|in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
            'tahun_2023' => 'required|numeric|between:0,100.0',
        ]);

        $num = $validated['kip1'] + $validated['kip2'] + $validated['kip3'] + $validated['kip4'];
        $denum = $num;

        $validated['num'] = $num;
        $validated['denum'] = $denum;

        $tahun_2024 = ($validated['num'] / $validated['denum']) * 100;
        $validated['tahun_2024'] = $tahun_2024;

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
    private function calculateTwAndGrowth($data)
    {
        $tw1kip1 = $tw1kip2 = $tw1kip3 = $tw1kip4 = $tw2kip1 = $tw2kip2 = $tw2kip3 = $tw2kip4 = 0;
        $tw3kip1 = $tw3kip2 = $tw3kip3 = $tw3kip4 = $tw4kip1 = $tw4kip2 = $tw4kip3 = $tw4kip4 = 0;
        $tw1tahun2023 = $tw2tahun2023 = $tw3tahun2023 = $tw4tahun2023 = 0;

        $firstQuarterMonths = ['Januari', 'Februari', 'Maret'];
        $secondQuarterMonths = ['April', 'Mei', 'Juni'];
        $thirdQuarterMonths = ['Juli', 'Agustus', 'September'];
        $fourthQuarterMonths = ['Oktober', 'November', 'Desember'];

        foreach ($data as $item) {
            $kip1 = (float) $item->kip1;
            $kip2 = (float) $item->kip2;
            $kip3 = (float) $item->kip3;
            $kip4 = (float) $item->kip4;
            $tahun_2023 = (float) $item->tahun_2023;
            $month = $item->month;

            if (in_array($month, $firstQuarterMonths)) {
                $tw1kip1 += $kip1;
                $tw1kip2 += $kip2;
                $tw1kip3 += $kip3;
                $tw1kip4 += $kip4;
                $tw1tahun2023 += $tahun_2023;
            } elseif (in_array($month, $secondQuarterMonths)) {
                $tw2kip1 += $kip1;
                $tw2kip2 += $kip2;
                $tw2kip3 += $kip3;
                $tw2kip4 += $kip4;
                $tw2tahun2023 += $tahun_2023;
            } elseif (in_array($month, $thirdQuarterMonths)) {
                $tw3kip1 += $kip1;
                $tw3kip2 += $kip2;
                $tw3kip3 += $kip3;
                $tw3kip4 += $kip4;
                $tw3tahun2023 += $tahun_2023;
            } elseif (in_array($month, $fourthQuarterMonths)) {
                $tw4kip1 += $kip1;
                $tw4kip2 += $kip2;
                $tw4kip3 += $kip3;
                $tw4kip4 += $kip4;
                $tw4tahun2023 += $tahun_2023;
            }
        }

        $tw1num =  ($tw1kip1 + $tw1kip2  + $tw1kip3  + $tw1kip4);
        $tw2num =  ($tw2kip1 + $tw2kip2  + $tw2kip3  + $tw2kip4);
        $tw3num =  ($tw3kip1 + $tw3kip2  + $tw3kip3  + $tw3kip4);
        $tw4num =  ($tw4kip1 + $tw4kip2  + $tw4kip3  + $tw4kip4);

        $tw1denum = $tw1num;
        $tw2denum = $tw2num;
        $tw3denum = $tw3num;
        $tw4denum = $tw4num;

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
            'growth' => $growth,
        ];
    } 
}

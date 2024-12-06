<?php

namespace App\Http\Controllers;
use App\Models\KepatuhanIDO;
use Illuminate\Http\Request;

class KepatuhanIDOController extends Controller
{
    public function index()
    {
        $data = KepatuhanIDO::all();
        $results = $this->calculateTwAndGrowth($data);
        return view('kepatuhan_ido.index', compact('data', 'results'));
    }

    public function create()
    {
        $unit = 'PPI';
        return view('kepatuhan_ido.create', compact('unit'));
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
        
        KepatuhanIDO::create($validated);

        return redirect()->route('kepatuhan-ido.index')->with('success', 'Data berhasil disimpan.');
    }

    public function edit($id)
    {
        $data = KepatuhanIDO::findOrFail($id);
        $unit = 'PPI';
        return view('kepatuhan_ido.edit', compact('data', 'unit'));
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

        $data = KepatuhanIDO::findOrFail($id);
        $data->update($validated);

        return redirect()->route('kepatuhan-ido.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = KepatuhanIDO::findOrFail($id);
        $data->delete();

        return redirect()->route('kepatuhan-ido.index')->with('success', 'Data berhasil dihapus.');
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
            $month = $item->month;

            if (in_array($month, $firstQuarterMonths)) {
                $tw1num += $num;
                $tw1denum += $denum;
            } elseif (in_array($month, $secondQuarterMonths)) {
                $tw2num += $num;
                $tw2denum += $denum;
            } elseif (in_array($month, $thirdQuarterMonths)) {
                $tw3num += $num;
                $tw3denum += $denum;
            } elseif (in_array($month, $fourthQuarterMonths)) {
                $tw4num += $num;
                $tw4denum += $denum;
            }
        }

        $tw1tahun2024 = ($tw1denum !== 0) ? ($tw1num / $tw1denum) * 100 : 0;
        $tw2tahun2024 = ($tw2denum !== 0) ? ($tw2num / $tw2denum) * 100 : 0;
        $tw3tahun2024 = ($tw3denum !== 0) ? ($tw3num / $tw3denum) * 100 : 0;
        $tw4tahun2024 = ($tw4denum !== 0) ? ($tw4num / $tw4denum) * 100 : 0;

        $hasiltwnum = $tw1num + $tw2num + $tw3num + $tw4num;
        $hasiltwdenum = $tw1denum + $tw2denum + $tw3denum + $tw4denum;

        $hasiltw2024 = ($hasiltwdenum !== 0) ? ($hasiltwnum / $hasiltwdenum) * 100 : 0;

        return [
            'tw1tahun2024' => $tw1tahun2024,
            'tw2tahun2024' => $tw2tahun2024,
            'tw3tahun2024' => $tw3tahun2024,
            'tw4tahun2024' => $tw4tahun2024,
            'hasiltw2024' => $hasiltw2024
        ];
    }
}

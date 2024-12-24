<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporanKomiteMutu;
use DB;
class LaporanKomiteMutuController extends Controller
{
    public function index()
    {
        $data=DB::table('master_indikator')->groupBy('Nama')->get();
        return view('laporan_komite_mutu.index',compact('data'));
    }

    public function show($id){
       
        // $data2=DB::table('master_indikator')->where('Nama')->get();
        $data2 = LaporanKomiteMutu::join('master_indikator','laporan_komite_mutu.indikatorMutu','=','master_indikator.id')->
        where('indikatorMutu',$id)->get();
        
         $data = LaporanKomiteMutu::all();
        $results = $this->calculateTwAndGrowth($data);
        // $results = $this->calculateTwAndGrowth($data'laporan_komite_mutu.indikatorMutu',);
          return view('kepatuhan_identifikasi.index', compact('data', 'results','data2','id'));
    }

       public function store(Request $request){
       
       $validated = $request->validate([
            'indikatorMutu' => 'nullable|string',
            'unit' => 'required|string|max:255',
            'bulan' => 'required|in:Januari,Februari,Maret,April,Mei,Juni,Juli,Agustus,September,Oktober,November,Desember',
            'tahun' => 'required|numeric',
        ]);

        // Create a new entry
       $data= LaporanKomiteMutu::create($validated);
        // dd($data);
        return redirect()->route('laporan-komite-mutu.show',$data->indikatorMutu)->with('success', 'Data berhasil disimpan.');
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

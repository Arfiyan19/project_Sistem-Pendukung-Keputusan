<?php

namespace App\Http\Controllers;

use App\Detail_alt;
use App\Perhitungan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Alternatif;
use App\Kriteria;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PerhitunganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //detail_alternatif
        $alternatif = alternatif::all();
        $kriteria = kriteria::all();
        $detail_alternatif = Detail_alt::with('alternatif', 'kriteria')->get();

        foreach ($kriteria as $row) {
            $detail_alternatif2 = db::table('detail_alts')
                ->where('kriteria_id', $row->id)
                ->get();
            $jumlah = 0;
            foreach ($detail_alternatif2 as $row2) {
                // setiap row pangkat 2
                $pangkat = pow($row2->nilai, 2);
                // sqrt pangkat 2
                // $pangkat = sqrt($pangkat);
                // jumlahkan
                $jumlah = $jumlah + $pangkat;
            }
            $arrayJumlahKriteria[] = sqrt($jumlah);
        }

        //masukan data alternatif kedalam array 
        foreach ($alternatif as $row) {
            $detail_alternatif = db::table('detail_alts')
                ->where('alternatif_id', $row->id)
                ->get();
            $jumlah = 0;
            foreach ($detail_alternatif as $row2) {
                $nilai = $row2->nilai;
                $jumlah = $jumlah + $nilai;
                $arrayAlternatif[] = $row2->nilai;
                $arrayAlternatif2[] = $row2->nilai;
            }
        }
        $arrayAlternatif = array_chunk($arrayAlternatif, 5);
        // conversi ke float
        // dd($arrayAlternatif);



        // dd($arrayAlternatif2);
        // perhitungan arrayAlternafit[0][0] / arrayJumlahKriteria[0] selanjutnya array alternatif[0][1] / arrayJumlahKriteria[1]
        // $hasil = [];
        for ($i = 0; $i < count($arrayAlternatif); $i++) {
            for ($j = 0; $j < count($arrayAlternatif[$i]); $j++) {
                $hasil[] = floatval($arrayAlternatif[$i][$j]) / floatval($arrayJumlahKriteria[$j]);
            }
        }
        $hasil = array_chunk($hasil, 5);
        //Matrik Nrmalisasi Terbobot
        // Bobot	c1=2	c2=3	c3=3	c4=1	c5=1
        $bobot = [2, 3, 3, 1, 1];
        // hasil[0][0] * c1 
        for ($i = 0; $i < count($hasil); $i++) {
            for ($j = 0; $j < count($hasil[$i]); $j++) {
                $hasil[$i][$j] = $hasil[$i][$j] * $bobot[$j];
                $hasilBobot[] = $hasil[$i][$j];
            }
        }
        $hasilBobot = (array_chunk($hasilBobot, 5));

        // SOLUSI IDEAL POSISTIF DAN SOLUSI IDEAL NEGATIF			
        $solusiIdealPositif = [];
        $solusiIdealNegatif = [];
        for ($i = 0; $i < count($hasilBobot[0]); $i++) {
            $solusiIdealPositif[] = max(array_column($hasilBobot, $i));
            $solusiIdealNegatif[] = min(array_column($hasilBobot, $i));
        }
        // Bobot Kriteria
        // 0,31
        // 0,16
        // 0,19
        // 0,09
        // 0,24
        $bobotKriteria = [0.31, 0.16, 0.19, 0.09, 0.24];
        // JARAK ALTERNATIF DENGAN SOLUSI IDEAL POSITIF DAN NEGATIF
        //hasil [0][1] dikurang solusiIdealPositif[1] pangkat 2
        // $d0Col0 = floatval($bobotKriteria[0]) * (pow(floatval($hasil[1][0]) - floatval($solusiIdealPositif[0]), 2)) di for 
        for ($i = 0; $i < count($hasil); $i++) {
            for ($j = 0; $j < count($hasil[$i]); $j++) {
                $d[$i][$j] = floatval($bobotKriteria[$j]) * (pow(floatval($hasil[$i][$j]) - floatval($solusiIdealPositif[$j]), 2));
            }
        }
        for ($i = 0; $i < count($hasil); $i++) {
            for ($j = 0; $j < count($hasil[$i]); $j++) {
                $d2[$i][$j] = floatval($bobotKriteria[$j]) * (pow(floatval($hasil[$i][$j]) - floatval($solusiIdealNegatif[$j]), 2));
            }
        }
        // sum d 
        for ($i = 0; $i < count($d); $i++) {
            $sumD[] = sqrt(array_sum($d[$i]));
        }
        for ($i = 0; $i < count($d2); $i++) {
            $sumD2[] = sqrt(array_sum($d2[$i]));
        }
        $totalIdealPositif = $sumD;
        $totalIdealNegatif = $sumD2;
        $NamaAlternatif[] = db::table('alternatifs')->get();
        // dd($NamaAlternatif[0][0]->nama);
        for ($i = 0; $i < count($totalIdealPositif); $i++) {
            // $ranking[] = $totalIdealNegatif[$i] / ($totalIdealPositif[$i] + $totalIdealNegatif[$i]);
            $ranking[] = $totalIdealNegatif[$i] / ($totalIdealPositif[$i] + $totalIdealNegatif[$i]);
            $nama[] = $NamaAlternatif[0][$i]->nama;
            $gabung[] = [$nama[$i], $ranking[$i]];
        }
        // dd($ranking);
        // urutkan gabung masuk ke array baru
        for ($i = 0; $i < count($gabung); $i++) {
            $urut[] = $gabung[$i][1];
        }
        array_multisort($urut, SORT_DESC, $gabung);
        $urutkanRanking = rsort($ranking);
        // dd($gabung);
        // for ($i = 0; $i < count($gabung); $i++) {
        //     $gabung[$i][1] = number_format($gabung[$i][1], 2);
        // }
        // dd($gabung);







        return view('perhitungan.index', compact('detail_alternatif', 'alternatif', 'kriteria', 'arrayJumlahKriteria', 'arrayAlternatif', 'hasil', 'hasilBobot', 'solusiIdealPositif', 'solusiIdealNegatif',  'totalIdealPositif', 'totalIdealNegatif', 'ranking', 'nama', 'gabung', 'urut', 'urutkanRanking'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Perhitungan  $perhitungan
     * @return \Illuminate\Http\Response
     */
    public function show(Perhitungan $perhitungan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Perhitungan  $perhitungan
     * @return \Illuminate\Http\Response
     */
    public function edit(Perhitungan $perhitungan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Perhitungan  $perhitungan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perhitungan $perhitungan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Perhitungan  $perhitungan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perhitungan $perhitungan)
    {
        //
    }
}

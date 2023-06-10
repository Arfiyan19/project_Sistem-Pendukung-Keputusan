<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Alternatif;
use App\Detail_alt;

class AlternatifAjaxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $alternatif = Alternatif::create([
            'id' => $request->idAlternatif,
            'nama' => $request->nama,
        ]);
        // foreach insert data detail_alt
        $datail_alt = [];
        $datail_idKriteria = [];
        foreach ($request->id_kriteria as $key => $value) {
            $datail_idKriteria[] = $value;
        }
        // return dd($datail_idKriteria);
        //    request nilai_kriteria[] 
        foreach ($request->nilai_kriteria as $key => $value) {
            $datail_alt[] = [
                'alternatif_id' => $request->idAlternatif,
                'kriteria_id' => 1,
                'nilai' => $value
            ];
        }
        $arrayGabungan = array_combine($datail_idKriteria, $datail_alt);
        foreach ($arrayGabungan as $key => $value) {
            $save = Detail_alt::create([
                'alternatif_id' => $value['alternatif_id'],
                'kriteria_id' => $key,
                'nilai' => $value['nilai'],
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan'
        ]);

        // kedua create data detail_alt
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = detail_alt::where('alternatif_id', $id)->with('alternatif')->with('kriteria')->get();
        // $alternatif = Alternatif::where('id', $id)->first();
        return response()->json([
            'success' => true,
            'data' => $detail,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Detail_alt::where('alternatif_id', $id)->delete();
        Alternatif::where('id', $id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Detail_alt;
use App\Http\Controllers\Controller;
use App\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KriteriaAjaxController extends Controller
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
        $kriteria = Kriteria::create([
            'name' => $request->name,
            'bobot' => $request->bobot,
            'code' => $request->code,
            'atribut' => $request->atribut,
        ]);


        return response()->json([
            'success' => true,
            'message' => 'Data berhasil disimpan'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = Kriteria::where('id', $id)->first();
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
        $kriteria = db::table('kriterias')->where('id', $id)->first();

        return response()->json(['status' => 200, 'message' => 'Success', 'data' => $kriteria], 200);
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
        // kriteria::where('id', $id)->delete();
        $detail = Detail_alt::where('kriteria_id', $id)->delete();
        $kriteria = Kriteria::where('id', $id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}

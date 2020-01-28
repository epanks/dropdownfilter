<?php

namespace App\Http\Controllers;

use App\Paket;
use DB;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (request()->ajax()) {
            if ($request->kdoutput) {
                $data = DB::table('paket')
                    ->join('tblkdoutput', 'paket.kdoutput', '=', 'tblkdoutput.kdoutput')
                    ->select('paket.id', 'paket.nmpaket', 'paket.pagurmp', 'paket.keuangan', 'paket.progres_fisik', 'tblkdoutput.nmoutput')
                    ->where('paket.kdoutput', $request->kdoutput);
            } else {
                $data = DB::table('paket')
                    ->join('tblkdoutput', 'paket.kdoutput', '=', 'tblkdoutput.kdoutput')
                    ->select('paket.id', 'paket.nmpaket', 'paket.pagurmp', 'paket.keuangan', 'paket.progres_fisik', 'tblkdoutput.nmoutput');
            }
            return datatables()->of($data)->make(true);
        }
        $kdoutput = DB::table('tblkdoutput')
            ->select("*")
            ->get();
        return view('paket-list', compact('kdoutput'));
    }

    public function wilayah(Request $request)
    {
        if (request()->ajax()) {
            if ($request->kdwilayah) {
                $data = DB::table('satker')
                    ->join('balai', 'satker.balai_id', '=', 'balai.id')
                    ->join('wilayah', 'balai.wilayah_id', '=', 'wilayah.id')
                    ->select('wilayah.id', 'wilayah.nmwilayah', 'balai.id', 'balai.nmbalai', 'satker.nmsatker')
                    ->where('balai.wilayah_id', $request->kdwilayah);
            } else {
                $data = DB::table('satker')
                    ->join('balai', 'satker.balai_id', '=', 'balai.id')
                    ->join('wilayah', 'balai.wilayah_id', '=', 'wilayah.id')
                    ->select('wilayah.id', 'wilayah.nmwilayah', 'balai.id', 'balai.nmbalai', 'satker.nmsatker');
            }
            return datatables()->of($data)->make(true);
        }
        $kdwilayah = DB::table('wilayah')
            ->select("*")
            ->get();
        return view('wilayah', compact('kdwilayah'));
    }


    public function filter(Request $request)
    {
        if (request()->ajax()) {
            if ($request->kdbalai) {
                $data = DB::table('satker')
                    ->join('balai', 'satker.balai_id', '=', 'balai.id')
                    ->select('balai.id', 'balai.nmbalai', 'satker.nmsatker')
                    ->where('satker.balai_id', $request->kdbalai);
            } else {
                $data = DB::table('satker')
                    ->join('balai', 'satker.balai_id', '=', 'balai.id')
                    ->select('balai.id', 'balai.nmbalai', 'satker.nmsatker');
            }
            return datatables()->of($data)->make(true);
        }
        $kdbalai = DB::table('balai')
            ->select("*")
            ->get();
        return view('paket-filter-all', compact('kdbalai'));
    }

    public function balaipaket(Request $request)
    {
        if (request()->ajax()) {
            if ($request->balaipaket) {
                $data = DB::table('paket')
                    ->join('satker', 'paket.kdsatker', '=', 'satker.kdsatker')
                    ->join('balai', 'satker.balai_id', '=', 'balai.id')
                    ->select('balai.nmbalai', 'paket.id', 'paket.nmpaket', 'paket.pagurmp', 'paket.keuangan', 'paket.progres_fisik')
                    ->where('balai.id', $request->balaipaket);
            } else {
                $data = DB::table('paket')
                    ->join('satker', 'paket.kdsatker', '=', 'satker.kdsatker')
                    ->join('balai', 'satker.balai_id', '=', 'balai.id')
                    ->select('balai.nmbalai', 'paket.id', 'paket.nmpaket', 'paket.pagurmp', 'paket.keuangan', 'paket.progres_fisik');
            }
            return datatables()->of($data)->make(true);
        }
        $balaipaket = DB::table('balai')
            ->select("*")
            ->get();
        return view('paket-filter-balaipaket', compact('balaipaket'));
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
     * @param  \App\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function show(Paket $paket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function edit(Paket $paket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paket $paket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paket $paket)
    {
        //
    }
}

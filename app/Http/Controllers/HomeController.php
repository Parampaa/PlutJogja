<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Kabupaten  = \App\Model\Lokasi\Kabupaten::all();
        $lokasi = collect([]);
        foreach ($Kabupaten as $kab) {
            $temp               = $kab;
            $temp->kecamatan    = $kab->daftarKecamatan()->get();
            $lokasi->push($temp);
        }
        $data       = \App\Model\JenisUsaha::all();
        return view('home')->with(['jenisUsaha'=>$data,'lokasi'=>$lokasi->toJson()]);
    }

    public function process(Request $request){
        $data = $request->all();

        return view('form.form-pkbl-print')->with($data);
    }
}

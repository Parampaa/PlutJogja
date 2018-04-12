<?php

namespace App\Http\Controllers;

use App\Model\Legalitas;
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
        $Legalitas = Legalitas::all();
        $oldest = \App\Model\Mitra::oldest()->first();
        if($oldest){
            $years = [];
            $years[] = explode('.', $oldest->id)[2];
            for($y = $years[0]+1 ; $y <= date('Y'); $y++){
                $years[] = $y;
            }
        }
        else{
            $years = [date('Y')];
        }
        
        $months = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $kriteria = \App\Model\KriteriaUMKM::all();
        return view('home')->with([
            'jenisUsaha'=> $data,
            'lokasi'    => $lokasi->toJson(),
            'lokasiArr' => $lokasi->all(),
            'legalitas' => $Legalitas,
            'years'     => $years,
            'months'    => $months,
            'kriteria'  => $kriteria
        ]);
    }

    public function process(Request $request){
        $data = $request->all();

        return view('form.form-pkbl-print')->with($data);
    }
}

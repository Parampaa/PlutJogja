<?php

namespace App\Http\Controllers\Plut;

use DB;
use Cache;
use App\Model\Mitra;
use App\Model\KriteriaUMKM;
use App\Model\Lokasi\Kabupaten;
use App\Model\Lokasi\Kecamatan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Laporan extends Controller
{
    //
    public function timeline(){
    	$awal 	= intval(substr(Mitra::oldest()->first()->id,10,4));
    	$akhir 	= intval(substr(Mitra::latest()->first()->id,10,4));
    	$timeline = [];
    	$label = [];
    	for($i=$awal-1;$awal<=$akhir+1&&$i<=$akhir+1;$i++){
    		$timeline[] = DB::table('mitra')->select('id as uid')->groupBy('uid')->having('uid','like',"%.$i.%")->get()->count();
    		$label[] = $i;
    	}
    	return response()->json(['datasets'=>$timeline,'label'=>$label],200);
    }
    public function area(){
    	$label = [];
    	$data = [];
    	foreach (Kabupaten::all() as $kab) {
    		$label[] = $kab->nama;
    		$data[] = $kab->daftarMitra()->get()->count();
    	}
    	return response()->json(['datasets'=>$data,'label'=>$label],200);
    }
    public function area2(){
    	$label = [];
    	$data = [];
    	foreach (Kecamatan::all() as $kec) {
    		$label[] = "$kec->kecamatan, ".$kec->kabupaten->nama;
    		$data[] = $kec->daftarMitra()->get()->count();
    	}
    	return response()->json(['datasets'=>$data,'label'=>$label],200);
    }
    public function category(){
    	$label = [];
    	$data = [];
    	if(Cache::has('mitra_non_filtered')){
            $mitra = Cache::get('mitra_non_filtered');
        }
        else{
        	$mitra = Mitra::all();
        	for($i = 0 ; $i < count($mitra);$i++){
                $mitra[$i]['kriteria']    = $mitra[$i]->kriteria();
            }
        }
        $dataRaw = $mitra->groupBy('kriteria');
        $dataExport = $dataRaw;
        foreach ($dataRaw as $key=>$val) {
        	$dataExport[$key] = collect($val)->count();
        }
        foreach (KriteriaUMKM::all() as $kriteria) {
        	$label[] = $kriteria->label;
        	$data[] = $dataExport[$kriteria->label];
        }
        return response()->json(['datasets'=>$data,'label'=>$label],200);
    }
}

<?php

namespace App\Http\Controllers\Plut;

use Cache;
use App\Model\KriteriaUMKM;
use App\Model\Legalitas;
use App\Model\JenisUsaha;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Pengaturan extends Controller
{
    //
    public function getKriteria(Request $request){
    	$kriteria = KriteriaUMKM::all();
    	return $kriteria;
    }
    public function postKriteria(Request $request){
    	$data = $request->all();
    	if($request->has('delete')){
    		KriteriaUMKM::find($data['delete'])->delete();
    		return redirect()->back();
    	}
    	for($i = 0 ; $i < count($data['nama_kriteria']);$i++){
    		if(!$data['id_kriteria'][$i]){
    			KriteriaUMKM::create([
    				'label' => $data['nama_kriteria'][$i],
    				'batas_asset' => $data['asset_kriteria'][$i],
    				'batas_omset' => $data['omset_kriteria'][$i],
    			]);
    		}
    		else{
    			$check = KriteriaUMKM::find($data['id_kriteria'][$i]);
    			if($check){
    				$check->label = $data['nama_kriteria'][$i];
	    			$check->batas_asset = $data['asset_kriteria'][$i];
	    			$check->batas_omset = $data['omset_kriteria'][$i];
	    			$check->save();
    			}
    		}
    	}
        Cache::flush();
    	return redirect()->back();
    }
    public function postLegalitas(Request $request){
        $id     = $request->input('id');
        $nama   = $request->input('nama');
        $des    = $request->input('deskripsi');
        for($i=0;$i < sizeof($nama);$i++){
            if($id[$i]){
                //return "$id[$i]";
                $legal = Legalitas::find($id[$i]);
                $legal -> nama      = $nama[$i];
                $legal -> deskripsi = $des[$i];
                $legal -> save();
            }
            else if( $nama[$i] && $des[$i] ){
                $legal = new Legalitas();
                $legal -> nama      = $nama[$i];
                $legal -> deskripsi = $des[$i];
                $legal -> save();
            }
        }
        return redirect()->back();
    }
    public function postJenisUMKM(Request $request){
        $id     = $request->input('id');
        $nama   = $request->input('nama');
        $des    = $request->input('deskripsi');
        for($i=0;$i< sizeof($nama);$i++){
            if($id[$i]){
                $legal = JenisUsaha::find($id[$i]);
                $legal -> nama      = $nama[$i];
                $legal -> deskripsi = $des[$i];
            }
            else if( $nama[$i] && $des[$i] ){
                $legal = new JenisUsaha();
                $legal -> nama      = $nama[$i];
                $legal -> deskripsi = $des[$i];
            }
            $legal -> save();
        }
        return redirect()->back();
    }
}

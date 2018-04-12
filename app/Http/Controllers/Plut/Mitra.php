<?php

namespace App\Http\Controllers\Plut;

use DB;
use Illuminate\Support\Facades\Cache;
use App\Model\Mitra as Model;
use App\Model\Produk;
use App\Model\JenisUsaha;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Mitra extends Controller
{
    //
    public function showList(Request $request,$mode = false){
        $hash = '';
    	if($request->has('field')){
            $filter = [];
            $orWhere = [];
            $jenisUsaha = null;
            $kriteria = null;
            for ($i=0; $i < count($request->input('field')); $i++) {
                if ($request->input('field')[$i] == 'id' || $request->input('field')[$i] == 'namaPemilik' || $request->input('field')[$i] == 'namaBadan' || $request->input('field')[$i] == 'sentra' || $request->input('field')[$i] == 'email' || $request->input('field')[$i] == 'npwp' || $request->input('field')[$i] == 'website' || $request->input('field')[$i] == 'kontak') {
                    $orWhere[] = [
                        $request->input('field')[$i],$request->input('operator')[$i],urldecode($request->input('value')[$i])
                    ];
                }
                else if($request->input('field')[$i] != 'jenis' && $request->input('field')[$i] != 'kriteria') 
                    $filter[] = [
                        $request->input('field')[$i],$request->input('operator')[$i],urldecode($request->input('value')[$i])
                    ];
                else if($request->input('field')[$i] == 'jenis'){
                    $jenisUsaha = [
                        $request->input('field')[$i],$request->input('operator')[$i],urldecode($request->input('value')[$i])
                    ];
                }
                else {
                    $kriteria = [
                        $request->input('field')[$i],$request->input('operator')[$i],urldecode($request->input('value')[$i])
                    ];
                }
                $hash.=$request->input('field')[$i].$request->input('operator')[$i].urldecode($request->input('value')[$i]);
            }
            $hash = md5($hash);
            if(Cache::has($hash)){
                $mitra = Cache::get($hash);
            }
            else{
                if($orWhere && !$filter){
                    $str = [];
                    $val = [];
                    foreach ($orWhere as $param) {
                        $str[] = "$param[0] $param[1] ?";
                        $val[] = "%$param[2]%";
                    }
                    $hasil = implode(' OR ', $str);
                    $mitra_raw = Model::whereRaw($hasil,$val)->get();
                }
                else if ($orWhere && $filter) {
                    $mitra_raw = Model::where($filter);
                    $str = [];
                    $val = [];
                    foreach ($orWhere as $param) {
                        $str[] = "$param[0] $param[1] ?";
                        $val[] = "%$param[2]%";
                    }
                    $hasil = implode(' OR ', $str);
                    $mitra_raw = $mitra_raw->whereRaw($hasil,$val)->get();
                }
                else if($filter)
                    $mitra_raw = Model::where($filter)->get();
                else
                    $mitra_raw = Model::all();
                $filtered = [];
                for($i=0,$j=0;$i<count($mitra_raw);$i++){
                    $raw_jenis = $mitra_raw[$i]->jenisUsaha();
                    if($jenisUsaha && collect($raw_jenis)->contains('id',$jenisUsaha[2])){
                        $filtered[] = $mitra_raw[$i];
                        $filtered[$j]['jenis_usaha']    = $raw_jenis;
                        $filtered[$j]['asal_kecamatan'] = $mitra_raw[$i]->asalKecamatan;
                        $filtered[$j]['kriteria']       = $mitra_raw[$i]->kriteria();
                        $filtered[$j]['avgOmset']       = $mitra_raw[$i]->trackOmset()->latest()->first()->omset;
                        $filtered[$j++]['asal_kabupaten'] = $mitra_raw[$i]->asalKabupaten;
                    }
                    else if(!$jenisUsaha){
                        $filtered[] = $mitra_raw[$i];
                        $filtered[$j]['jenis_usaha']    = $raw_jenis;
                        $filtered[$j]['asal_kecamatan'] = $mitra_raw[$i]->asalKecamatan;
                        $filtered[$j]['kriteria']       = $mitra_raw[$i]->kriteria();
                        $filtered[$j]['avgOmset']       = $mitra_raw[$i]->trackOmset()->latest()->first()->omset;
                        $filtered[$j++]['asal_kabupaten'] = $mitra_raw[$i]->asalKabupaten;
                    }
                }
                $filter_kriteria = [];
                if($kriteria){
                    for($i=0;$i<count($filtered);$i++){
                        $raw_kriteria = $filtered[$i]->kriteria();
                        if($raw_kriteria == $kriteria[2]){
                            $filter_kriteria[] = $filtered[$i];
                        }
                    }
                    $filtered=$filter_kriteria;
                }

                $mitra=$filtered;
                Cache::put($hash,$mitra,60);
            }
        }
        else {
            if(Cache::has('mitra_non_filtered')){
                $mitra = Cache::get('mitra_non_filtered');
            }
            else{
                $mitra = Model::all()->load(['asalKecamatan','asalKabupaten']);

                for($i = 0 ; $i < count($mitra);$i++){
                    $temp = [];
                    foreach ($mitra[$i]->daftarProduk()->get() as $produk) {
                        $temp[] = $produk->jenisUsaha;
                    }
                    $mitra[$i]['kriteria']    = $mitra[$i]->kriteria();
                    $mitra[$i]['avgOmset']    = $mitra[$i]->trackOmset()->latest()->first()->omset;
                    $mitra[$i]['jenis_usaha'] = collect($temp)->unique('nama')->values()->all();
                }
                Cache::put('mitra_non_filtered',$mitra,60);
            }
    	}
    	if(!$mode){
            return response()->json($mitra,200);
        }
        return $mitra;
    }

    public function add(Request $request){
    	$message = [
            'error' => false,
            'content' => 'OK'
        ];
        $data 		= $request->except(['fproduk','jenis','nproduk','asset_isian','omset_isian']);
    	
        if(Model::where('namaBadan','=',"$data[namaBadan]")->get()->count() > 0){
            $message['error']   = true;
    		$message['content'] = 'Kesamaan Badan Usaha';
            return response()->json($message,200);
    	}
        $latest = Model::latest('id')->first();
        if($latest)
    	    $total = intval(explode('.',Model::latest('id')->first()->id)[0]) + 1;
    	else
            $total = 1;
        $total = str_pad($total, 6,'0', STR_PAD_LEFT);
        $data['id'] = "$total.34.".date("Y.m");
    	$mitra 		= Model::create($data);

    	if($request->input('asset_isian'))
    		$data['asset'] = $request->input('asset_isian');
    	if($request->input('omset_isian'))
    		$data['omset'] = $request->input('omset_isian');
    	if($request->has('nproduk')){
            for($i=0;$i < count($request->nproduk) ; $i++){
                if($request->hasFile('fproduk'))
                    $produk = Produk::create([
                        'nama'      => $request->nproduk[$i],
                        'jenis'     => $request->jenis[$i],
                        'image'     => $request->fproduk[$i]->store("images/$data[id]")
                    ]);
                else
                    $produk = Produk::create([
                        'nama'      => $request->nproduk[$i],
                        'jenis'     => $request->jenis[$i]
                    ]);
                $produk -> milik() -> associate($data['id']);
                $produk -> save();
            }
        }
        Cache::flush();
    	return response()->json($message,200);
    }

    public function show(Request $request){
    	$mitra = Model::find($request->input('id'));
    	return response()->json($mitra,200);
    }

    public function edit(Request $request){
        $message = [
            'error' => false,
            'content' => 'OK'
        ];
    	$mitra 	= Model::find($request->input('id'));
    	$data 	= $request->all();
    	foreach ($mitra->toArray() as $key => $value) {
    		if(isset($data[$key])){
    			$mitra->{$key} = $data[$key];
            }
    	}
    	$mitra -> save();
        Cache::flush();
    	return response()->json($message,200);
    }

    public function delete(Request $request,$id){
    	$mitra = Model::find($id);
    	if($mitra) {
            $mitra->delete();
            Cache::flush();
        }
        return response()->json($id,200);
    }

    public function produk(Request $request){
    	$produk = Model::find($request->input('id'));
        if($produk){
            $produk = $produk->daftarProduk()->with('jenisUsaha')->get();
        }
    	return response()->json($produk,200);
    }
    public function produkAdd(Request $request){
        if($request->has('idMitra'))
            $id = $request->input('idMitra');
        else
            return $request->all();

        if($request->hasFile('image'))
            $produk = Produk::create([
                'nama'      => $request->input('nama'),
                'jenis'     => $request->input('jenis'),
                'image'     => $request->image->store("images/$id")
            ]);
        else
            $produk = Produk::create([
                'nama'      => $request->input('nama'),
                'jenis'     => $request->input('jenis')
            ]);
        
        $produk -> milik() -> associate($id);
        $produk -> save();
        Cache::flush();
        return $produk;
    }
    public function produkEdit(Request $request){
        $id = $request->input('id');
        $produk = Produk::find($id);
            
        if(!$produk){
            return 'false';
        }
        $produk -> nama = $request->input('nama');
        $produk -> jenis = $request->input('jenis');
        if($request->hasFile('image')){
            if ($produk->image) {
                unlink(storage_path($produk->image));
            }
            $produk->image = $request->image->store("images/$id");
        }
        $produk -> save();
        Cache::flush();
        return $produk;
    }
    public function produkDelete(Request $request){
        $id = $request->input('id');
        $produk = Produk::find($id);
            
        if($produk){
            $produk -> delete();
            if ($produk->image) {
                unlink(storage_path($produk->image));
            }
        }
        else{
            return "w $id";
        }
        Cache::flush();
        return 'ok';
    }

    public function idMitra(Request $request){
        $query = $request->input('id');
        $mitra = DB::table('mitra')->where('id','like',"%$query%")->get(['id','namaBadan']);
        return response()->json($mitra,200);
    }
}

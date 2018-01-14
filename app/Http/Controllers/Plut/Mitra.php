<?php

namespace App\Http\Controllers\Plut;

use App\Model\Mitra as Model;
use App\Model\Produk;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Mitra extends Controller
{
    //
    public function showList(Request $request){
    	$mitra = Model::all()->load(['jenisUsaha','asalKecamatan','asalKabupaten']);

    	// for($i=0;$i<count($mitra);$i++){
    	// 	if($mitra[$i]->jenisUsaha)
    	// 		$mitra[$i]['jenis'] = $mitra[$i]->jenisUsaha->nama;
    	// }
    	return response()->json($mitra,200);
    }

    public function add(Request $request){
    	$data 		= $request->except(['fproduk','asset_isian','omset_isian']);
    	if(Model::where('namaBadan','=',"$data[namaBadan]")->get()->count() > 0){
    		$request->session()->flash('error','Kesamaan Nama Badan Usaha');
    		return redirect()->back();
    	}


    	$total 		= intval(explode('.',Model::latest()->get()->get('id'))[0]) + 1;
    	$data['id'] = "$total.34.".date("Y.m");
    	$mitra 		= Model::create($data);

    	if($request->input('asset_isian'))
    		$data['asset'] = $request->input('asset_isian');
    	if($request->input('omset_isian'))
    		$data['omset'] = $request->input('omset_isian');
    	if($request->hasFile('fproduk'))
	    	foreach ($request->fproduk as $foto) {
	    		$produk = Produk::create([
	    			'nama'	=> '',
	    			'image'	=> $foto->store("images/$data[id]")
	    		]);
	    		$produk -> milik() -> associate($data['id']);
	    		$produk -> save();
	    	}
    	return redirect()->back();
    }

    public function show(Request $request){
    	$mitra = Model::find($request->input('id'));
    	return response()->json($mitra,200);
    }

    public function edit(Request $request){
    	$mitra 	= Model::find($request->input('id'));
    	$data 	= $request->except(['fproduk','asset_isian','omset_isian']);
    	if($request->input('asset') == 'isi')
    		$data['asset'] = $request->input('asset_isian');
    	if($request->input('omset') == 'isi')
    		$data['omset'] = $request->input('omset_isian');
    	foreach ($mitra->toArray() as $key => $value) {
    		if(isset($mitra->{$key}) && isset($data[$key]))
    			$mitra->{$key} = $data[$key];
    	}
    	if($request->hasFile('fproduk'))
	    	foreach ($request->fproduk as $foto) {
	    		$produk = Produk::create([
	    			'nama'	=> '',
	    			'image'	=> $foto->store("images/$data[id]")
	    		]);
	    		$produk -> milik() -> associate($data['id']);
	    		$produk -> save();
	    	}
    	$mitra -> save();
    	$request->session()->flash('msg','Berhasil melakukan edit mitra');
    	return redirect()->back();
    }

    public function delete(Request $request,$id){
    	$mitra = Model::find($id);
    	if($mitra) $mitra->delete();
    	return response()->json($id,200);
    }

    public function produk(Request $request){
    	$produk = Model::find($request->input('id'))->daftarProduk()->get();
    	return response()->json($produk,200);
    }
}

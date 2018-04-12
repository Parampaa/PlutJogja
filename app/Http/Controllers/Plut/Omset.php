<?php

namespace App\Http\Controllers\Plut;

use Cache;
use App\Model\TrackOmset;
use App\Model\Mitra;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Omset extends Controller
{
    public function add(Request $request){
    	$masalah = TrackOmset::create($request->only(['omset']));
    	if ($request->has('time') && strtotime($request->input('time'))) {
    		$masalah->created_at = date('Y-m-d H:i:s',strtotime($request->input('time')));
    		$masalah->save();
    	}
        $masalah->omsetMitra()->associate($request->input('mitra'));
    	$masalah->save();
    	$masalah->omsetMitra->omset = $masalah->omset;
    	$masalah->omsetMitra->save();
    	Cache::flush();
        return response()->json('ok',200);
    }

    public function show(Request $request){
        $datamitra = Mitra::find($request->input('mitra'));
        $data = null;
        if ($datamitra) {
            $data = $datamitra->trackOmset()->get();
        }
        return response()->json($data,200);
    }

    public function edit(Request $request){
        $dataomset = TrackOmset::find($request->input('id'));
        $data = [
            'message' => 'not found',
            'code'    => 404
        ];
        if ($dataomset) {
            $dataomset->omset = $request->input('omset');
            if ($request->has('time'))
    			$dataomset->created_at = date('Y-m-d H:i:s',strtotime($request->input('time')));
            $dataomset->save();
            $data = [
                'message' => 'ok',
                'code'    => 200
            ];
        }
        $dataomset->omsetMitra->omset = $dataomset->omsetMitra->trackOmset()->latest()->first()->omset;
        $dataomset->omsetMitra->save();
        Cache::flush();
        return response()->json($data['message'],$data['code']);
    }

    public function delete(Request $request){
        $dataomset = TrackOmset::find($request->input('id'));
        $data = [
            'message' => 'not found',
            'code'    => 404
        ];
        if ($dataomset) {
        	$mitra = $dataomset->omsetMitra;
            $dataomset->delete();
            $mitra->omset = $mitra->trackOmset()->latest()->first()->omset;
            $mitra->save();
            $data = [
                'message' => 'ok',
                'code'    => 200
            ];
        }

        Cache::flush();
        return response()->json($data['message'],$data['code']);
    }
}

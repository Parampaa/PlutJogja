<?php

namespace App\Http\Controllers\Plut;

use App\Model\Konsultasi as Masalah;
use App\Model\Mitra;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Konsultasi extends Controller
{
    //
    public function add(Request $request){
    	$masalah = Masalah::create($request->only(['masalah','diagnosa','solusi']));
        $masalah->mitraKonsultasi()->associate($request->input('mitra'));
    	$masalah->save();
        return response()->json('ok',200);
    }

    public function show(Request $request){
        $datamitra = Mitra::find($request->input('mitra'));
        $data = null;
        if ($datamitra) {
            $data = $datamitra->konsultasi()->get();
        }
        return response()->json($data,200);
    }

    public function edit(Request $request){
        $datakonsul = Masalah::find($request->input('id'));
        $data = [
            'message' => 'not found',
            'code'    => 404
        ];
        if ($datakonsul) {
            $datakonsul->masalah = $request->input('masalah');
            $datakonsul->diagnosa = $request->input('diagnosa');
            $datakonsul->solusi = $request->input('solusi');
            $datakonsul->save();
            $data = [
                'message' => 'ok',
                'code'    => 200
            ];
        }
        return response()->json($data['message'],$data['code']);
    }

    public function delete(Request $request){
        $datakonsul = Masalah::find($request->input('id'));
        $data = [
            'message' => 'not found',
            'code'    => 404
        ];
        if ($datakonsul) {
            $datakonsul->delete();
            $data = [
                'message' => 'ok',
                'code'    => 200
            ];
        }
        return response()->json($data['message'],$data['code']);
    }
}

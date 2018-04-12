<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Mitra extends Model
{
    //
    protected $table	= 'mitra';
    protected $guarded 	= [];
    public $incrementing = false;
    public function jenisUsaha(){
        $data = $this->daftarProduk()->get();
        $result = [];
        foreach ($data as $produk) {
            $result[] = $produk->jenisUsaha; 
        }
        return collect($result)->unique('nama')->values()->all();
    }
    public function kriteria(){
        $kriteria = KriteriaUMKM::all();

        $omset = $this->lastOmset()->omset;
        
        if (!$this->asset || !$this->omset ) {
            return 'Data Kosong';
        }
        for($i = 0; $i<count($kriteria) ; $i++){
            if($this->asset <= $kriteria[$i]->batas_asset && $omset <= $kriteria[$i]->batas_omset){
                return $kriteria[$i]->label;
            }
        }
        for($i = 0; $i<count($kriteria) ; $i++){
            if($omset <= $kriteria[$i]->batas_omset){
                return $kriteria[$i]->label;
            }
        }
        return 'Tidak Dapat Digolongkan';
    }
    public function trackOmset(){
        return $this->hasMany('App\Model\TrackOmset','mitra');
    }
    public function avgOmset(){
        $omset = 0 ;
        $i = 0;
        foreach ($this->trackOmset()->get() as $data) {
            $omset += $data->omset;
            $i++;
        }
        if($i)
            return $omset/$i;
        return $omset;
    }
    public function lastOmset(){
        return $this->trackOmset()->latest()->first();
    }

    public function konsultasi(){
        return $this->hasMany('App\Model\konsultasi','mitra');
    }
    public function daftarProduk(){
    	return $this->hasMany('App\Model\Produk','mitra');
    }
    public function asalKabupaten(){
    	return $this->belongsTo('App\Model\Lokasi\Kabupaten','kabupaten');
    }
    public function asalKecamatan(){
    	return $this->belongsTo('App\Model\Lokasi\Kecamatan','kecamatan');
    }
}

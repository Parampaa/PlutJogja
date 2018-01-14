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
    	return $this->belongsTo('App\Model\JenisUsaha','jenis');
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

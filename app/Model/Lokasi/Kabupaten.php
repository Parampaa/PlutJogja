<?php

namespace App\Model\Lokasi;

use Illuminate\Database\Eloquent\Model;

class Kabupaten extends Model
{
    //
    protected $table = 'kabupaten';

    public function daftarKecamatan(){
    	return $this->hasMany('App\Model\Lokasi\Kecamatan','id_kabupaten');
    }
    public function daftarMitra(){
    	return $this->hasMany('App\Model\Mitra','kabupaten');
    }
}

<?php

namespace App\Model\Lokasi;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    //
    protected $table = 'kecamatan';
    public function kabupaten(){
    	return $this->belongsTo('App\Model\Lokasi\Kabupaten','id_kabupaten');
    }
    public function daftarMitra(){
    	return $this->hasMany('App\Model\Mitra','kecamatan');
    }
}

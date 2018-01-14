<?php

namespace App\Model\Lokasi;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    //
    protected $table = 'kecamatan';
    public function daftarKecamatan(){
    	return $this->belongsTo('App\Model\Lokasi\Kabupaten','id_kabupaten');
    }
}

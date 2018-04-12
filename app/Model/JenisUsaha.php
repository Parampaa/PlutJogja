<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JenisUsaha extends Model
{
    //
    protected $table	= 'jenis_usaha';
    protected $guarded 	= ['id'];
    public $timestamps	= false;

    public function pelaku(){
    	return $this->hasMany('App\Model\Mitra','jenis');
    }
    public function macamProduk(){
    	return $this->hasMany('App\Model\Produk','jenis');
    }
}

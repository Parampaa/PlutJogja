<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    //
    protected $table	= 'produk';
    protected $guarded 	= ['id'];
    public $timestamps	= false;

    public function milik(){
    	return $this->belongsTo('\App\Model\Mitra','mitra');
    }
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    //
    protected $table	= 'konsultasi';
    protected $guarded 	= ['id'];

    public function mitraKonsultasi(){
    	return $this->belongsTo('\App\Model\Mitra','mitra');
    }
}

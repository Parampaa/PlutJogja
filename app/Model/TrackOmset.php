<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TrackOmset extends Model
{
    //
    protected $table	= 'track_omset';
    protected $guarded 	= [];

    public function omsetMitra(){
    	return $this->belongsTo('App\Model\Mitra','mitra');
    }
}

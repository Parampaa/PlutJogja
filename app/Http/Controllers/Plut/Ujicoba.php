<?php

namespace App\Http\Controllers\Plut;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Ujicoba extends Controller
{
    public function usaha($str){
	
	$str=strtolower($str);
	if($str==null || trim($str)=='' || trim($str)=='-' ){
		return null;
	}
	else if(strstr($str, "produksi") || strstr($str, "olah") ){
		return 14;
	}
	else if(strstr($str, "dagang")  ){
		return 9;
	}
	else if(strstr($str, "ternak") ||strstr($str, "pakan")  ){
		return 5;
	}
	else if(strstr($str, "makanan") || strstr($str, "minuman") || strstr($str, "snack") || strstr($str, "kuliner")){
		return 1;
	}
	else if(strstr($str, "rajin") || strstr($str, "craft") || strstr($str, "handy") || strstr($str, "mebel")){
		return 4; 
	}
	else if(strstr($str, "fashion") || strstr($str, "modis") || strstr($str, "batik") || strstr($str, "baju") || strstr($str, "celana") || strstr($str, "tas")  ){
		return 2;
	}
	else if(strstr($str, "ikan")  ){
		return 7;
	}
	else if(strstr($str, "tani") || strstr($str, "pupuk") || strstr($str, "urea")){
		return 3;
	}

	else if(strstr($str, "jasa") || strstr($str, "salon") || strstr($str, "laundry")  ){
		return 6;
	}
	else if(strstr($str, "koperasi") || strstr($str, "simpan") || strstr($str, "pinjam") || strstr($str, "sentra") ){
		return 8;
	}
	else if(strstr($str, "bengkel") || strstr($str, "motor") || strstr($str, "mobil") ){
		return 10;
	}
	else if(strstr($str, "bimbel") || strstr($str, "kursus") || strstr($str, "les") ){
		return 11;
	}
	else if(strstr($str, "commerce") || strstr($str, "online") ){
		return 12;
	}
	else if(strstr($str, "komputer") || strstr($str, "elektronik") | strstr($str, "gadget") ){
		return 13;
	}

	

	}

}

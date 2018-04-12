<?php

namespace App\Http\Controllers\Plut;

use Cache;
use App\Model\Mitra;
use App\Model\TrackOmset;
use App\Model\Produk;
use App\Model\KriteriaUMKM as Kriteria;
use App\Http\Controllers\Plut\Mitra as MitraController;
use App\Model\Lokasi\Kecamatan;
use App\Model\Lokasi\Kabupaten;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Excel extends Controller
{
    //
	public function nominal($str){
		$str = strtolower($str);
		$n = str_replace('.', '', $str);
		$n = str_replace(',', '.', $n);
		if(strstr($str, 'jt') || strstr($str, 'juta')){
			return floatval($n)*1000000;
		}
		elseif (strstr($str, 'rb') || strstr($str, 'ribu')) {
			return floatval($str)*1000;
		}
		elseif (strstr($str, 'M')) {
			return floatval($str)*1000000000;
		}
		elseif (strstr($str, '-')) {
			$str = explode('-', $str);
			$str[0] = str_replace('.', '', $str[0]);
			$str[0] = str_replace(',', '.', $str[0]);
			$str[1] = str_replace('.', '', $str[1]);
			$str[1] = str_replace(',', '.', $str[1]);
			return ( floatval($str[1]) + floatval($str[0]) )/2;
		}
		return floatval($n)<1000?floatval($n)*1000:floatval($n);
	}
	private function formatID($str){
		$arr = explode('.', $str);
		$number = intval($arr[0]);
		$strpad = str_pad($number, 6,'0', STR_PAD_LEFT);
		$arr[0] = $strpad;
		return implode('.', $arr);
	}

    public function import(Request $request){
    	ini_set('max_execution_time', 0);

    	$file = $request->file('excel')->path();
    	$reader = IOFactory::createReader('Xlsx');
    	//$reader->setReadOnlyData(true);
    	$spreadsheet = $reader->load($file);
    	$worksheet = $spreadsheet->getSheetByName($request->input('sheet'));
    	// Get the highest row and column numbers referenced in the worksheet
		$highestRow = $worksheet->getHighestRow(); // e.g. 10
		$highestColumn = $worksheet->getHighestColumn(); // e.g 'F'
		$highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
		
		$mode = $request->input('mode');
		$baris_batas = [$request->input('baris_awal'),$request->input('baris_akhir')];
		$baris_batas[0] = intval($baris_batas[0]);
		$baris_batas[1] = intval($baris_batas[1])?intval($baris_batas[1]):$highestRow;
    	for($row = $baris_batas[0]; $row < $baris_batas[1];$row++){
    		$result = [];
		    $result['id'] = $this->formatID( trim($worksheet->getCellByColumnAndRow(1, $row)->getValue()) );
		    $mitra = Mitra::find($result['id']);
		    if( $mode != 'add' && $result['id'] && !$mitra ){
			    $result['namaPemilik'] = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
			    $result['namaBadan'] = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
			    
			    $result['alamat'] = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
			    
			    $str_kec = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
			    if( ($hasil = Kecamatan::where('kecamatan','like','%'.ucfirst($str_kec).'%')->first()) ){
			    	$result['kecamatan'] = $hasil->id;
			    	$result['kabupaten'] = $hasil->id_kabupaten;
			    }
			    else{
			    	$result['kecamatan'] = null;
			    	$str_kab = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
			    	if( ($hasil = Kabupaten::where('nama','like','%'.ucfirst($str_kab).'%')->first()))
				    	$result['kabupaten'] = $hasil->id;
			    	else if(ucfirst($str_kab) == 'Kodya')
				    	$result['kabupaten'] = 1;
			    	else
			    		$result['kabupaten'] = null;
			    }
			    
			    
			    $result['kontak'] = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
			    if( ($hasil = trim($worksheet->getCellByColumnAndRow(10, $row)->getValue()) && ($hasil != null && $hasil != '') ) )
			    	$result['tahun'] = date('Y', strtotime($hasil) );
			    else
			    	$result['tahun'] = null;
			    $result['omset'] = $this->nominal($worksheet->getCellByColumnAndRow(14, $row)->getValue());
			    $result['asset'] = $this->nominal($worksheet->getCellByColumnAndRow(15, $row)->getValue());
			    if( !$result['omset'] || !$result['asset'] ){
			    	$kriteria = $worksheet->getCellByColumnAndRow(11, $row);
			    	$prev = [1,1];
			    	foreach (Kriteria::all() as $krit) {
			    		if( strstr(strtolower($kriteria), strtolower($krit->label) )){
			    			$result['omset'] = $prev[0];
			    			$result['asset'] = $prev[1];
			    			break;
			    		}
			    		$prev = [$krit->batas_omset+1,$krit->batas_asset+1];
			    	}
			    }
			    $result['status'] = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
			    $result['sentra'] = $worksheet->getCellByColumnAndRow(25, $row)->getValue();
			    $result['legalitas'] = $worksheet->getCellByColumnAndRow(26, $row)->getValue();
			    $result['total_karyawan'] = intval($worksheet->getCellByColumnAndRow(27, $row)->getValue());
			    $result['email'] = $worksheet->getCellByColumnAndRow(29, $row)->getValue();
			    $result['npwp'] = $worksheet->getCellByColumnAndRow(30, $row)->getValue();
			    $result['volume'] = $worksheet->getCellByColumnAndRow(32, $row)->getValue();
			    $mitra = Mitra::create($result);
			    $produk = [];
			    if( ($hasil = $this->usaha($worksheet->getCellByColumnAndRow(4, $row)->getValue()) ) )
			    	$produk['jenis'] = $hasil;
			    $produk['mitra'] = $mitra->id;
			    $produk['nama'] = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
			    $produk= Produk::create($produk);
				    $TrackOmset = TrackOmset::create([
				    	'mitra' => $mitra->id,
				    	'omset' => $mitra->omset
				    ]);
			}
			elseif( $mode == 'replace' && $result['id'] && $mitra ){
				$mitra->namaPemilik = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
			    $mitra->namaBadan = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
			    
			    $mitra->alamat = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
			    
			    $str_kec = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
			    if( ($hasil = Kecamatan::where('kecamatan','like',"%".ucfirst($str_kec)."%")->first() )){
			    	$mitra->kecamatan = $hasil->id;
			    	$mitra->kabupaten = $hasil->id_kabupaten;
			    }
			    else{
			    	$mitra->kecamatan = null;
			    	$str_kab = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
			    	if( ($hasil = Kabupaten::where('nama','like',"%".ucfirst($str_kab)."%")->first())){
				    	$mitra->kabupaten = $hasil->id;
				    	if(ucfirst($str_kab) == 'Kodya')
				    		$mitra->kabupaten = 1;
			    	}
			    	else{
			    		$mitra->kabupaten = null;
			    	}
			    }
			    $mitra->kontak = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
			    if( ($hasil = trim($worksheet->getCellByColumnAndRow(10, $row)->getValue()) && ($hasil != null && $hasil != '') ) )
			    	$mitra->tahun = date('Y', strtotime($worksheet->getCellByColumnAndRow(10, $row)->getValue()) );
				else
					$mitra->tahun = null;
			    $mitra->omset 		= $this->nominal($worksheet->getCellByColumnAndRow(14, $row)->getValue());
			    $mitra->asset 		= $this->nominal($worksheet->getCellByColumnAndRow(15, $row)->getValue());
			    if( !$mitra->omset || !$mitra->asset ){
			    	$kriteria = $worksheet->getCellByColumnAndRow(11, $row);
			    	$prev = [1,1];
			    	foreach (Kriteria::all() as $krit) {
			    		if( strstr(strtolower($kriteria), strtolower($krit->label) )){
			    			$mitra->omset = $prev[0];
			    			$mitra->asset = $prev[1];
			    			break;
			    		}
			    		$prev = [$krit->batas_omset+1,$krit->batas_asset+1];
			    	}
			    }
			    $mitra->status 		= $worksheet->getCellByColumnAndRow(16, $row)->getValue();
			    $mitra->sentra 		= $worksheet->getCellByColumnAndRow(25, $row)->getValue();
			    $mitra->legalitas 	= $worksheet->getCellByColumnAndRow(26, $row)->getValue();
			    $mitra->total_karyawan = intval($worksheet->getCellByColumnAndRow(27, $row)->getValue());
			    $mitra->email 		= $worksheet->getCellByColumnAndRow(29, $row)->getValue();
			    $mitra->npwp 		= $worksheet->getCellByColumnAndRow(30, $row)->getValue();
			    $mitra->volume 		= $worksheet->getCellByColumnAndRow(32, $row)->getValue();
			    $mitra->save();
			    $TrackOmset = $mitra->trackOmset()->first();
				$TrackOmset -> omset = $mitra->omset;
				$TrackOmset -> save();
			}
			elseif ($mode == 'add') {
				$latest = Mitra::latest('id')->first();
		        if($latest)
		    	    $total = intval(explode('.',Mitra::latest('id')->first()->id)[0]) + 1;
		    	else
		            $total = 1;
		        $result['id'] = "$total.34.".date("Y.m");
				$result['namaPemilik'] = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
			    $result['namaBadan'] = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
			    
			    $result['alamat'] = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
			    
			    $str_kec = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
			    if( ($hasil = Kecamatan::where('kecamatan','like','%'.ucfirst($str_kec).'%')->first()) ){
			    	$result['kecamatan'] = $hasil->id;
			    	$result['kabupaten'] = $hasil->id_kabupaten;
			    }
			    else{
			    	$result['kecamatan'] = null;
			    	$str_kab = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
			    	if( ($hasil = Kabupaten::where('nama','like','%'.ucfirst($str_kab).'%')->first()))
				    	$result['kabupaten'] = $hasil->id;
			    	else if(ucfirst($str_kab) == 'Kodya')
				    	$result['kabupaten'] = 1;
			    	else
			    		$result['kabupaten'] = null;
			    }
			    
			    
			    $result['kontak'] = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
			    if( ($hasil = trim($worksheet->getCellByColumnAndRow(10, $row)->getValue()) && ($hasil != null && $hasil != '') ) )
			    	$result['tahun'] = date('Y', strtotime($hasil) );
			    else
			    	$result['tahun'] = null;
			    $result['omset'] = $this->nominal($worksheet->getCellByColumnAndRow(14, $row)->getValue());
			    $result['asset'] = $this->nominal($worksheet->getCellByColumnAndRow(15, $row)->getValue());
			    if( !$mitra->omset || !$mitra->asset ){
			    	$kriteria = $worksheet->getCellByColumnAndRow(11, $row);
			    	$prev = [1,1];
			    	foreach (Kriteria::all() as $krit) {
			    		if( strstr(strtolower($kriteria), strtolower($krit->label) )){
			    			$mitra->omset = $prev[0];
			    			$mitra->asset = $prev[1];
			    			break;
			    		}
			    		$prev = [$krit->batas_omset+1,$krit->batas_asset+1];
			    	}
			    }
			    $result['status'] = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
			    $result['sentra'] = $worksheet->getCellByColumnAndRow(25, $row)->getValue();
			    $result['legalitas'] = $worksheet->getCellByColumnAndRow(26, $row)->getValue();
			    $result['total_karyawan'] = intval($worksheet->getCellByColumnAndRow(27, $row)->getValue());
			    $result['email'] = $worksheet->getCellByColumnAndRow(29, $row)->getValue();
			    $result['npwp'] = $worksheet->getCellByColumnAndRow(30, $row)->getValue();
			    $result['volume'] = $worksheet->getCellByColumnAndRow(32, $row)->getValue();
			    
			    if (!$this->dataValid($result['namaBadan'],$result['namaPemilik'])) {
			    	continue;
			    }
			    $mitra = Mitra::create($result);
			    //$produk['jenis'] = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
			    $produk = [];
			    if( ($hasil = $this->usaha($worksheet->getCellByColumnAndRow(4, $row)->getValue()) ) )
			    	$produk['jenis'] = $hasil;
			   	
			    $produk['mitra'] = $mitra->id;
			    $produk['nama'] = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
			    $produk= Produk::create($produk);
			    $TrackOmset = TrackOmset::create([
				    	'mitra' => $mitra->id,
				    	'omset' => $mitra->omset
				    ]);
			}
		}
		Cache::flush();
		return redirect()->back();
    }
    private function dataValid($NamaBadanUsaha,$NamaPemilik){
    	return $NamaBadanUsaha && $NamaPemilik;
    }
    public function export(Request $request){
    	$spreadsheet = new Spreadsheet();
		$worksheet = $spreadsheet->getActiveSheet();
		$worksheet->setCellValueByColumnAndRow(1, 1, 'No Mitra');
		$worksheet->setCellValueByColumnAndRow(2, 1, 'Nama Pemilik');
		$worksheet->setCellValueByColumnAndRow(3, 1, 'Nama Usaha');
		$worksheet->setCellValueByColumnAndRow(4, 1, 'Jenis Usaha');
		$worksheet->setCellValueByColumnAndRow(5, 1, 'Produk');
		$worksheet->setCellValueByColumnAndRow(6, 1, 'Alamat');
		$worksheet->setCellValueByColumnAndRow(7, 1, 'Kecamatan');
		$worksheet->setCellValueByColumnAndRow(8, 1, 'Kabupaten');
		$worksheet->setCellValueByColumnAndRow(9, 1, 'Kontak');
		$worksheet->setCellValueByColumnAndRow(10, 1, 'Tahun');
		$worksheet->setCellValueByColumnAndRow(11, 1, 'Kriteria');
		$worksheet->setCellValueByColumnAndRow(12, 1, 'Omset');
		$worksheet->setCellValueByColumnAndRow(13, 1, 'Asset');
		$worksheet->setCellValueByColumnAndRow(14, 1, 'Status pada Usaha');
		$worksheet->setCellValueByColumnAndRow(15, 1, 'Sentra');
		$worksheet->setCellValueByColumnAndRow(16, 1, 'Legalitas Usaha');
		$worksheet->setCellValueByColumnAndRow(17, 1, 'Jumlah Karyawan');
		$worksheet->setCellValueByColumnAndRow(18, 1, 'Email');
		$worksheet->setCellValueByColumnAndRow(19, 1, 'Kapasitas Produksi / Volume Usaha');
		$row = 2;

    	if($request->input('exportMode') == 'all'){
    		$mitra = Mitra::all();
    		foreach ($mitra as $baris) {
				$produk = $baris->daftarProduk()->with('jenisUsaha')->get();
				$jenis  = [];
				$namaProduk = [];
				foreach ($produk as $k) {
					$jenis[] = collect($k)->all()['jenis_usaha']['nama'];
					$namaProduk[] = $k->nama;
				}
				$jenis = implode(',', collect($jenis)->unique()->values()->all());
				$namaProduk = implode(',', $namaProduk);
				$worksheet->setCellValueByColumnAndRow(1,$row, $baris->id);
				$worksheet->setCellValueByColumnAndRow(2,$row, $baris->namaPemilik);
				$worksheet->setCellValueByColumnAndRow(3,$row, $baris->namaBadan);
				$worksheet->setCellValueByColumnAndRow(4,$row, $jenis);
				$worksheet->setCellValueByColumnAndRow(5,$row, $namaProduk);
				$worksheet->setCellValueByColumnAndRow(6,$row, $baris->alamat);
				if($baris->asalKecamatan)
					$worksheet->setCellValueByColumnAndRow(7,$row, $baris->asalKecamatan->kecamatan);
				if($baris->asalKabupaten)
					$worksheet->setCellValueByColumnAndRow(8,$row, $baris->asalKabupaten->nama);
				$worksheet->setCellValueByColumnAndRow(9,$row, $baris->kontak);
				$worksheet->setCellValueByColumnAndRow(10,$row, $baris->tahun);
				$worksheet->setCellValueByColumnAndRow(11,$row, $baris->kriteria());
				$worksheet->setCellValueByColumnAndRow(12,$row, $baris->omset);
				$worksheet->setCellValueByColumnAndRow(13,$row, $baris->asset);
				$worksheet->setCellValueByColumnAndRow(14,$row, $baris->status);
				$worksheet->setCellValueByColumnAndRow(15,$row, $baris->sentra);
				$worksheet->setCellValueByColumnAndRow(16,$row, $baris->legalitas);
				$worksheet->setCellValueByColumnAndRow(17,$row, $baris->total_karyawan);
				$worksheet->setCellValueByColumnAndRow(18,$row, $baris->email);
				$worksheet->setCellValueByColumnAndRow(19,$row++, $baris->volume);
			}
    	}
    	else{
    		$mitra = (new MitraController())->showList($request,true);
    		//return collect($mitra[0]->daftarProduk()->with('jenisUsaha')->get());
    		foreach ($mitra as $baris) {
				$worksheet->setCellValueByColumnAndRow(1,$row, $baris->id);
				$worksheet->setCellValueByColumnAndRow(2,$row, $baris->namaPemilik);
				$worksheet->setCellValueByColumnAndRow(3,$row, $baris->namaBadan);
				$produk = $baris->daftarProduk()->with('jenisUsaha')->get();
				$jenis  = [];
				$namaProduk = [];
				foreach ($produk as $k) {
					$jenis[] = collect($k)->all()['jenis_usaha']['nama'];
					$namaProduk[] = $k->nama;
				}
				$jenis = implode(',', collect($jenis)->unique()->values()->all());
				$namaProduk = implode(',', $namaProduk);
				$worksheet->setCellValueByColumnAndRow(4,$row, $jenis);
				$worksheet->setCellValueByColumnAndRow(5,$row, $namaProduk);
				$worksheet->setCellValueByColumnAndRow(6,$row, $baris->alamat);
				$worksheet->setCellValueByColumnAndRow(7,$row, $baris->asal_kecamatan['kecamatan']);
				$worksheet->setCellValueByColumnAndRow(8,$row, $baris->asal_kabupaten['nama']);
				$worksheet->setCellValueByColumnAndRow(9,$row, $baris->kontak);
				$worksheet->setCellValueByColumnAndRow(10,$row, $baris->tahun);
				$worksheet->setCellValueByColumnAndRow(11,$row, $baris->kriteria());
				$worksheet->setCellValueByColumnAndRow(12,$row, $baris->omset);
				$worksheet->setCellValueByColumnAndRow(13,$row, $baris->asset);
				$worksheet->setCellValueByColumnAndRow(14,$row, $baris->status);
				$worksheet->setCellValueByColumnAndRow(15,$row, $baris->sentra);
				$worksheet->setCellValueByColumnAndRow(16,$row, $baris->legalitas);
				$worksheet->setCellValueByColumnAndRow(17,$row, $baris->total_karyawan);
				$worksheet->setCellValueByColumnAndRow(18,$row, $baris->email);
				$worksheet->setCellValueByColumnAndRow(19,$row++, $baris->volume);
			}
    	}
		
		
		$namafile = $request->input('exportName');
		$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, "Xlsx");
		$writer->save(storage_path("app/$namafile.xlsx"));
		return response()->download(storage_path("app/$namafile.xlsx"))->deleteFileAfterSend(true);	
    }


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
		return null;
	}
}

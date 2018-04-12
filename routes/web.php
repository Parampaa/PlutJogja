<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/form',function(){
	return view('form.form-pkbl');
});

Route::post('/form','HomeController@process')->name('form-pkbl');


Route::group(['prefix'=>'kelola','middleware'=>'auth'],function(){
	Route::group(['prefix'=>'mitra'],function(){
		Route::post   ('add'   ,'Plut\Mitra@add')->name('mitra-add');
		Route::get    ('list'  ,'Plut\Mitra@showList')->name('mitra-list');
		Route::get 	  ('check' ,'Plut\Mitra@check');
		Route::get 	  ('cariID' ,'Plut\Mitra@idMitra')->name('mitra-cariid');
		Route::get 	  ('show'  ,'Plut\Mitra@show')->name('mitra-show');
		Route::post   ('edit'  ,'Plut\Mitra@edit')->name('mitra-edit');
		Route::get    ('produk'  ,'Plut\Mitra@produk')->name('mitra-produk');
		Route::post   ('produk'  ,'Plut\Mitra@produkAdd')->name('mitra-produk-add');
		Route::post   ('produk/edit'  ,'Plut\Mitra@produkEdit')->name('mitra-produk-edit');
		Route::post   ('produk/delete'  ,'Plut\Mitra@produkDelete')->name('mitra-produk-delete');
		Route::post   ('delete/{id}'  ,'Plut\Mitra@delete')->name('mitra-delete');

		Route::post   ('jenis','Plut\Pengaturan@jenis');

		Route::post   ('import','Plut\Excel@import')->name('mitra-import');
		Route::get    ('export','Plut\Excel@export')->name('mitra-export');

		Route::get     ('kriteria','Plut\Pengaturan@getkriteria')->name('kriteria-get');
		Route::post    ('kriteria','Plut\Pengaturan@postkriteria')->name('kriteria-set');

		Route::post    ('legalitas','Plut\Pengaturan@postLegalitas')->name('legalitas');
		Route::post    ('jenis_umkm','Plut\Pengaturan@postJenisUMKM')->name('jenis_umkm');
	});
	Route::group(['prefix'=>'konsultasi'],function(){
		Route::post   ('add'   ,'Plut\Konsultasi@add')->name('konsultasi-add');
		Route::get    ('list'  ,'Plut\Konsultasi@showList')->name('konsultasi-list');
		Route::get 	  ('show'  ,'Plut\Konsultasi@show')->name('konsultasi-show');
		Route::post   ('edit'  ,'Plut\Konsultasi@edit')->name('konsultasi-edit');
		Route::post   ('delete'  ,'Plut\Konsultasi@delete')->name('konsultasi-delete');
	});

	Route::group(['prefix'=>'omset'],function(){
		Route::post   ('add'   ,'Plut\Omset@add')->name('omset-add');
		Route::get    ('list'  ,'Plut\Omset@showList')->name('omset-list');
		Route::get 	  ('show'  ,'Plut\Omset@show')->name('omset-show');
		Route::post   ('edit'  ,'Plut\Omset@edit')->name('omset-edit');
		Route::post   ('delete'  ,'Plut\Omset@delete')->name('omset-delete');
	});

	Route::group(['prefix'=>'anggota'],function(){
		Route::post   ('add'   ,'Plut\Anggota@add')->name('anggota-add');
		Route::get    ('list'  ,'Plut\Anggota@showList')->name('anggota-list');
		Route::get 	  ('{id}'  ,'Plut\Anggota@show');
		Route::post   ('{id}'  ,'Plut\Anggota@edit');
		Route::delete ('{id}'  ,'Plut\Anggota@delete');
	});
});


	Route::group(['prefix'=>'laporan'],function(){
		Route::get   ('timeline'   ,'Plut\Laporan@timeline')->name('laporan-timeline');
		Route::get   ('area'   ,'Plut\Laporan@area')->name('laporan-area');
		Route::get   ('kec'   ,'Plut\Laporan@area2')->name('laporan-kec');
		Route::get   ('category'   ,'Plut\Laporan@category')->name('laporan-category');
	});

Route::get('/images/{id}/{file}',function($id,$file){
	$path = storage_path("app/images/$id/$file");

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
})->where(['id'=>'[^/]+','file'=>'[^/]+']);

Route::get('coba','Plut\Laporan@timeline');
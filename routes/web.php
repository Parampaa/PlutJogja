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
		Route::get 	  ('show'  ,'Plut\Mitra@show')->name('mitra-show');
		Route::post   ('edit'  ,'Plut\Mitra@edit')->name('mitra-edit');
		Route::get    ('produk'  ,'Plut\Mitra@produk')->name('mitra-produk');
		Route::post   ('delete/{id}'  ,'Plut\Mitra@delete')->name('mitra-delete');
		
	});
	Route::group(['prefix'=>'konsultasi'],function(){
		Route::post   ('add'   ,'Plut\Konsultasi@add');
		Route::get    ('list'  ,'Plut\Konsultasi@showList');
		Route::get 	  ('{id}'  ,'Plut\Konsultasi@show');
		Route::post   ('{id}'  ,'Plut\Konsultasi@edit');
		Route::delete ('{id}'  ,'Plut\Konsultasi@delete');
	});
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
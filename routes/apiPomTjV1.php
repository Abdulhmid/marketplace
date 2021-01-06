<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes Version 1
|--------------------------------------------------------------------------
|
*/

 
Route::group(['prefix' => 'data'], function () {
	Route::post('/complaint', 'API\\GeneralController@complaint');
	Route::get('/products', 'API\\ProductsController@dataProducts');
	Route::get('/sliders', 'API\\SlidersController@dataSliders');
	Route::get('/data-general', 'API\\GeneralController@dataGeneral');
	Route::post('/buy', 'API\\GeneralController@buy');
	Route::post('/confirm', 'API\\GeneralController@confirm');
	Route::get('/cek-ongkir', 'API\\GeneralController@cekOngkir');
	Route::get('/cek-status', 'API\\GeneralController@cekStatusTrans');
	Route::post('/actionLogin', 'API\\GeneralController@actionLogin');
	Route::post('/actionRegister', 'API\\GeneralController@actionRegister');
	Route::post('/gologout', 'API\\GeneralController@goLogout');

});

<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes Version 1
|--------------------------------------------------------------------------
|
*/

 
Route::group(['prefix' => 'data'], function () {
	Route::get('/products', 'API\\ProductsController@dataProducts');
	Route::get('/sliders', 'API\\SlidersController@dataSliders');
	Route::get('/data-general', 'API\\GeneralController@dataGeneral');
	Route::post('/buy', 'API\\GeneralController@buy');
});

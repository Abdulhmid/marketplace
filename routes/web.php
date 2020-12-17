<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'HomeMarketController@index')->name('home-market');
Route::get('/products', 'HomeMarketController@products')->name('home-products');
Route::get('/products/{category}', 'HomeMarketController@productsCategory')
		->name('productsCategory');
Route::get('/products/detail/{slug}', 'HomeMarketController@productsDetail')
		->name('productsDetail');
Route::post('/products/checkout', 'HomeMarketController@checkout')->name('checkout');
Route::post('/products/data-checkout', 'HomeMarketController@checkoutData')->name('checkoutData');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('roles', ['uses'=>'RolesController@index', 'as'=>'roles.index']);
Route::get('roles/create', ['uses'=>'RolesController@create', 'as'=>'roles.create']);
Route::post('roles', ['uses'=>'RolesController@store', 'as'=>'roles.store']);
Route::get('roles-delete/{id}', ['uses'=>'RolesController@destroy', 'as'=>'roles.destro']);
Route::get('roles/{id}', ['uses'=>'RolesController@edit', 'as'=>'roles.edit']);

// Users
Route::get('users', ['uses'=>'UsersController@index', 'as'=>'users.index']);
Route::get('users/create', ['uses'=>'UsersController@create', 'as'=>'users.create']);
Route::post('users', ['uses'=>'UsersController@store', 'as'=>'users.store']);
Route::get('users-delete/{id}', ['uses'=>'UsersController@destroy', 'as'=>'users.destroy']);
Route::get('users/{id}', ['uses'=>'UsersController@edit', 'as'=>'users.edit']);

// Products Category
Route::get('products-category', 
	['uses'=>'ProductsCategoryController@index', 'as'=>'products-category.index']);
Route::get('products-category/create', 
	['uses'=>'ProductsCategoryController@create', 'as'=>'products-category.create']);
Route::post('products-category', 
	['uses'=>'ProductsCategoryController@store', 'as'=>'products-category.store']);
Route::get('products-category-delete/{id}', 
	['uses'=>'ProductsCategoryController@destroy', 'as'=>'products-category.destro']);
Route::get('products-category/{id}', 
	['uses'=>'ProductsCategoryController@edit', 'as'=>'products-category.edit']);

// Products Type
Route::get('products-types', 
	['uses'=>'ProductsTypesController@index', 'as'=>'products-types.index']);
Route::get('products-types/create', 
	['uses'=>'ProductsTypesController@create', 'as'=>'products-types.create']);
Route::post('products-types', 
	['uses'=>'ProductsTypesController@store', 'as'=>'products-types.store']);
Route::get('products-types-delete/{id}', 
	['uses'=>'ProductsTypesController@destroy', 'as'=>'products-types.destro']);
Route::get('products-types/{id}', 
	['uses'=>'ProductsTypesController@edit', 'as'=>'products-types.edit']);


// Products Variant
Route::get('products-variant', 
	['uses'=>'ProductsVariantController@index', 'as'=>'products-variant.index']);
Route::get('products-variant/create', 
	['uses'=>'ProductsVariantController@create', 'as'=>'products-variant.create']);
Route::post('products-variant', 
	['uses'=>'ProductsVariantController@store', 'as'=>'products-variant.store']);
Route::get('products-variant-delete/{id}', 
	['uses'=>'ProductsVariantController@destroy', 'as'=>'products-variant.destro']);
Route::get('products-variant/{id}', 
	['uses'=>'ProductsVariantController@edit', 'as'=>'products-variant.edit']);


// Produsen
Route::get('produsen', 
	['uses'=>'ProdusenController@index', 'as'=>'produsen.index']);
Route::get('produsen/create', 
	['uses'=>'ProdusenController@create', 'as'=>'produsen.create']);
Route::post('produsen', 
	['uses'=>'ProdusenController@store', 'as'=>'produsen.store']);
Route::get('produsen-delete/{id}', 
	['uses'=>'ProdusenController@destroy', 'as'=>'produsen.destro']);
Route::get('produsen/{id}', 
	['uses'=>'ProdusenController@edit', 'as'=>'produsen.edit']);

// Payments
Route::get('payments', 
	['uses'=>'PaymentsController@index', 'as'=>'payments.index']);
Route::get('payments/create', 
	['uses'=>'PaymentsController@create', 'as'=>'payments.create']);
Route::post('payments', 
	['uses'=>'PaymentsController@store', 'as'=>'payments.store']);
Route::get('payments-delete/{id}', 
	['uses'=>'PaymentsController@destroy', 'as'=>'payments.destro']);
Route::get('payments/{id}', 
	['uses'=>'PaymentsController@edit', 'as'=>'payments.edit']);

// Products
Route::get('data-products', 
	['uses'=>'ProductsController@index', 'as'=>'data-products.index']);
Route::get('data-products/create', 
	['uses'=>'ProductsController@create', 'as'=>'data-products.create']);
Route::post('data-products', 
	['uses'=>'ProductsController@store', 'as'=>'data-products.store']);
Route::get('data-products-delete/{id}', 
	['uses'=>'ProductsController@destroy', 'as'=>'data-products.destroy']);
Route::get('data-products/{id}', 
	['uses'=>'ProductsController@edit', 'as'=>'data-products.edit']);

// Products Sliders
Route::get('sliders', 
	['uses'=>'SlidersController@index', 'as'=>'sliders.index']);
Route::get('sliders/create', 
	['uses'=>'SlidersController@create', 'as'=>'sliders.create']);
Route::post('sliders', 
	['uses'=>'SlidersController@store', 'as'=>'sliders.store']);
Route::get('sliders-delete/{id}', 
	['uses'=>'SlidersController@destroy', 'as'=>'sliders.destro']);
Route::get('sliders/{id}', 
	['uses'=>'SlidersController@edit', 'as'=>'sliders.edit']);


// Banner
Route::get('banners', 
	['uses'=>'BannersController@index', 'as'=>'banners.index']);
Route::get('banners/create', 
	['uses'=>'BannersController@create', 'as'=>'banners.create']);
Route::post('banners', 
	['uses'=>'BannersController@store', 'as'=>'banners.store']);
Route::get('banners-delete/{id}', 
	['uses'=>'BannersController@destroy', 'as'=>'banners.destro']);
Route::get('banners/{id}', 
	['uses'=>'BannersController@edit', 'as'=>'banners.edit']);

// Menus
Route::get('menus', 
	['uses'=>'MenusController@index', 'as'=>'menus.index']);
Route::get('menus/create', 
	['uses'=>'MenusController@create', 'as'=>'menus.create']);
Route::post('menus', 
	['uses'=>'MenusController@store', 'as'=>'menus.store']);
Route::get('menus-delete/{id}', 
	['uses'=>'MenusController@destroy', 'as'=>'menus.destro']);
Route::get('menus/{id}', 
	['uses'=>'MenusController@edit', 'as'=>'menus.edit']);


// Configuration
Route::get('configurations', 
	['uses'=>'ConfigurationsController@index', 'as'=>'configurations.index']);
Route::get('configurations/create', 
	['uses'=>'ConfigurationsController@create', 'as'=>'configurations.create']);
Route::post('configurations', 
	['uses'=>'ConfigurationsController@store', 'as'=>'configurations.store']);
Route::get('configurations-delete/{id}', 
	['uses'=>'ConfigurationsController@destroy', 'as'=>'configurations.destro']);
Route::get('configurations/{id}', 
	['uses'=>'ConfigurationsController@edit', 'as'=>'configurations.edit']);



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

Route::get('/', 'PagesController@index')->name('index');

Auth::routes(['verify' => false]);

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['role:vendor'])->group(function () {
	Route::prefix('vendor')->group(function () {		
		Route::get('/', 'VendorController@index')->name('vendor');

		Route::get('/{path}', 'VendorController@index')->where([
			'/path' => '([A-Z\d-\/_.]+)?',
		]);

		Route::get('/{path}/{pathTwo}', 'VendorController@index')->where([
			'/path' => '([A-Z\d-\/_.]+)?',
			'/pathTwo' => '([A-Z\d-\/_.]+)?',
		]);

		Route::get('/{path}/{pathTwo}/{id}', 'VendorController@index')->where([
			'/path' => '([A-Z\d-\/_.]+)?',
			'/pathTwo' => '([A-Z\d-\/_.]+)?',
			'/id' => '([0-9]+)?',
		]);
	});
});

Route::middleware(['role:user'])->group(function () {
	Route::prefix('user')->group(function () {
		
		Route::get('/', 'UserController@index')->name('user');
		Route::get('/{path}', 'UserController@index')->where('/path', '([A-Z\d-\/_.]+)?');

		Route::get('/{path}/{id}', 'UserController@index')->where([
			'/path' => '([A-Z\d-\/_.]+)?',
			'/id' => '([0-9]+)?',
		]);
	});
});

Route::get('/category', 'CategoryController@index')->name('category.all');
Route::get('/category/services/{id}', 'CategoryController@services')->where('id', '([0-9]+)')->name('category.services');

Route::get('/states', 'LocationController@states')->name('state.all');
Route::get('/states/cities/{id}', 'LocationController@cities')->where('id', '([0-9]+)')->name('state.cities.all');

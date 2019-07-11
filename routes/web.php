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

Route::prefix('vendor')->group(function () {
	Route::get('/service', 'Vendor\ServiceController@index');
	Route::get('/service/{id}', 'Vendor\ServiceController@show')->where('/id', '([0-9]+)?');
	Route::post('/service', 'Vendor\ServiceController@store');
	Route::put('/service/{id}', 'Vendor\ServiceController@update')->where('id', '([0-9]+)');
	Route::delete('/service/{id}', 'Vendor\ServiceController@delete')->where('id', '([0-9]+)');

	Route::middleware(['role:vendor'])->group(function () {
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
		Route::post('/post-request', 'User\UserRequestController@store');

		Route::get('/{path}', 'UserController@index')->where('/path', '([A-Z\d-\/_.]+)?');
	});
});

Route::get('/category', 'CategoryController@index')->name('category.all');
Route::get('/category/services/{id}', 'CategoryController@services')->where('id', '([0-9]+)')->name('category.services');

Route::get('/profile', 'ProfileController@index')->name('user.profile');
Route::put('/profile', 'ProfileController@update')->name('user.update');
Route::delete('/profile', 'ProfileController@delete')->name('user.delete');

Route::get('/states', 'LocationController@states')->name('state.all');
Route::get('/states/cities/{id}', 'LocationController@cities')->where('id', '([0-9]+)')->name('state.cities.all');

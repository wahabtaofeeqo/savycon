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

// Home
Route::get('/', 'PagesController@index')->name('index');
Route::get('/index', 'PagesController@index');

// Services
Route::get('/services', 'PagesController@services')->name('services');
Route::get('/our-services', 'PagesController@services');

// About
Route::get('/about', 'PagesController@about')->name('about');
Route::get('/about-us', 'PagesController@about');

// Contact
Route::get('/contact', 'PagesController@contact')->name('contact');
Route::get('/contact-us', 'PagesController@contact');

// Help and FAQs
Route::get('/help-and-faqs', 'PagesController@help')->name('help');
Route::get('/help', 'PagesController@help');
Route::get('/faqs', 'PagesController@help');

// Terms of Use
Route::get('/terms-of-use', 'PagesController@terms')->name('terms');
Route::get('/terms', 'PagesController@terms');
Route::get('/terms-and-conditions', 'PagesController@terms');

// How it works
Route::get('/how-it-works', 'PagesController@howItWorks')->name('howItWorks');

// Privacy policy
Route::get('/privacy-policy', 'PagesController@privacyPolicy')->name('privacyPolicy');
Route::get('/privacy', 'PagesController@privacyPolicy');

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
Route::get('/category/limited', 'CategoryController@limitedIndex');
Route::get('/category/{id}', 'CategoryController@showUserServices')->where('id', '([0-9]+)');
Route::get('/category/services/{id}', 'CategoryController@services')->where('id', '([0-9]+)')->name('category.services');

Route::get('/services', 'ServiceController@index')->name('services');
Route::get('/services/featured', 'ServiceController@featured')->name('services.featured');
Route::get('/service/{id}', 'ServiceController@show')->where('id', '([0-9]+)');

Route::get('/states', 'LocationController@states')->name('state.all');
Route::get('/states/cities/{id}', 'LocationController@cities')->where('id', '([0-9]+)')->name('state.cities.all');

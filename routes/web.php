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
Route::get('/service/{id}', 'PagesController@showService')->where('/id', '([0-9]+)')->name('service.single');

// Categories & Sub-categories
Route::get('/category/{id}', 'PagesController@loadCategory')->where('/id', '([0-9]+)')->name('service.category');
Route::get('/sub-category/{id}', 'PagesController@loadSubCategory')->where('/id', '([0-9]+)')->name('service.service');
Route::get('/sub/{id}', 'PagesController@loadSubCategory')->where('/id', '([0-9]+)');

// About
Route::get('/about', 'PagesController@about')->name('about');
Route::get('/about-us', 'PagesController@about');

// Contact
Route::get('/contact', 'PagesController@contact')->name('contact');
Route::get('/contact-us', 'PagesController@contact');
Route::post('/contact', 'General\ContactEnquiryController@store')->name('contact');

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

// Subscription
Route::post('/subscription', 'General\SubscriptionController@store')->name('subscription');

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

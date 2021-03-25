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

Route::get('/testmail', function () {
	\Illuminate\Support\Facades\Mail::html('<h1>Hi</h1>', function ($message) {
	   $message->subject('App is live!');
	   $message->to('folurinyinka@gmail.com');
	});
});

// Home
Route::get('/', 'PagesController@index')->name('index');
Route::get('/index', 'PagesController@index');

// Services
Route::get('/services', 'PagesController@services')->name('services');
Route::get('/servicepage', 'PagesController@servicepage')->name('servicepage');
Route::get('/services/user/{id}', 'PagesController@userServices')->where('/id', '([0-9]+)')->name('services.user');
Route::get('/our-services', 'PagesController@services');
Route::get('/service/{id}', 'PagesController@showService')->where('/id', '([0-9]+)')->name('service.single');

// Buyers' Requests
Route::get('/buyers-requests', 'PagesController@buyersRequests')->name('buyerRequests');
Route::get('/buyers-requests/{id}', 'PagesController@showBuyersRequest')->where('/id', '([0-9]+)')->name('single.buyersRequest');
Route::get('/requests', 'PagesController@buyersRequests');
Route::get('/buyersRequests', 'PagesController@buyersRequests');

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

//Invoice
Route::get('/invoice/{id}', 'PagesController@invoice');

// Privacy policy
Route::get('/privacy-policy', 'PagesController@privacyPolicy')->name('privacyPolicy');
Route::get('/privacy', 'PagesController@privacyPolicy');

// Subscription
Route::post('/subscription', 'General\SubscriptionController@store')->name('subscription');

Auth::routes(['verify' => false]);

Route::get('/home', 'HomeController@index')->name('home');

//Donate
Route::get('/donate', 'General\DonateController@index')->name('donate');

// Socialite
Route::get('/social/redirect/{provider}', 'Auth\SocialController@redirectToProvider')->where('provider', 'twitter|linkedin|google|facebook')->name('social.redirect');
Route::get('/social/callback/{provider}', 'Auth\SocialController@handleProviderCallback')->where('provider', 'twitter|linkedin|google|facebook');

Route::middleware(['role:admin'])->group(function () {
	Route::prefix('admin')->group(function () {		
		Route::get('/', 'AdminController@index')->name('admin');

		Route::get('/{path}', 'AdminController@index')->where([
			'/path' => '([A-Z\d-\/_.]+)?',
		]);

		Route::get('/{path}/{pathTwo}', 'AdminController@index')->where([
			'/path' => '([A-Z\d-\/_.]+)?',
			'/pathTwo' => '([A-Z\d-\/_.]+)?',
		]);

		Route::get('/{path}/{pathTwo}/{id}', 'AdminController@index')->where([
			'/path' => '([A-Z\d-\/_.]+)?',
			'/pathTwo' => '([A-Z\d-\/_.]+)?',
			'/id' => '([0-9]+)?',
		]);
	});
});

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
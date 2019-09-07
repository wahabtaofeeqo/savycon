<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResources([
	'service' => 'Vendor\ServiceController',
	'userService' => 'Admin\UserServiceController',
	'request' => 'User\UserRequestController',
	'profile' => 'ProfileController',
	'rating' => 'General\RatingController',
	'message' => 'General\MessageController',
	'user' => 'Admin\UserController',
	'state' => 'Admin\StateController',
	'city' => 'Admin\CityController',
	'search' => 'Admin\SearchController',
	'contact' => 'General\ContactEnquiryController',
	'categories' => 'Admin\CategoryController',
	'sub-categories' => 'Admin\ServiceController',
	'advert' => 'Admin\AdvertController'
]);

// Admin Usage
Route::get('/subscribers', 'General\SubscriptionController@index');
Route::get('/messages', 'General\MessageController@index');
Route::get('/vendor/messages', 'General\MessageController@getVendorMessages');

Route::get('/users/vendor', 'Admin\UserController@vendors');
Route::get('/users/user', 'Admin\UserController@users');

Route::get('/suspend/user/{id}', 'Admin\UserController@alterSuspension')->where('id', '([0-9]+)');
Route::get('/ban/service/{id}', 'Admin\UserServiceController@alterBan')->where('id', '([0-9]+)');
Route::get('/feature/service/{id}', 'Admin\UserServiceController@alterFeature')->where('id', '([0-9]+)');

// Search
Route::get('/findService/{text?}/{location?}', 'SearchController@search')->where([
	'/text', '.*',
	'/location', '.*',
])->name('search');
Route::get('/suggestService/{text?}', 'SearchController@suggestSearch')->where([
	'/text', '.*',
])->name('suggest.search');

Route::get('/category', 'CategoryController@index');
Route::get('/category/limited', 'CategoryController@limitedIndex');
Route::get('/category/show/{id}', 'CategoryController@show')->where('id', '([0-9]+)');
Route::get('/category/{id}', 'CategoryController@showUserServices')->where('id', '([0-9]+)');
Route::get('/category/services/{id}', 'CategoryController@services')->where('id', '([0-9]+)');

// Sub-categories
Route::get('/sub-category/{id}', 'CategoryController@showUserServicesFromSub')->where('id', '([0-9]+)');
Route::get('/sub-category/show/{id}', 'CategoryController@showSub')->where('id', '([0-9]+)');

Route::get('/services', 'ServiceController@index')->name('services');
Route::get('/services/all', 'ServiceController@allServices');
Route::get('/services/featured', 'ServiceController@featured');
Route::get('/services/featured/{count}', 'ServiceController@limitedFeatured')->where('count', '([0-9]+)');
Route::get('/service/{id}', 'ServiceController@show')->where('id', '([0-9]+)');

// States and Cities
Route::get('/states', 'LocationController@states')->name('state.all');
Route::get('/states/cities/{id}', 'LocationController@cities')->where('id', '([0-9]+)');

Route::get('/adverts/dashboard/{limit}', 'General\AdvertController@dashboard')->where('limit', '([0-9]+)');

// Counters
Route::prefix('counter')->group(function() {
	Route::get('states', 'General\CounterController@totalStates');
	Route::get('cities', 'General\CounterController@totalCities');

	Route::get('categories', 'General\CounterController@totalCategories');
	Route::get('sub-categories', 'General\CounterController@totalSubCategories');

	Route::prefix('services')->group(function() {
		Route::get('/', 'General\CounterController@totalServices');
		Route::get('featured', 'General\CounterController@featuredServices');
		Route::get('banned', 'General\CounterController@bannedServices');
	});

	Route::prefix('vendors')->group(function() {
		Route::get('/', 'General\CounterController@totalVendors');
		Route::get('suspended', 'General\CounterController@suspendedVendors');
	});

	Route::get('buyers', 'General\CounterController@totalBuyers');
	Route::get('subscribers', 'General\CounterController@totalSubscribers');

	Route::prefix('messages')->group(function() {
		Route::get('contact', 'General\CounterController@totalContactMessages');
		Route::get('vendor', 'General\CounterController@totalVendorMessages');
	});

	Route::get('unfound-searches', 'General\CounterController@totalUnfoundSearches');
	Route::get('buyer-requests', 'General\CounterController@totalBuyerRequests');

	Route::prefix('vendor')->group(function() {
		Route::get('services', 'General\CounterController@totalVendorServices');
		Route::get('rating', 'General\CounterController@averageUserRating');
	});
});

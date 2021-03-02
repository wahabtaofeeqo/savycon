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
	'advert' => 'Admin\AdvertController',
	'phonenumber' => 'General\PhonenumberController',
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

//Upload Services from Excel file
Route::post('/uploadService', 'Admin\UserServiceController@store');
Route::get('/activateService/{id}', 'Admin\UserServiceController@activateService');

//Merge categories
Route::post('/categoryMerge', 'Admin\CategoryController@merge');

//
Route::post('/usersNeed', 'UsersNeedController@store');

//
Route::delete('/deleteSubscriber/{id}', 'General\SubscriptionController@destroy')->where('id', '([0-9]+)');
Route::post('/editSubscriber', 'General\SubscriptionController@edit');

//Delete service of 'need a Service'
Route::delete('deleteService/{id}', 'ServicePageController@deleteService')->where('id', '([0-9]+)');

//Visitors
Route::post('/visitors', 'UsersNeedController@visitor');
Route::get('/visitors', 'UsersNeedController@index');

//Newsletter
Route::post('/subscribe', 'General\SubscriptionController@subscribe');

// Search
Route::get('/findService/{text?}/{location?}', 'SearchController@search')->where([
	'/text', '.*',
	'/location', '.*',
])->name('search');
Route::get('/suggestCategory/{text?}', 'SearchController@suggestSearch')->where([
	'/text', '.*',
])->name('suggest.search');
Route::get('/suggestLocation/{location?}', 'SearchController@suggestLocation')->where([
	'/location', '.*',
])->name('suggest.location');

// Admin Search
Route::get('/findAdminService/{text?}', 'SearchController@adminSearch')->where([
	'/text', '.*',
])->name('admin.search');
Route::get('/findAdminVendor/{text?}', 'SearchController@adminSearchVendor')->where([
	'/text', '.*',
])->name('admin.search.vendor');

Route::get('/category', 'CategoryController@index');
Route::get('/category/limited', 'CategoryController@limitedIndex');
Route::get('/category/show/{id}', 'CategoryController@show')->where('id', '([0-9]+)');
Route::get('/category/{id}', 'CategoryController@showUserServices')->where('id', '([0-9]+)');
Route::get('/category/services/{id}', 'CategoryController@services')->where('id', '([0-9]+)');
Route::get('/category/services/{name}', 'CategoryController@servicesFromCategory')->where('name', '([a-zA-Z]+)');

// Sub-categories
Route::get('/sub-category/{id}', 'CategoryController@showUserServicesFromSub')->where('id', '([0-9]+)');
Route::get('/sub-category/show/{id}', 'CategoryController@showSub')->where('id', '([0-9]+)');

Route::get('/services', 'ServiceController@index')->name('services');
Route::post('/servicespage', 'ServicePageController@store');
Route::get('/servicepagerequests', 'ServicePageController@index');
Route::get('/services/all', 'ServiceController@allServices');
Route::get('/services/featured', 'ServiceController@featured');
Route::get('/services/featured/{count}', 'ServiceController@limitedFeatured')->where('count', '([0-9]+)');
Route::get('/service/{id}', 'ServiceController@show')->where('id', '([0-9]+)');

// Services display for buyers on dashboard
Route::get('/buyers/services/', 'ServiceController@buyerServices')->middleware('auth:api');
// Requests display for vendors on dashboard
Route::get('/vendors/requests/', 'User\UserRequestController@vendorRequests');

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

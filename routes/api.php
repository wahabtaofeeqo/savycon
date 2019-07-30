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
	'userService' => 'Admin\ServiceController',
	'request' => 'User\UserRequestController',
	'profile' => 'ProfileController',
	'rating' => 'General\RatingController',
	'message' => 'General\MessageController',
	'user' => 'Admin\UserController',
	'state' => 'Admin\StateController',
	'city' => 'Admin\CityController',
	'search' => 'Admin\SearchController',
	'contact' => 'General\ContactEnquiryController',
]);

// Admin Usage
Route::get('/subscribers', 'General\SubscriptionController@index');
Route::get('/messages', 'General\MessageController@index');

Route::get('/users/vendor', 'Admin\UserController@vendors');
Route::get('/users/user', 'Admin\UserController@users');
Route::get('/user-requests', 'General\UserRequestController@userRequests');

Route::get('/suspend/user/{id}', 'Admin\UserController@alterSuspension')->where('id', '([0-9]+)');
Route::get('/ban/service/{id}', 'Admin\ServiceController@alterBan')->where('id', '([0-9]+)');
Route::get('/feature/service/{id}', 'Admin\ServiceController@alterFeature')->where('id', '([0-9]+)');

// Search
Route::get('/findService/{text?}/{location?}', 'ServiceController@search')->where([
	'/text', '.*',
	'/location', '.*',
])->name('search');

Route::get('/category', 'CategoryController@index');
Route::get('/category/limited', 'CategoryController@limitedIndex');
Route::get('/category/show/{id}', 'CategoryController@show')->where('id', '([0-9]+)');
Route::get('/category/{id}', 'CategoryController@showUserServices')->where('id', '([0-9]+)');
Route::get('/category/services/{id}', 'CategoryController@services')->where('id', '([0-9]+)');

// Sub-categories
Route::get('/sub-category/{id}', 'CategoryController@showUserServicesFromSub')->where('id', '([0-9]+)');
Route::get('/sub-category/show/{id}', 'CategoryController@showSub')->where('id', '([0-9]+)');

Route::get('/services', 'ServiceController@index')->name('services');
Route::get('/services/featured', 'ServiceController@featured');
Route::get('/services/featured/{count}', 'ServiceController@limitedFeatured')->where('count', '([0-9]+)');
Route::get('/service/{id}', 'ServiceController@show')->where('id', '([0-9]+)');

Route::get('/states', 'LocationController@states')->name('state.all');
Route::get('/states/cities/{id}', 'LocationController@cities')->where('id', '([0-9]+)');

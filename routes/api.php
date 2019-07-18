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
	'request' => 'User\UserRequestController',
	'profile' => 'ProfileController',
	'rating' => 'RatingController',
]);

Route::get('/findService/{query}', 'ServiceController@search')->where('/query', '([A-Za-z0-9])\w+')->name('search');

Route::get('/user-requests', 'UserRequestController@userRequests');

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

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

//////////////////////////// API for items //////////////////////////////
// get specific item
Route::get('/items/{id}', 'ItemController@get');

// get all items
Route::get('/items', 'ItemController@all');

// get items according to category
Route::get('/items/category/{category}', 'ItemController@getCate');

// get items according to user_id(owner)
Route::get('/items/user/{user_id}', 'ItemController@getUser');

// get items according to status
Route::get('/items/status/{status}', 'ItemController@getStatus');

// get user bought and sold
Route::get('/items/bought/{user_id}', 'ItemController@getBought');
Route::get('/items/sold/{user_id}', 'ItemController@getSold');

// create an item
Route::post('/items', 'ItemController@create');

// update an item
Route::put('/items/{item}', 'ItemController@update');

// delete an item
Route::delete('/items/{item}', 'ItemController@delete');

// post a photo related to certain item
Route::post('/items/image/{item}', 'ItemController@uploadPhoto');

/////////////////////////// API for items end /////////////////////////////

/////////////////////////// API for users /////////////////////////////////

// get all user
Route::get('/users', 'UserController@all');

// get specific user
Route::get('/users/{id}', 'UserController@get');

// create a new user
Route::post('/users', 'UserController@create');

// update a user
Route::put('/users/{user}', 'UserController@update');

// delete a user
Route::delete('/users/{user}', 'UserController@delete');

// update the user photo
Route::post('/items/image/{item}', 'ItemController@uploadPhoto');

////////////////////////// API for users end /////////////////////////////////


////////////////////////// API for transactions //////////////////////////////

// get a specific transactions
Route::get('/trans', 'TransactionController@all');

// get specific user
Route::get('/trans/{id}', 'TransactionController@get');

// create a new user
Route::post('/trans', 'TransactionController@create');

// update a user
Route::put('/trans/{trans}', 'TransactionController@update');

// delete a user
Route::delete('/trans/{trans}', 'TransactionController@delete');

////////////////////////// API for transactions end //////////////////////////// 



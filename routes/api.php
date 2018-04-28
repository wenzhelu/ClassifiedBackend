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
Route::get('/items/{id}', 'ItemController@get')->middleware('checkPass:1');

// get all items
Route::get('/items', 'ItemController@all')->middleware('checkPass:1');

// get items according to category
Route::get('/items/category/{category}', 'ItemController@getCate')->middleware('checkPass:1');

// get items according to user_id(owner)
Route::get('/items/user/{user_id}', 'ItemController@getUser')->middleware('checkPass:1');

// get items according to status
Route::get('/items/status/{status}', 'ItemController@getStatus')->middleware('checkPass:1');

// get user bought and sold
Route::get('/items/bought/{user_id}', 'ItemController@getBought')->middleware('checkPass:1');
Route::get('/items/sold/{user_id}', 'ItemController@getSold')->middleware('checkPass:1');

// create an item
Route::post('/items', 'ItemController@create')->middleware('checkPass:1');

// update an item
Route::put('/items/{item}', 'ItemController@update')->middleware('checkPass:1');

// delete an item
Route::delete('/items/{item}', 'ItemController@delete')->middleware('checkPass:1');

// post a photo related to certain item
Route::post('/items/image/{item}', 'ItemController@uploadPhoto')->middleware('checkPass:1');

/////////////////////////// API for items end /////////////////////////////

/////////////////////////// API for users /////////////////////////////////

// get all user
Route::get('/users', 'UserController@all')->middleware('checkPass:0');

// get specific user
Route::get('/users/{id}', 'UserController@get')->middleware('checkPass:1');

// create a new user
// register
// not protect by api auth
Route::post('/users', 'UserController@create');

// update a user
Route::put('/users/{user}', 'UserController@update')->middleware('checkPass:1');

// delete a user
Route::delete('/users/{user}', 'UserController@delete')->middleware('checkPass:0');

// update the user photo
Route::post('/items/image/{item}', 'ItemController@uploadPhoto')->middleware('checkPass:1');

////////////////////////// API for users end /////////////////////////////////


////////////////////////// API for transactions //////////////////////////////

// get a specific transactions
Route::get('/trans', 'TransactionController@all')->middleware('checkPass:0');

Route::get('/trans/{id}', 'TransactionController@get')->middleware('checkPass:1');

Route::post('/trans', 'TransactionController@create')->middleware('checkPass:1');

Route::put('/trans/{trans}', 'TransactionController@update')->middleware('checkPass:1');

Route::delete('/trans/{trans}', 'TransactionController@delete')->middleware('checkPass:0');

////////////////////////// API for transactions end ////////////////////////////

////////////////////////// Login API /////////////////////////////
Route::post('/login', 'UserController@login');



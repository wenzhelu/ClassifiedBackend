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

// get specific item
Route::get('/items/{id}', 'ItemController@get');

// get all items
Route::get('/items', 'ItemController@all');

// get items according to category
Route::get('/items/category/{category}', 'ItemController@getCate');

// create an item
Route::post('/items', 'ItemController@create');

// update an item
Route::put('/items/{item}', 'ItemController@update');

// delete an item
Route::delete('/items/{item}', 'ItemController@delete');

// post a photo related to certain item
Route::post('/items/image/{id}', 'ItemController@uploadPhoto');


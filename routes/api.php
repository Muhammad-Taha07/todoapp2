<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Router for Homepage / Task Listing
// Route::get('/task','TaskController@allTasks');

// Route::post('/task','TaskController@storeData');

//For Storing data in database
// Route::post('/task/','TaskController@storeData');

// Route::post('/task','TaskController@storeData');

// Route::get('/task/{id}','TaskController@storeData');

// Route::get('/tasks','TaskController@storeData');



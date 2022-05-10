<?php

use Illuminate\Support\Facades\Route;

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

//Router for Homepage / Task Listing
Route::get('/','TaskController@index');

// Route::view('/tasks','TaskController@index');
Route::get('/tasks/create', 'TaskController@create');

//Routing for adding a task
Route::post('/tasks','TaskController@store')->name('createTasks');

//Routing for Updating data via Patching
Route::get('/tasks/{id}', 'TaskController@update');

//Routing for Deleting a task from index
Route::get('/tasks-delete/{id}', 'TaskController@delete');

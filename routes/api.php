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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// List managers
Route::get('managers', 'ManagerController@index');

// List single managers
Route::get('manager/{id}', 'ManagerController@show');

// Create new managers
Route::post('manager', 'ManagerController@store');

// Update managers
Route::put('manager', 'ManagerController@store');

// Delete managers
Route::delete('manager/{id}', 'ManagerController@destroy');


// List todos
Route::get('todos', 'TodoController@index');

// List single todos
Route::get('todo/{id}', 'TodoController@show');

// Create new todos
Route::post('todo', 'TodoController@store');

// Update todos
Route::put('todo', 'TodoController@store');

// Delete todos
Route::delete('todo/{id}', 'TodoController@destroy');
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

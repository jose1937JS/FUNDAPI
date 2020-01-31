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

Route::get('doctors', 'DoctorController@get_all');
Route::get('doctor/{id}', 'DoctorController@get_one');

Route::get('services', 'ServiceController@get_all');
Route::get('service/{id}', 'ServiceController@get_one');

Route::get('enterprise', 'EnterpriseController@get_all');
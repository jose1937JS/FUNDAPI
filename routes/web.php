<?php

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

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::resource('services', 'ServiceController');
Route::get('show_all_services', 'ServiceController@show_all');

Route::get('productos', 'ProductController@index')->name('productos');
Route::get('servicios', 'ServiceController@index')->name('servicios');
Route::get('doctores', 'DoctorController@index')->name('doctores');
Route::get('empresa', 'EnterpriseController@index')->name('empresa');


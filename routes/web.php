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

// Route::get('/home', function () {
//     return redirect('login');
// });

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function(){
	Route::resource('services', 'ServiceController');
	Route::post('services/add_doctor_to_service', 'ServiceController@add_doctor_to_service')->name('services.add_doctor_to_service');
	Route::delete('services/delete_doctor_from_service/{idesp}/{idserv}', 'ServiceController@delete_doctor_from_service')->name('services.delete_doctor_from_service');

	Route::resource('doctors', 'DoctorController');
	Route::resource('specialties', 'SpecialtyController');
	Route::resource('enterprise', 'EnterpriseController');
});

// Route::get('show_all_services', 'ServiceController@get_all');


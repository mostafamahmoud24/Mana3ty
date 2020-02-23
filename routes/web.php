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

// Artisan::call('storage:link');

Route::get('/', 'PatientsController@index');
Route::get('/patients/create', 'PatientsController@create');
Route::post('/', 'PatientsController@store');
Route::delete('/patients/{patient}', 'PatientsController@destroy');
Route::get('/patients/{patient}', 'PatientsController@show');
Route::get('/patients/{patient}/edit', 'PatientsController@edit');
Route::patch('/patients/{patient}', 'PatientsController@update');
Route::get('/search/patients', 'PatientsController@search');

// Route::resource('patients', 'PatientsController');
// Route::resource('diagnoses', 'DiagnosesController');

Route::get('/diagnoses', 'DiagnosesController@index');
Route::get('/patients/{patient}/diagnoses/create',
'DiagnosesController@create');
Route::post('/patients/{patient}', 'DiagnosesController@store');
Route::get('/patients/{patient}/diagnoses/{diagnosis}', 'DiagnosesController@show');
Route::get('/patients/{patient}/diagnoses/{diagnosis}/edit', 'DiagnosesController@edit');
Route::patch('/patients/{patient}/diagnoses/{diagnosis}', 'DiagnosesController@update');
Route::delete('/patients/{patient}/diagnoses/{diagnosis}', 'DiagnosesController@destroy'); 
Route::get('/search/diagnoses', 'DiagnosesController@search');




Auth::routes();

Route::get('/patients/{patient}/diagnoses/{diagnosis}/images', 'ImagesController@index')->middleware('auth');
Route::delete('/images/{uploadImage}', 'ImagesController@destroy');
Route::post('/images/create', 'ImagesController@store');
Route::get('/patients/{patient}/diagnoses/{diagnosis}/images/{image}', 'ImagesController@show');







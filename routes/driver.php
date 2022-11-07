<?php

/*
|--------------------------------------------------------------------------
| Drivers Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'DriverController@index')->name('index');
Route::get('/trips', 'DriverResources\TripController@history')->name('trips');

Route::get('/incoming', 'DriverController@incoming')->name('incoming');
Route::post('/request/{id}', 'DriverController@accept')->name('accept');
Route::patch('/request/{id}', 'DriverController@update')->name('update');
Route::post('/request/{id}/rate', 'DriverController@rating')->name('rating');
Route::delete('/request/{id}', 'DriverController@reject')->name('reject');

Route::get('/earnings', 'DriverController@earnings')->name('earnings');
Route::get('/upcoming', 'DriverController@upcoming_trips')->name('upcoming');
Route::post('/cancel', 'DriverController@cancel')->name('cancel');

Route::resource('documents', 'DriverResources\DocumentController');

Route::get('/profile', 'DriverResources\ProfileController@show')->name('profile.index');
Route::post('/profile', 'DriverResources\ProfileController@store')->name('profile.update');

Route::get('/location', 'DriverController@location_edit')->name('location.index');
Route::post('/location', 'DriverController@location_update')->name('location.update');

Route::get('/profile/password', 'DriverController@change_password')->name('change.password');
Route::post('/change/password', 'DriverController@update_password')->name('password.update');

Route::post('/profile/available', 'DriverController@available')->name('available');
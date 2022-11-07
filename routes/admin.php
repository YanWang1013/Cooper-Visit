<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::get('/', 'AdminController@dashboard')->name('index');
Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');
Route::get('/heatmap', 'AdminController@heatmap')->name('heatmap');
Route::get('/translation',  'AdminController@translation')->name('translation');

Route::group(['as' => 'dispatcher.', 'prefix' => 'dispatcher'], function () {
	Route::get('/', 'DispatcherController@index')->name('index');
	Route::post('/', 'DispatcherController@store')->name('store');
    Route::get('/trips', 'DispatcherController@trips')->name('trips');
    Route::get('/cancelled', 'DispatcherController@cancelled')->name('cancelled');
	Route::get('/cancel', 'DispatcherController@cancel')->name('cancel');
	Route::get('/trips/{trip}/{driver}', 'DispatcherController@assign')->name('assign');
	Route::get('/users', 'DispatcherController@users')->name('users');
	Route::get('/drivers', 'DispatcherController@drivers')->name('drivers');
});

Route::resource('user', 'Resource\UserResource');
Route::resource('dispatch-manager', 'Resource\DispatcherResource');
Route::resource('account-manager', 'Resource\AccountResource');
Route::resource('fleet', 'Resource\FleetResource');
Route::resource('driver', 'Resource\DriverResource');
Route::resource('document', 'Resource\DocumentResource');
Route::resource('service', 'Resource\ServiceResource');
Route::resource('coupon', 'Resource\CouponResource');

Route::group(['as' => 'driver.'], function () {
    Route::get('review/driver', 'AdminController@driver_review')->name('review');
    Route::get('driver/{id}/approve', 'Resource\DriverResource@approve')->name('approve');
    Route::get('driver/{id}/disapprove', 'Resource\DriverResource@disapprove')->name('disapprove');
    Route::get('driver/{id}/ride', 'Resource\DriverResource@ride')->name('ride');
    Route::get('driver/{id}/statement', 'Resource\DriverResource@statement')->name('statement');
    Route::get('driver/{id}/payment-history', 'Resource\DriverResource@paymentHistory')->name('payment_history');
    Route::resource('driver/{driver}/document', 'Resource\DriverDocumentResource');
    Route::delete('driver/{driver}/service/{document}', 'Resource\DriverDocumentResource@service_destroy')->name('document.service');
    Route::post('driver/{driver}/new_service', 'Resource\DriverDocumentResource@service_approve')->name('new_service');
});

Route::get('review/user', 'AdminController@user_review')->name('user.review');
Route::get('user/{id}/request', 'Resource\UserResource@request')->name('user.request');
Route::get('user/{id}/payment-history', 'Resource\UserResource@paymentHistory')->name('user.payment_history');
Route::get('map', 'AdminController@map_index')->name('map.index');
Route::get('map/ajax', 'AdminController@map_ajax')->name('map.ajax');

Route::group(['as' => 'places.'], function() {
    Route::get('/place/list', 'PlaceController@index')->name('index');
    Route::get('/place/create', 'PlaceController@create')->name('create');
    Route::post('/place/store', 'PlaceController@store')-> name('store');
    Route::get('/place/{id}/edit', 'PlaceController@edit')->name('edit');
    Route::post('/place/{id}/update', 'PlaceController@update')->name('update');
    Route::post('/place/{id}/delete', 'PlaceController@delete')->name('delete');
});

Route::get('settings', 'AdminController@settings')->name('settings');
Route::post('settings/store', 'AdminController@settings_store')->name('settings.store');
Route::get('settings/payment', 'AdminController@settings_payment')->name('settings.payment');
Route::post('settings/payment', 'AdminController@settings_payment_store')->name('settings.payment.store');

Route::get('profile', 'AdminController@profile')->name('profile');
Route::post('profile', 'AdminController@profile_update')->name('profile.update');

Route::get('password', 'AdminController@password')->name('password');
Route::post('password', 'AdminController@password_update')->name('password.update');

Route::get('payment', 'AdminController@payment')->name('payment');

// statements

Route::get('/statement', 'AdminController@statement')->name('ride.statement');
Route::get('/statement/driver', 'AdminController@statement_driver')->name('ride.statement.driver');
Route::get('/statement/today', 'AdminController@statement_today')->name('ride.statement.today');
Route::get('/statement/monthly', 'AdminController@statement_monthly')->name('ride.statement.monthly');
Route::get('/statement/yearly', 'AdminController@statement_yearly')->name('ride.statement.yearly');


// Static Pages - Post updates to pages.update when adding new static pages.

Route::get('/help', 'AdminController@help')->name('help');
Route::get('/send/push', 'AdminController@push')->name('push');
Route::post('/send/push', 'AdminController@send_push')->name('send.push');
Route::get('/privacy', 'AdminController@privacy')->name('privacy');
Route::post('/pages', 'AdminController@pages')->name('pages.update');
Route::resource('rides', 'Resource\RideResource');
Route::get('scheduled', 'Resource\RideResource@scheduled')->name('rides.scheduled');

Route::get('push', 'AdminController@push_index')->name('push.index');
Route::post('push', 'AdminController@push_store')->name('push.store');


Route::get('/dispatch', function () {
    return view('admin.dispatch.index');
});

Route::get('/cancelled', function () {
    return view('admin.dispatch.cancelled');
});

Route::get('/ongoing', function () {
    return view('admin.dispatch.ongoing');
});

Route::get('/schedule', function () {
    return view('admin.dispatch.schedule');
});

Route::get('/add', function () {
    return view('admin.dispatch.add');
});

Route::get('/assign-driver', function () {
    return view('admin.dispatch.assign-driver');
});

Route::get('/dispute', function () {
    return view('admin.dispute.index');
});

Route::get('/dispute-create', function () {
    return view('admin.dispute.create');
});

Route::get('/dispute-edit', function () {
    return view('admin.dispute.edit');
});
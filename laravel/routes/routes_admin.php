<?php

Route::group(
        array('prefix' => 'admin'), function() {
    $admin = "Admin\\";
//
//    Route::get('login', $admin . 'LoginController@login')->name('login');
//    Route::post('login', $admin . 'LoginController@postLogin');
    Route::get('/', function() {
        return redirect('admin/dashboard');
    });
    Route::get('/dashboard', $admin . 'DashboardController@index');
////Users Routes
    Route::get('/users', $admin . 'UsersController@index');
    Route::get('/user/{id}', $admin . 'UsersController@userDetail');
    Route::get('/user/edit/{id}', $admin . 'UsersController@edit');
    Route::post('/user/update', $admin . 'UsersController@update');
    Route::get('users/listing', $admin . 'UsersController@listing');
    Route::get('/user/delete/{id}', $admin . 'UsersController@delete');
    Route::get('/user/approve/{id}', $admin . 'UsersController@accept');
    Route::get('/user/disapprove/{id}', $admin . 'UsersController@reject');
//    Route::post('clientOrderStatus', $admin . 'UsersController@ordersBystatus');
////    Route::get('importExport', 'UsersController@importExport');
//    Route::get('/download/{type}', $admin . 'UsersController@downloadExcel');
//    Route::post('/importExcel', $admin . 'UsersController@importExcel');
//    Route::get('user/edit/{id}', $admin . 'UsersController@edit');
//
//Content Routes
    Route::get('content', $admin . 'ContentController@index');
    Route::get('content/create', $admin . 'ContentController@create');
    Route::post('content/insert', $admin . 'ContentController@insert');
    Route::get('content/edit/{id}', $admin . 'ContentController@edit');
    Route::post('content/update/{id}', $admin . 'ContentController@update');
    Route::get('content/delete/{id}', $admin . 'ContentController@delete');
////Contact Routes
    Route::get('contact-us', $admin . 'ContactusController@index');
    Route::get('contact-detail/{id}', $admin . 'ContactusController@detail');
    Route::get('contact/delete/{id}', $admin . 'ContactusController@delete');
}
);

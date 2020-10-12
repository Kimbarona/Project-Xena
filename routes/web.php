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
    return view('auth.login');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home', 'Admin\ReportsController@OtherUser');

Route::group(['middleware' => ['auth','admin']], function(){

    // Route::get('/dashboard', function () {
    //     return view('admin.dashboard');
    // });

    // Dashboard controller
        Route::get('/dashboard', 'Admin\DashboardController@index');

    //User Controller
        Route::get('/role-register', 'Admin\UsersController@registered');

        Route::get('/role-edit/{id}', 'Admin\UsersController@registeredit');

        Route::put('/role-register-update/{id}', 'Admin\UsersController@registerupdate');

        Route::delete('/role-delete/{id}', 'Admin\UsersController@registerdelete');

    // Customer Controller
        Route::get('/customer', 'Admin\CustomerController@index');

        Route::post('/save-customer', 'Admin\CustomerController@store');

        Route::get('customer-edit/{id}', 'Admin\CustomerController@edit');

        Route::put('/customer-update/{id}', 'Admin\CustomerController@update');

        Route::delete('/customer-delete/{id}', 'Admin\CustomerController@delete');

    // upload file
        Route::get('/upload-file', 'Admin\FileUploadController@index');
        Route::post('/import-file', 'Admin\FileUploadController@ImportPost');

    //Export File
        Route::get('/export', 'Admin\DashboardController@export');

    //reports

        Route::get('/reports', 'Admin\ReportsController@index');

    //Manage store

        Route::get('/manage-store', 'Admin\ManageStoreController@index');

        Route::post('/save-store', 'Admin\ManageStoreController@store');

        Route::get('store-edit/{id}', 'Admin\ManageStoreController@edit');

        Route::put('/store-update/{id}', 'Admin\ManageStoreController@update');


    //update upd status
    // Route::get('/update-upd-status', 'Admin\UpdateUpdStatusController@index');

    // Route::get('upd-edit/{id}', 'Admin\UpdateUpdStatusController@edit');

    // Route::put('/Import-update/{id}', 'Admin\UpdateUpdStatusController@update');


    //Add or update status
        Route::post('/save-remarks', 'Admin\UpdateUpdStatusController@store');

        Route::put('/update-remarks', 'Admin\UpdateUpdStatusController@update');


});



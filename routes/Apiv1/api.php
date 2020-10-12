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

// Route::get('/list', 'Sampleapi\CustomerApiController@List');



// Route::group(['middleware' => 'auth:api'], function(){

//     // Route::get('/list','sampleapi\CustomerApiController@List');
//     Route::post('/addnew', 'Sampleapi\CustomerApiController@Store');

//     });

// users

Route::prefix('/user')->group(function() {

    Route::post('/login', 'apiv1\LoginController@login');

    Route::middleware('auth:api')->get('/all', 'apiv1\user\UserController@index');

    Route::get('/customer', 'apiv1\customer\CustomerController@customer');

    Route::get('/customer/{id}', 'apiv1\customer\CustomerController@findcustomer');

    Route::post('/customer-save', 'apiv1\customer\CustomerController@Savecustomer');

    Route::put('/customer-update/{customerId}', 'apiv1\customer\CustomerController@Updatecustomer');

    Route::delete('/customer-delete/{customerId}', 'apiv1\customer\CustomerController@Deletecustomer');

    Route::get('/dashboard', 'apiv1\customer\CustomerController@showdata');


});

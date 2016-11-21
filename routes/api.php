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

Route::post('register', 'TokenAuthController@register');
Route::post('authenticate', 'TokenAuthController@authenticate');
Route::get('authenticate/user', 'TokenAuthController@getAuthenticatedUser');



Route::resource('customer', 'CustomerController');
/**
+--------+-----------+------------------------------+------------------+---------------------------------------------------------------+--------------+
| Domain | Method    | URI                          | Name             | Action                                                        | Middleware   |
+--------+-----------+------------------------------+------------------+---------------------------------------------------------------+--------------+
|        | GET|HEAD  | /                            |                  | Closure                                                       | web          |
|        | POST      | api/authenticate             |                  | App\Http\Controllers\TokenAuthController@authenticate         | api          |
|        | GET|HEAD  | api/authenticate/user        |                  | App\Http\Controllers\TokenAuthController@getAuthenticatedUser | api          |
|        | POST      | api/customer                 | customer.store   | App\Http\Controllers\CustomerController@store                 | api,jwt.auth |
|        | GET|HEAD  | api/customer                 | customer.index   | App\Http\Controllers\CustomerController@index                 | api          |
|        | GET|HEAD  | api/customer/create          | customer.create  | App\Http\Controllers\CustomerController@create                | api,jwt.auth |
|        | PUT|PATCH | api/customer/{customer}      | customer.update  | App\Http\Controllers\CustomerController@update                | api,jwt.auth |
|        | GET|HEAD  | api/customer/{customer}      | customer.show    | App\Http\Controllers\CustomerController@show                  | api,jwt.auth |
|        | DELETE    | api/customer/{customer}      | customer.destroy | App\Http\Controllers\CustomerController@destroy               | api,jwt.auth |
|        | GET|HEAD  | api/customer/{customer}/edit | customer.edit    | App\Http\Controllers\CustomerController@edit                  | api,jwt.auth |
|        | POST      | api/register                 |                  | App\Http\Controllers\TokenAuthController@register             | api          |
+--------+-----------+------------------------------+------------------+---------------------------------------------------------------+--------------+
*/
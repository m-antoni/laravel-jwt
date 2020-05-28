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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});



Route::group(['middleware' => 'api'], function ($router){

    /*
	| (Login) You can get (jwt) token in here after login
	| Created: Michael Antoni update 05/29/2020
	*/
    Route::post('login', 'AuthController@login');

    /*
	| (jwt middleware) All routes inside this group will need admin auth (jwt) before they can accesss
	| Created: Michael Antoni Last update 05/29/2020
	*/
    Route::group(['middleware' => 'jwt.auth'], function ($router){
        Route::get('users', 'UserController@index');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::post('me', 'AuthController@me');
    });
    
});

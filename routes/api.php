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

Route::prefix('auth')->group(function () {
    Route::post('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
    Route::get('refresh', 'AuthController@refresh');

    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('user', 'AuthController@user');
        Route::post('logout', 'AuthController@logout');
    });
});

Route::prefix('admin')->group(function () {
    
    
    //Persons
    Route::get('person', 'PersonController@index');
    Route::post('person', ['as' => 'person.store','uses' => 'PersonController@store']);
    Route::put('person/{id}', ['as' => 'person.update', 'uses' => 'PersonController@update']);
    Route::delete('person/{id}', ['as' => 'person.destroy','uses' => 'PersonController@destroy']);
    Route::get('personList', ['as' => 'person.list','uses' => 'PersonController@list']);

 
});
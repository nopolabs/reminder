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

Route::get('/', 'RemindersApiController@index');
Route::post('/new', 'RemindersApiController@store');
Route::get('/{reminder}', 'RemindersApiController@show')->where(['reminder' => '[0-9]+']);
Route::put('/{reminder}', 'RemindersApiController@update')->where(['reminder' => '[0-9]+']);

<?php

Route::get('/', 'RemindersController@index');
Route::get('/{reminder}', 'RemindersController@show')->where(['reminder' => '[0-9]+']);
Route::post('/', 'RemindersController@store');
Route::put('/{reminder}', 'RemindersController@update')->where(['reminder' => '[0-9]+']);

Route::get('/api', 'RemindersApiController@index');
Route::get('/api/{reminder}', 'RemindersApiController@show')->where(['reminder' => '[0-9]+']);
Route::post('/api', 'RemindersApiController@store');
Route::put('/api/{reminder}', 'RemindersApiController@update')->where(['reminder' => '[0-9]+']);

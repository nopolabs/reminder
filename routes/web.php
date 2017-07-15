<?php

Route::get('/', 'RemindersController@index');
Route::post('/new', 'RemindersController@store');
Route::get('/{reminder}', 'RemindersController@show')->where(['reminder' => '[0-9]+']);
Route::put('/{reminder}', 'RemindersController@update')->where(['reminder' => '[0-9]+']);

Route::get('/api', 'RemindersApiController@index');
Route::post('/api/new', 'RemindersApiController@store');
Route::get('/api/{reminder}', 'RemindersApiController@show')->where(['reminder' => '[0-9]+']);
Route::put('/api/{reminder}', 'RemindersApiController@update')->where(['reminder' => '[0-9]+']);

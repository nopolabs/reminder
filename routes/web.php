<?php

Route::get('/', 'RemindersController@index');
Route::post('/new', 'RemindersController@store');
Route::get('/{reminder}', 'RemindersController@show')->where(['reminder' => '[0-9]+']);
Route::put('/{reminder}', 'RemindersController@update')->where(['reminder' => '[0-9]+']);

Route::get('/api', 'RemindersApiController@index');
Route::post('/api/new', 'RemindersApiController@store');
Route::get('/api/{reminder}', 'RemindersApiController@show')->where(['reminder' => '[0-9]+']);
Route::post('/api/{reminder}/cancel', 'RemindersApiController@cancel')->where(['reminder' => '[0-9]+']);
Route::post('/api/{reminder}/reminded', 'RemindersApiController@reminded')->where(['reminder' => '[0-9]+']);

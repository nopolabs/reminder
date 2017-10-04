<?php

Route::get('/', 'RemindersController@index');
Route::post('/new', 'RemindersController@store');
Route::get('/{reminder}', 'RemindersController@show')->where(['reminder' => '[0-9]+']);
Route::put('/{reminder}', 'RemindersController@update')->where(['reminder' => '[0-9]+']);

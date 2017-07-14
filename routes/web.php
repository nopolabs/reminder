<?php

Route::get('/', 'RemindersController@index');

Route::get('/{reminder}', 'RemindersController@show');

Route::post('/', 'RemindersController@store');

Route::put('/{reminder}', 'RemindersController@update');

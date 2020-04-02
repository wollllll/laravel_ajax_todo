<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'TaskController@index')->name('tasks.index');
Route::post('/', 'TaskController@store')->name('tasks.store');
Route::put('/{task}', 'TaskController@update')->name('tasks.update');
Route::delete('/{task}', 'TaskController@destroy')->name('tasks.delete');
Route::get('/show_more', 'TaskController@showMore')->name('tasks.showMore');

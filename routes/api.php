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


Route::get('task/all','Api\TaskController@getAllTasks')->name('get-all-tasks');

Route::get('task/new', 'Api\TaskController@getCreateNew')->name('get-create-new-task');
Route::post('task/new', 'Api\TaskController@postCreateNew')->name('post-create-new-task');

Route::get('task/edit/{id?}', 'Api\TaskController@getEditTask')->name('get-edit-task');
Route::post('task/edit/{id?}', 'Api\TaskController@postEditTask')->name('post-edit-task');

Route::delete('task/delete/{id?}', 'Api\TaskController@getDeleteTask')->name('get-delete-task');


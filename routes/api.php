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

Route::post('task/new', 'Api\TaskController@postCreateNew')->name('post-create-new-task');

Route::post('task/to/done','Api\TaskController@postToDone')->name('post-to-done');
Route::post('task/to/inprogress','Api\TaskController@postToInProgress')->name('post-to-inprogress');


Route::get('task/edit/{id?}', 'Api\TaskController@getEditTask')->name('get-edit-task');
Route::post('task/edit/{id?}', 'Api\TaskController@postEditTask')->name('post-edit-task');

Route::delete('task/delete/{id?}', 'Api\TaskController@getDeleteTask')->name('get-delete-task');

Route::get('task/de/{id?}','Api\TaskController@getDependencies')->name('get-dependencies');
Route::get('task/an/{id?}','Api\TaskController@getAncestors')->name('get-ancestors');
<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('potential', 'PotentialsController@index');
Route::get('potential/new', 'PotentialsController@show');
Route::post('potential/store', 'PotentialsController@store');

Route::get('tasks', 'TasksController@show');
Route::get('tasks/{id}', 'TasksController@create');
Route::post('tasks/store', 'TasksController@store');

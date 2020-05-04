<?php

use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::group(['middleware' => ['auth']], function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::post('/filter', 'HomeController@filter')->name('filter');

    Route::get('tasks', 'TasksController@index')->name('task');
    Route::get('/task/create', 'TasksController@create')->name('task.create');
    Route::post('/task/create', 'TasksController@store')->name('task.store');
    Route::delete('/task/delete/{id}', 'TasksController@delete')->name('task.delete');
    Route::post('/filter/users', 'TasksController@filter')->name('filter.user');

    Route::get('/echipa', 'TeamController@index')->name('team');

});


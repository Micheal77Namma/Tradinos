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
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('task.index');
    });
Route::get('/home', 'taskController@index')->name('home');
Route::resource('task', "taskController");
Route::get('task-pagination','taskController@page');
Route::get('task/{id}/deleted',"taskController@deleted");
});

Route::get('sendEmail',"taskController@sendEmail");

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


    Route::group(['namespace'=>'Admin','prefix'=>'admin','as'=>'admin.'],function(){
    Auth::routes();
    Route::group(['middleware'=>'auth'],function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('task','TasksController');

    Route::post('isCompleted','TasksController@isCompleted')->name('task.isCompleted');
    Route::get('export', 'TasksController@export')->name('export');

  

});
});
 Route::get('/', 'ContentsController@index')->name('index');
 Route::get('/create', 'ContentsController@create')->name('create');
 Route::get('/create/{task}', 'ContentsController@store')->name('store');

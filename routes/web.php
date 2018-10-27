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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/user', 'UsersController@index')->name('user.show.list');
Route::get('/user/create', 'UsersController@create')->name('user.show.create');
Route::post('/user/create', 'UsersController@store')->name('user.create');
Route::get('/user/edit/{id}', 'UsersController@edit')->name('user.show.edit');
Route::post('/user/edit/{id}', 'UsersController@update')->name('user.update');

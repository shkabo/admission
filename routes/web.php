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
// User routes
Route::get('/user', 'UsersController@index')->name('user.show.list');
Route::get('/user/create', 'UsersController@create')->name('user.show.create');
Route::post('/user/create', 'UsersController@store')->name('user.create');
Route::get('/user/edit/{id}', 'UsersController@edit')->name('user.show.edit');
Route::post('/user/edit/{id}', 'UsersController@update')->name('user.update');

// Admission Types routes
Route::get('/admissiontype', 'AdmissionType@index')->name('admission.type.show.list');
Route::get('admissiontype/create', 'AdmissionType@create')->name('admission.type.show.create');
Route::post('admissiontype/create', 'AdmissionType@store')->name('admission.type.create');
Route::get('admissiontype/edit/{id}', 'AdmissionType@edit')->name('admission.type.show.edit');
Route::post('admissiontype/edit/{id}', 'AdmissionType@update')->name('admission.type.update');

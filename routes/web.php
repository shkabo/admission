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
Route::get('admissiontype/{id}', 'AdmissionType@show')->name('admission.type.view');

// Admission routes
Route::get('/admissions', 'Admissions@index')->name('admission.show.list');
Route::post('/admission/apply/{id}', 'Admissions@apply')->name('admission.apply');
Route::get('/admissions/ajax/{id?}/{date?}', 'Admissions@ajaxTime')->name('admission.ajax');
Route::get('/admissions/my', 'Admissions@applicationsList')->name('admission.my');
Route::get('/admission/approve/{id}', 'Admissions@approve')->name('admission.approve');
Route::get('/admission/reject/{id}', 'Admissions@reject')->name('admission.reject');

Route::get('/temp', function() {

    $datetime = \Carbon\Carbon::parse('30.10.2018.');
    $admissions = \App\Admissions::where('date', $datetime)->pluck('working_hours_id')->toArray();
        //dd($admissions);
    dd(\DB::table('working_hours')->whereNotIn('id', $admissions)->get());
});

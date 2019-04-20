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

Route::resource('guest', 'ClientController');
Route::get('alreadyHaveAccount', 'ClientController@alreadyHaveAccount')->name('alreadyHaveAccount');
Route::post('redirectToShow', 'ClientController@redirectToShow')->name('redirectToShow');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function() {
    Route::resource('/', 'MainController');
    Route::resource('main', 'MainController');
});

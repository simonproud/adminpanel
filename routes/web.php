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


Auth::routes();

Route::middleware(['auth', 'userinfo'])->group(function () {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');

    /**  ---------------------------------------------------------------------------  **/
    /**  -------------------------------PERSONAL------------------------------------  **/
    /**  ---------------------------------------------------------------------------  **/
    Route::get('/personal', 'Personal\PersonalController@index')->name('personal.index');
    Route::get('/personal/settings', 'Personal\PersonalController@getSettings')->name('personal.settings');
    Route::get('/notifications/list', 'HomeController@notifications');
});



Route::middleware(['auth'])->group(function () {
    Route::post('/personal/saveme', 'Personal\PersonalController@postSaveme')->name('personal.saveme');
    Route::get('/personal/edit', 'Personal\PersonalController@getEdit')->name('personal.edit');

});



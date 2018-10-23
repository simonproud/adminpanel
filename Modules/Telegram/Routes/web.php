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

Route::prefix('telegram')->group(function() {
    Route::post('/sendlead', 'TelegramController@sendlead');
});
Route::prefix('telegram')->group(function() {
    Route::get('/', 'TelegramController@index');
});

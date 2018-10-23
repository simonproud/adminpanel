<?php

Route::group(['middleware' => ['web', 'auth', 'permission:import.basic'], 'prefix' => 'import', 'namespace' => 'Modules\Import\Http\Controllers'], function()
{
    Route::get('/', 'ImportController@index')->name('import');
    Route::post('/import_parse', 'ImportController@parseImport')->name('import_parse');
    Route::post('/setdata', 'ImportController@setData')->name('setdata');
    Route::post('/import_process', 'ImportController@processImport')->name('import_process');
    Route::post('/import_process', 'ImportController@processImport')->name('import_process');
});

Route::group(['middleware' => ['web', 'auth', 'permission:import.basic'], 'prefix' => 'api/import', 'namespace' => 'Modules\Import\Http\Controllers'], function()
{
    Route::post('/updateImport', 'ImportController@updateImport')->name('updateImport');
});

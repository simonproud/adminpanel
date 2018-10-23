<?php

Route::group(['middleware' => ['web', 'auth', 'permission:crm.basic'], 'prefix' => 'crm', 'namespace' => 'Modules\CRM\Http\Controllers'], function()
{
    Route::get('/', 'CRMController@index');
    Route::get('/leads', 'LeadsController@index');
    Route::get('/leads/create',  'LeadsController@create');
    Route::get('/leads/edit',  'LeadsController@edit');

    Route::get('/orders/create',  'OrdersController@create');
    Route::get('/orders', 'OrdersController@index');

    Route::get('/clients', 'CRMController@getClients');
    Route::get('/clients/create', 'ClientsController@create');

    Route::get('/contacts', 'CRMController@getContacts');
    Route::get('/contacts/create', 'ContactsController@create');
});

Route::group(['middleware' => ['web', 'auth', 'permission:crm.settings'], 'prefix' => 'crm/settings', 'namespace' => 'Modules\CRM\Http\Controllers'], function()
{
    Route::get('/', 'SettingsController@index');
    Route::get('/createfield', 'SettingsController@createfield');
    Route::get('/editfield', 'SettingsController@editField');
    Route::post('/savefield', 'SettingsController@saveField');
    Route::post('/deletefield', 'SettingsController@deleteFieldclientinfo');

});

Route::group(['middleware' => ['api'], 'prefix' => 'crm/api', 'namespace' => 'Modules\CRM\Http\Controllers'], function()
{

    Route::get('/get-leads', 'LeadsController@ajaxList');
    Route::post('/create-lead', 'LeadsController@store');
    Route::post('/delete-lead', 'LeadsController@destroy');

    Route::get('/get-clients', 'APIController@getClients');
    Route::get('/table-clients', 'ClientsController@ajaxList');

    Route::get('/get-contacts', 'ContactsController@ajaxList');
    Route::post('/create-contact', 'ContactsController@store');

    Route::get('/get-orders', 'APIController@getOrders');
    Route::post('/create-order', 'APIController@createOrder');



});

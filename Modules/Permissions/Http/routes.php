<?php

Route::group(['middleware' => ['web', 'auth', 'permission:permissions.basic'], 'prefix' => 'permissions', 'namespace' => 'Modules\Permissions\Http\Controllers'], function()
{
    Route::get('/', 'PermissionController@index');

    /**  ---------------------------------------------------------------------------  **/
    /**  -------------------------------PERMISSIONS---------------------------------  **/
    /**  ---------------------------------------------------------------------------  **/

    Route::get('/', 'PermissionController@index')->name('permissions.index');

    Route::get('/role/create', 'PermissionController@getRoleCreate')->name('permissions.role.create');
    Route::post('/role/create', 'PermissionController@postRoleCreate');
    Route::get('/role/show/{name}', 'PermissionController@getRoleDetail')->name('permissions.role.show');
    Route::post('/role/update/{name}', 'PermissionController@postRoleUpdate')->name('permissions.role.update');
    Route::post('/role/{name}/adduser/', 'PermissionController@postRoleAddUser')->name('permissions.role.adduser');
    Route::post('/role/{name}/deleteuser/', 'PermissionController@postRoleDeleteUser')->name('permissions.role.deleteuser');
    Route::get('/role/delete/{name}', 'PermissionController@roleDelete')->name('permissions.role.delete');

    Route::get('/user/show/{name}', 'PermissionController@getUserDetail')->name('permissions.user.show');
    Route::post('/user/update/{id}', 'PermissionController@postUserUpdate')->name('permissions.user.update');
});

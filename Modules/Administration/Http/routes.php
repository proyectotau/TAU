<?php
/*
Route::group([
    'middleware' => 'web',
    'prefix' => 'Administration',
    'namespace' => 'Modules\Administration\Http\Controllers\Api\V1'], function() {
            Route::resource('users', 'AdministrationController'); // TODO: Move to apiResource()
    }
);

Route::prefix('Administration')
     ->namespace('Modules\Administration\Http\Controllers\Api\V1')
     ->get('/test', 'Modules\Administration\Http\Controllers\Api\V1\AdministrationController@index');
*/

// TODO: Move to api

Route::group([
    /*'middleware' => ['auth:api'],*/'middleware' => ['web'], // TODO: auth:api
    'namespace' => 'Modules\Administration\Http\Controllers\Api\V1',
    'prefix' => 'v1/admin',
    'as' => 'apiv1.admin.'], function () {
    Route::apiResource('users', 'UsersController')->parameters(['users' => 'id']);
    /*Route::apiResource('groups', 'GroupsController');
    Route::apiResource('roles', 'RolesController');*/
    /*Route::apiResource('companies', 'CompaniesController');
    Route::apiResource('employees', 'EmployeesController');*/
});


// TODO: Move to web

Route::group([
    /*'middleware' => ['auth:api'],*/'middleware' => ['web'],
    'namespace' => 'Modules\Administration\Http\Controllers',
    'prefix' => 'admin',
    'as' => 'admin.'], function () {
    Route::resource('users', 'UsersController')->parameters(['users' => 'id']);
    /*Route::apiResource('groups', 'GroupsController');
    Route::apiResource('roles', 'RolesController');*/
    /*Route::apiResource('companies', 'CompaniesController');
    Route::apiResource('employees', 'EmployeesController');*/
});

/*
Route::namespace('Modules\Administration\Http\Controllers')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
    Route::resource('users', 'UsersController');
});
*/
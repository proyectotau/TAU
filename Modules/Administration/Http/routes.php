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

//Route::pattern('id', '[0-9]+');

// TODO: Move to api

Route::group([
    /*'middleware' => ['auth:api'],*/
    'middleware' => ['web'], // TODO: auth:api
    'namespace' => 'Modules\Administration\Http\Controllers\Api\V1',
    'prefix' => 'v1/admin',
    'as' => 'apiv1.admin.',
    'where' => ['id', '[0-9]+'],
    ], function () {
    Route::get('users/{criteria}/criteria', 'UsersController@index')->name('users.criteria');
    Route::get('groups/{criteria}/criteria', 'GroupsController@index')->name('groups.criteria');
    Route::get('roles/{criteria}/criteria', 'RolesController@index')->name('roles.criteria');
    Route::apiResource('users', 'UsersController'/*, ['except' => ['index']]*/)->parameters(['users' => 'id']);
    Route::apiResource('groups', 'GroupsController'/*, ['except' => ['index']]*/)->parameters(['groups' => 'id']);
    Route::apiResource('roles', 'RolesController'/*, ['except' => ['index']]*/)->parameters(['roles' => 'id']);
});

// TODO: Move to web

Route::group([
    /*'middleware' => ['auth:api'],*/
    'middleware' => ['web'],
    'namespace' => 'Modules\Administration\Http\Controllers',
    'prefix' => 'admin',
    'as' => 'admin.',
    'where' => ['id', '[0-9]+'],
    ], function () {
    Route::get('users/{criteria?}/criteria', 'UsersController@index')->name('users.criteria');
    Route::get('groups/{criteria?}/criteria', 'GroupsController@index')->name('groups.criteria');
    Route::get('roles/{criteria?}/criteria', 'RolesController@index')->name('roles.criteria');
    Route::resource('users', 'UsersController'/*, ['except' => ['index']]*/)->parameters(['users' => 'id']);
    Route::resource('groups', 'GroupsController'/*, ['except' => ['index']]*/)->parameters(['groups' => 'id']);
    Route::resource('roles', 'RolesController'/*, ['except' => ['index']]*/)->parameters(['roles' => 'id']);
});

Route::get('test/', 'Modules\Administration\Http\Controllers\Api\V1\UsersController@test');


/*
Route::namespace('Modules\Administration\Http\Controllers')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
    Route::resource('users', 'UsersController');
});
*/
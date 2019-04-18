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
    /*
     * MODULES ARE DYNAMICS !!!
     * Route::apiResource('modules', 'ModulesController'/#*, ['except' => ['index']]*#/)->parameters(['modules' => 'id']);
     */
    /*
     * Relations
     */
    /** @return List of groups which user id belongs to */
    Route::get('users/{id}/groups', 'UsersController@usersGroups')->name('users.groups');
    Route::put('users/{id}/groups', 'UsersController@usersGroupsUpdate')->name('users.groups.update');
    /** @return List of groups which user id is NOT belongs to */
    Route::get('users/{id}/groupsnotin', 'UsersController@usersGroupsNotIn')->name('users.groupsnotin');

    /** @return List of users that belong to the group id */
    Route::get('groups/{id}/users', 'GroupsController@groupsUsers')->name('groups.users');
    Route::put('groups/{id}/users', 'GroupsController@groupsUsersUpdate')->name('groups.users.update');
    Route::get('groups/{id}/usersnotin', 'GroupsController@groupsUsersNotIn')->name('groups.usersnotin');

    /** @return List of roles that grant access to the group id */
    Route::get('groups/{id}/roles', 'GroupsController@groupsRoles')->name('groups.roles');
    Route::put('groups/{id}/roles', 'GroupsController@groupsRolesUpdate')->name('groups.roles.update');
    Route::get('groups/{id}/rolesnotin', 'GroupsController@groupsRolesNotIn')->name('groups.rolesnotin');

    /** @return List of locations tenanted by selected group id */
    Route::get('groups/{id}/locations', 'GroupsController@groupsLocations')->name('groups.locations');
/// Route::put('groups/{id}/locations',  'GroupsController@groupsLocationsUpdate')->name('groups.locations.update');

    /** @return List of modules authorized by selected group id */
    Route::get('roles/{id}/modules', 'RolesController@rolesModules')->name('roles.modules');
/// Route::put('groups/{id}/locations',  'GroupsController@groupsLocationsUpdate')->name('groups.locations.update');

    Route::get('roles/{id}/groups', 'RolesController@rolesGroups')->name('roles.groups');
/// Route::put('roles/{id}/groups', 'RolesController@rolesGroupsUpdate')->name('roles.groups.update');
    Route::get('roles/{id}/groupsnotin', 'RolesController@rolesGroupsNotIn')->name('roles.groupsnotin');

    Route::get('roles/{id}/modules', 'RolesController@rolesModules')->name('roles.modules');
/// Route::put('roles/{id}/groups', 'RolesController@rolesGroupsUpdate')->name('roles.groups.update');
    Route::get('roles/{id}/groupsnotin', 'RolesController@rolesGroupsNotIn')->name('roles.groupsnotin');
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
    /*
     * Relations
     */
    Route::get('users/{id}/groups', 'UsersController@usersGroups')->name('users.groups');
    Route::put('users/{id}/groups', 'UsersController@usersGroupsUpdate')->name('users.groups.update');

    Route::get('groups/{id}/users', 'GroupsController@groupsUsers')->name('groups.users');
    Route::put('groups/{id}/users', 'GroupsController@groupsUsersUpdate')->name('groups.users.update');

    Route::get('groups/{id}/roles', 'GroupsController@groupsRoles')->name('groups.roles');
    Route::put('groups/{id}/roles', 'GroupsController@groupsRolesUpdate')->name('groups.roles.update');

    Route::get('groups/{id}/locations', 'GroupsController@groupsLocations')->name('groups.locations');
/// Route::put('groups/{id}/locations',  'GroupsController@groupsLocationsUpdate')->name('groups.locations.update');

    /** @return List of modules authorized by selected group id */
    Route::get('roles/{id}/modules', 'RolesController@rolesModules')->name('roles.modules');
/// Route::put('groups/{id}/locations',  'GroupsController@groupsLocationsUpdate')->name('groups.locations.update');

    Route::get('roles/{id}/groups', 'RolesController@rolesGroups')->name('roles.groups');
/// Route::put('roles/{id}/groups', 'RolesController@rolesGroupsUpdate')->name('roles.groups.update');
    Route::get('roles/{id}/groupsnotin', 'RolesController@rolesGroupsNotIn')->name('roles.groupsnotin');
});

//Route::get('test', 'Modules\Administration\Http\Controllers\Api\V1\UsersController@test');
//Route::get('test', 'Modules\Administration\Http\Controllers\Api\V1\UsersController@testview');


/*
Route::namespace('Modules\Administration\Http\Controllers')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
    Route::resource('users', 'UsersController');
});
*/
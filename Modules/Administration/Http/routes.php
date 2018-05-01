<?php

Route::group([
    'middleware' => 'web',
    'prefix' => 'Administration',
    'namespace' => 'Modules\Administration\Http\Controllers'], function() {
            Route::resource('users', 'AdministrationController'); // TODO: Move to apiResource()
    }
);

Route::prefix('Administration')
     ->namespace('Modules\Administration\Http\Controllers')
     ->get('/test', 'Modules\Administration\Http\Controllers\AdministrationController@index');

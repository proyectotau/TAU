<?php

Route::group(['middleware' => 'web', 'prefix' => 'administration', 'namespace' => 'Modules\Administration\Http\Controllers'], function()
{
    Route::get('/', 'AdministrationController@index');
});

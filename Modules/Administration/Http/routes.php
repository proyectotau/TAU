<?php

use Modules\Administration\Http\Controllers\AdministrationController;

Route::group([
    'middleware' => 'web',
    'prefix' => 'Administration',
    'namespace' => 'Modules\Administration\Http\Controllers'], function() {
            Route::resource('users', 'AdministrationController');
    }
);

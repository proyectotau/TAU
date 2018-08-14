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

Route::get('/', function () {
    return view('welcome');
});
/*
Route::group(['prefix'     => 'log-viewer'], function() {
    Route::get('/', [
        'as'   => 'log-viewer::dashboard',
        'uses' => function(){
                    return 'log-viewer::dashboard';
        },
    ]);

    Route::group(['prefix' => 'logs',], function() {
        Route::get('/', [
            'as'   => 'log-viewer::logs.list',
            'uses' => function(){
                    return 'log-viewer/logs.list';
            },
        ]);
        Route::delete('delete', [
            'as'   => 'log-viewer::logs.delete',
            'uses' => function(){
                    return 'log-viewer::logs.delete';
            },
        ]);
    });
});
*/
/*Route::group([
        'middleware' => 'auth',
        'prefix'     => 'access',
        'namespace'  => 'Access',
        'as'         => 'como',
        'domain' => '{account}.myapp.com' ], function () {
            Route::get('/hola', function ()    {
                // Se usa Auth Middleware, el Prefijo Access, y el namespace Access
            });
});*/


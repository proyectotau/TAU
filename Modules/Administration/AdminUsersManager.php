<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 19/08/2018
 * Time: 14:49
 */

namespace Modules\Administration;

/*
 * This is Application Service for Users Administration Module
 *
 * Here comes from:
 *      Route/Controller
 *      Artisan Commands
 *      Programatically: $u = AdminUsersManager::store(['login'=>'login', 'name'=>'name', 'surname'=>'surname']);
 *      Queue
 *      Event handler
 */

class AdminUsersManager
{

    static public function index(array $middleware = []){
        return resolve('admin.commandbus')
            ->dispatch('Modules\Administration\Commands\IndexUser', [], $middleware); // TODO: Use array $data instead of []
    }

    static public function store(array $data, array $middleware = []){
        return resolve('admin.commandbus')
            ->dispatch('Modules\Administration\Commands\StoreUser', $data, $middleware);
    }

    static public function show(array $data, array $middleware = []){
        return resolve('admin.commandbus')
            ->dispatch('Modules\Administration\Commands\ShowUser', $data, $middleware);
    }

    static public function update(array $data, array $middleware = []){
        return resolve('admin.commandbus')
            ->dispatch('Modules\Administration\Commands\UpdateUser', $data, $middleware);
    }

    static public function destroy(array $data, array $middleware = []){
        return resolve('admin.commandbus')
            ->dispatch('Modules\Administration\Commands\DestroyUser', $data, $middleware);
    }
}
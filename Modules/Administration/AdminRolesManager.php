<?php

namespace Modules\Administration;

/*
 * This is Application Service for Roles Administration Module
 *
 * Here comes from:
 *      Route
 *      Controller
 *      Artisan Commands
 *      Programatically: $u = AdminUsersManager::store(['login'=>'login', 'name'=>'name', 'surname'=>'surname']);
 *      Queue
 *      Event handler
 *      others...
 */

class AdminRolesManager
{
    public static $response =  null;

    static public function index(array $data, array $middleware = []){
        static::$response = resolve('admin.commandbus')
            ->dispatch('Modules\Administration\Commands\IndexRole', $data, $middleware);
        return new static();
    }

    static public function store(array $data, array $middleware = []){
        static::$response = resolve('admin.commandbus')
            ->dispatch('Modules\Administration\Commands\StoreRole', $data, $middleware);
        return new static();
    }

    static public function show(array $data, array $middleware = []){
        static::$response = resolve('admin.commandbus')
            ->dispatch('Modules\Administration\Commands\ShowRole', $data, $middleware);
        return new static();
    }

    static public function update(array $data, array $middleware = []){
        static::$response = resolve('admin.commandbus')
            ->dispatch('Modules\Administration\Commands\UpdateRole', $data, $middleware);
        return new static();
    }

    static public function destroy(array $data, array $middleware = []){
        static::$response = resolve('admin.commandbus')
            ->dispatch('Modules\Administration\Commands\DestroyRole', $data, $middleware);
        return new static();
    }

    static public function test(mixed $data, array $middleware = []){
        static::$response = $data;
        return new static();
    }

    static public function toArray(){
        return (array)static::$response;
    }

    static public function toJson(){
        return json_encode(static::$response);
    }

    static public function toObject(){
        return (object)static::$response;
    }
}

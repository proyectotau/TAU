<?php
/**
 * Created by PhpStorm.
 * User: jagarsoft
 * Date: 09/12/2018
 * Time: 18:36
 */

namespace Modules\Administration;

/*
 * This is Application Service for Groups Administration Module
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

class AdminGroupsManager
{
    public static $response =  null;

    static public function index(array $data, array $middleware = []){
        static::$response = resolve('admin.commandbus')
            ->dispatch('Modules\Administration\Commands\IndexGroup', $data, $middleware);
        return new static();
    }

    static public function store(array $data, array $middleware = []){
        static::$response = resolve('admin.commandbus')
            ->dispatch('Modules\Administration\Commands\StoreGroup', $data, $middleware);
        return new static();
    }

    static public function show(array $data, array $middleware = []){
        static::$response = resolve('admin.commandbus')
            ->dispatch('Modules\Administration\Commands\ShowGroup', $data, $middleware);
        return new static();
    }

    static public function update(array $data, array $middleware = []){
        static::$response = resolve('admin.commandbus')
            ->dispatch('Modules\Administration\Commands\UpdateGroup', $data, $middleware);
        return new static();
    }

    static public function destroy(array $data, array $middleware = []){
        static::$response = resolve('admin.commandbus')
            ->dispatch('Modules\Administration\Commands\DestroyGroup', $data, $middleware);
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

<?php
/**
 * Created by PhpStorm.
 * User: jagarsoft
 * Date: 09/12/2018
 * Time: 18:36
 */

namespace Modules\Administration;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

/*
 * This is Application Service for Groups Administration Module
 *
 * Here comes from:
 *      Route
 *      Controller
 *      Artisan Commands
  *     Queue
 *      Event handler
 *      others...
 *      Programatically: $u = AdminUsersManager::store(['login'=>'login',
 *                                                      'name'=>'name',
 *                                                      'surname'=>'surname']);
 */

class AdminGroupsManager
{
    private static $response =  null;
    private static $jsonresponse = null;

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

    /*
     * Relations
     */

    static public function groupsUsers(array $data, array $middleware = []){
        static::$response = resolve('admin.commandbus')
            ->dispatch('Modules\Administration\Commands\GroupsUsers', $data, $middleware);
        return new static();
    }

    static public function groupsUsersNotIn(array $data, array $middleware = []){
        static::$response = resolve('admin.commandbus')
            ->dispatch('Modules\Administration\Commands\GroupsUsersNotIn', $data, $middleware);
        return new static();
    }

    static public function groupsUsersUpdate(array $data, array $middleware = []){
        static::$response = resolve('admin.commandbus')
            ->dispatch('Modules\Administration\Commands\GroupsUsersUpdate', $data, $middleware);
        return new static();
    }
    //

    static public function groupsRoles(array $data, array $middleware = []){
        static::$response = resolve('admin.commandbus')
            ->dispatch('Modules\Administration\Commands\GroupsRoles', $data, $middleware);
        return new static();
    }

    static public function groupsRolesNotIn(array $data, array $middleware = []){
        static::$response = resolve('admin.commandbus')
            ->dispatch('Modules\Administration\Commands\GroupsRolesNotIn', $data, $middleware);
        return new static();
    }

    static public function groupsRolesUpdate(array $data, array $middleware = []){
        static::$response = resolve('admin.commandbus')
            ->dispatch('Modules\Administration\Commands\GroupsRolesUpdate', $data, $middleware);
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
        static::$jsonresponse = new JsonResponse();
        static::$jsonresponse->setData(static::$response);
        return static::$jsonresponse;
    }

    static public function toObject(){
        return (object)static::$response;
    }
}

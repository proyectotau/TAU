<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 19/08/2018
 * Time: 14:49
 */

namespace Modules\Administration;

use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

/*
 * This is Application Service for Users Administration Module
 *
 * Here comes from:
 *      Route
 *      Controller
 *      Artisan Commands
 *      Queue
 *      Event handler
 *      others...
  *     Programatically: $u = AdminUsersManager::store(['login'=>'login', 'name'=>'name', 'surname'=>'surname']);
 */

class AdminUsersManager
{
    private static $response =  null;
    private static $jsonresponse = null;

    static public function index(array $data, array $middleware = []){
        static::$response = resolve('admin.commandbus')
            ->dispatch('Modules\Administration\Commands\IndexUser', $data, $middleware);
        return new static();
    }

    static public function store(array $data, array $middleware = []){
        static::$response = resolve('admin.commandbus')
            ->dispatch('Modules\Administration\Commands\StoreUser', $data, $middleware);
        return new static();
    }

    static public function show(array $data, array $middleware = []){
        //self::validateOrFails($data);
        static::$response = resolve('admin.commandbus')
            ->dispatch('Modules\Administration\Commands\ShowUser', $data, $middleware);
        return new static();
    }

    static public function update(array $data, array $middleware = []){
        static::$response = resolve('admin.commandbus')
            ->dispatch('Modules\Administration\Commands\UpdateUser', $data, $middleware);
        return new static();
    }

    static public function destroy(array $data, array $middleware = []){
        static::$response = resolve('admin.commandbus')
            ->dispatch('Modules\Administration\Commands\DestroyUser', $data, $middleware);
        return new static();
    }

    /*
     * Relations
     */

    static public function usersGroups(array $data, array $middleware = []){
        static::$response = resolve('admin.commandbus')
            ->dispatch('Modules\Administration\Commands\UsersGroups', $data, $middleware);
        return new static();
    }

    static public function usersGroupsNotIn(array $data, array $middleware = []){
        static::$response = resolve('admin.commandbus')
            ->dispatch('Modules\Administration\Commands\UsersGroupsNotIn', $data, $middleware);
        return new static();
    }

    static public function usersGroupsUpdate(array $data, array $middleware = []){
        static::$response = resolve('admin.commandbus')
            ->dispatch('Modules\Administration\Commands\UsersGroupsUpdate', $data, $middleware);
        return new static();
    }

    /*
     * Miscellaneous
     */

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

/*    private static function validateOrFails(array $data) // TODO
    {
        $value = $data['id'];
        if( ! (is_int($value) || ctype_digit($value)) )
            throw Symfony\Component\Debug\Exception\Thr
    }*/
}

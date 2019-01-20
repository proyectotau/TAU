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
 *      Route
 *      Controller
 *      Artisan Commands
 *      Programatically: $u = AdminUsersManager::store(['login'=>'login', 'name'=>'name', 'surname'=>'surname']);
 *      Queue
 *      Event handler
 *      others...
 */

class AdminUsersManager
{
    public static $response =  null;

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

/*    private static function validateOrFails(array $data) // TODO
    {
        $value = $data['id'];
        if( ! (is_int($value) || ctype_digit($value)) )
            throw Symfony\Component\Debug\Exception\Thr
    }*/
}

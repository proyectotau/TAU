<?php

use Modules\Administration\Entities\User;
use Modules\Administration\Entities\Group;
use Modules\Administration\Entities\Role;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(User::class, function (Faker\Generator $faker) {

    $x =$faker->numberBetween(1);
    //dd('u:'.$x);
    return [
        'ID_USUARIO' => $x,
        'USUARIO_RED' => $faker->userName,
        'NOMBRE' => $faker->firstName,
        'APELLIDOS' => $faker->lastName
    ];
});

$factory->define(Group::class, function (Faker\Generator $faker) {

    $x =$faker->numberBetween(1);
    //dd('g:'.$x);
    return [
        'ID_GRUPO' => $x,
        'NOMBRE' => $faker->word,
        'DESCRIPCION' => substr($faker->sentence,50)
    ];
});

$factory->define(Role::class, function (Faker\Generator $faker) {

    $x =$faker->numberBetween(1);
    //dd('g:'.$x);
    return [
        'ID_PERFIL' => $x,
        'Nombre' => $faker->word,
        'DESCRIPCION' => substr($faker->sentence,100)
    ];
});

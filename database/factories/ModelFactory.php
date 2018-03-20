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

    return [
        'ID_USUARIO' => $faker->numberBetween(1),
        'USUARIO_RED' => $faker->unique()->userName,
        'NOMBRE' => $faker->firstName,
        'APELLIDOS' => $faker->lastName
    ];
});

$factory->define(Group::class, function (Faker\Generator $faker) {

    return [
        'ID_GRUPO' => $faker->numberBetween(1),
        'NOMBRE' => $faker->unique()->word,
        'DESCRIPCION' => substr($faker->sentence,0,50)
    ];
});

$factory->define(Role::class, function (Faker\Generator $faker) {

    return [
        'ID_PERFIL' => $faker->numberBetween(1),
        'Nombre' => $faker->unique()->word,
        'DESCRIPCION' => substr($faker->sentence,0,100)
    ];
});

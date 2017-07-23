<?php

use Modules\Administration\Entities\User;
use Modules\Administration\Entities\Group;

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
        'ID_USUARIO' => $faker->numberBetween(1), // TODO: must be autoincrement
        'USUARIO_RED' => $faker->userName,
        'NOMBRE' => $faker->name,
        'APELLIDOS' => $faker->lastName
    ];

});

$factory->define(Group::class, function (Faker\Generator $faker) {

    return [
        'ID_GRUPO' => $faker->numberBetween(1), // TODO: must be autoincrement
        'NOMBRE' => $faker->word,
        'DESCRIPCION' => substr($faker->sentence,50)
    ];

});

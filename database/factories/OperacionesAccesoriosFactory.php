<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\OperacionAccesorio;

$factory->define(OperacionAccesorio::class, function (Faker $faker) {
    return [
        //
        'operacion_id' => $faker->numberBetween($min = 1, $max = 100),
        'accesorio_id' => $faker->numberBetween($min = 1, $max = 4),
    ];
});

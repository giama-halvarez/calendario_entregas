<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;
use App\Operacion;

$factory->define(Operacion::class, function (Faker $faker) {
    //$faker = Faker\Factory::create('es_ES');
    return [
        'chasis' => $faker->md5,
        'tipo_operacion' => $faker->numberBetween($min = 1, $max = 2),
        'nro_preventa' => $faker->unique()->randomNumber($nbDigits = NULL, $strict = false),
        'grupo' => $faker->numberBetween($min = 1000, $max = 9000),
        'orden' => $faker->numberBetween($min = 1, $max = 168),
        'marca_id' => $faker->numberBetween($min = 1, $max = 2),
        'modelo' => 'MODELO XXX ' . $faker->numberBetween($min = 1, $max = 5),
        'color' => $faker->randomElement(['blanco', 'negro', 'rojo', 'azul', 'amarillo']),
        'vin' => $faker->md5,
        'nombre' => $faker->firstName,
        'apellido' => $faker->lastName,
        'telefono1' => $faker->phoneNumber,
        'telefono2' => $faker->phoneNumber,
        'telefono3' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'semaforo' => $faker->numberBetween($min = 0, $max = 2),
        'fecha_calendario_entrega' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now'),
        'sede_entrega_id' => $faker->numberBetween($min = 1, $max = 2),
    ];
});

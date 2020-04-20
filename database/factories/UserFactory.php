<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;

$factory->define(User::class, function (Faker $faker) {
    return [
        'identificacion' => $faker->randomNumber($nbDigits = 9, $strict = false),
        'nombre' => $faker->name,
        'apellidos' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'acreditado' => 1
    ];
});

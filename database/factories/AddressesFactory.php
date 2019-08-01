<?php

use Faker\Generator as Faker;
use App\Address;

/* @var $factory \Illuminate\Database\Eloquent\Factory */

$factory->define(App\Address::class, function (Faker $faker) {
    return [
        'surname' => $faker->lastName,
        'phone' => $faker->phoneNumber,
    ];
});

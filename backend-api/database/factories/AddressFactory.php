<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Address::class, function (Faker $faker) {

    return [
        'street' => $faker->streetAddress,
        'suite' => $faker->streetName,
        'city' => $faker->city,
        'zipcode' => $faker->postcode,
        'geo_lat' => $faker->randomFloat(4),
        'geo_lng' => $faker->randomFloat(4)
    ];
});
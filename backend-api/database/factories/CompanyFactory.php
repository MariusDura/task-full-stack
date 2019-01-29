<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Company::class, function (Faker $faker) {

    return [
        'name' => $faker->text(35),
        'catch_phrase' => $faker->text(35),
        'bs' => $faker->text(35)
    ];
});
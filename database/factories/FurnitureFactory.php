<?php

use App\Furniture;
use Faker\Generator as Faker;

$factory->define(Furniture::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'description' => $faker->sentence,
    ];
});

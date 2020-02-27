<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Products;
use Faker\Generator as Faker;

$factory->define(Products::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->name,
        'quantity' => $faker->numberBetween(5, 100),

    ];
});

<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Suppliers;
use Faker\Generator as Faker;

$factory->define(Suppliers::class, function (Faker $faker) {
    return [
        'name' => $faker->name,

    ];
});

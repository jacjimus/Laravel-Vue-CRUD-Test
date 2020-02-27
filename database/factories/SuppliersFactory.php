<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Orders;
use Faker\Generator as Faker;

$factory->define(Orders::class, function (Faker $faker) {
    return [
        'order_number' => $faker->numberBetween(1000 , 9999999),

    ];
});

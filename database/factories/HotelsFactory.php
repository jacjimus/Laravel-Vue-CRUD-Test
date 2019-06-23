<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Hotels;
use Faker\Generator as Faker;

$factory->define(Hotels::class, function (Faker $faker) {
    return [
        'name' => $faker->text(50),
        'address' => $faker->address(100),
        'city' => $faker->city(50),
        'state' => $faker->text(100),
        'country' => $faker->country(40),
        'zip' => $faker->numberBetween(1000 , 9000),
        'phone_number' => $faker->phoneNumber(12),
        'email' => $faker->companyEmail(100),
        'image' => $faker->imageUrl(100),
    ];
});

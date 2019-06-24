<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Hotels;
use Faker\Generator as Faker;

$factory->define(Hotels::class, function (Faker $faker) {
    return [
        'name' => $faker->domainName(50),
        'address' => $faker->address(100),
        'city' => $faker->city(50),
        'state' => $faker->text(10),
        'country' => $faker->country(40),
        'zip' => $faker->numberBetween(1000 , 9000),
        'phone_number' => $faker->phoneNumber(15),
        'email' => $faker->companyEmail(100),
        'image' => $faker->image('public/images/'),
    ];
});

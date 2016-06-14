<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => Hash::make('password'),
        'date_of_birth' => $faker->date(),
        'gender' => $faker->randomElement(['Male','Female']),
        'active' => TRUE
    ];
});


$factory->define(App\Business::class, function (Faker\Generator $faker) {
    $types = ["Retail", "Services", "Retail and Services"];

    return [
        'name' => $faker->name,
        'address' => $faker->address,
        'city' => $faker->city,
        'state' => $faker->state,
        'zip_code' => $faker->postcode,
        'type' => $faker->randomElement($types),
        'active' => TRUE
    ];
});


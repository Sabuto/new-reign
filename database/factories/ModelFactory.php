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

$factory->define(App\User::class, function ($faker) {
    return [
        'name' => $faker->userName,
        'email' => $faker->email,
        'password' => Hash::make('frepper'),
        'remember_token' => str_random(10),
        'state_id' => str_random(1),
        'gender_id' => str_random(1),
        'crimeTime' => $faker->dateTime,
        'travelTime' => $faker->dateTime,
        'rank_id' => str_random(1),
        'cashHand' => $faker->randomNumber,
        'cashBank' => $faker->randomNumber,
    ];
});
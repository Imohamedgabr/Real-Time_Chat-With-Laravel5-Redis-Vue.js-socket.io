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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Message::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'user_id' => $faker->numberBetween($min = 7, $max = 10),
        'receiver_id' =>  $faker->numberBetween($min = 7, $max = 10) ,
        'content' => $faker->word,
    ];
});

// randomDigit // 7
// randomDigitNotNull // 5
// randomNumber($nbDigits = NULL) // 79907610
// randomFloat($nbMaxDecimals = NULL, $min = 0, $max = NULL) // 48.8932
// numberBetween($min = 1000, $max = 9000) // 8567
// randomLetter // 'b'
// randomElements($array = array ('a','b','c'), $count = 1) // array('c')
// randomElement($array = array ('a','b','c')) // 'b'
// numerify($string = '###') // '609'
// lexify($string = '????') // 'wgts'
// bothify($string = '## ??') // '42 jz'

//to create a message  factory('App\Message',20)->create();
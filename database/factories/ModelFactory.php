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
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'nickname' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Article::class, function (Faker\Generator $faker) {

    return [
        'user_id' => $faker->numberBetween(1,2),
        'type' => $faker->numberBetween(1,2),
        'category_id' => $faker->numberBetween(1,6),
        'title' => $faker->title,
        'cover' => '/img/default' . $faker->numberBetween(1,4) . '.jpg',
        'intro' => $faker->text,
        'view' => $faker->randomNumber,
        'comment' => $faker->randomNumber,
    ];
});

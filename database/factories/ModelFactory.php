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
$factory->define(App\Quiz::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence(4),
        'author' => $faker->name,
        'completions' => $faker->numberBetween(0, 100),
    ];
});

$factory->define(App\Question::class, function (Faker\Generator $faker) {
    return [
        'body' => $faker->sentence(10),
        'quiz_id' => $faker->numberBetween(1, 5),
        'answer_a' => $faker->sentence(10),
        'answer_b' => $faker->sentence(10),
        'answer_c' => $faker->sentence(10),
        'answer_d' => $faker->sentence(10),
        'correct_answer' => 'a'
    ];
});

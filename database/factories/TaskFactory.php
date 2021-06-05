<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3),
        'preview' => $faker->sentence(10),
        'text' => $faker->text(255),
        'file' => null,
        'status' => rand(1, 3),
    ];
});

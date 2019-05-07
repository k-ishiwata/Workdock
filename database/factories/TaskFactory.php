<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    return [
        'title' => $faker->realText($faker->numberBetween(15,40)),
        'status_id' => $faker->numberBetween(1, 4),
        'priority_id' => $faker->numberBetween(1, 3),
        'user_id' => $faker->numberBetween(1, 2),
//        'price' => $faker->numberBetween($min = 600, $max = 4000),
//        'due_at' => $faker->dateTime($max = 'now', $timezone = date_default_timezone_get()),
        // ランダムでnull
        'due_at' => $faker->boolean(20) ? $faker->dateTimeBetween($startDate = 'now', $endDate = '+ 20 days') : null,
    ];
});

//dateTimeBetween($startDate = 'now', $endDate = '+ 20 days', $timezone = null)

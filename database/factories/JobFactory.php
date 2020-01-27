<?php

use Carbon\Carbon;
use App\Models\Job;
use Faker\Generator as Faker;

$factory->define(Job::class, function (Faker $faker) {
    return [
        "title" => $faker->sentence,
        "slogan" => $faker->sentence,
        "problem" => $faker->paragraph(5, true),
        "description" => $faker->paragraph(10, true),
        "starts_at" => Carbon::now()->format("Y-m-d"),
        "ends_at" => Carbon::now()->addQuarter()->format("Y-m-d")
    ];
});
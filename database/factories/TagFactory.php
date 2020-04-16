<?php

use Carbon\Carbon;
use Tessify\Core\Models\Tag;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker) {
    return [
        "name" => $faker->word,
    ];
});
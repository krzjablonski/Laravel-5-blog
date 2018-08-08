<?php

use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(6),
        'body' => $faker->paragraphs(rand(2, 10), true)
    ];
});

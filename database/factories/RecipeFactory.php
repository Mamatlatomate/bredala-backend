<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Recipe;
use Faker\Generator as Faker;

$factory->define(Recipe::class, function (Faker $faker) {
    return [
        'title' => ucfirst($faker->words(4, true)),
        'body',
        'ingredients',
        'utensils',
        'image',
        'duration'   => $faker->randomNumber(0).' '.$faker->randomElement(['heures', 'minutes']),
        'difficulty' => $faker->randomElement(['Facile', 'Moyen', 'Difficile']),
        'price'      => $faker->randomNumber(0).'€',
        'quantity'   => $faker->randomNumber(0).' biscuits',
        'advice'     => $faker->sentence,
    ];
});

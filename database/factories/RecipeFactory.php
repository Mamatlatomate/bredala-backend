<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Recipe;
use Faker\Generator as Faker;

$factory->define(Recipe::class, function (Faker $faker) {
    return [
        'title'        => ucfirst($faker->words(4, true)),
        'body'         => $faker->paragraphs(9, true),
        'duration'     => $faker->numberBetween(1, 10).' '.$faker->randomElement(['heures', 'minutes']),
        'difficulty'   => $faker->randomElement(['Facile', 'Moyenne', 'Difficile']),
        'price'        => $faker->numberBetween(1, 50).' €',
        'quantity'     => $faker->numberBetween(1, 50).' biscuits',
        'advice'       => $faker->sentence,
    ];
});

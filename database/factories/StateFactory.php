<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use SavyCon\Models\State;
use Faker\Generator as Faker;

$factory->define(State::class, function (Faker $faker) {
    return [
        'name' => $faker->state(),
    ];
});

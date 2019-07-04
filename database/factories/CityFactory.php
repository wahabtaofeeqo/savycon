<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use SavyCon\Models\City;
use Faker\Generator as Faker;

$factory->define(City::class, function (Faker $faker) {
    return [
        'name' => $faker->city,
        'state_id' => function () {
            return factory(SavyCon\Models\State::class)->create()->id;
        }
    ];
});

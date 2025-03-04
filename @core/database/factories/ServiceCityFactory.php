<?php

namespace Database\Factories;

use App\Country;
use App\ServiceCity;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceCityFactory extends Factory
{
    protected $model = ServiceCity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'service_city' => $this->faker->name,
            'status' => 1,
            'country_id' => Country::inRandomOrder()->first()->id,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Country;
use App\ServiceCity;
use App\ServiceArea;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\ServiceArea>
 */
class ServiceAreaFactory extends Factory
{
    protected $model = ServiceArea::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'status' => 1,
            'service_area' => $this->faker->name,
            'country_id' => Country::inRandomOrder()->first()->id,
            'service_city_id' => ServiceCity::inRandomOrder()->first()->id,
        ];
    }
}
